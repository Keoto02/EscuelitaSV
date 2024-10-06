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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Eliminar Reporte de Problema</h1>
    
    <p>¿Estás seguro de que deseas eliminar el siguiente reporte?</p>
    
    <ul>
        <li><strong>ID del Reporte:</strong> <?php echo $problemReport['id']; ?></li>
        <li><strong>Descripción:</strong> <?php echo $problemReport['description']; ?></li>
        <li><strong>Nombre del Estudiante:</strong> <?php echo $problemReport['first_name_students'] . " " . $problemReport['last_name_students']; ?></li>
        <li><strong>Carrera:</strong> <?php echo $problemReport['name_career_course']; ?></li>
    </ul>

    <form action="../controllers/deleteProblemReportController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $problemReport['id']; ?>">
        
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <a href="../views/problemsReports.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
