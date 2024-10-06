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
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-building" style="font-size: 19px;"></i> Universidad de Oriente
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index_user.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index_user.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Tipo de Carrera o Curso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index_user.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Carreras y Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index_user.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Modalidades de Estudio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./students.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./problemsReports.php"> <i class="bi bi-person bi-lg" style="font-size: 19px;"></i> Reportes de Problemas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controllers/logout.php"><i class="bi bi-box-arrow-right" style="font-size: 19px;"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Usuarios</h1>
        <?php
        if ($_SESSION["user"] == "administrator") {
        ?>
            <a href="../views/addUser.php" class="btn btn-success mb-3">
                <i class="bi bi-plus"></i> Crear Nuevo Usuario
            </a>
        <?php } ?>


        <form method="POST" action="./index_user.php">
            <div class="input-group mb-3">
                <input type="text" id="searchInput" class="form-control" name="search" placeholder="Buscar por nombre, apellido o correo electrónico">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Nombre de Usuario</th>
                    <th>Tipo de Usuario</th>
                    <?php
                    if ($_SESSION["user"] == "administrator") {
                    ?>
                        <th>Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="userList">
                <?php
                include '../controllers/AdminController.php';


                foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id_user']; ?></td>
                        <td><?php echo $user['first_name_user']; ?></td>
                        <td><?php echo $user['last_name_user']; ?></td>
                        <td><?php echo $user['email_user']; ?></td>
                        <td><?php echo $user['username_user']; ?></td>
                        <td><?php echo $user['user_type']; ?></td>
                        <?php
                        if ($_SESSION["user"] == "administrator") {
                        ?>
                            <td>
                                <a href="../Controllers/getByIdUserController.php?action=edit&id=<?php echo $user['id_user']; ?>" class="btn btn-primary btn-sm mr-2">
                                    <i class="bi bi-pencil" style="font-size: 25px;"></i>
                                </a>
                                <a href="../Controllers/getByIdUserController.php?action=delete&id=<?php echo $user['id_user']; ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash" style="font-size: 25px;"></i>
                                </a>
                            </td>
                        <?php } ?>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../Controllers/export_users_to_csv.php" class="btn btn-primary"> <i class="bi bi-file-earmark-excel" style="font-size: 19px;"></i> Exportar a Excel</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>