<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
//var_dump($link);
$start_rec = 0;
$end_rec = $start_rec+25;
$query = "SELECT eventos.id_eventos, eventos.nome, eventos.data_inicio, eventos.data_fim, eventos.longitude, eventos.latitude, eventos.descricao, eventos.participantes, eventos.alcance, eventos.super, eventos.fotografia, categorias.nome, acessibilidade.descricao FROM eventos INNER JOIN categorias  ON eventos.ref_categorias = id_categorias INNER JOIN acessibilidade ON eventos.ref_acessibilidade = id_acessibilidade WHERE 1=1 LIMIT $start_rec , $end_rec";

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $super, $fotografia, $categoria, $acessibilidade);

        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr><td>$id_eventos</td><td>$nome</td>";
            echo "<td>$data_inicio</td>";
            echo "<td>$data_fim</td>";
            echo "<td>$descricao</td>";
            echo "<td>$alcance pessoas alcançadas</td><td>$participantes participantes</td><td>$acessibilidade</td><td>$categoria</td>";
            echo "<td><a href='table_det3.php?id=".$id_eventos."'><button class='btn-success mr-1' type='button'><i class='fas fa-edit '></i></button></a></td>";
            echo "</tr>";
        }

    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
