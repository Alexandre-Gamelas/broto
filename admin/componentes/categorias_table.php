<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT categorias.*, tipos_categorias.nome_tipo FROM categorias INNER JOIN tipos_categorias ON categorias.ref_tipos_categorias = id_tipos";

if (mysqli_stmt_prepare($stmt, $query)) {
    if (mysqli_stmt_execute($stmt)){
        mysqli_stmt_bind_result($stmt, $id_categorias, $nome, $ref_tipos_categorias, $descricao, $imagem, $tipo);
        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr><td>$id_categorias</td><td>$nome</td>";
            echo "<td>$descricao</td>";
            echo "<td>$tipo</td>";
            echo "<td>$imagem</td>";
            echo "<td><a href='table_det4.php?id=".$id_categorias."'><button class='btn-success mr-1' type='button'><i class='fas fa-edit '></i></button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
