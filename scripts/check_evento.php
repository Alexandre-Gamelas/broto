<?php
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT ref_utilizadores FROM utilizadores_has_eventos
INNER JOIN utilizadores ON utilizadores_has_eventos.ref_utilizadores = id_utilizadores
INNER JOIN eventos ON utilizadores_has_eventos.ref_eventos = id_eventos
WHERE ref_utilizadores = ?
AND ref_eventos = ?";
$participou = false;

if(mysqli_stmt_prepare($stmt, $query)){
    mysqli_stmt_bind_param($stmt, "ii", $user, $evento);
    $user = $_SESSION['user']['id_user'];
    $evento = $id_evento;

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt, $id_user);
        if(mysqli_stmt_fetch($stmt)){
            $participou = true;
        } else {
            $participou = false;
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo mysqli_stmt_error($stmt);
}