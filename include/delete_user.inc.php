<?php
require_once "dbh.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $idUtente = $_POST["txtId"];

    $query = "UPDATE Utente SET tipologiaUtente = '".$categoria."', famigliaUtente = '".$famiglia."' WHERE idUtente = '".$idUtente."'"; 
    mysqli_query($pdo_sqli, $query);

    echo "Modifica effettuata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
}
else
{
    header("Location: ../index.php");
    die();
}
?>