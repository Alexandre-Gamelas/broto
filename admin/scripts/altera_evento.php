<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE eventos SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, longitude = ?, latitude =?, participantes = ?, alcance = ?, super = ?, ref_categorias = ?, ref_acessibilidade = ?, fotografia = ?  WHERE id_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ssssddiiiiisi', $nome, $descricao, $data_inicio, $data_fim, $longitude, $latitude, $participantes, $alcance, $super, $ref_categorias, $ref_acessibilidade, $fotografia, $id_eventos);
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];
    $participantes = $_POST["participantes"];
    $alcance = $_POST["alcance"];
    $super = $_POST["super"];
    $ref_categorias = $_POST["ref_categorias"];
    $ref_acessibilidade = $_POST["ref_acessibilidade"];
    $fotografia = $_POST["fotografia"];
    $id_eventos = $_POST["id_eventos"];
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../tables3.php?msg=Registo atualizado com sucesso");
    }else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);