<?php
// Modulo di controllo degli errori per il Login
declare(strict_types=1);

/**
 * Controlla se i campi di input del login sono vuoti.
 *
 * @param string $username Nome utente inserito
 * @param string $pwd Password inserita
 * @return bool True se almeno uno dei campi è vuoto, altrimenti False
 */
function is_input_empty(string $username, string $pwd)
{
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Controlla se l'username esiste nel database.
 *
 * @param bool|array $result Risultato della query al database (false se non trovato, array se trovato)
 * @return bool True se l'username non esiste, altrimenti False
 */
function is_username_wrong(bool|array $result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

/**
 * Controlla se la password inserita corrisponde a quella salvata nel database.
 *
 * @param string $pwd Password inserita dall'utente
 * @param string $hashPwd Hash della password memorizzata nel database
 * @return bool True se la password è errata, altrimenti False
 */
function is_password_wrong(string $pwd, string $hashPwd)
{
    if (!password_verify($pwd, $hashPwd)) {
        return true;
    } else {
        return false;
    }
}

?>
