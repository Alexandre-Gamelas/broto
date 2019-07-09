<!doctype html>
<html lang="en">
<?php
session_start();
include_once "components/head.php";
if(isset($_GET['id']))
    $id_evento = $_GET['id'];
else
    header("Location: mapa.php");
require_once "scripts/get_event.php";
?>
<body>
<?php include_once "components/header_evento.php"?>

<section class="row justify-content-center background-evento mt-4 ml-4 mr-4 mb-0">
    <article class="col-12 text-center mt-2">
        <a href="<?= $inscricao ?>" target="_blank" class="text-white"><h3 class="text-white text-uppercase"><i class="text-white fas fa-external-link-alt mr-2"></i>inscreve-te</h3></a>
        <p class="text-white"><?= $descricao ?></p>
    </article>
</section>

<div id="carouselEvento" class="carousel slide mt-0 ml-4 mr-4 mb-5" data-ride="carousel">
    <ol class="carousel-indicators mb-5">
        <li data-target="#carouselEvento" data-slide-to="0" class="active"></li>
        <li data-target="#carouselEvento" data-slide-to="1"></li>
        <li data-target="#carouselEvento" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner carouselEvento">
        <div class="carousel-item active">
            <img class="d-block w-100" src="admin/<?= $fotografia?>" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="admin/<?= $fotografia?>" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="admin/<?= $fotografia?>" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselEvento" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselEvento" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- COMENTARIOS --->

<?php $pagina = "Comentários <i class=\"pl-1 fas fa-comments\"></i>"; include "components/barra_de_pagina.php"; ?>

<?php
//FEEDBACK
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case "sim":
            $message = "Comentário Submetido!";
            $class = "alert-success";
            break;
        case "nao":
            $message = "Erro no comentário!";
            $class = "alert-warning";
            break;
        default:
            $msg_show = false;
            break;
    }

    echo "<div class=\"alert $class alert-dismissible fade show mx-5 mt-3\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
    if ($msg_show) {
        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
}
?>

<?php include_once "scripts/get_comentarios.php" ?>
<?php
    foreach ($comentarios as $comentario){
        ?>

        <section class="row caixa-comentarios p-2 pl-4 pr-4 mt-3 justify-content-center">
            <a href="amigo_detail.php?id=<?= $comentario['id_utilizador'] ?>">
                <article class="col-2 text-center p-0">
                    <div id="foto-comentario" class="bg-success">
                        <img src="admin/<?= $comentario['fotografia'] ?>" alt="" class="img-fluid">
                    </div>
                </article>
            </a>
            <article id="caixa-texto-comentario" class="col-9 ml-3 position-relative">
                <i class="fas fa-caret-left fa-2x seta-comentario"></i>
                <a href="amigo_detail.php?id=<?= $comentario['id_utilizador'] ?>"><h6 class="text-white font-weight-bold pt-2"><?= $comentario['nome'] ?> <i class="fas fa-reply-all ml-2"></i></h6></a>
                <p id="texto-comentario" class="text-white"><?= $comentario['comentario'] ?></p>
                <p id="data-comentario" class="text-white text-right mb-2"><?= $comentario['data']?></p>
                <hr class="mt-1">
            </article>
        </section>

<?php
    }

?>

<form action="scripts/post_comentario.php?id_evento=<?= $id_evento ?>" method="post" class="form-row align-items-start justify-content-end p-3">
    <input class="input-comentario form-control ml-4 col-12" name="comentario" type="text" placeholder="Insere o teu comentário...">
    <button id="cancelar-comentario" class="col-4 button-4-broto p-1 mr-2 mt-3 bg-transparent">CANCELAR</button>
    <button id="submeter-comentario" class="col-4 button-4-broto p-1 mt-3 text-white" type="submit">COMENTAR</button>
</form>





<div class="mb-5 pb-5"></div>
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
<script>
    $(".input-comentario").focus(function () {
        $(".button-4-broto").animate({
            opacity: 1
        }, 500)
    });

    $(".input-comentario").focusout(function () {
        $(".button-4-broto").animate({
            opacity: 0
        }, 500)
    });
</script>
</html>