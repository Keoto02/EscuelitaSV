<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportId = $_POST['id'];

    $sql = "DELETE FROM problem_reports WHERE id = :report_id";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':report_id', $reportId);
        $stmt->execute();

        header("Location: ../views/problemsReports.php");
        exit();
    } catch (PDOException $e) {
        $error = "Ocurrió un error al eliminar el reporte. Por favor, intenta nuevamente.";
        echo "<script>
            alert('$error');
            window.location.href = '../views/problemReports.php';
        </script>";
    }
}
?>
