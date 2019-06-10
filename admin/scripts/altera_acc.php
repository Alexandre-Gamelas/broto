<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE acessibilidade SET descricao = ? WHERE id_acessibilidade = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'si', $descricao, $id_acessibilidade);
    $descricao = $_POST["descricao"];
    $id_acessibilidade = $_POST["id_acessibilidade"];
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../tables_cong.php?id=3&msg=Registo Acessibilidade atualizado com sucesso");
    }else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);