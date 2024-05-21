<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <script type="type/javascript" src="scripts/login.js"></script>
    </head>

    <body>
        <form action="controllo.php" method="post">
            <h2>Inserire i dati</h2>

            <fieldset>
                <legend>Login</legend>

                <label>Nome Utente</label>
                <input type="text" name="nomeUtente" id="txtUtente">

                <label>Password</label>
                <input type="password" name="password" id="txtPassword">
            </fieldset>

            <span class="buttons">
                <input type="submit" id="bSubmit" value="Accedi">
            </span>
        </form>
    </body>
</html>