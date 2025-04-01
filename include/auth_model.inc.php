<?php

declare(strict_types=1); // Abilita il controllo rigoroso dei tipi di dati

// Funzione che restituisce i privilegi di un determinato utente dal Database
// Parametri:
// - $pdo: oggetto PDO per la connessione al database
// - $username: stringa contenente il nome utente di cui recuperare i privilegi
// Ritorna:
// - Un array associativo con i privilegi dell'utente (tipologiaUtente e nomeCategoria) se trovato, altrimenti null
function get_user_privilege(object $pdo, string $username)
{
    // Query per ottenere la tipologia e la categoria dell'utente
    $query = "SELECT tipologiaUtente, nomeCategoria 
              FROM utente U 
              JOIN CategoriaUtente C ON U.tipologiaUtente = C.idCategoria 
              WHERE username = :username;";
    
    // Preparazione della query SQL
    $stmt = $pdo->prepare($query);
    
    // Associazione del valore del parametro alla query
    $stmt->bindParam(":username", $username);
    
    // Esecuzione della query
    $stmt->execute();

    // Recupero del risultato della query come array associativo
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Restituzione dei privilegi dell'utente
    return $result;
}

?>
