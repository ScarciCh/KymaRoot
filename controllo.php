<!DOCTYPE html>
<html>
    <head>
        <title>Controllo Password</title>
    </head>

    <body>
        <?php
            ini_set('display_errors', 1);

            //session_regenerate_id(true);
            session_start();

            /*if (isset($_SESSION['session_id'])) {
                header('Location: home.php');
                exit;
            }*/

            require "config/config.php";

            if (isset($_POST['login']))
            {
                $username = $_POST["nomeUtente"] ?? '';
                $password = $_POST["password"] ?? '';

                if (empty($username) || empty($password))
                {
                    $msg = 'Inserisci username e password %s';
                } 
                else 
                {
                    $query = "SELECT username, password FROM utente WHERE username = :username";
                        
                    $check = $pdo->prepare($query);
                    $check->bindParam(':username', $username, PDO::PARAM_STR);
                    $check->execute();
                        
                    $user = $check->fetch(PDO::FETCH_ASSOC);
                        
                    if (!$user || $password !== $user['password'])
                    {
                        $msg = 'Credenziali utente errate %s';
                    }
                    else
                    {
                        session_regenerate_id();
                        $_SESSION['session_id'] = session_id();
                        $_SESSION['session_user'] = $user['username'];
                        
                        header('Location: home.php');
                        exit;
                    }
                }
                    
                printf($msg, '<a href="login.html">torna indietro</a>');
            }
        ?>
    </body>
</html>