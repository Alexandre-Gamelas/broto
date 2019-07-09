<?php
session_start();
include_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_eventos, fotografia  FROM eventos";
if (mysqli_stmt_prepare($stmt, $query)) {

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $id_evento, $imagem);
        while (mysqli_stmt_fetch($stmt)) {

            include "syncfotos2.php";
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }
} else {
    echo mysqli_stmt_error($stmt);
}
