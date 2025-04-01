<?php

require_once 'include/config_session.inc.php';
require_once 'include/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root | Login</title>
    </head>

    <body>
        <!-- Una volta completata il login il modulo "login.inc.php" gestirá la richiesta-->
        <form action="include/login.inc.php" method="post">
            <h3>Accedi</h3>

            <label>Username</label>
            <input type="text" name="username">
            <br>
            
            <label>Password</label>
            <input type="password" name="pwd">
            <br>

            <input type="submit" value="Accedi">
        </form>

        <p><a href="index.php">Torna indietro...</a></p>

        <?php
		check_login_errors();
		?>
    </body>
</html>