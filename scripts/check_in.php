<?php
session_start();
require "../connections/connection.php";
//fazer check se o evento existe
$existe = false;
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_eventos, ref_categorias, ref_tipos_categorias FROM eventos
 INNER JOIN categorias  ON eventos.ref_categorias = id_categorias
 WHERE check_in = ?";

if(mysqli_stmt_prepare($stmt, $query)){
    mysqli_stmt_bind_param($stmt, "s", $check_in);
    $check_in = $_GET['check_in'];

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt, $id_evento, $categoria, $tipo_categoria);
        if(mysqli_stmt_fetch($stmt)){
            //evento existe
            $existe = true;
            echo "<p>EXISTE</p>";
        } else {
            //evento não existe
            echo "<p>NÃO EXISTE</p>";
            echo mysqli_stmt_error($stmt);
            header("Location: ../perfil.php?msg=eventoNao");
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo mysqli_stmt_error($stmt);
}
//verificar se o utilizador já foi ao evento!!!!!

include "check_evento.php";


//inserir em utilizadores tem eventos
$inseriu = false;
if($existe && !$participou){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $id_user = $_SESSION['user']['id_user'];
    $query = "INSERT INTO utilizadores_has_eventos (ref_utilizadores, ref_eventos) VALUES (?, ?)";

    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_evento);
        if(mysqli_stmt_execute($stmt)){
            echo "<p>INSERIU</p>";
            $inseriu = true;
        } else {
            header("Location: ../perfil.php?msg=eventoJa");
            echo mysqli_stmt_error($stmt);
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

//inserir em utilizador tem categorias
if($inseriu){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $id_user = $_SESSION['user']['id_user'];
    $query = "INSERT INTO utilizadores_has_categorias (ref_utilizadores, ref_categorias, ref_tipos_categorias, peso) VALUES (?, ?, ? , 1)
      ON DUPLICATE KEY UPDATE peso = peso + 1";

    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, "iii", $id_user, $categoria, $tipo_categoria);
        if(mysqli_stmt_execute($stmt)){
            echo "<p>INSERIU</p>";
            $inseriu = true;
            if(isset($_GET['from']) && $_GET['from'] == 'detail')
                header("Location: ../evento_detail.php?id=$id_evento&msg=checkSim");
            else
                header("Location: ../perfil.php?msg=checkinSim");
        } else {
            if(isset($_GET['from']) && $_GET['from'] == 'detail')
                header("Location: ../evento_detail.php?id=$id_evento&msg=checkNao");
            else
                header("Location: ../perfil.php?msg=checkinErro");
            echo mysqli_stmt_error($stmt);
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}