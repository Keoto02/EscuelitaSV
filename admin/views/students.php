<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../views/students.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        /* Muestra el menú desplegable al pasar el mouse */
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-building" style="font-size: 19px;"></i> Universidad de Oriente
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <?php
                    if ($_SESSION["user"] == "administrator") {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./Admin.php">
                                <i class="bi bi-person-fill bi-lg" style="font-size: 19px;"></i> Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./careers.php">
                                <i class="bi bi-book bi-lg" style="font-size: 19px;"></i> Carreras y Cursos
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./students.php">
                            <i class="bi bi-person-badge bi-lg" style="font-size: 19px;"></i> Estudiantes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./problemsReports.php">
                            <i class="bi bi-exclamation-triangle-fill bi-lg" style="font-size: 19px;"></i> Reportes de Problemas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./graphicProblemReport.php">
                            <i class="bi bi-bar-chart bi-lg" style="font-size: 19px;"></i> Gráfico de Problemas
                        </a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Controllers/logout.php">
                            <i class="bi bi-box-arrow-right" style="font-size: 19px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <h1 class="mb-4">Lista de Estudiantes</h1>
            <div class="col">
                <?php
                if ($_SESSION["user"] == "administrator") {
                ?>
                    <a href="./addStudent.php" class="btn btn-success mb-3">
                        <i class="bi bi-plus"></i> Crear Nuevo Estudiante
                    </a>
                <?php } ?>
            </div>

            <form action="../controllers/importDataController.php" id="importForm" class="col-8 d-flex" method="post" enctype="multipart/form-data">
                <div class="col mb-3">
                    <div class="input-group custom-file-button">
                        <input type="file" class="form-control" id="inputGroupFile" name="archivo" accept=".csv, .xlsx">
                    </div>
                </div>

                <div class="px-2">
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </form>
        </div>

        <table class="table" id="studentTable">
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
                    <?php
                    if ($_SESSION["user"] == "administrator") {
                    ?>
                        <th>Acciones</th>
                    <?php } ?>
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
                        <?php
                        if ($_SESSION["user"] == "administrator") {
                        ?>
                            <td>
                                <a href="../Controllers/getByIdStudentController.php?action=edit&id=<?php echo $student['id_students']; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="../Controllers/getByIdStudentController.php?action=delete&id=<?php echo $student['id_students']; ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#studentTable").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],
                columnDefs: [{
                    targets: <?php echo ($_SESSION["user"] == "administrator") ? 8 : 7; ?>,
                    orderable: false,
                    searchable: false
                }],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                }
            });
        });
    </script>

</body>

</html>