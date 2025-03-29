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

    if (user_not_auth("edit_user"))
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
        <title>Kyma Root | Modifica Utente</title>
    </head>

    <body>
        <h3>Stai modificando l'utente</h3>

        <table border=1>
            <tr>
                <th><b>Id</b></th>
                <th><b>Nome Utente</b></th>
                <th><b>Tipologia Utente</b></th>
                <th><b>Famiglia Utente</b></th>
                <th><b>Data Creazione</b></th>
            </tr>

            <?php
            
            $query = "SELECT * FROM Utente U JOIN Famigliautente F ON U.famigliaUtente = F.idFamiglia JOIN categoriaUtente C ON U.tipologiaUtente = C.idCategoria WHERE U.idUtente = ".$_GET["id"];        
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
                    echo "</tr>";
                }
            }
            ?>
        </table>

        </table>

        <form action="include/edit_user.inc.php" method="post">
            <table>
                    <tr>
                        <th>
                            <label>Id:</label>
                            <input type="text" value=<?php echo $_GET["id"] ?> name="txtId" readonly>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Categoria Utente:</label>
                            <select name="slCategoria" required>
                            <?php
            
                            $query = "SELECT * FROM categoriautente";        
                            $result = mysqli_query($pdo_sqli, $query);
                            $resultCheck = mysqli_num_rows($result);
                            
                            if($resultCheck>0)
                            {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    echo "<option value='".$row["idCategoria"]."'>" . $row["nomeCategoria"] . "</option>";
                                }
                            }
                            ?>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Famiglia Utente:</label>
                            <select name="slFamiglia" required>
                            <?php
            
                            $query = "SELECT * FROM Famigliautente";        
                            $result = mysqli_query($pdo_sqli, $query);
                            $resultCheck = mysqli_num_rows($result);
                            
                            if($resultCheck>0)
                            {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    echo "<option value='".$row["idFamiglia"]."'>" . $row["nomeFamiglia"] . "</option>";
                                }
                            }
                            ?>
                        </th>
                    </tr>

                    <tr>
                        <th>
                            <label>Elimina Utente</label>
                            <input type=checkbox value="delete" name="chDelete">
                        </th>
                    </tr>
            </table>

            <input type="submit" value="Applica">
            <input type="button" onclick=history.back() value="Torna Indietro">
        </form>
    </body>
</html>