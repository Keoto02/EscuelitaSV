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
    <title>Crear Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Eliminar Usuario</h1>
    <form action="../controllers/deleteUserController.php" method="POST">
        <div class="form-group">
            <label for="firstName">ID:</label>
            <input type="text" class="form-control" id="idUser" name="idUser" value="<?php echo $users['id_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="firstName">Nombre:</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $users['first_name_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="lastName">Apellido:</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $users['last_name_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $users['email_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $users['username_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $users['password_user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="userType">Tipo de Usuario:</label>
            <input type="text" class="form-control" id="typeUser" name="typeUser" value="<?php echo $users['user_type']; ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Eliminar Usuario</button>
        <a href="../views/Admin.php" class="btn btn-danger mt-4">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
