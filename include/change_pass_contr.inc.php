<?php
// Modulo di verifica errori per il Cambio Password
declare(strict_types=1);

// Funzione che verifica se uno dei campi della password è vuoto
// Parametri:
// - $oldPass: stringa contenente la vecchia password
// - $newPass1: stringa contenente la nuova password
// - $newPass2: stringa contenente la conferma della nuova password
// Restituisce:
// - true se almeno uno dei campi è vuoto
// - false se tutti i campi sono compilati
function is_input_empty(string $oldPass, string $newPass1, string $newPass2)
{
    if (empty($oldPass) || empty($newPass1) || empty($newPass2)) {
        return true;
    } else {
        return false;
    }
}

// Funzione che verifica se la vecchia password inserita è errata
// Parametri:
// - $pwd: stringa contenente la password inserita dall'utente
// - $hashPwd: stringa contenente l'hash della password memorizzata nel database
// Restituisce:
// - true se la password non corrisponde all'hash salvato
// - false se la password è corretta
function is_password_wrong(string $pwd, string $hashPwd)
{
    if (!password_verify($pwd, $hashPwd)) {
        return true;
    } else {
        return false;
    }
}

// Funzione che verifica se le due nuove password inserite coincidono
// Parametri:
// - $pwd1: stringa contenente la prima nuova password
// - $pwd2: stringa contenente la seconda nuova password (conferma)
// Restituisce:
// - true se le due password sono diverse
// - false se le password coincidono
function are_password_diff(string $pwd1, string $pwd2)
{
    if ($pwd1 !== $pwd2) {
        return true;
    } else {
        return false;
    }
}

?>
