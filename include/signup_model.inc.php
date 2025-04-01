<?php
//Modulo che restituisce i dati per la Registrazione Utente
declare(strict_types=1);

// Funzione che verifica se un determinato username esiste già nel database.
// Esegue una query per cercare l'username nella tabella "Utente" e restituisce i dati se esiste, altrimenti null.
function get_username(object $pdo, string $username)
{
    // Preparazione della query SQL per cercare lo username nel database
    $query = "SELECT username FROM Utente WHERE username = :username;";
    $stmt = $pdo->prepare($query);

    // Bind del parametro :username con il valore passato alla funzione
    $stmt->bindParam(":username", $username);
    
    // Esecuzione della query
    $stmt->execute();

    // Recupero del risultato come array associativo
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ritorna il risultato della query (l'array se esiste, null se non trovato)
    return $result;
}

// Funzione che inserisce un nuovo utente nel database con un username e una password.
// La password viene hashata per sicurezza prima dell'inserimento.
function set_user(object $pdo, string $username, string $pwd)
{
    // Preparazione della query SQL per inserire un nuovo utente nel database
    $query = "INSERT INTO Utente (username, pwd) VALUES (:username, :pwd);";
    $stmt = $pdo->prepare($query);
    
    // Impostazione delle opzioni per la funzione password_hash
    $options = [
        'cost' => 12 // Costo del lavoro di hashing (maggiore è il numero, maggiore è la sicurezza)
    ];

    // Hash della password usando l'algoritmo bcrypt
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    // Bind dei parametri :username e :pwd con i valori passati alla funzione
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    
    // Esecuzione della query per inserire l'utente nel database
    $stmt->execute();

    // Recupero del risultato (anche se non utilizzato, può essere utile per il debug o altre operazioni)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ritorna il risultato della query
    return $result;
}

?>
