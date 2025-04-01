<?php
// Modulo che restituisce i dati utente per il Login dal Database
declare(strict_types=1);

/**
 * Recupera i dati dell'utente dal database in base all'username.
 *
 * @param object $pdo Connessione al database tramite PDO
 * @param string $username Nome utente da cercare nel database
 * @return array|false Restituisce un array con i dati dell'utente se trovato, altrimenti false
 */
function get_user(object $pdo, string $username)
{
    // Query per selezionare i dati dell'utente, includendo informazioni sulla categoria e la famiglia di appartenenza
    $query = "SELECT * FROM utente U 
              JOIN categoriaUtente C ON U.tipologiaUtente = C.idCategoria 
              JOIN famigliaUtente F ON U.famigliaUtente = F.idFamiglia 
              WHERE username = :username;";

    // Prepara la query per prevenire SQL injection
    $stmt = $pdo->prepare($query);
    
    // Associa il valore dell'username al parametro della query
    $stmt->bindParam(":username", $username);
    
    // Esegue la query
    $stmt->execute();

    // Recupera il risultato come array associativo
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
?>
