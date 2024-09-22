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

        $query = "SELECT username_user, password_user, user_type_id FROM users WHERE username_user = :user AND password_user = :pwd";
        $stmt = $connection->prepare($query);
    
        $stmt->execute([
            ':user' => $user,
            ':pwd' => $pwd
        ]);
    
        if ($stmt->rowCount() == 1) {
            session_start();
            $theUser = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["user"] = $theUser['user_type_id'];
            header('Location: ./admin/views/index.php');
        } else {
            $error = "Error en el inicio de sesión";
        }
    }
?>