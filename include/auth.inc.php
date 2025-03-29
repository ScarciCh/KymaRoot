<?php

declare(strict_types=1);

function user_not_auth(string $page)
{
    if($page === "bacheca")
    {
        if($_SESSION["user_privilege"] === "1")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    if($page === "edit_document")
    {
        if($_SESSION["user_privilege"] !== "3")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    if($page === "add_document")
    {
        if($_SESSION["user_privilege"] !== "3")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    if($page === "edit_user")
    {
        if($_SESSION["user_privilege"] !== "3")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>