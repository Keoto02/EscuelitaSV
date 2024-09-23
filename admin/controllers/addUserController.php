<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $userType = $_POST['userType'];

    $sql = "INSERT INTO users (first_name_user, last_name_user, email_user, username_user, password_user, user_type_id) 
            VALUES (:firstName, :lastName, :email, :username, :password, :userType)";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        
        // Hashing la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        
        
        $stmt->bindParam(':userType', $userType);
        $stmt->execute();

        header("Location: ../views/Admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al crear el usuario: " . $e->getMessage();
    }
}
?>

