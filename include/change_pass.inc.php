<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    
    $username = $_POST["txtUsername"];
    $oldPass = $_POST["txtPassOld"];
    $newPass1 = $_POST["txtPass1"];
    $newPass2 = $_POST["txtPass2"];

    try
    {
        require_once 'dbh.inc.php';
        require_once 'change_pass_model.inc.php';
        require_once 'change_pass_contr.inc.php';
        require_once 'config_session.inc.php';

        $errors = [];

        if(is_input_empty($oldPass, $newPass1, $newPass2))
        {
            $errors["empty_input"] = "I campi richiesti sono vuoti!";
        }


        $result = get_password($pdo, $username);

        if(is_password_wrong($oldPass, $result["pwd"]))
        {
            $errors["login_incorrect"] = "Password errata.";
        }
        if(are_password_diff($newPass1, $newPass2))
        {
            $errors["login_incorrect"] = "Le password non corrispondono";
        }

        

        if($errors)
        {
            $_SESSION["passCh_error"] = $errors;

            header("Location: ../profile.php");
            die();
        }

        set_new_pass($pdo, $username, $newPass1);
        header("Location: ../index.php");
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