<?php
if(isset($_SESSION['user'])) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT comentarios.conteudo, comentarios.data, utilizadores.nome, utilizadores.id_utilizadores, utilizadores.fotografia FROM comentarios
INNER JOIN utilizadores ON comentarios.ref_utilizadores = id_utilizadores
INNER JOIN eventos ON comentarios.ref_eventos = id_eventos
WHERE comentarios.ref_eventos = ?";
    $comentarios = array();

    if (mysqli_stmt_prepare($stmt, $query)) {

        if (mysqli_stmt_bind_param($stmt, 'i', $id_evento)) {

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $comentario, $data, $nome, $id_utilizador, $foto_user);
                while (mysqli_stmt_fetch($stmt)) {
                    $coment = array();
                    $coment['nome'] = $nome;
                    $coment['comentario'] = $comentario;
                    $coment['id_utilizador'] = $id_utilizador;
                    $coment['fotografia'] = $foto_user;

                    setlocale(LC_ALL, NULL);
                    setlocale(LC_ALL, 'pt');
                    $ano = $inicio[0];
                    $coment['data'] = strftime('%d de %B, %Y', strtotime($data));

                    array_push($comentarios, $coment);
                }
            } else {
                echo mysqli_stmt_error($stmt);
            }
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }  else {
        echo mysli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}