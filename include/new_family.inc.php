<?php

require_once "dbh.inc.php";
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $fName = $_POST["txtNewFamily"];

    //AGGIUNTA FAMIGLIA
    $query ="INSERT INTO famigliautente(nomeFamiglia) VALUES('".$fName."')";      
    mysqli_query($pdo_sqli, $query);

    echo "Nuova famiglia creata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utenti...</a>";
}
else
{
    header("Location: ../index.php");
    die();
}
?>
