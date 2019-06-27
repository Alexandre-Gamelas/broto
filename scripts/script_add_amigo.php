<?php
require_once "../connections/connection.php";
session_start();
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO utilizadores_has_amigos (ref_utilizadores, ref_amigos) VALUES (?,?)";

if (mysqli_stmt_prepare($stmt, $query)) {


    mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_amigo);
    $id_user = $_SESSION['user']['id_user'];
    $id_amigo=$_GET['id'];


    if (mysqli_stmt_execute($stmt)) {
        header("location: ../amigo_detail.php?id=".$id_amigo);
    }else{
        echo mysqli_stmt_error($stmt);
        //header("location: ../amigo_detail.php?msg=0");
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);