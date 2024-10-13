<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student_id'];
    $teacherId = $_POST['teacher_id'];
    $careerCourseId = $_POST['career_course_id'];
    $reportDate = $_POST['report_date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO problem_reports (student_id, teacher_id, career_course_id, report_date, description) 
            VALUES (:student_id, :teacher_id, :career_course_id, :report_date, :description)";


    try {

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':career_course_id', $careerCourseId);
        $stmt->bindParam(':report_date', $reportDate);
        $stmt->bindParam(':description', $description);
        $stmt->execute();


        header("Location: ../views/problemsReports.php");
        exit();
    } catch (PDOException $e) {
        // $error = "Ocurrió un error al crear el reporte. Por favor, intenta nuevamente.";
        // echo "<script>
        //     alert('$error');
        //     window.location.href = '../views/problemsReports.php';
        // </script>";
        echo $e->getMessage();
    }
}
?>
