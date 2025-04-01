<?php

// Imposta l'uso esclusivo dei cookie per la gestione della sessione (evita attacchi di session fixation)
ini_set('session.use_only_cookies', 1);

// Abilita la modalità rigorosa della sessione (impedisce l'uso di sessioni non esistenti)
ini_set('session.use_strict_mode', 1);

// Configura i parametri del cookie di sessione
session_set_cookie_params([
    'lifetime' => 1800,  // Durata della sessione in secondi (30 minuti)
    'domain' => 'localhost',  // Dominio valido per il cookie (modificare in produzione)
    'path' => '/',  // Percorso in cui il cookie è valido
    'secure' => true,  // Permette l'invio del cookie solo su connessioni HTTPS
    'httponly' => true  // Impedisce l'accesso al cookie tramite JavaScript (migliora la sicurezza)
]);

// Avvia la sessione
session_start();

// Verifica se l'utente è autenticato controllando l'esistenza della variabile di sessione "user_id"
if (isset($_SESSION["user_id"])) {
    // Controlla se la sessione è stata rigenerata almeno una volta
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin(); // Rigenera la sessione per aumentare la sicurezza
    } else {
        $interval = 60 * 30; // Intervallo di rigenerazione (30 minuti)
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin(); // Rigenera la sessione dopo l'intervallo
        }
    }
} else {
    // Gestione per utenti non autenticati
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id(); // Rigenera la sessione per gli utenti ospiti
    } else {
        $interval = 60 * 30; // Intervallo di rigenerazione (30 minuti)
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id(); // Rigenera la sessione dopo l'intervallo
        }
    }
}

/**
 * Funzione per rigenerare l'ID di sessione per utenti non autenticati.
 * - Rigenera l'ID di sessione in modo sicuro
 * - Aggiorna il timestamp dell'ultima rigenerazione
 */
function regenerate_session_id()
{
    session_regenerate_id(true); // Crea un nuovo ID di sessione ed elimina quello precedente
    $_SESSION["last_regeneration"] = time(); // Registra il momento della rigenerazione
}

/**
 * Funzione per rigenerare l'ID di sessione per utenti autenticati.
 * - Rigenera l'ID di sessione
 * - Crea un nuovo ID sessione con un identificativo unico basato sull'ID utente
 * - Imposta il nuovo ID di sessione e aggiorna il timestamp della rigenerazione
 */
function regenerate_session_id_loggedin()
{
    session_regenerate_id(true); // Crea un nuovo ID di sessione ed elimina quello precedente

    $userId = $_SESSION["user_id"]; // Ottiene l'ID dell'utente autenticato
    $newSessionId = session_create_id(); // Genera un nuovo ID di sessione univoco
    $sessionId = $newSessionId . "_" . $userId; // Crea un nuovo ID di sessione associato all'utente
    session_id($sessionId); // Imposta il nuovo ID di sessione

    $_SESSION["last_regeneration"] = time(); // Registra il momento della rigenerazione
}

?>
