<?php
if (isset($_POST["id_tipos"]) && ($_POST["id_tipos"]!="")) {
    require_once "../connections/connection.php";
    var_dump($_POST);
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE tipos_categorias SET nome_tipo = ? WHERE id_tipos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'si', $nome_tipo, $id_tipos);
        $nome_tipo = $_POST["nome_tipo"];
        $id_tipos = $_POST["id_tipos"];
        if (mysqli_stmt_execute($stmt)) {
            header("location: ../tables_cong.php?id=2&msg=Registo atualizado com sucesso");
        } else {
            echo mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_close($link);
}  else {
    header("location: ../tables_cong.php?id=2&msg=Sem dados para atualizar");
}