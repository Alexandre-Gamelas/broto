<?php
if(isset($_POST))
    var_dump($_POST);

function random_str($length, $keyspace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "INSERT INTO eventos (nome, data_inicio, data_fim, longitude, latitude, descricao, check_in, ref_categorias, ref_acessibilidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'sssddssii', $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $check_in, $categoria, $acess);

    $nome = $_POST['nome'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $acess = $_POST['acessibilidade'];
    $check_in = random_str(6);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../eventos_sync.php?work=1?msg=1");
    } else {
        echo mysqli_stmt_error($stmt);
    }
} else {
    echo mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
header("Location: ../eventos_sync.php?work=1?msg=2");

