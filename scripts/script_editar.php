<?php
session_start();


require_once "../connections/connection.php";
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "UPDATE utilizadores
SET nome = ?, email = ?, data_nascimento = ?, bio = ?, ref_nacionalidades = ? WHERE id_utilizadores LIKE ?";


if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt, 'ssssii', $nome, $email, $data_nascimento, $bio, $nac, $id); // Bind variables by type to each parameter

    $id = $_SESSION['user']['id_user'];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data"];
    $nac = $_POST["nacionalidade"];
    $bio=$_POST["bio"];
    if(mysqli_stmt_execute($stmt)){
        $_SESSION['user']["nome"]=$nome;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['bio'] = $bio;
        $_SESSION['user']['data_nasc']=$data_nascimento;

    }else{
        header("Location: ../editar_perfil.php?id=$id&msg=updateNao");
    }
    mysqli_stmt_close($stmt); // Close statement
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);



$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT nacionalidades.nome FROM nacionalidades WHERE nacionalidades.id_nacionalidades = ?";


if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt, 'i', $idNac); // Bind variables by type to each parameter

    $idNac = $_POST['nacionalidade'];

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt,  $nomeNac);
        if(mysqli_stmt_fetch($stmt)){
            $_SESSION['user']['nacionalidade'] = $nomeNac;
            header("Location: ../editar_perfil.php?id=$id&msg=updateSim");
        }
    }else{
        header("Location: ../editar_perfil.php?id=$id&msg=updateNao");
    }
    mysqli_stmt_close($stmt); // Close statement
}else{
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);



