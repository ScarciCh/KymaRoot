<?php
//Modulo per la visualizzazione degli errori Registrazione Utente a schermo
declare(strict_types=1);

// Funzione per visualizzare gli errori di registrazione dell'utente
// Controlla se ci sono errori di registrazione nella sessione e li mostra a schermo.
function check_signup_errors()
{
    // Verifica se ci sono errori di registrazione salvati nella sessione
    if(isset($_SESSION["error_signup"]))
    {
        // Recupera gli errori dalla sessione
        $errors = $_SESSION["error_signup"];
        echo "<br>";

        // Cicla su ogni errore e lo visualizza
        foreach($errors as $error)
        {
            // Mostra ogni errore con un'apposita classe CSS per formattare l'errore
            echo '<p class=form-error>' . $error . '</p>';
        }

        // Pulisce la sessione da questi errori una volta mostrati
        unset($_SESSION["error_signup"]);
    }
    // Se la registrazione è stata completata con successo, visualizza un messaggio di successo
    else if (isset($_GET['signup']) && $_GET['signup'] === "success")
    {
        echo "<br>";
        // Mostra un messaggio di successo con una classe CSS per formattarlo
        echo '<p class=form-success>Registrazione effettuata!</p>';
    }
}
?>
