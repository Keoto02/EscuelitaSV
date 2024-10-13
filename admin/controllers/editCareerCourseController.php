<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_career_course'];
    $nameCareerCourse = $_POST['name_career_course']; 
    $careerCourseTypeId = $_POST['career_course_type_id'];

    $sql = "UPDATE careers_courses 
            SET name_career_course = :nameCareerCourse, career_course_type_id = :careerCourseTypeId 
            WHERE id_career_course = :id";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nameCareerCourse', $nameCareerCourse);
        $stmt->bindParam(':careerCourseTypeId', $careerCourseTypeId);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();

        header("Location: ../views/careers.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al actualizar la carrera o curso: " . $e->getMessage();
    }
}
?>
