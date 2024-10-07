<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reporte de Problema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Eliminar Reporte de Problema</h1>
    
    <p>¿Estás seguro de que deseas eliminar el siguiente reporte?</p>
    
    <div class="form-group">
        <label for="reportId">ID del Reporte:</label>
        <input type="text" class="form-control" id="reportId" name="reportId" value="<?php echo $problemReport['id']; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="studentName">Nombre del Estudiante:</label>
        <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $problemReport['first_name_students'] . " " . $problemReport['last_name_students']; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="teacher_id">Nombre del Profesor:</label>
        <input type="text" class="form-control" id="teacher_id" name="teacher_id" value="<?php echo $problemReport['first_name_user'] . " " . $problemReport['last_name_user']; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="career">Carrera:</label>
        <input type="text" class="form-control" id="career" name="career" value="<?php echo $problemReport['name_career_course']; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="report_date">Fecha de Reporte:</label>
        <input type="text" class="form-control" id="report_date" name="report_date" value="<?php echo $problemReport['report_date']; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="description">Descripción:</label>
        <textarea class="form-control" id="description" name="description" rows="3" readonly><?php echo $problemReport['description']; ?></textarea>
    </div>

    <form action="../controllers/deleteProblemReportController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $problemReport['id']; ?>">
        
        <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
        <a href="../views/problemsReports.php" class="btn btn-secondary mt-4">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>