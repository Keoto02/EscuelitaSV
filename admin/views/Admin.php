<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
    header("Location: ../../index.php");
    exit;
}

if ($_SESSION['user'] != 'administrator') {
    header('Location: ./index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo admin</title>
</head>
<body>
    <h1>Solo admin</h1>
    <a href="../controllers/logout.php">Salir</a>
</body>
</html>