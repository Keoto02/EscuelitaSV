<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCareerCourse'])) {
    try {
        $idCareerCourse = $_POST['idCareerCourse'];

        $sql = "DELETE FROM careers_courses WHERE id_career_course = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $idCareerCourse, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../Views/careers.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<script>
                    alert('No se puede eliminar porque existen registros relacionados.');
                    window.location.href = '../Views/careers.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error al eliminar la carrera o curso: " . addslashes($e->getMessage()) . "');
                    window.location.href = '../Views/careers.php';
                  </script>";
            exit();
        }
    }
} else {
    header("Location: ../Views/careers.php");
    exit();
}
?>
