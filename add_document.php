<?php
    session_start();
    require_once "include/auth.inc.php";
    require_once "include/dbh.inc.php";

    if(!isset($_SESSION["user_id"]))
    {
        header("Location: index.php");
        $_SESSION["session_error"] = "Sessione scaduta";
        die();
    }

    if (user_not_auth("add_document"))
    {
        header("Location: not_auth.html");
        die();
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root | Aggiungi Documento</title>
    </head>

    <body>
        <h3>Stai aggiungendo documento</h3>

        <form action="include/add_document.inc.php" method="post">
            <table>
            <tr>
            <tr>
                    <tr>
                        <th>
                            <label>Tipologia:</label>
                            <input type="text" name="txtTipologia" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Oggetto:</label>
                            <input type="text" name="txtOggetto" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Validita:</label>
                            <input type="date" name="txtValidita" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Numero:</label>
                            <input type="number" name="txtNumero" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Firma:</label>
                            <input type="text" name="txtFirma" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Data:</label>
                            <input type="date" name="txtData" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Link:</label>
                            <input type="url" name="txtLink" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Destinatari:</label><br>
                            <?php
            
                                $query = "SELECT idFamiglia, nomeFamiglia FROM famigliaUtente";        
                                $result = mysqli_query($pdo_sqli, $query);
                                $resultCheck = mysqli_num_rows($result);
                                
                                if($resultCheck>0)
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<input required name='chkDestinatari[]' type='checkbox' value=". $row["idFamiglia"] . ">". $row["nomeFamiglia"] ."</input><br>";
                                    }
                                }
                            ?>
                        </th>
                    </tr>
            </tr>
            </table>

            <input type="submit" value="Aggiungi">
            <input type="button" onclick=history.back() value="Torna Indietro">
        </form>
    </body>
</html>