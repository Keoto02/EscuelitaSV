<?php
include '../conf/conf.php';

try 
{
    $idUser = $_GET['id'];
    $action = $_GET['action'];

    $sql = "SELECT U.id_user, U.first_name_user, U.last_name_user, U.email_user, U.username_user, U.password_user, UT.id_user_type, UT.user_type
          FROM users U
          INNER JOIN user_types UT ON U.user_type_id = UT.id_user_type
          WHERE U.id_user LIKE :idUser";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($action == 'edit') {
        include '../Views/editUser.php';
    } else if ($action == 'delete') {
        include '../Views/deleteUser.php';
    }
} catch (PDOException $e) {
    echo "Error al obtener la carrera: " . $e->getMessage();
    return null;
}