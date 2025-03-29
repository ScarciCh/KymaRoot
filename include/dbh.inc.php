<?php
    $host = 'localhost';
    $dbname = 'KymaRoot_db';
    $dbusername = 'root';
    $dbpassword = '';
    

    try 
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo_sqli = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
    }
    catch (PDOException $e)
    {
        die("Connessione fallita: " . $e->getMessage());
    }
?>
