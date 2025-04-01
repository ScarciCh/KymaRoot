<?php
// Modulo per la preparazione della query per il cambio Password
declare(strict_types=1);

// Funzione che recupera la password hashata di un utente dal database
// Parametri:
// - $pdo: oggetto PDO per la connessione al database
// - $username: stringa contenente il nome utente
// Restituisce:
// - Un array associativo contenente la password hashata dell'utente, se trovato
// - false se l'utente non esiste
function get_password(object $pdo, string $username)
{
    // Query per selezionare la password dell'utente
    $query = "SELECT pwd FROM Utente WHERE username = :username;";
    
    // Preparazione della query
    $stmt = $pdo->prepare($query);
    
    // Associazione del parametro username
    $stmt->bindParam(":username", $username);
    
    // Esecuzione della query
    $stmt->execute();

    // Recupero del risultato della query
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Restituzione del risultato
    return $result;
}

// Funzione che aggiorna la password di un utente nel database
// Parametri:
// - $pdo: oggetto PDO per la connessione al database
// - $username: stringa contenente il nome utente
// - $pwd: stringa contenente la nuova password in chiaro
// Restituisce:
// - Il risultato dell'operazione di aggiornamento
function set_new_pass(object $pdo, string $username, string $pwd)
{
    // Query per aggiornare la password dell'utente
    $query = "UPDATE Utente SET pwd = :pwd WHERE username = :username;";
    
    // Preparazione della query
    $stmt = $pdo->prepare($query);
    
    // Definizione delle opzioni per l'hashing della password
    $options = [
        'cost' => 12 // Imposta il costo dell'algoritmo bcrypt per una maggiore sicurezza
    ];

    // Generazione dell'hash della nuova password
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    // Associazione dei parametri alla query
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    
    // Esecuzione della query
    $stmt->execute();

    // Recupero del risultato della query
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Restituzione del risultato
    return $result;
}

?>
