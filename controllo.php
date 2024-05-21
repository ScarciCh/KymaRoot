<!DOCTYPE html>
<html>
    <head>
        <title>Controllo Password</title>
    </head>

    <body>
        <?php
            ini_set('display_errors', 0);

            require "com/config.php";
            require "com/connect.php";

            $nomeUtente = trim($_POST["nomeUtente"]);
            $password = trim($_POST["password"]);

            $query = "SELECT * FROM utente WHERE username = '$nomeUtente' AND password = '$password'";
            $riga_letta = mysqli_query($connessione, $query);

            if(!$riga_letta)
            {
                header("Location: login.html?error=Dati errati");
                exit("Dati Errati");
            }
            else
            {
                if (mysqli_num_rows($riga_letta) === 1)
                {
                    $righe = mysqli_fetch_assoc($riga_letta);
                    
                    if($righe['username']===$nomeUtente && $righe['password']===$password)
                    {
                        echo("Dati corretti!");
                    }
                }
            }
        ?>
    </body>
</html>