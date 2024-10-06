<?php
include '../conf/conf.php';

try {
   
    $idReport = $_GET['id'];
    $action = $_GET['action'];

    
    $sql = "SELECT PR.id, PR.description, 
                   S.first_name_students, S.last_name_students, 
                   CC.name_career_course
            FROM problem_reports PR
            LEFT JOIN students S ON PR.student_id = S.id_students
            LEFT JOIN careers_courses CC ON S.program_id = CC.id_career_course
            WHERE PR.id = :idReport";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
    $stmt->execute();
    $problemReport = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($action == 'edit') {
        include '../views/editProblemReport.php';
    } else if ($action == 'delete') {
        include '../views/deleteProblemReport.php';
    }
} catch (PDOException $e) {
    echo "Error al obtener el reporte de problema: " . $e->getMessage();
    return null;
}
?>
