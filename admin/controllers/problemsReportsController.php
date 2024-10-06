<?php
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

include '../conf/conf.php';

$query = "SELECT PR.id, S.first_name_students AS student_name, U.first_name_user AS teacher_name, C.name_career_course AS career_course, PR.report_date, PR.description
          FROM problem_reports PR
          INNER JOIN students S ON PR.student_id = S.id_students
          INNER JOIN users U ON PR.teacher_id = U.id_user
          INNER JOIN careers_courses C ON PR.career_course_id = C.id_career_course
          WHERE S.first_name_students LIKE :search
          OR U.first_name_user LIKE :search
          OR PR.report_date LIKE :search
          OR PR.description LIKE :search";

try {
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener la lista de reportes: " . $e->getMessage();
}
?>
