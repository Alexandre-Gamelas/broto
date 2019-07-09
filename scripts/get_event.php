<?php
require_once "./connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT eventos.nome, data_inicio, data_fim, eventos.descricao, participantes, alcance, fotografia, inscricao, categorias.nome, acessibilidade.descricao, localizacao, check_in FROM eventos
  INNER JOIN acessibilidade ON eventos.ref_acessibilidade = id_acessibilidade
  INNER JOIN categorias  ON eventos.ref_categorias = id_categorias
WHERE eventos.id_eventos = ?";
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_evento);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $nome, $data_inicio, $data_fim, $descricao, $participantes, $alcance, $fotografia, $inscricao, $categoria, $acessibilidade, $local, $check_in);
        if (!mysqli_stmt_fetch($stmt)) {
            echo mysqli_stmt_error($stmt);
        }
    } else {
        echo mysqli_stmt_error($stmt);

    }
} else {
    echo mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
$inicio = explode("-", $data_inicio);
$dia = $inicio[2];
$mes = $inicio[1];
$mes = substr(date('F', mktime(0, 0, 0, $mes, 10)), 0, 3); //para alem de ir sacar o mes tmb estou a limitar aos 3 primeiros chars
