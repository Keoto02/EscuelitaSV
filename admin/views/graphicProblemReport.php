<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    .date-range-container {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .date-input {
        margin: 0 10px;
    }
    label {
        margin-right: 5px;
    }
    #drawGraphic {
        margin-top: 10px;
    }
    .full-height {
        height: 100vh; /* Altura de la pantalla completa */
        display: flex; /* Usar Flexbox */
        align-items: center; /* Centrar verticalmente */
        justify-content: center; /* Centrar horizontalmente */
    }
    .danger{
        background-color: #FF4D4D;
    }
</style>

<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block; /* Muestra el menú desplegable al pasar el mouse */
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
                    <li class="nav-item">
                        <a class="nav-link" href="./Admin.php">
                            <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./careers.php">
                            <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Carreras y Cursos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./students.php">
                            <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Estudiantes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./problemsReports.php">
                            <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Reportes de Problemas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./graphicProblemReport.php">
                            <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Reportes de Problemas
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

    <div class="full-height">
        <center>
            <div class="container-fluid rounded shadow p-4">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>

                <form id="chartForm" action="" method="POST" class="bg-light p-4">
                    <h2 class="text-center mb-4">Generar Reporte</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Inicio del Reporte:</label>
                            <input type="date" id="startDate" name="startDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label">Final del Reporte:</label>
                            <input type="date" id="endDate" name="endDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" id="drawGraphic" class="btn btn-primary">Generar Grafico</button>
                    </div>
                </form>
            </div>
        </center>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        $(document).ready(function() {
            $('#drawGraphic').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                if (startDate && endDate) {
                    $.ajax({
                        url: '../controllers/graphicProblemReportController.php',
                        type: 'POST',
                        data: { 
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function(res) {
                            $('#container').html(res);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating chart:", error);
                            $('#container').html('<p class="p-4 danger rounded fw-bold">Error al cargar el grafico. porfavor vuelva a intentarlo.</p>');
                        }
                    });
                } else {
                    $('#container').html('<p class="p-4 danger rounded fw-bold">Seleccione un Rango de Fechas.</p>').find('');
                }
            });
        });
    </script>
</body>
</html>