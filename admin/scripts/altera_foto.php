<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE galeria_eventos SET fotografia = ?, ref_eventos = ? WHERE id_fotografia = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'sii', $fotografia, $ref_eventos, $id_fotografia);
    $id_fotografia=$_GET['id'];
    $fotografia = $_POST["fotografia"];
    $ref_eventos = $_POST["ref_eventos"];
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../tables_galeria.php?id=$id_fotografia");
    } else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);