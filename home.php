<?php
session_start();
require_once "include/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root | Home</title>
    </head>

    <body>
        <h3>Benvenuto alla Home</h3>

        <form action="include/logout.inc.php" method="post">
            <div><?php output_username() ?> &#9660 <br> Tipologia Utente: <br><b><?php output_privilege_id() ?>. <?php output_privilege_name() ?></b><br></div>
            <a href="profile.php">Profilo</a> <br>
            <a href="#" onclick="this.closest('form').submit();return false;">Logout</a>
        </form>
        
        <br> <!-- Sezione Utenti -->

        <a href="bacheca.php">Bacheca</a> <br>
        
        <br> <!-- Sezione Admin -->

        <a href="lista_utenti.php">Gestisci Utenti</a> <br>

        <?php
        check_login_errors();
        ?>
    </body>
</html>