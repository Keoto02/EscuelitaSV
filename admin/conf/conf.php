<?php

$db_host = 'localhost';
$db_name = 'MiEscuelaDB';
$db_username = 'root';
$db_password = '1234';

try {
    $connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: ".$e->getMessage();
}
?>
