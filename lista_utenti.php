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
if (user_not_auth("edit_user"))
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
        <title>Kyma Root | Gestisci Utenti</title>
    </head>

    <body>
        <h3>Lista Utenti</h3>

        <table border=1>
            <tr>
                <th><b>Id</b></th>
                <th><b>Nome Utente</b></th>
                <th><b>Tipologia Utente</b></th>
                <th><b>Famiglia Utente</b></th>
                <th><b>Data Creazione</b></th>
                <th><b>Azioni</b></th>
            </tr>

            <?php
            
            $query = "SELECT * FROM Utente U JOIN Famigliautente F ON U.famigliaUtente = F.idFamiglia JOIN categoriaUtente C ON U.tipologiaUtente = C.idCategoria";        
            $result = mysqli_query($pdo_sqli, $query);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row["idUtente"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["tipologiaUtente"] . ". ". $row["nomeCategoria"] ."</td>";
                    echo "<td>" . $row["famigliaUtente"] . ". ". $row["nomeFamiglia"] ."</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row["idUtente"] . "'>Modifica</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <form action="include/new_family.inc.php" method="post">
            <h4>Crea nuova famiglia Utenti: </h4>
            <input type="text" name="txtNewFamily">
            <input type="submit" value="Crea">
        </form>

        <h4>Lista Famiglie</h4>

        <table border=1>
            <tr>
                <th><b>Id</b></th>
                <th><b>Nome Famiglia</b></th>
                <th><b>Azioni</b></th>
            </tr>

            <?php
            
            $query = "SELECT * FROM Famigliautente";        
            $result = mysqli_query($pdo_sqli, $query);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row["idFamiglia"] . "</td>";
                    echo "<td>" . $row["nomeFamiglia"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_family.php?id=" . $row["idFamiglia"] . "'>Modifica</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <a href="home.php">Torna alla home</a>
    </body>
</html>