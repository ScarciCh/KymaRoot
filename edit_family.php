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
        <title>Kyma Root | Modifica Famiglia</title>
    </head>

    <body>
        <h3>Stai modificando la famiglia</h3>

        <table border=1>
            <tr>
                <th><b>Id</b></th>
                <th><b>Nome Famiglia</b></th>
            </tr>

            <?php
            
            $query = "SELECT * FROM Famigliautente WHERE idFamiglia = '".$_GET["id"]."'";        
            $result = mysqli_query($pdo_sqli, $query);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row["idFamiglia"] . "</td>";
                    echo "<td>" . $row["nomeFamiglia"] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        </table>

        <form action="include/edit_family.inc.php" method="post">
            <table>

            <tr>
                <th>
                    <label>Id:</label>
                    <input type="text" name="txtId" value="<?php echo $_GET['id'] ?>" required readonly>
                </th>
            </tr>
            
            <tr>
                <th>
                    <label>Nome:</label>
                    <input type="text" name="txtName" id="txtName" required>
                </th>
            </tr>

            <tr>
                <th>
                    <label>Elimina Famiglia</label>
                    <input type=checkbox value="delete" id="chDelete" name="chDelete" onchange=toggleDel()>

                    <script>
                                function toggleDel()
                                {
                                    const checkbox = document.getElementById("chDelete");

                                    if(checkbox.checked)
                                    {
                                        document.getElementById("txtName").disabled = true;
                                    }
                                    else
                                    {
                                        document.getElementById("txtName").disabled = false;
                                    }
                                }         
                    </script>
                </th>
            </tr>
            </table>

            <input type="submit" value="Applica">
            <input type="button" onclick=history.back() value="Torna Indietro">
        </form>
    </body>
</html>