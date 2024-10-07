<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin/css/styleLogin.css">
    <title>Login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="index.php" method="POST">
                    <h2>Iniciar Sesión</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" required name="user">
                        <label for="">Usuario</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required name="pwd">
                        <label for="">Contraseña</label>
                    </div>
                    <button type="submit">Acceder</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

<?php
    include_once "./admin/conf/conf.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = isset($_POST['user']) ? $_POST['user'] : "";
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";

        $query = "
            SELECT id_user, u.first_name_user, u.username_user, u.password_user, ut.user_type 
            FROM users u 
            INNER JOIN user_types ut ON u.user_type_id = ut.id_user_type 
            WHERE u.username_user = :user";
            
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $userFound = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($pwd, $userFound["password_user"])) {
            session_start();
            $_SESSION["user"] = $userFound['user_type'];
            $_SESSION["userID"] = $userFound['id_user'];
            $_SESSION["username"] = $userFound['first_name_user'];

            if ($userFound['user_type'] == 'administrator') {
                header('Location: ./admin/views/Admin.php');
            } elseif ($userFound['user_type'] == 'teacher') {
                header('Location: ./admin/views/Admin.php');
            } else {
                $error = "Tipo de usuario no reconocido";
                echo "<script>alert('$error')</script>";
            }
        } else {
            $error = "Error en el inicio de sesión";
            echo "<script>alert('$error')</script>";
        }
    }
?>
