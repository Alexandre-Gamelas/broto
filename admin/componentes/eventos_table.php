<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
//var_dump($link);
$start_rec = 0;
$end_rec = $start_rec+25;
$query = "SELECT * FROM eventos WHERE 1=1 LIMIT $start_rec , $end_rec";
#$query = "SHOW COLUMNS FROM eventos";
//var_dump($query);


if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)){
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $super, $ref_categorias, $ref_acessibilidade);

        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr><td>$id_eventos</td><td>$nome</td><td>";
            echo "<button class='btn-success mr-1' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit '></i></button>$data_inicio</td>";
            echo "<button class='btn-success mr-1' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit '></i></button>$data_fim</td>";
            echo "<td><button class='btn-success mr-1' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit '></i></button> $longitude.</td>";
            echo "<td><button class='btn-success mr-1' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit '></i></button> $latitude.</td>";
            echo "<td>$descricao</td>";
            echo "<td><button class='btn-success mr-1' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit '></i></button>50</td>";
            echo "<td>$alcance pessoas alcançadas</td><td>$participantes participantes</td><td>$ref_acessibilidade</td><td>$descricao</td><td>$ref_categorias</td>";
            echo "<td><button class='btn-success' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-eraser '></i></button></td>";
            echo "</tr>";
        }

    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($link);
}
