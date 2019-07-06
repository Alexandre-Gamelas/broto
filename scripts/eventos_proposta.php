<?php
require_once "connections/connection.php";

function model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao) {

    $matriz["id_eventos"] = $id_eventos;
    $matriz["nome"] = $nome;
    $matriz["data_inicio"] = $data_inicio;
    $matriz["data_fim"] = $data_fim;
    $matriz["longitude"] = $longitude;
    $matriz["latitude"] = $latitude;
    $matriz["descricao"] = $descricao;
    $matriz["participantes"] = $participantes;
    $matriz["alcance"] = $alcance;
    $matriz["fotografia"] = $fotografia;
    $matriz["ref_categorias"] = $ref_categorias;
    $matriz["ref_acessibilidade"] = $ref_acessibilidade;
    $matriz["check_in"] = $check_in;
    $matriz["inscricao"] = $inscricao;
    $matriz["localizacao"] = $localizacao;

    return $matriz;
}


function ev_mais_participado() {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT * FROM eventos WHERE data_inicio >= CAST(now() as date) ORDER BY participantes DESC;";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}



function ev_cat_favorita($id_user) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT * FROM eventos WHERE data_inicio >= CAST(now() as date) AND ref_categorias IN (SELECT ref_categorias FROM utilizadores_has_categorias WHERE ref_utilizadores = ? ORDER by peso DESC) ORDER BY data_inicio ASC LIMIT 1 ";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}

function ev_suacat_mais_participada($id_user) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT * FROM eventos where data_inicio >= CAST(now() as date) AND ref_categorias IN (SELECT ref_categorias FROM utilizadores_has_categorias where ref_utilizadores = ? ORDER by peso DESC) ORDER BY participantes DESC LIMIT 1";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}

function ev_mais_amigos($id_user) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT * FROM eventos WHERE data_inicio >= CAST(now() as date) AND id_eventos IN (SELECT DISTINCT ref_eventos FROM utilizadores_has_eventos WHERE ref_utilizadores IN (SELECT ref_amigos FROM utilizadores_has_amigos WHERE ref_utilizadores = ?) GROUP BY ref_eventos) ORDER BY participantes DESC LIMIT 1";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}

function ev_suacat_mais_amigos($id_user) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    //$query21 = "SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) AND id_eventos IN (SELECT DISTINCT ref_eventos, COUNT(ref_utilizadores) as conta FROM utilizadores_has_eventos WHERE ref_utilizadores IN (SELECT ref_amigos WHERE ref_utilizador = ?) GROUP BY ref_eventos) ORDER BY participantes DESC";
    $query = "SELECT * FROM eventos WHERE ref_categorias IN (SELECT ref_categorias from utilizadores_has_categorias WHERE ref_utilizadores = ? ORDER BY peso DESC) AND id_eventos in (SELECT DISTINCT id_eventos FROM utilizadores_has_eventos WHERE ref_utilizadores IN (SELECT ref_amigos from utilizadores_has_amigos WHERE ref_utilizadores = ?) GROUP BY id_eventos) AND data_inicio >= CAST(now() as date) LIMIT 1";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}

function ev_next_mais_amigos($id_user) {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT * FROM eventos WHERE id_eventos IN (SELECT ref_eventos FROM utilizadores_has_eventos WHERE ref_utilizadores in (SELECT ref_amigos FROM utilizadores_has_amigos WHERE ref_utilizadores = ?)) AND data_inicio >= CAST(now() as date) ORDER BY data_inicio ASC LIMIT 1";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos = model_dados($id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $ref_categorias, $ref_acessibilidade, $fotografia, $check_in, $inscricao, $localizacao);
                return $matriz_eventos;

            }
        } else {
            $matriz_eventos["erro"] = "Erro: " . mysqli_stmt_error($stmt);
            return $matriz_eventos;
        }
        mysqli_stmt_close($stmt);
    } else {
        $matriz_eventos["erro"] = "Erro: " . mysqli_error($link);
        return $matriz_eventos;
    }
}

function get_propostas($user) {
    $matriz_total[] = "";

    $cautela = ev_mais_participado();
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    $cautela = ev_cat_favorita($user);
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    $cautela = ev_suacat_mais_participada($user);
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    $cautela = ev_suacat_mais_amigos($user);
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    $cautela = ev_mais_amigos($user);
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    $cautela = ev_next_mais_amigos($user);
    if (!isset($cautela["erro"])) $matriz_total[] = $cautela ;

    return $matriz_total;

}

function demote_eventos($matriz[]) {


}

?>