<?php

require_once 'include/signup_view.inc.php';
require_once 'include/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root</title>
    </head>

    <body>
        <h3>Benvenuto</h3>

        <input type="button" value="Accedi" onclick="location.href='index_login.php'">
        <br>
        <input type="button" value="Registrati" onclick="location.href='index_signup.php'">
    </body>

    <?php
    check_signup_errors();
    check_login_errors();
    ?>

</html>