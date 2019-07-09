<?php
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT fotografia  FROM galeria_eventos WHERE ref_eventos = ?";
$fotografias = array();

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_evento);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $fotografia);
        while (mysqli_stmt_fetch($stmt)) {
            array_push($fotografias, $fotografia);
        }
    } else {
        echo mysqli_stmt_error($stmt);

    }
} else {
    echo mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($link);