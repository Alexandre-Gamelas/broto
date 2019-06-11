<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT * FROM papeis WHERE 1";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_papeis, $nome);

        /* fetch values */

        while (mysqli_stmt_fetch($stmt)) {
            if($nome== $papel)
                echo "<option selected value='$id_papeis'>$nome</option>";
            else
                echo "<option value='$id_papeis'>$nome</option>";
        }
        echo "</select>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
