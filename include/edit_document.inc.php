<?php
require_once "dbh.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $id = $_POST["txtId"];
    $tipo = $_POST["txtTipologia"];
    $oggetto = $_POST["txtOggetto"];
    $validita = $_POST["txtValidita"];
    $numero = $_POST["txtNumero"];
    $firma = $_POST["txtFirma"];
    $data = $_POST["txtData"];
    $link = $_POST["txtLink"];
    $destinatari = $_POST["chkDestinatari"];
    $delete = $_POST["chDelete"];

    if(!empty($delete))
    {
        //UPDATE DATI DOCUMENTO
        $query =
        "
            UPDATE Documento SET tipologiaDocumento = '".$tipo."', oggettoDocumento = '".$oggetto."', 
            validitaDocumento = '".$validita."', numeroDocumento = '".$numero."', firmaDocumento = '".$firma."',
            dataDocumento = '".$data."', linkDocumento = '".$link."' WHERE idDocumento = ".$id
        ;        
        mysqli_query($pdo_sqli, $query);

        //ELIMINAZIONE ASSOCIAZIONI OBSOLETE
        $query =
        "
            DELETE FROM Associazione WHERE documento = '".$id."' ;
        ";        
        mysqli_query($pdo_sqli, $query);

        //INSERIMENTO NUOVE ASSOCIAZIONI
        $stmt = $pdo->prepare("INSERT INTO Associazione(documento, destinatario) VALUES ('".$id."', :s)");

        if (!$stmt) {
            die("Preparazione query fallita: " . $conn->error);
        }

        foreach ($destinatari as $value) {
            $stmt->bindParam("s", $value);
            $stmt->execute();
        }

        echo "Modifica effettuata con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
    }
    else
    {
        $query =
        "
            DELETE FROM Associazione WHERE documento = '".$id."' ;
            DELETE FROM Documento WHERE idDocumento = '".$id."' ;   
        ";        
        mysqli_query($pdo_sqli, $query);

        echo "Documento Eliminato con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
    }
}
else
{
    header("Location: ../index.php");
    die();
}
?>