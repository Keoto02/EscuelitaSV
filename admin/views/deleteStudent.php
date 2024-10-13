<?php
session_start();
if ($_SESSION['user'] == "" || $_SESSION['user'] != "administrator") {
    header("Location: ../views/students.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Eliminar Estudiante</h1>
    <p>¿Estás seguro de que deseas eliminar al estudiante "<?php echo $student['first_name_students']; ?> <?php echo $student['last_name_students']; ?>" con carnet "<?php echo $student['carnet_students']; ?>"?</p>
    <form action="../Controllers/deleteStudentController.php" method="POST">
        <input type="hidden" name="idStudent" value="<?php echo $student['id_students']; ?>">
        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
        <a href="../views/students.php" class="btn btn-primary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
