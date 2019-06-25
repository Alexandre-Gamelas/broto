<?php
require_once  "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_utilizadores, nome, email, fotografia FROM utilizadores WHERE nome LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 's', $name);
    $name="%".$_POST["search"]."%";
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)) {
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_user,$nome, $email, $foto);
        while(mysqli_stmt_fetch($stmt)){
            echo "<p>$nome, $email</p>";
            echo "<img src='$foto'>";
        }
    }else{
        echo mysqli_stmt_error($stmt);
    }}else{
    echo mysqli_stmt_error($stmt);
}