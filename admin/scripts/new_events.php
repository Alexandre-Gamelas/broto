<?php
//+++++++++++++++ir buscar conteudo ao JSON com get Files//
$dados = file_get_contents("../eventos.json");

//parse para array
$dados = json_decode($dados, true);

$new_events = array();
//CHECK NEW EVENTS
require_once "../connections/connection.php";
foreach ($dados as $eventos){
    foreach ($eventos as $evento){
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT id_eventos FROM eventos WHERE nome LIKE ?";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $nome);
            $nome = $evento['name'];
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 0 )
                    array_push($new_events, $evento);
            } else {
                echo  mysqli_stmt_error($stmt);
            }
        } else {
            echo mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
}