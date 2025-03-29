<?php
session_start();
require_once "include/login_view.inc.php";
require_once "include/dbh.inc.php";

if(!isset($_SESSION["user_id"]))
{
    header("Location: index.php");
    $_SESSION["session_error"] = "Sessione scaduta";
    die();
}
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root | Profilo</title>
    </head>

    <body>
        <h3>Gestione Profilo Utente</h3>

        <p>Nome <?php echo output_username() ?></p>
        <p>Tipologia Utente: <br><b><?php output_privilege_id() ?>. <?php output_privilege_name() ?></p>
        <p>Famiglia: <?php echo output_famiglia() ?></p>

        <form action="include/change_pass.inc.php" method="post">
            <h4>Modifica Password</h4>

            <label>Password Attuale<label>
            <input type=text name="txtUsername" readonly value=<?php echo output_username() ?>> <br>

            <label>Password Attuale<label>
            <input type=password name="txtPassOld"> <br>

            <label>Nuova Password<label>
            <input type=password name="txtPass1"> <br>

            <label>Ripeti Nuova Password<label>
            <input type=password name="txtPass2"> <br>

            <input type="submit" value="Applica">
        </form>

        <input type="button" onclick=history.back() value="Torna Indietro">

        <?php check_passCh_errors() ?>
    </body>
</html>