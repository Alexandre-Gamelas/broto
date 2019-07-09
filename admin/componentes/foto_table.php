<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
//var_dump($link);
$start_rec = 0;
$end_rec = $start_rec+25;
$query = "SELECT * FROM galeria_eventos";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_fotografia, $fotografia, $ref_eventos );

        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr><td>$id_fotografia</td><td>$fotografia</td><td>$ref_eventos</td>";
            echo "<td><a href='table_det_foto.php?id=".$id_fotografia."'><button class='btn-success mr-1' type='button'><i class='fas fa-edit '></i></button></a></td>";
            echo "</tr>";
        }

    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
