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

if (user_not_auth("bacheca"))
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
        <title>Kyma Root | Bacheca</title>
    </head>

    <body>
        <h3>Bacheca Documenti</h3>
        <a href="add_document.php">Aggiungi Documento</a> <br>

        <table border=1>
            <tr>
                <th><b>Id</b></th>
                <th><b>Tipologia</b></th>
                <th><b>Oggetto</b></th>
                <th><b>Validita</b></th>
                <th><b>Numero</b></th>
                <th><b>Firma</b></th>
                <th><b>Data</b></th>
                <th><b>Azioni</b></th>
            </tr>

            <?php
            
            $query = "SELECT * FROM Documento D JOIN Associazione A ON D.idDocumento = A.documento JOIN FamigliaUtente F ON A.destinatario = F.idFamiglia JOIN Utente U ON U.famigliaUtente = F.idFamiglia WHERE U.famigliaUtente = " . $_SESSION["user_family"];        
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
                    echo "<td>";
                    echo "<a href=" . $row["linkDocumento"] . " target='_blank'>Visualizza</a> | ";
                    echo "<a href='edit_document.php?id=" . $row["idDocumento"] . "'>Modifica</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <br>
        <a href="home.php">Torna alla home</a>
    </body>
</html>