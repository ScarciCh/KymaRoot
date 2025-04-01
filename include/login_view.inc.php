<?php
// Modulo per la visualizzazione degli errori Login a schermo
declare(strict_types=1);

/**
 * Controlla se ci sono errori di login nella sessione e li mostra a schermo.
 * Dopo averli mostrati, rimuove gli errori dalla sessione.
 */
function check_login_errors()
{
    if(isset($_SESSION["error_login"]))
    {
        $errors = $_SESSION["error_login"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["error_login"]);
    }
    // Se il login ha avuto successo, reindirizza alla home
    else if (isset($_GET['login']) && $_GET['login'] === "success")
    {
        header("Location: home.php");
        die();
    }
}

/**
 * Controlla e visualizza eventuali errori di autorizzazione.
 * Dopo averli mostrati, rimuove gli errori dalla sessione.
 */
function check_auth_errors()
{
    if(isset($_SESSION["auth_errors"]))
    {
        $errors = $_SESSION["auth_errors"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["auth_errors"]);
    }
}

/**
 * Controlla e visualizza eventuali errori di sessione.
 * Dopo averli mostrati, rimuove gli errori dalla sessione.
 */
function check_session_errors()
{
    if(isset($_SESSION["session_error"]))
    {
        $errors = $_SESSION["session_error"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["session_error"]);
    }
}

/**
 * Controlla e visualizza eventuali errori nel cambio password.
 * Dopo averli mostrati, rimuove gli errori dalla sessione.
 */
function check_passCh_errors()
{
    if(isset($_SESSION["passCh_error"]))
    {
        $errors = $_SESSION["passCh_error"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["passCh_error"]);
    }
}

/**
 * Stampa il nome utente se la sessione è attiva, altrimenti mostra un messaggio di sessione scaduta.
 */
function output_username()
{
    if(isset($_SESSION["user_id"]))
    {
        echo $_SESSION["user_username"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

/**
 * Stampa l'ID del privilegio dell'utente se la sessione è attiva, altrimenti mostra un messaggio di sessione scaduta.
 */
function output_privilege_id()
{
    if(isset($_SESSION["user_privilege"]))
    {
        echo $_SESSION["user_privilege"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

/**
 * Stampa il nome del privilegio dell'utente se la sessione è attiva, altrimenti mostra un messaggio di sessione scaduta.
 */
function output_privilege_name()
{
    if(isset($_SESSION["user_privilege_name"]))
    {
        echo $_SESSION["user_privilege_name"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

/**
 * Stampa il nome della famiglia dell'utente se la sessione è attiva, altrimenti mostra "Nessuna Famiglia".
 */
function output_famiglia()
{
    if(isset($_SESSION["user_family_name"]))
    {
        echo $_SESSION["user_family_name"];
    }
    else
    {
        echo "Nessuna Famiglia";
    }
}

?>
