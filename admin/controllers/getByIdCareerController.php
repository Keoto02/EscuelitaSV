<?php
include '../conf/conf.php';

try {
    $idCareer = $_GET['id'];
    $action = $_GET['action'];

    $sql = "SELECT 
        cc.id_career_course, 
        cc.name_career_course, 
        cct.career_course_type
    FROM 
        careers_courses cc
    INNER JOIN 
        career_course_types cct ON cc.career_course_type_id = cct.id_career_course_type
    WHERE cc.id_career_course = :idCareer;";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':idCareer', $idCareer, PDO::PARAM_INT);
    $stmt->execute();
    $careerCourse = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$careerCourse) {
        throw new Exception("No se encontró la carrera o curso.");
    }

    if ($action == 'edit') {
        include '../views/editCareer.php';
    } else if ($action == 'delete') {
        include '../Views/deleteCareer.php';
    }
} catch (PDOException $e) {
    echo "Error al obtener la materia: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
