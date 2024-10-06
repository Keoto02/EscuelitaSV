<?php
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

include '../conf/conf.php';

$query = "SELECT S.id_students, S.first_name_students, S.last_name_students, S.carnet_students, S.email_students, S.phone_students, C.name_career_course AS name_career, M.study_mode AS study_mode
          FROM students S
          INNER JOIN careers_courses C ON S.program_id = C.id_career_course
          INNER JOIN study_modes M ON S.study_mode_id = M.id_study_mode
          WHERE S.first_name_students LIKE :search
          OR S.last_name_students LIKE :search
          OR C.name_career_course LIKE :search
          OR M.study_mode LIKE :search";

try {
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener la lista de estudiantes: " . $e->getMessage();
}


