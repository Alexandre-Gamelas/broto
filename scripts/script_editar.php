<?php
session_start();


require_once "../connections/connection.php";
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "UPDATE utilizadores
SET nome = ?, email = ?, data_nascimento = ?, bio = ? WHERE id_utilizadores LIKE ?";


if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $data_nascimento, $bio, $id); // Bind variables by type to each parameter

    $id = $_SESSION['user']['id_user'];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data"];
    $bio=$_POST["bio"];
    if(mysqli_stmt_execute($stmt)){
        $_SESSION['user']["nome"]=$nome;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['bio'] = $bio;
        header("Location: ../editar_perfil.php?id=$id&msg=updateSim");
    }else{
        header("Location: ../editar_perfil.php?id=$id&msg=updateNao");
    }
    mysqli_stmt_close($stmt); // Close statement
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);


