<?php
session_start();
if(isset($_SESSION['user'])) {
    require "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "DELETE FROM comentarios WHERE id_comentario = ?";
    $id_evento = $_GET['evento'];
    if (mysqli_stmt_prepare($stmt, $query)) {

        if (mysqli_stmt_bind_param($stmt, 'i', $id_comentario)) {
            $id_comentario = $_GET['id'];
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../evento_detail.php?id=$id_evento&msg=apagado");
            } else {
                echo mysqli_stmt_error($stmt);
                header("Location: ../evento_detail.php?id=$id_evento&msg=naoapagado");
            }
        } else {
            echo mysqli_stmt_error($stmt);
            header("Location: ../evento_detail.php?id=$id_evento&msg=naoapagado");
        }
    }  else {
        echo mysli_stmt_error($stmt);
        header("Location: ../evento_detail.php?id=$id_evento&msg=naoapagado");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}