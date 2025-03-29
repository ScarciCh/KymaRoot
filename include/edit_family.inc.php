<?php
ini_set('display_errors', 0);

require_once "dbh.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $idFamiglia = $_POST["txtId"];
    $nomeFamiglia = $_POST["txtName"];
    $delete = $_POST["chDelete"];

    if(!empty($delete))
    {
        $query = "DELETE FROM Famigliautente WHERE idFamiglia = '".$idFamiglia."'"; 
        mysqli_query($pdo_sqli, $query);

        echo "Famiglia eliminata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    }
    else
    {
        $query = "UPDATE Famigliautente SET nomeFamiglia = '".$nomeFamiglia."' WHERE idFamiglia = '".$idFamiglia."'";
        mysqli_query($pdo_sqli, $query);

        echo "Modifica effettuata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    }

    
}
else
{
    header("Location: ../index.php");
    die();
}
?>