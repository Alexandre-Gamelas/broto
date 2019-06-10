<?php
session_start();
$post_id = $_POST['id'];
$post_name = $_POST['nome'];
$post_mail = $_POST['mail'];
$post_nacionalidade = $_POST['nacionalidade'];
$post_papel = $_POST['papel'];
$post_data_nascimento = $_POST['nascimento'];
$post_data_registo = $_POST['registo'];
$post_fotografia = $_POST['fotografia'];
$post_blocked = $_POST['blocked'];

$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT(utilizadores.id_utilizadores) FROM utilizadores WHERE utilizadores.data_entrada LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt,'s', $data); // Bind variables by type to each parameter
    $data = date("Y-m")."%";
    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $num); // Bind results

    if (mysqli_stmt_fetch($stmt)) { // Fetch values
        $num_contas_recentes = $num;
    }
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection
