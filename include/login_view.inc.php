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

function output_username()
{
    if(isset($_SESSION["user_id"]))
    {
        echo "Utente: " . $_SESSION["user_username"];
    }
    else
    {
        echo "Sessione scaduta.";
    }
}

?>