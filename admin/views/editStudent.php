<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
    exit();
}

include '../conf/conf.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del estudiante
    $query = "SELECT * FROM students WHERE id_students = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener carreras y modalidades de estudio
    $queryCareers = "SELECT * FROM careers_courses";
    $stmtCareers = $connection->prepare($queryCareers);
    $stmtCareers->execute();
    $careers = $stmtCareers->fetchAll(PDO::FETCH_ASSOC);

    $queryModes = "SELECT * FROM study_modes";
    $stmtModes = $connection->prepare($queryModes);
    $stmtModes->execute();
    $studyModes = $stmtModes->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ../views/students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Editar Estudiante</h1>
    <form action="../controllers/editStudentController.php" method="POST">
        <input type="hidden" name="id_students" value="<?php echo $student['id_students']; ?>">
        
        <div class="form-group">
            <label for="firstName">Nombre del Estudiante:</label>
            <input type="text" class="form-control" id="firstName" name="first_name_students" value="<?php echo $student['first_name_students']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="lastName">Apellido del Estudiante:</label>
            <input type="text" class="form-control" id="lastName" name="last_name_students" value="<?php echo $student['last_name_students']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email del Estudiante:</label>
            <input type="email" class="form-control" id="email" name="email_students" value="<?php echo $student['email_students']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Teléfono del Estudiante:</label>
            <input type="text" class="form-control" id="phone" name="phone_students" value="<?php echo $student['phone_students']; ?>">
        </div>
        
        <div class="form-group">
            <label for="carnet">Carnet del Estudiante:</label>
            <input type="text" class="form-control" id="carnet" name="carnet_students" value="<?php echo $student['carnet_students']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="career">Carrera:</label>
            <select class="form-control" id="career" name="program_id" required>
                <option value="">Selecciona una carrera</option>
                <?php foreach ($careers as $career): ?>
                    <option value="<?php echo $career['id_career_course']; ?>" <?php if ($student['program_id'] == $career['id_career_course']) echo 'selected'; ?>>
                        <?php echo $career['name_career_course']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="studyMode">Modalidad de Estudio:</label>
            <select class="form-control" id="studyMode" name="study_mode_id" required>
                <option value="">Selecciona una modalidad</option>
                <?php foreach ($studyModes as $mode): ?>
                    <option value="<?php echo $mode['id_study_mode']; ?>" <?php if ($student['study_mode_id'] == $mode['id_study_mode']) echo 'selected'; ?>>
                        <?php echo $mode['study_mode']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
        <a href="./students.php" class="btn btn-danger mt-4">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
