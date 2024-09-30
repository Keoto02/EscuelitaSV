<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_students'];
    $firstName = $_POST['first_name_students'];
    $lastName = $_POST['last_name_students'];
    $email = $_POST['email_students'];
    $phone = $_POST['phone_students'];
    $carnet = $_POST['carnet_students'];
    $career = $_POST['program_id'];
    $studyMode = $_POST['study_mode_id'];

    $sql = "UPDATE students 
            SET first_name_students = :firstName, last_name_students = :lastName, email_students = :email, phone_students = :phone, 
                carnet_students = :carnet, program_id = :career, study_mode_id = :studyMode 
            WHERE id_students = :id";

    try {
        
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':carnet', $carnet);
        $stmt->bindParam(':career', $career);
        $stmt->bindParam(':studyMode', $studyMode);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../views/students.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al actualizar el estudiante: " . $e->getMessage();
    }
    
}

?>
