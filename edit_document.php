<?php

if(!empty($_GET["id"]))
{
    session_start();
    require_once "include/auth.inc.php";
    require_once "include/dbh.inc.php";

    if(!isset($_SESSION["user_id"]))
    {
        header("Location: index.php");
        $_SESSION["session_error"] = "Sessione scaduta";
        die();
    }

    if (user_not_auth("edit_document"))
    {
        header("Location: not_auth.html");
        die();
    }
}
else
{
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, iniatial scale=1.0">
        <title>Kyma Root | Modifica Documento</title>
    </head>

    <body>
        <h3>Stai modificando il documento</h3>

        <table border=1>

        <tr>
                <th><b>Id</b></th>
                <th><b>Tipologia</b></th>
                <th><b>Oggetto</b></th>
                <th><b>Validita</b></th>
                <th><b>Numero</b></th>
                <th><b>Firma</b></th>
                <th><b>Data</b></th>
                <th><b>Link</b></th>
        </tr>

        <?php
            
            $query = "SELECT * FROM Documento D JOIN Associazione A ON D.idDocumento = A.documento JOIN FamigliaUtente F ON A.destinatario = F.idFamiglia JOIN Utente U ON U.famigliaUtente = F.idFamiglia WHERE D.idDocumento = ". $_GET["id"];        
            $result = mysqli_query($pdo_sqli, $query);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row["idDocumento"] . "</td>";
                    echo "<td>" . $row["tipologiaDocumento"] . "</td>";
                    echo "<td>" . $row["oggettoDocumento"] . "</td>";
                    echo "<td>" . $row["validitaDocumento"] . "</td>";
                    echo "<td>" . $row["numeroDocumento"] . "</td>";
                    echo "<td>" . $row["firmaDocumento"] . "</td>";
                    echo "<td>" . $row["dataDocumento"] . "</td>";
                    echo "<td>" . $row["linkDocumento"] . "</td>";
                    echo "</tr>";
                }
            }
        ?>

        </table>

        <form action="include/edit_document.inc.php" method="post">
            <table>
            <tr>
            <tr>
                    <th>
                            <label>Id:</label>
                            <input type="text" name="txtId" value="<?php echo $_GET['id'] ?>" required readonly>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Tipologia:</label>
                            <input type="text" name="txtTipologia" id="txtTipologia" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Oggetto:</label>
                            <input type="text" name="txtOggetto" id="txtOggetto" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Validita:</label>
                            <input type="date" name="txtValidita" id="txtValidita" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Numero:</label>
                            <input type="number" name="txtNumero" id="txtNumero" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Firma:</label>
                            <input type="text" name="txtFirma" id="txtFirma" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Data:</label>
                            <input type="date" name="txtData" id="txtData" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Link:</label>
                            <input type="url" name="txtLink" id="txtLink" required>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Destinatari:</label><br>
                            <fieldset id='chkDestinatari'>
                            <?php
            
                                $query = "SELECT idFamiglia, nomeFamiglia FROM famigliaUtente";        
                                $result = mysqli_query($pdo_sqli, $query);
                                $resultCheck = mysqli_num_rows($result);
                                
                                if($resultCheck>0)
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo "<input  name='chkDestinatari[]' type='checkbox' value=". $row["idFamiglia"] . ">". $row["nomeFamiglia"] ."</input><br>";
                                    }
                                }
                            ?>
                            </fieldset>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Elimina Documento</label>
                            <input type=checkbox value="delete" name="chDelete" id="chDelete" onchange="toggleDel()">

                            <script>
                                function toggleDel()
                                {
                                    const checkbox = document.getElementById("chDelete");

                                    if(checkbox.checked)
                                    {
                                        document.getElementById("txtTipologia").disabled = true;
                                        document.getElementById("txtOggetto").disabled = true;
                                        document.getElementById("txtValidita").disabled = true;
                                        document.getElementById("txtNumero").disabled = true;
                                        document.getElementById("txtFirma").disabled = true;
                                        document.getElementById("txtData").disabled = true;
                                        document.getElementById("txtLink").disabled = true;
                                        document.getElementById("chkDestinatari").disabled = true;
                                    }
                                    else
                                    {
                                        document.getElementById("txtTipologia").disabled = false;
                                        document.getElementById("txtOggetto").disabled = false;
                                        document.getElementById("txtValidita").disabled = false;
                                        document.getElementById("txtNumero").disabled = false;
                                        document.getElementById("txtFirma").disabled = false;
                                        document.getElementById("txtData").disabled = false;
                                        document.getElementById("txtLink").disabled = false;
                                        document.getElementById("chkDestinatari").disabled = false;
                                    }
                                }
                                
                            </script>
                        </th>
                    </tr>
            </tr>
            </table>

            <input type="submit" value="Applica">
            <a href="bacheca.php">Torna alla bacheca</a>
        </form>
    </body>
</html>