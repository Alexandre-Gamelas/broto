<?php
require_once "./connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT eventos.nome, data_inicio, data_fim, eventos.descricao, participantes, alcance, fotografia, categorias.nome, acessibilidade.descricao FROM eventos
  INNER JOIN acessibilidade ON eventos.ref_acessibilidade = id_acessibilidade
  INNER JOIN categorias  ON eventos.ref_categorias = id_categorias
WHERE eventos.id_eventos = ?";
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_evento);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $nome, $data_inicio, $data_fim, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
        if (!mysqli_stmt_fetch($stmt)) {
            echo "<script>alert('Erro fetch');</script>";
        }
    }
}