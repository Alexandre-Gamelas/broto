<?php
session_start();
include_once "../connections/connection.php";
$nome = $_POST['nome_tipo'];
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO tipos_categorias (nome_tipo) VALUES (?) ";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, 's', $nome_tipo);
    $nome_tipo = $nome;
   if (mysqli_stmt_execute($stmt)){
        header("Location: ../tables_cong.php?id=2&msg=Novo Tipo de Categoria inserido com sucesso");
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