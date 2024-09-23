<?php

$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

include '../conf/conf.php';

$query = "SELECT U.id_user, U.first_name_user, U.last_name_user, U.email_user, U.username_user, UT.user_type
          FROM users U
          INNER JOIN user_types UT ON U.user_type_id = UT.id_user_type
          WHERE U.first_name_user LIKE :search
          OR U.last_name_user LIKE :search
          OR UT.user_type LIKE :search";

try {
    $stmt = $connection->prepare($query);
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener la lista de usuarios: " . $e->getMessage();
}
