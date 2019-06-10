<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "UPDATE categorias SET nome = ?, descricao = ?, ref_tipos_categorias = ?, imagem = ?  WHERE id_categorias = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'ssisi', $nome, $descricao, $ref_tipos_categorias, $imagem, $id_categorias);
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $ref_tipos_categorias = $_POST["ref_tipos_categorias"];
    $imagem = $_POST["imagem"];
    $id_categorias = $_POST["id_categorias"];
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../tables_categorias.php?msg=Registo atualizado com sucesso");
    }else{
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);