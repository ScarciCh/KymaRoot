<?php
// Modulo per il Login Utente nel Database

// Controlla che la richiesta provenga da un modulo inviato tramite metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupera i dati inviati dal form
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {
        // Inclusione dei file necessari per la connessione al database e le funzioni di controllo
        require_once 'dbh.inc.php'; // Connessione al database
        require_once 'login_model.inc.php'; // Funzione per recuperare l'utente
        require_once 'login_contr.inc.php'; // Funzioni di verifica input

        // Array per raccogliere eventuali errori
        $errors = [];

        // Controlla se uno dei campi è vuoto
        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "I campi richiesti sono vuoti!";
        }

        // Recupera i dati dell'utente dal database in base allo username
        $result = get_user($pdo, $username);

        // Controlla se lo username esiste nel database
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Username o Password errati.";
        }
        // Se lo username esiste, verifica se la password è corretta
        elseif (is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Username o Password errati.";
        }

        // Se ci sono errori, salva i messaggi in sessione e reindirizza alla pagina di login
        require_once 'config_session.inc.php'; // Avvia o riprende la sessione
        if ($errors) {
            $_SESSION["error_login"] = $errors;
            header("Location: ../index_login.php");
            exit();
        }

        // Creazione di un nuovo ID di sessione per prevenire attacchi di session fixation
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["idUtente"];
        session_id($sessionId);

        // Memorizza le informazioni dell'utente nella sessione
        $_SESSION["user_id"] = $result["idUtente"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION['user_privilege'] = htmlspecialchars($result['tipologiaUtente']);
        $_SESSION['user_privilege_name'] = htmlspecialchars($result['nomeCategoria']);
        
        // Controlla se l'utente appartiene a una famiglia e salva l'informazione nella sessione
        if (!empty($result['famigliaUtente'])) {
            $_SESSION['user_family'] = htmlspecialchars($result['famigliaUtente']);
            $_SESSION['user_family_name'] = htmlspecialchars($result['nomeFamiglia']);
        }
        
        // Registra il timestamp dell'ultima rigenerazione della sessione
        $_SESSION["last_regeneration"] = time();

        // Reindirizza l'utente alla homepage con un messaggio di successo
        header("Location: ../index.php?login=success");
        
        // Chiude la connessione al database
        $pdo = null;
        
        exit();
    }
    catch (PDOException $e) {
        // In caso di errore con il database, interrompe l'esecuzione e mostra il messaggio di errore
        die("Query fallita" . $e->getMessage());
    }
} else {
    // Se la richiesta non è di tipo POST, reindirizza l'utente alla homepage
    header("Location: ../index.php");
    exit();
}
?>
