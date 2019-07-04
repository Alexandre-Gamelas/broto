<?php
require_once "connections/connection.php";


function ev_mais_participado() {
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) ORDER BY participantes DESC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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
    $query = "SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) AND ref_categoria IN (SELECT TOP 1 FROM utilizadores_has_categorias where ref_utilizador = ? ORDER by peso DESC) ORDER BY data_inicio ASC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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
    $query = "SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) AND ref_categoria IN (SELECT TOP 1 FROM utilizadores_has_categorias where ref_utilizador = ? ORDER by peso DESC) ORDER BY participantes DESC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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
    $query = "SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) AND id_eventos IN (SELECT DISTINCT ref_eventos, COUNT(ref_utilizadores) as conta FROM utilizadores_has_eventos WHERE ref_utilizadores IN (SELECT ref_amigos WHERE ref_utilizador = ?) GROUP BY ref_eventos) ORDER BY participantes DESC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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
    $query = "SELECT TOP 1 FROM eventos WHERE id_eventos IN (SELECT TOP 1 FROM eventos where data_inicio >= CAST(now() as date) AND id_eventos IN (SELECT DISTINCT ref_eventos, COUNT(ref_utilizadores) as conta FROM utilizadores_has_eventos WHERE ref_utilizadores IN (SELECT ref_amigos WHERE ref_utilizador = ?) GROUP BY ref_eventos) ORDER BY participantes DESC) AND ref_categorias IN (SELECT TOP 5 ref_categorias FROM utilizadores_has_categorias WHERE ref_utilizadores = ? ORDER BY peso DESC) ORDER BY participantes DESC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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
    $query = "SELECT TOP 1 FROM eventos WHERE id_eventos IN (SELECT ref_eventos FROM utilizadores_has_eventos WHERE ref_utilizadores in (SELECT ref_amigos WHERE ref_utilizador = ?)) AND data_inicio >= CAST(now() as date) ORDER BY data_inicio ASC";
    $matriz_eventos[]="";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)){
            mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $fotografia, $categoria, $acessibilidade);
            while (mysqli_stmt_fetch($stmt)) {
                //Construir Registo para retornar em ARRAY
                $matriz_eventos["id"] = $id_eventos;
                $matriz_eventos["nome"] = $nome;
                $matriz_eventos["data_inicio"] = $data_inicio;
                $matriz_eventos["data_fim"] = $data_fim;
                $matriz_eventos["longitude"] = $longitude;
                $matriz_eventos["latitude"] = $latitude;
                $matriz_eventos["descricao"] = $descricao;
                $matriz_eventos["participantes"] = $participantes;
                $matriz_eventos["alcance"] = $alcance;
                $matriz_eventos["fotografia"] = $fotografia;
                $matriz_eventos["categoria"] = $categoria;
                $matriz_eventos["acessibilidade"] = $acessibilidade;
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

?>