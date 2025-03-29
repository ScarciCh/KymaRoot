<?php

declare(strict_types=1);

function get_user(object $pdo, string $username)
{
    $query = "SELECT * FROM utente U JOIN categoriaUtente C ON U.tipologiaUtente = C.idCategoria JOIN famigliaUtente F ON U.famigliaUtente = F.idFamiglia WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


?>