<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT * FROM tipos_categorias ORDER BY nome_tipo";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_tipos, $nome_tipo);

        /* fetch values */

        while (mysqli_stmt_fetch($stmt)) {
            echo "<option value=$id_tipos>$nome_tipo</option>";
        }
        echo "</select>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
