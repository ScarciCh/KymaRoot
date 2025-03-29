<?php

declare(strict_types=1);

function check_login_errors()
{
    if(isset($_SESSION["error_login"]))
    {
        $errors = $_SESSION["error_login"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["error_login"]);
    }
    else if (isset($_GET['login']) && $_GET['login'] === "success")
    {
        header("Location: home.php");
        die();
    }
}

function check_auth_errors()
{
    if(isset($_SESSION["auth_errors"]))
    {
        $errors = $_SESSION["auth_errors"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["auth_errors"]);
    }
}

function check_session_errors()
{
    if(isset($_SESSION["session_error"]))
    {
        $errors = $_SESSION["session_error"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["auth_errors"]);
    }
}

function check_passCh_errors()
{
    if(isset($_SESSION["passCh_error"]))
    {
        $errors = $_SESSION["passCh_error"];
        echo "<br>";

        foreach($errors as $error)
        {
            echo '<p class=form-error>' . $error . '</p>';
        }

        unset($_SESSION["passCh_error"]);
    }
}

function output_username()
{
    if(isset($_SESSION["user_id"]))
    {
        echo $_SESSION["user_username"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

function output_privilege_id()
{
    if(isset($_SESSION["user_privilege"]))
    {
        echo $_SESSION["user_privilege"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

function output_privilege_name()
{
    if(isset($_SESSION["user_privilege_name"]))
    {
        echo $_SESSION["user_privilege_name"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

function output_famiglia()
{
    if(isset($_SESSION["user_family_name"]))
    {
        echo $_SESSION["user_family_name"];
    }
    else
    {
        echo "Nessuna Famiglia";
    }
}

?>