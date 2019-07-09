<?php
session_start();
if(isset($_POST) && isset($_POST['comentario']) && isset($_SESSION['user'])) {

    require "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO comentarios (ref_utilizadores, ref_eventos, conteudo, data) VALUES (?, ?, ?, ?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        if (mysqli_stmt_bind_param($stmt, 'iiss', $id_user, $id_evento, $conteudo, $data)) {
            $id_user = $_SESSION['user']['id_user'];
            $id_evento = $_GET['id_evento'];
            $conteudo = $_POST['comentario'];
            $data = date('Y-m-d');

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../evento_detail.php?id=$id_evento&msg=sim");
            } else {
                echo mysqli_stmt_error($stmt);
                header("Location: ../evento_detail.php?id=$id_evento&msg=nao");
            }
        } else {
            echo mysqli_stmt_error($stmt);
            header("Location: ../evento_detail.php?id=$id_evento&msg=nao");
        }
    }  else {
        echo mysli_stmt_error($stmt);
        header("Location: ../evento_detail.php?id=$id_evento&msg=nao");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}