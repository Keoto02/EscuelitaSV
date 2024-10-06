<?php
include '../conf/conf.php';

try {
    $idStudent = $_GET['id'];
    $action = $_GET['action'];

    // Consulta para obtener el estudiante con su carrera y modalidad de estudio
    $sql = "SELECT S.id_students, S.first_name_students, S.last_name_students, S.email_students, S.phone_students, S.carnet_students, 
                   CC.id_career_course, CC.name_career_course, 
                   SM.id_study_mode, SM.study_mode
            FROM students S
            LEFT JOIN careers_courses CC ON S.program_id = CC.id_career_course
            LEFT JOIN study_modes SM ON S.study_mode_id = SM.id_study_mode
            WHERE S.id_students = :idStudent";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':idStudent', $idStudent, PDO::PARAM_INT);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($action == 'edit') {
        include '../Views/editStudent.php';
    } else if ($action == 'delete') {
        include '../Views/deleteStudent.php';
    }
} catch (PDOException $e) {
    echo "Error al obtener el estudiante: " . $e->getMessage();
    return null;
}
