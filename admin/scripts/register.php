<?php
require_once "../connections/connection.php";
var_dump($_POST);
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO utilizadores (nome, email, password) VALUES (?,?,?)";

if (mysqli_stmt_prepare($stmt, $query)) {


    mysqli_stmt_bind_param($stmt, 'sss', $nome, $mail, $password_cript);
    $nome = $_POST["nome"];
    $mail = strtolower($_POST["email"]);
    $password_cript = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (mysqli_stmt_execute($stmt)) {
        header("location: ../login.php?msg=3");
    }else{
        header("location: ../register.php?msg=0");
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);