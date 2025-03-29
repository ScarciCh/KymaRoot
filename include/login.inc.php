<?php

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try
    {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];

        
        if(is_input_empty($username, $pwd))
        {
            $errors["empty_input"] = "I campi richiesti sono vuoti!";
        }

        $result = get_user($pdo, $username);

        if(is_username_wrong($result))
        {
            $errors["login_incorrect"] = "Username o Password errati.";
        }
        if(!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"]))
        {
            $errors["login_incorrect"] = "Username o Password errati.";
        }

        require_once 'config_session.inc.php';

        if($errors)
        {
            $_SESSION["error_login"] = $errors;

            header("Location: ../index_login.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["idUtente"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["idUtente"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION['user_privilege'] = htmlspecialchars($result['tipologiaUtente']);
        $_SESSION['user_privilege_name'] = htmlspecialchars($result['nomeCategoria']);
        if(!empty($result['famigliaUtente']))
        {
            $_SESSION['user_family'] = htmlspecialchars($result['famigliaUtente']);
            $_SESSION['user_family_name'] = htmlspecialchars($result['nomeFamiglia']);
        }
        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php?login=success");
        
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