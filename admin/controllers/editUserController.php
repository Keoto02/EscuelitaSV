<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUser = $_POST['idUser'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $newPassword = $_POST['newPassword']; 
    $userType = $_POST['userType'];

    // Iniciar la consulta SQL para actualizar los datos
    $sql = "UPDATE users
            SET first_name_user = :firstName,
                last_name_user = :lastName, 
                email_user = :email, 
                username_user = :username, 
                user_type_id = :userType";

    // Añadir la parte de la contraseña solo si se proporciona una nueva contraseña
    if (!empty($newPassword) && isset($newPassword)) {
        $sql .= ", password_user = :newPassword"; // Agregar a la consulta si hay nueva contraseña
    }
    
    $sql .= " WHERE id_user = :idUser"; // Condición para el usuario

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':userType', $userType);
        $stmt->bindParam(':idUser', $idUser);     

        // Hashing la nueva contraseña solo si se ha proporcionado
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt->bindParam(':newPassword', $hashedPassword);
        }

        $stmt->execute();

        header("Location: ../views/Admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al crear el usuario: " . $e->getMessage();
    }
}
?>
