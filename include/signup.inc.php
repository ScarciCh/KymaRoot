<?php

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];

        try
        {
            require_once 'dbh.inc.php';
            require_once 'signup_model.inc.php';
            require_once 'signup_contr.inc.php';

            $errors = [];

            if(is_input_empty($username, $pwd))
            {
                $errors["empty_input"] = "I campi richiesti sono vuoti!";
            }
            if(is_username_taken($pdo, $username))
            {
                $errors["invalid_username"] = "Il nome utente é gia in uso.";
            }

            require_once 'config_session.inc.php';

            if($errors)
            {
                $_SESSION["error_signup"] = $errors;
                header("Location: ../index_signup.php");
                die();
            }

            create_user($pdo, $username, $pwd);

            header("Location: ../index.php?signup=success");
            
            $pdo = null;
            $stmt = null;
            
            die();
        }
        catch(PDOException $e)
        {
            die("Query fallita" . $e->getMessage());
        }
    }
    else
    {
        header("Location: ../index.php");
        die();
    }

?>