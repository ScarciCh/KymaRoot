<?php
// Modulo per la modifica di un utente da parte di un Admin

// Disabilita la visualizzazione degli errori per evitare output indesiderati
ini_set('display_errors', 0);

require_once "dbh.inc.php"; // Inclusione del modulo di connessione al database

// Verifica che la richiesta provenga da un form con metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dei dati inviati dal form
    $idUtente = $_POST["txtId"]; // ID dell'utente da modificare
    $categoria = $_POST["slCategoria"]; // Nuova categoria dell'utente
    $famiglia = $_POST["slFamiglia"]; // Nuova famiglia di appartenenza dell'utente
    $delete = $_POST["chDelete"]; // Flag per l'eliminazione dell'utente

    if (!empty($delete)) {
        // Query per eliminare l'utente dal database
        $query = "DELETE FROM Utente WHERE idUtente = '".$idUtente."'"; 
        mysqli_query($pdo_sqli, $query);

        // Messaggio di conferma per l'eliminazione dell'utente
        echo "Utente eliminato con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    } 
    else {
        // Query per aggiornare i dati dell'utente nel database
        $query = "UPDATE Utente 
                  SET tipologiaUtente = '".$categoria."', 
                      famigliaUtente = '".$famiglia."' 
                  WHERE idUtente = '".$idUtente."'"; 
        mysqli_query($pdo_sqli, $query);

        // Messaggio di conferma per la modifica dell'utente
        echo "Modifica effettuata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    }
} 
else {
    // Se l'accesso non è avvenuto tramite POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}
?>
