<?php
require "config/config.php";

$conn = new mysqli( $config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Caricamento file
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $name = $_POST['name'];
        $owner = $_POST['owner'];
        $date_uploaded = date("Y-m-d");
        $file_path = $target_file;

        $sql = "INSERT INTO documents (name, owner, date_uploaded, file_path) VALUES ('$name', '$owner', '$date_uploaded', '$file_path')";

        if ($conn->query($sql) === TRUE) {
            echo "File caricato con successo.";
        } else {
            echo "Errore: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Errore durante il caricamento del file.";
    }
}

// Recupero documenti dal database
$sql = "SELECT * FROM documents ORDER BY date_uploaded DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bacheca</title>
    <link rel="stylesheet" href="resources/bacheca_style.css">
</head>
<body>
    <div class="container">
        <h1>Bacheca</h1>
        <form action="bacheca.php" method="post" enctype="multipart/form-data">
            Nome file: <input type="text" name="name" required>
            Proprietario: <input type="text" name="owner" required>
            Seleziona file: <input type="file" name="file" required>
            <input type="submit" value="Carica">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Proprietario</th>
                    <th>Data di caricamento</th>
                    <th>Azione</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['owner']) . "</td>
                                <td>" . htmlspecialchars($row['date_uploaded']) . "</td>
                                <td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>Visualizza</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nessun documento trovato</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <a href="home.php">Torna alla Home</a>
</body>
</html>

<?php
$conn->close();
?>
