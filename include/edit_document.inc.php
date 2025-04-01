<?php
// Modulo di modifica documento
require_once "dbh.inc.php"; // Inclusione del modulo di connessione al database

// Verifica che la richiesta provenga da un form con metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dei dati inviati dal form
    $id = $_POST["txtId"]; // ID del documento
    $tipo = $_POST["txtTipologia"]; // Tipologia del documento
    $oggetto = $_POST["txtOggetto"]; // Oggetto del documento
    $validita = $_POST["txtValidita"]; // Validità del documento
    $numero = $_POST["txtNumero"]; // Numero del documento
    $firma = $_POST["txtFirma"]; // Firma del documento
    $data = $_POST["txtData"]; // Data del documento
    $link = $_POST["txtLink"]; // Link del documento
    $destinatari = $_POST["chkDestinatari"]; // Destinatari del documento
    $delete = $_POST["chDelete"]; // Flag per la cancellazione del documento

    if (!empty($delete)) {
        // Aggiornamento dei dati del documento nel database
        $query =
        "
            UPDATE Documento 
            SET tipologiaDocumento = '".$tipo."', oggettoDocumento = '".$oggetto."', 
                validitaDocumento = '".$validita."', numeroDocumento = '".$numero."', 
                firmaDocumento = '".$firma."', dataDocumento = '".$data."', linkDocumento = '".$link."' 
            WHERE idDocumento = ".$id
        ;        
        mysqli_query($pdo_sqli, $query);

        // Eliminazione delle associazioni obsolete tra documento e destinatari
        $query =
        "
            DELETE FROM Associazione WHERE documento = '".$id."' ;
        ";        
        mysqli_query($pdo_sqli, $query);

        // Inserimento delle nuove associazioni
        $stmt = $pdo->prepare("INSERT INTO Associazione(documento, destinatario) VALUES ('".$id."', :s)");

        // Verifica che la preparazione della query sia avvenuta con successo
        if (!$stmt) {
            die("Preparazione query fallita: " . $conn->error);
        }

        // Esecuzione della query per ogni destinatario selezionato
        foreach ($destinatari as $value) {
            $stmt->bindParam("s", $value);
            $stmt->execute();
        }

        // Messaggio di conferma per la modifica del documento
        echo "Modifica effettuata con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
    } 
    else {
        // Eliminazione delle associazioni legate al documento
        $query =
        "
            DELETE FROM Associazione WHERE documento = '".$id."' ;
            DELETE FROM Documento WHERE idDocumento = '".$id."' ;   
        ";        
        mysqli_query($pdo_sqli, $query);

        // Messaggio di conferma per l'eliminazione del documento
        echo "Documento eliminato con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
    }
} 
else {
    // Se l'accesso non è avvenuto tramite POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}
?>
