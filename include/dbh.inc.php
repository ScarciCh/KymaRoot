<?php
// Modulo di collegamento al Database principale in locale

// Definizione delle credenziali di accesso al database
$host = 'localhost';       // Indirizzo del server database
$dbname = 'KymaRoot_db';   // Nome del database
$dbusername = 'root';      // Nome utente del database
$dbpassword = '';          // Password del database (vuota per impostazione predefinita in ambiente locale)

try {
    // Creazione di un'istanza PDO per la connessione al database MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    
    // Imposta la modalità di errore di PDO per generare eccezioni in caso di problemi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connessione alternativa con MySQLi (utilizzata in alcune parti del codice)
    $pdo_sqli = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
} 
catch (PDOException $e) {
    // Se la connessione fallisce, interrompe l'esecuzione dello script e mostra un messaggio di errore
    die("Connessione fallita: " . $e->getMessage());
}
?>
