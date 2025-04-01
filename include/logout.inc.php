<?php
// Avvia la sessione per poter accedere e modificare le variabili di sessione attuali.
session_start(); 

// Rimuove tutte le variabili di sessione attualmente impostate, senza distruggere la sessione.
session_unset();

// Distrugge completamente la sessione eliminando tutti i dati associati.
session_destroy();

// Reindirizza l'utente alla pagina principale (index.php) dopo il logout.
// "die()" termina l'esecuzione dello script per evitare l'esecuzione di codice non necessario.
header("Location: ../index.php");
die();
?>
