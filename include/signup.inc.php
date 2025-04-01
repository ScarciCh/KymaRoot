<?php
//Modulo per la Registrazione Utente nel Database

// Solo se proviene da una richiesta POST
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    // Recupera i dati inviati tramite il modulo di registrazione
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try
    {
        // Include i moduli necessari per la gestione della connessione al database e le funzioni
        require_once 'dbh.inc.php'; // Connessione al database
        require_once 'signup_model.inc.php'; // Modello per la gestione dell'utente
        require_once 'signup_contr.inc.php'; // Funzioni di controllo e creazione utente

        // Array per raccogliere eventuali errori
        $errors = [];

        // Controlla se i campi sono vuoti
        if(is_input_empty($username, $pwd))
        {
            $errors["empty_input"] = "I campi richiesti sono vuoti!";
        }

        // Verifica se il nome utente è già stato preso
        if(is_username_taken($pdo, $username))
        {
            $errors["invalid_username"] = "Il nome utente è già in uso.";
        }

        // Se ci sono errori, li salva nella sessione e reindirizza alla pagina di registrazione
        require_once 'config_session.inc.php';

        if($errors)
        {
            $_SESSION["error_signup"] = $errors; // Memorizza gli errori nella sessione
            header("Location: ../index_signup.php"); // Ritorna alla pagina di registrazione con gli errori
            die();
        }

        // Se non ci sono errori, crea il nuovo utente nel database
        create_user($pdo, $username, $pwd);

        // Reindirizza alla pagina principale con il messaggio di successo
        header("Location: ../index.php?signup=success");
        
        // Termina lo script per evitare ulteriori esecuzioni
        $pdo = null;
        $stmt = null;
        
        die();
    }
    catch(PDOException $e)
    {
        // Gestisce eventuali errori del database
        die("Query fallita: " . $e->getMessage());
    }
}
else
{
    // Se la richiesta non proviene da un modulo POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}
?>