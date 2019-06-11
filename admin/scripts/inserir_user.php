<?php
session_start();
include_once "../connections/connection.php";
var_dump($_POST);
echo "<br>";
$nome = $_POST['nome'];
$mail = $_POST['mail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nascimento = $_POST['nascimento'];

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO utilizadores (nome, email, password, data_nascimento) VALUES (?, ?, ?, ?) ";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, 'ssss', $nomeP,$emailP, $passwordP, $data_nascimentoP);
    $nomeP = $nome;
    $emailP = $mail;
    $passwordP = $password;
    $data_nascimentoP = $nascimento;

   if (mysqli_stmt_execute($stmt)){
        header("Location: ../tabela_utilizadores.php");
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