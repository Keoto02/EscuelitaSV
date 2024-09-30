<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-building"></i> Universidad de Oriente
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index_student.php">Estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index_career.php">Carreras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controllers/logout.php"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Lista de Estudiantes</h1>
        <a href="./addStudent.php" class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> Crear Nuevo Estudiante
        </a>

        <form method="POST" action="./index_student.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, apellido, carrera o modalidad">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Carnet</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Carrera</th>
                    <th>Modalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../Controllers/indexStudentController.php';

                foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id_students']; ?></td>
                        <td><?php echo $student['first_name_students']; ?></td>
                        <td><?php echo $student['last_name_students']; ?></td>
                        <td><?php echo $student['carnet_students']; ?></td>
                        <td><?php echo $student['email_students']; ?></td>
                        <td><?php echo $student['phone_students']; ?></td>
                        <td><?php echo $student['name_career']; ?></td>
                        <td><?php echo $student['study_mode']; ?></td>
                        <td>
                            <a href="../Controllers/getByIdStudentController.php?action=edit&id=<?php echo $student['id_students']; ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="../Controllers/getByIdStudentController.php?action=delete&id=<?php echo $student['id_students']; ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../Controllers/export_students_to_csv.php" class="btn btn-primary">
            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

