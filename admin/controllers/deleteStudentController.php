<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idStudent'])) {
    try {
        $idStudent = $_POST['idStudent'];

        // Consulta SQL para eliminar el estudiante
        $sql = "DELETE FROM students WHERE id_students = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $idStudent, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir de vuelta a la lista de estudiantes
        header("Location: ../Views/students.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar el estudiante: " . $e->getMessage();
    }
} else {
    header("Location: ../views/students.php");
    exit();
}
?>
