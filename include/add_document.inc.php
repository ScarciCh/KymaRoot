<?php
require_once "dbh.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $tipo = $_POST["txtTipologia"];
    $oggetto = $_POST["txtOggetto"];
    $validita = $_POST["txtValidita"];
    $numero = $_POST["txtNumero"];
    $firma = $_POST["txtFirma"];
    $data = $_POST["txtData"];
    $link = $_POST["txtLink"];
    $destinatari = $_POST["chkDestinatari"];

    //AGGIUNTA DATI DOCUMENTO
    $query =
    "
        INSERT INTO Documento(tipologiaDocumento, oggettoDocumento, validitaDocumento, numeroDocumento,
        firmaDocumento, dataDocumento, linkDocumento) VALUES ('".$tipo."', '".$oggetto."', '".$validita."',
        '".$numero."', '".$firma."', '".$data."', '".$link."');"
    ;        
    mysqli_query($pdo_sqli, $query);

    //INSERIMENTO NUOVE ASSOCIAZIONI
    $stmt = $pdo->prepare("INSERT INTO Associazione(documento, destinatario) VALUES ('".mysqli_insert_id($pdo_sqli)."', :s)");

    if (!$stmt) {
        die("Preparazione query fallita: " . $conn->error);
    }

    foreach ($destinatari as $value) {
        $stmt->bindParam("s", $value);
        $stmt->execute();
    }

    echo "Documento aggiunto con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
}
else
{
    header("Location: ../index.php");
    die();
}
?>