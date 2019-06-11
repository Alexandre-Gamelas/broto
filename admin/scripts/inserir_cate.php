<?php
session_start();
include_once "../connections/connection.php";
var_dump($_POST);
echo "<br>";
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];


$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO categorias (nome, ref_tipos_categorias) VALUES (?, ?) ";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, 'ss', $nomeP,$tipoP);
    $nomeP = $nome;
    $tipoP = $tipo;

    if (mysqli_stmt_execute($stmt)){
        header("Location: ../tables_categorias.php");
    } else {
        echo mysqli_stmt_error($stmt);
        echo "<p>Erro no execute</p>";
    }

    mysqli_stmt_close($stmt); // Close statement
} else {
    echo mysqli_stmt_error($stmt);
    mysqli_error($link);
}

mysqli_error($link);
mysqli_close($link);