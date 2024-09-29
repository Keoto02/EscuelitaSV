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
    <title>Actualizar Carrera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<?php

include '../conf/conf.php';


$query = "SELECT id_user_type, user_type FROM user_types";
$stmt = $connection->prepare($query);
$stmt->execute();
$userTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Actualizar Usuarios</h1>

        <form action="../controllers/editUserController.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="idUser" name="idUser" value="<?php echo $users['id_user']; ?>" hidden>
            </div>
            <div class="form-group">
                <label for="firstName">Nombre:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $users['first_name_user']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Apellido:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $users['last_name_user']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users['email_user']; ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $users['username_user']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Nueva Contraseña">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary input-group-text" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="userType">Tipo de Usuario:</label>

                <select class="form-control" id="userType" name="userType" required>
                    <option value="">Selecciona un tipo de usuario</option>
                    <?php foreach ($userTypes as $type):
                        $selected = ($users['id_user_type'] == $type['id_user_type']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $type['id_user_type']; ?>" <?php echo $selected; ?>> <?php echo $type['user_type']; ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Actualizar Usuario</button>
            <a href="../views/Admin.php" class="btn btn-danger mt-4">Regresar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
    </script>
</body>
</html>
