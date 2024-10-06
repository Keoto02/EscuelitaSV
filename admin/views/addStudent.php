<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
    exit();
}

// Obtener carreras y modalidades de estudio
include '../Controllers/indexStudentController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php

include '../conf/conf.php';


$query = "SELECT * FROM careers_courses";
$stmt = $connection->prepare($query);
$stmt->execute();
$careers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM study_modes";
$stmt = $connection->prepare($query);
$stmt->execute();
$studymodes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container mt-5">
    <h1 class="mb-4">Crear Nuevo Estudiante</h1>
    <form action="../Controllers/addStudentController.php" method="POST">
        <div class="form-group">
            <label for="firstName">Nombre del Estudiante:</label>
            <input type="text" class="form-control" id="firstName" name="first_name_students" required>
        </div>
        <div class="form-group">
            <label for="lastName">Apellido del Estudiante:</label>
            <input type="text" class="form-control" id="lastName" name="last_name_students" required>
        </div>
        <div class="form-group">
            <label for="email">Email del Estudiante:</label>
            <input type="email" class="form-control" id="email" name="email_students" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono del Estudiante:</label>
            <input type="text" class="form-control" id="phone" name="phone_students">
        </div>
        <div class="form-group">
            <label for="carnet">Carnet del Estudiante:</label>
            <input type="text" class="form-control" id="carnet" name="carnet_students" required>
        </div>
        <div class="form-group">
            <label for="career">Carrera:</label>
            <select class="form-control" id="career" name="program_id" required>
                <option value="">Selecciona una carrera</option>
                <?php foreach ($careers as $career): ?>
                    <option value="<?php echo $career['id_career_course']; ?>"><?php echo $career['name_career_course']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="studyMode">Modalidad de Estudio:</label>
            <select class="form-control" id="studyMode" name="study_mode_id" required>
                <option value="">Selecciona una modalidad</option>
                <?php foreach ($studymodes as $mode): ?>
                    <option value="<?php echo $mode['id_study_mode']; ?>"><?php echo $mode['study_mode']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Guardar Nuevo Estudiante</button>
        <a href="./student.php" class="btn btn-danger mt-4">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
