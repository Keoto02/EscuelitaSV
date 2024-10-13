<?php
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

include '../conf/conf.php';

$query = "SELECT 
    cc.id_career_course, 
    cc.name_career_course, 
    cct.career_course_type
FROM 
    careers_courses cc
INNER JOIN 
    career_course_types cct ON cc.career_course_type_id = cct.id_career_course_type;
WHERE cc.name_career_course LIKE :search;
";

try {
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
    $careers_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener la lista de carreras/cursos: " . $e->getMessage();
}
