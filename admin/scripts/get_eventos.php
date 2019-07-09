<?php
include "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT nome, id_eventos FROM eventos";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $nome, $id);

        /* fetch values */

        while (mysqli_stmt_fetch($stmt)) {
                echo "<option  value=$id>$nome</option>";
        }
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
mysqli_close($link);
