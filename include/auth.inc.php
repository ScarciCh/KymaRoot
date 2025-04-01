<?php
// Modulo di gestione delle autorizzazioni
declare(strict_types=1);

// Funzione che verifica se un utente NON è autorizzato ad accedere a una determinata pagina
// Parametri:
// - $page: stringa che rappresenta la pagina a cui si sta tentando di accedere
// Restituisce:
// - true se l'utente NON è autorizzato ad accedere alla pagina
// - false se l'utente è autorizzato
function user_not_auth(string $page)
{
    // Controllo delle autorizzazioni per la pagina "bacheca"
    if ($page === "bacheca") {
        if ($_SESSION["user_privilege"] === "1") { // Se il privilegio è "1", l'utente non è autorizzato
            return true;
        } else {
            return false;
        }
    }

    // Controllo delle autorizzazioni per la modifica di documenti
    if ($page === "edit_document") {
        if ($_SESSION["user_privilege"] !== "3") { // Solo gli utenti con privilegio "3" sono autorizzati
            return true;
        } else {
            return false;
        }
    }

    // Controllo delle autorizzazioni per l'aggiunta di documenti
    if ($page === "add_document") {
        if ($_SESSION["user_privilege"] !== "3") { // Solo gli utenti con privilegio "3" sono autorizzati
            return true;
        } else {
            return false;
        }
    }

    // Controllo delle autorizzazioni per la modifica degli utenti
    if ($page === "edit_user") {
        if ($_SESSION["user_privilege"] !== "3") { // Solo gli utenti con privilegio "3" sono autorizzati
            return true;
        } else {
            return false;
        }
    }
}

?>
