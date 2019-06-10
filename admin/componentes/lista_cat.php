<?php
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_categorias, nome FROM categorias WHERE ref_tipos_categorias = ?";
$resultado ="";
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $ref_tipo);
    $ref_tipo = $_GET['id'];
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_categorias, $nome);
        while (mysqli_stmt_fetch($stmt)) {
             $resultado += "<option value='.$id_categorias.'>'.$nome.'</option>";
        }
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    var_dump($resultado);
    return $resultado;
} else {
    echo "Error: " . mysqli_error($link);
}
