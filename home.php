<?php
session_start();
require_once "include/login_view.inc.php";
//require_once "include/auth.inc.php";
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
            <div><?php output_username() ?> &#9660</div>
            <a href="#">Profilo</a> <br>
            <a href="#" onclick="this.closest('form').submit();return false;">Logout</a>
        </form>    
    </body>
</html>