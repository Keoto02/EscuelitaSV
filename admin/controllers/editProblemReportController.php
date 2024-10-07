<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problemReportId = $_POST['id'];
    $studentId = $_POST['student_id'];
    $teacherId = $_POST['teacher_id'];
    $careerCourseId = $_POST['career_course_id'];
    $reportDate = $_POST['report_date'];
    $description = $_POST['description'];

    $sql = "UPDATE problem_reports 
            SET student_id = :student_id, 
            teacher_id = :teacher_id, 
            career_course_id = :career_course_id, 
            report_date = :report_date,             
            description = :description 
            WHERE id = :id";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $problemReportId);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':career_course_id', $careerCourseId);
        $stmt->bindParam(':report_date', $reportDate);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        header("Location: ../views/problemsReports.php");
        exit();
    } catch (PDOException $e) {
        $error = "Ocurrió un error al modificar el reporte. Por favor, intenta nuevamente.";
        echo "<script>
            alert('$error');
            window.location.href = '../views/problemsReports.php';
        </script>";
    }
}
?>