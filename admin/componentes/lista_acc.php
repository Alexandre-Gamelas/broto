<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT * FROM acessibilidade ORDER BY descricao";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_acessibilidade, $descricao);

        /* fetch values */

        while (mysqli_stmt_fetch($stmt)) {
            echo "<option value=$id_acessibilidade>$descricao</option>";
        }

    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}


/*
<?php
require "connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_acessibilidade, descricao FROM acessibilidade WHERE 1";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement *//*
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
   /*     mysqli_stmt_bind_result($stmt, $id_acessibilidade, $descricao);

        /* fetch values */
/*
        while (mysqli_stmt_fetch($stmt)) {
            if(isset($ref_acessibilidade) && $id_acessibilidade == $ref_acessibilidade)
                echo "<option selected value=$id_acessibilidade>$descricao</option>";
            else
                echo "<option value=$id_acessibilidade>$descricao</option>";
            var_dump($id_acessibilidade);
        }
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
mysqli_close($link);
