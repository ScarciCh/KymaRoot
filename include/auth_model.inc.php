<?php

declare(strict_types=1);

function get_user_privilege(object $pdo, string $username)
{
    $query = "SELECT tipologiaUtente, nomeCategoria FROM utente U JOIN CategoriaUtente C ON U.tipologiaUtente = C.idCategoria WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

?>