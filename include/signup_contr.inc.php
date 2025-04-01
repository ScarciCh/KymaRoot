<?php
//Modulo di controllo degli errori per la Registrazione Utente
declare(strict_types=1);

// Funzione che verifica se uno o entrambi i campi (username e password) sono vuoti.
// Restituisce "true" se uno dei campi è vuoto, altrimenti "false".
function is_input_empty(string $username, string $pwd)
{
    if(empty($username) || empty($pwd))
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Funzione che verifica se un determinato username è già presente nel database.
// Se il nome utente esiste già, restituisce "true", altrimenti "false".
function is_username_taken(object $pdo, string $username)
{
    if(get_username($pdo, $username))
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Funzione che crea un nuovo utente nel database, 
// chiamando una funzione separata per inserire i dati dell'utente (username e password).
function create_user(object $pdo, string $username, string $pwd)
{
    set_user($pdo, $username, $pwd);
}

?>
