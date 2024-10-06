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
    <title>Lista de Reportes de Problemas</title>
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
        <h1 class="mb-4">Lista de Reportes de Problemas</h1>
        <a href="./addProblemReport.php" class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> Crear Nuevo Reporte
        </a>

        <form method="POST" action="./index_problem_reports.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Buscar por estudiante, profesor, fecha o descripción">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Profesor</th>
                    <th>Carrera</th>
                    <th>Fecha de Reporte</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../Controllers/problemsReportsController.php';

                foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['id']; ?></td>
                        <td><?php echo $report['student_name']; ?></td>
                        <td><?php echo $report['teacher_name']; ?></td>
                        <td><?php echo $report['career_course']; ?></td>
                        <td><?php echo $report['report_date']; ?></td>
                        <td><?php echo $report['description']; ?></td>
                        <td>
                            <a href="../Controllers/getByIdProblemReportController.php?action=edit&id=<?php echo $report['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="../Controllers/getByIdProblemReportController.php?action=delete&id=<?php echo $report['id']; ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../Controllers/export_problem_reports_to_csv.php" class="btn btn-primary">
            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
