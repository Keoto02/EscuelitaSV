<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../index.php");
    exit();
}

// Incluir la conexión y obtener el ID de la carrera
include '../conf/conf.php';

if (isset($_GET['id'])) {
    $idCareerCourse = $_GET['id'];

    // Obtener datos de la carrera
    $query = "SELECT * FROM careers_courses WHERE id_career_course = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $idCareerCourse);
    $stmt->execute();
    $careerCourse = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$careerCourse) {
        header("Location: ../views/careers.php");
        exit();
    }
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
    <title>Eliminar Carrera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Eliminar Carrera</h1>
    <p>¿Estás seguro de que deseas eliminar la carrera "<?php echo htmlspecialchars($careerCourse['name_career_course']); ?>"?</p>
    <form action="../Controllers/deleteCareerController.php" method="POST">
        <input type="hidden" name="idCareerCourse" value="<?php echo $careerCourse['id_career_course']; ?>">
        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
        <a href="../views/careers.php" class="btn btn-primary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
