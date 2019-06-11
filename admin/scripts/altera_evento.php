<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE eventos SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, longitude = ?, latitude =?, participantes = ?, alcance = ?, ref_categorias = ?, ref_acessibilidade = ? WHERE id_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'sssssiiiiii', $nome, $descricao, $data_inicio, $data_fim, $longitude, $latitude, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $id_eventos);
    $id=$_GET['id'];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];
    $participantes = $_POST["participantes"];
    $alcance = $_POST["alcance"];
    $ref_categorias = $_POST["categorias"];
    $ref_acessibilidade = $_POST["acessibilidade"];
    $id_eventos = $_POST["id_eventos"];
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../tables3.php?id=$id");
    } else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);