<?php
if ((isset($_POST["id_nacionalidades"])) && ($_POST["id_nacionalidades"]!="")) {
    require_once "../connections/connection.php";
    var_dump($_POST);
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE nacionalidades SET nome = ? WHERE id_nacionalidades = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $nome, $id_nacionalidades);
        $nome = $_POST["nome"];
        $id_nacionalidades = $_POST["id_nacionalidades"];
        if (mysqli_stmt_execute($stmt)) {
            header("location: ../tables_cong.php?id=1&msg=Registo de País atualizado com sucesso");
        } else {
            echo mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_close($link);
} else {
    header("location: ../tables_cong.php?id=1&msg=Sem dados para atualizar");
}