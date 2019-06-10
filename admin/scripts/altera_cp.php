<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE postais SET postal = ? WHERE id_postais = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'si', $postal, $id_postais);
    $postal = $_POST["postal"];
    $id_postais = $_POST["id_postais"];
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../tables_cong.php?id=2&msg=Registo atualizado com sucesso");
    }else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);