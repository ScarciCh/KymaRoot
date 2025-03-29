<?php

declare(strict_types=1);

function get_password(object $pdo, string $username)
{
    $query = "SELECT pwd FROM Utente WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_new_pass(object $pdo, string $username, string $pwd)
{
    $query = "UPDATE Utente SET pwd = :pwd WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    
    $options =
    [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

?>