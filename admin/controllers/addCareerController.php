<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameCareerCourse = $_POST['name_career_course'];
    $careerCourseTypeId = $_POST['career_course_type_id'];

    $sql = "INSERT INTO careers_courses (name_career_course, career_course_type_id)
            VALUES (:nameCareerCourse, :careerCourseTypeId)";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nameCareerCourse', $nameCareerCourse);
        $stmt->bindParam(':careerCourseTypeId', $careerCourseTypeId);
        $stmt->execute();

        header("Location: ../views/careers.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al crear la carrera o curso: " . $e->getMessage();
    }
}
?>
