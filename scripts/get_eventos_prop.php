<?php

require_once "./scripts/eventos_proposta.php";
$user = $_SESSION['user']["id_user"];
$eventos_recomendados = array();

if(ev_mais_participado() != null) {
    $evento_mais_participado = ev_mais_participado();
    $eventos_recomendados['evento_mais_participado'] = $evento_mais_participado;

}
if(ev_cat_favorita($user) != null) {
    $evento_categoria_favorita = ev_cat_favorita($user);
    $eventos_recomendados['evento_categoria_favorita'] = $evento_categoria_favorita;
}

if(ev_suacat_mais_participada($user) != null) {
    $evento_cat_mais_participado = ev_suacat_mais_participada($user);
    $eventos_recomendados['evento_cat_mais_participada'] = $evento_cat_mais_participado;
}

if(ev_mais_amigos($user) != null) {
    $evento_mais_amigos = ev_mais_amigos($user);
    $eventos_recomendados['evento_mais_amigos'] = $evento_mais_amigos;
}
if(ev_suacat_mais_amigos($user) != null) {
    $evento_cat_mais_amigos = ev_suacat_mais_amigos($user);
    $eventos_recomendados['evento_cat_mais_amigos'] = $evento_cat_mais_amigos;
}

if(ev_next_mais_amigos($user) != null) {
    $evento_next_mais_amigos = ev_next_mais_amigos($user);
    $eventos_recomendados['evento_next_mais_amigos'] = $evento_next_mais_amigos;
}



?>
