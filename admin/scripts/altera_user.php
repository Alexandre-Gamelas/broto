<?php
include_once "../connections/connection.php";
session_start();
$post_id = $_POST['id'];
$post_name = $_POST['nome'];
$post_mail = $_POST['mail'];
$post_nacionalidade = $_POST['nacionalidade'];
$post_papel = $_POST['papel'];
$post_data_nascimento = $_POST['nascimento'];
$post_data_registo = $_POST['registo'];
//$post_fotografia = $_POST['fotografia'];
$post_blocked = $_POST['block'];

//var_dump($_POST);

$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "UPDATE utilizadores
SET id_utilizadores = ?, nome = ?, email = ?, ref_nacionalidades = ?, ref_papeis = ?, data_nascimento = ?, is_blocked = ? WHERE id_utilizadores LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt,'isssssii', $id, $nome,$email, $nacionalidade, $papel, $data_nascimento,$block, $id ); // Bind variables by type to each parameter

    $id = $post_id;
    $nome = $post_name;
    $email = $post_mail;
    $nacionalidade = $post_nacionalidade;
    $papel = $post_papel;
    $data_nascimento = $post_data_nascimento;
    $data_entrada = $post_data_registo;

    //$fotografia = $post_fotografia;
    if($_POST["block"]){
        $block="1";
    }else{
        $block="0";
    }

   if( mysqli_stmt_execute($stmt)) // Execute the prepared statement
       header("Location: ../tabela_edit_utilizadores.php?id=$id&msg=updateSim");
   else

       header("Location: ../tabela_edit_utilizadores.php?id=$id&msg=updateNao");
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection
