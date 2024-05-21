<?php
    $connessione = mysqli_connect($db_host, $db_user, $db_password);
    if (!$connessione)
    {
        //print("<h3>Connessione al server MySQL fallita. ERRORE: ".MySqli_Error()."</h3>");
        exit();
    }

    $selezione_db = mysqli_select_db($connessione, $db_name);
    if (!$selezione_db)
    {
        //print("<h3>Connessione al Database fallita. ERRORE: ".MySqli_Error()."</h3>");
        exit();
    }
?>
