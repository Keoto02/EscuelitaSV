<?php
include '../conf/conf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name_students'];
    $lastName = $_POST['last_name_students'];
    $email = $_POST['email_students'];
    $phone = $_POST['phone_students'];
    $carnet = $_POST['carnet_students'];
    $career = $_POST['program_id'];
    $studyMode = $_POST['study_mode_id'];

    $sql = "INSERT INTO students (first_name_students, last_name_students, email_students, phone_students, carnet_students, program_id, study_mode_id)
            VALUES (:firstName, :lastName, :email, :phone, :carnet, :career, :studyMode)";

    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':carnet', $carnet);
        $stmt->bindParam(':career', $career);
        $stmt->bindParam(':studyMode', $studyMode);
        $stmt->execute();

        header("Location: ../views/students.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al crear el estudiante: " . $e->getMessage();
    }
}
?>
