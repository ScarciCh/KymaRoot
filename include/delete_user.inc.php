<?php
// Modulo di eliminazione utente
require_once "dbh.inc.php"; // Inclusione del modulo di connessione al database

// Verifica che la richiesta provenga da un form con metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recupero dell'ID dell'utente da eliminare
    $idUtente = $_POST["txtId"];

    // Query per aggiornare la tipologia e la famiglia dell'utente
    // (Le variabili $categoria e $famiglia non sono definite in questo codice)
    $query = "UPDATE Utente SET tipologiaUtente = '".$categoria."', famigliaUtente = '".$famiglia."' WHERE idUtente = '".$idUtente."'"; 
    
    // Esecuzione della query sul database
    mysqli_query($pdo_sqli, $query);

    // Messaggio di conferma e link per tornare alla gestione utenti
    echo "Modifica effettuata con successo! <br> <a href='../lista_utenti.php'>Torna alla gestione utente...</a>";
} 
else {
    // Se l'accesso non è avvenuto tramite POST, reindirizza alla home
    header("Location: ../index.php");
    die();
}
?>
