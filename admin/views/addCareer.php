<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
    exit();
}

include '../Controllers/indexCareerController.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Carrera o Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php
include '../conf/conf.php';

$query = "SELECT * FROM career_course_types";
$stmt = $connection->prepare($query);
$stmt->execute();
$courseTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="mb-4">Crear Nueva Carrera o Curso</h1>
    <form action="../Controllers/addCareerController.php" method="POST">
        <div class="form-group">
            <label for="name">Nombre de la Carrera o Curso:</label>
            <input type="text" class="form-control" id="name" name="name_career_course" required>
        </div>
        <div class="form-group">
            <label for="courseType">Tipo de Carrera o Curso:</label>
            <select class="form-control" id="courseType" name="career_course_type_id" required>
                <option value="">Selecciona un tipo</option>
                <?php foreach ($courseTypes as $type): ?>
                    <option value="<?php echo $type['id_career_course_type']; ?>"><?php echo $type['career_course_type']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Guardar Nueva Carrera o Curso</button>
        <a href="../views/careers.php" class="btn btn-danger mt-4">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
