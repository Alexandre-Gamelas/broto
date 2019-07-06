<?php

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_categorias, nome FROM categorias";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_categoria, $nome_categoria);

        /* fetch values */

        while (mysqli_stmt_fetch($stmt)) {
            echo "<option value=$id_categoria>$nome_categoria</option>";
        }
        echo "<option value='nova'>Nova Categoria*</option>";
        echo "</select>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
?>
