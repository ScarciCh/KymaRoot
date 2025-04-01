<?php
// Modulo per l'aggiunta di un documento
require_once "dbh.inc.php"; // Inclusione del file per la connessione al database

// Verifica che la richiesta sia di tipo POST prima di procedere
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dei dati inviati dal form tramite il metodo POST
    $tipo = $_POST["txtTipologia"]; // Tipologia del documento
    $oggetto = $_POST["txtOggetto"]; // Oggetto del documento
    $validita = $_POST["txtValidita"]; // Periodo di validità del documento
    $numero = $_POST["txtNumero"]; // Numero identificativo del documento
    $firma = $_POST["txtFirma"]; // Nome di chi ha firmato il documento
    $data = $_POST["txtData"]; // Data del documento
    $link = $_POST["txtLink"]; // Link di riferimento al documento
    $destinatari = $_POST["chkDestinatari"]; // Elenco dei destinatari selezionati

    // Creazione della query per inserire il documento nel database
    $query = "
        INSERT INTO Documento (tipologiaDocumento, oggettoDocumento, validitaDocumento, numeroDocumento, 
        firmaDocumento, dataDocumento, linkDocumento) 
        VALUES ('".$tipo."', '".$oggetto."', '".$validita."', '".$numero."', '".$firma."', '".$data."', '".$link."');
    ";

    // Esecuzione della query di inserimento del documento
    mysqli_query($pdo_sqli, $query);

    // Recupera l'ID dell'ultimo documento inserito per associarlo ai destinatari
    $lastInsertedId = mysqli_insert_id($pdo_sqli);

    // Preparazione della query per inserire le associazioni documento-destinatario
    $stmt = $pdo->prepare("INSERT INTO Associazione (documento, destinatario) VALUES (:documento, :destinatario)");

    // Verifica che la preparazione della query abbia avuto successo
    if (!$stmt) {
        die("Preparazione query fallita: " . $pdo->errorInfo()[2]);
    }

    // Ciclo attraverso l'elenco dei destinatari selezionati
    foreach ($destinatari as $value) {
        $stmt->bindParam(":documento", $lastInsertedId); // Associa l'ID del documento
        $stmt->bindParam(":destinatario", $value); // Associa l'ID del destinatario
        $stmt->execute(); // Esegue l'inserimento nel database
    }

    // Messaggio di conferma per l'utente e link per tornare alla bacheca
    echo "Documento aggiunto con successo! <br> <a href='../bacheca.php'>Torna alla bacheca...</a>";
} else {
    // Se la richiesta non è di tipo POST, reindirizza alla pagina principale
    header("Location: ../index.php");
    die();
}
?>
