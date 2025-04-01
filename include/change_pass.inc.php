<?php
// Modulo per la ricezione dei dati inerenti alla nuova password ed eventuale controllo degli errori

// Verifica che la richiesta provenga da un form con metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dei dati inviati dal form
    $username = $_POST["txtUsername"]; // Nome utente
    $oldPass = $_POST["txtPassOld"]; // Vecchia password
    $newPass1 = $_POST["txtPass1"]; // Nuova password
    $newPass2 = $_POST["txtPass2"]; // Conferma della nuova password

    try {
        // Inclusione dei file necessari per la gestione della sessione, il database e le funzioni di controllo
        require_once 'dbh.inc.php'; // Connessione al database
        require_once 'change_pass_model.inc.php'; // Modulo per la gestione delle query di cambio password
        require_once 'change_pass_contr.inc.php'; // Modulo per la validazione delle password
        require_once 'config_session.inc.php'; // Configurazione della sessione utente

        $errors = []; // Array per memorizzare eventuali errori

        // Controllo se uno dei campi è vuoto
        if (is_input_empty($oldPass, $newPass1, $newPass2)) {
            $errors["empty_input"] = "I campi richiesti sono vuoti!";
        }

        // Recupero della password hashata dell'utente dal database
        $result = get_password($pdo, $username);

        // Controllo se la vecchia password inserita è errata
        if (is_password_wrong($oldPass, $result["pwd"])) {
            $errors["login_incorrect"] = "Password errata.";
        }

        // Controllo se le nuove password non coincidono
        if (are_password_diff($newPass1, $newPass2)) {
            $errors["login_incorrect"] = "Le password non corrispondono";
        }

        // Se ci sono errori, vengono salvati nella sessione e l'utente viene reindirizzato alla pagina del profilo
        if ($errors) {
            $_SESSION["passCh_error"] = $errors;
            header("Location: ../profile.php");
            die();
        }

        // Se non ci sono errori, aggiorna la password nel database
        set_new_pass($pdo, $username, $newPass1);

        // Reindirizza l'utente alla home dopo il cambio password
        header("Location: ../index.php");
        die();
    }
    catch (PDOException $e) {
        // In caso di errore nella query, termina lo script e mostra il messaggio di errore
        die("Query fallita: " . $e->getMessage());
    }
} else {
    // Se l'accesso non è avvenuto tramite POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}

?>
