<?php
// Modulo di modifica Famiglia Utenti

// Disabilita la visualizzazione degli errori per evitare output indesiderati
ini_set('display_errors', 0);

require_once "dbh.inc.php"; // Inclusione del modulo di connessione al database

// Verifica che la richiesta provenga da un form con metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dei dati inviati dal form
    $idFamiglia = $_POST["txtId"]; // ID della famiglia utente
    $nomeFamiglia = $_POST["txtName"]; // Nome della famiglia utente
    $delete = $_POST["chDelete"]; // Flag per l'eliminazione della famiglia

    if (!empty($delete)) {
        // Query per eliminare la famiglia utente dal database
        $query = "DELETE FROM Famigliautente WHERE idFamiglia = '".$idFamiglia."'"; 
        mysqli_query($pdo_sqli, $query);

        // Messaggio di conferma per l'eliminazione della famiglia utente
        echo "Famiglia eliminata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    } 
    else {
        // Query per aggiornare il nome della famiglia utente
        $query = "UPDATE Famigliautente SET nomeFamiglia = '".$nomeFamiglia."' WHERE idFamiglia = '".$idFamiglia."'";
        mysqli_query($pdo_sqli, $query);

        // Messaggio di conferma per la modifica della famiglia utente
        echo "Modifica effettuata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
    }
} 
else {
    // Se l'accesso non è avvenuto tramite POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}
?>
