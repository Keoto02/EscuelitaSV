<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUser = $_POST['idUser'];

    $query = "DELETE FROM users WHERE id_user = :id";

    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $idUser);
        $stmt->execute();

        header("Location: ../views/Admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar la carrera: " . $e->getMessage();
    }
}
?>
