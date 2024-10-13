<?php
session_start();
if ($_SESSION['user'] == "" || $_SESSION['user'] != "administrator") {
    header("Location: ../views/students.php");
}

include '../conf/conf.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos de la carrera o curso
    $query = "SELECT * FROM careers_courses WHERE id_career_course = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $careerCourse = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener tipos de carrera o curso
    $queryTypes = "SELECT * FROM career_course_types";
    $stmtTypes = $connection->prepare($queryTypes);
    $stmtTypes->execute();
    $courseTypes = $stmtTypes->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ../views/careers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carrera/Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Editar Carrera/Curso</h1>
    <form action="../controllers/editCareerCourseController.php" method="POST">
        <input type="hidden" name="id_career_course" value="<?php echo $careerCourse['id_career_course']; ?>">
        
        <div class="form-group">
            <label for="nameCareerCourse">Nombre de la Carrera/Curso:</label>
            <input type="text" class="form-control" id="nameCareerCourse" name="name_career_course" value="<?php echo $careerCourse['name_career_course']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="careerCourseType">Tipo de Carrera/Curso:</label>
            <select class="form-control" id="careerCourseType" name="career_course_type_id" required>
                <option value="">Selecciona un tipo</option>
                <?php foreach ($courseTypes as $type): ?>
                    <option value="<?php echo $type['id_career_course_type']; ?>" <?php if ($careerCourse['career_course_type_id'] == $type['id_career_course_type']) echo 'selected'; ?>>
                        <?php echo $type['career_course_type']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
        <a href="../views/careers.php" class="btn btn-danger mt-4">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
