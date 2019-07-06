<?php
require_once "./connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT categorias.nome, categorias.descricao, categorias.imagem FROM categorias
INNER JOIN utilizadores_has_categorias ON categorias.id_categorias = utilizadores_has_categorias.ref_categorias
WHERE ref_utilizadores = ?
ORDER BY peso
LIMIT 2";
$categorias = array();
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    if (!isset($amigo))
        $id_user = $_SESSION['user']['id_user'];
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $nome, $descricacao, $imagem);
        while (mysqli_stmt_fetch($stmt)) {
            $dados = array($nome, $descricacao, $imagem);
            array_push($categorias, $dados);
        }
    } else {
        mysqli_stmt_error($stmt);
    }
} else {
    mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
