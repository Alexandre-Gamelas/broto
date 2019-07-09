<!doctype html>
<html lang="en">
<?php
session_start();
include_once "components/head.php";
if (isset($_GET['id']))
    $id_evento = $_GET['id'];
else
    header("Location: mapa.php");
require_once "scripts/get_event.php";
?>
<body>
<?php include "scripts/check_evento.php";
include_once "components/header_evento.php" ?>
<?php
//FEEDBACK
if (isset($_GET["msg2"])) {
    $msg_show = true;
    switch ($_GET["msg2"]) {
        case "checkSim":
            $message = "Check in efetuado com sucesso!";
            $class = "alert-success";
            break;
        case "checkNao":
            $message = "Erro no check in, por favor tente novamente";
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


<section class="row justify-content-center background-evento mt-4 ml-4 mr-4 mb-0">
    <article class="col-12 text-center mt-2">
        <a href="<?= $inscricao ?>" target="_blank" class="text-white"><h3 class="text-white text-uppercase"><i
                        class="text-white fas fa-external-link-alt mr-2"></i>inscreve-te</h3></a>
        <p class="text-white"><?= $descricao ?></p>
    </article>
</section>

<!-- FOTOGRAFIAS -->
<?php include "scripts/get_fotografias.php";
$contador = 0 ?>
<div id="carouselEvento" class="carousel slide mt-0 ml-4 mr-4 mb-5" data-ride="carousel">
    <ol class="carousel-indicators mb-2">
        <?php

        foreach ($fotografias as $fotografia) {
            if ($contador == 0)
                $class = "active";
            else
                $class = "";
            ?>
            <li data-target="#carouselEvento" data-slide-to="<?= $contador?>" class="<?= $class?>"></li>
            <?php
            $contador++;
        }

        ?>
    </ol>
    <div class="carousel-inner carouselEvento">
        <?php
        $contador = 0;
        foreach ($fotografias as $fotografia) {
            if ($contador == 0)
                $class = "active";
            else
                $class = "";
            ?>
                <div class="carousel-item <?= $class ?>">
                    <img class="d-block w-100" src="admin/<?= $fotografia ?>">
                </div>

            <?php
            $contador++;
        }
        ?>
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

<!-- estatisticas -->
<?php
foreach ($estatisticas as $tipo => $estatistica) {
    switch ($tipo) {
        case "Categoria":
            $estatistica = explode("-", $estatistica);
            $nome = $estatistica[0];
            $imagem = $estatistica[1];
            break;
        case "Acessibilidade":
            $imagem = "img/access.svg";
            break;
        case "Participantes":
            $imagem = "img/participantes.svg";
            break;
        case "Alcance":
            $imagem = "img/alcance2.svg";
            break;
    }
    ?>
    <section class="row caixa-categoria col-10 align-items-center pl-0 pr-0">

        <article class="col-4 pl-0 pr-0">
            <img class="img-fluid pl-0" src="admin/<?= $imagem ?>" alt="">
        </article>

        <article class="col-8 pr-0 pl-2">
            <h5 class="font-italic font-weight-bold texto-cat">
                <?= $tipo ?>
            </h5>


            <h6 class="font-weight-light texto-cat">
                <?php
                if ($tipo == "Categoria")
                    echo $nome;
                else
                    echo $estatistica;

                ?>

            </h6>

        </article>

    </section>
    <?php
}
?>


<!-- COMENTARIOS --->
<div class="mt-5"></div>
<?php $pagina = "Comentários <i class=\"pl-1 fas fa-comments\"></i>";
include "components/barra_de_pagina.php"; ?>

<?php
//FEEDBACK
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case "sim":
            $message = "Comentário Submetido!";
            $class = "alert-success";
            break;
        case "apagado":
            $message = "Comentário Apagado!";
            $class = "alert-success";
            break;
        case "naoapagado":
            $message = "Comentário não apagado, tente novamente";
            $class = "alert-warning";
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
if (sizeof($comentarios) > 0) {
    foreach ($comentarios as $comentario) {
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
                <?php
                if ($_SESSION['user']['papel'] == 1) {
                    echo "<a href='scripts/apagar_comentario.php?id=" . $comentario['id_comentario'] . "&evento=$id_evento' class=\"fas fa-times text-danger apagar-comentario\"></a>";
                }
                ?>
                <i class="fas fa-caret-left fa-2x seta-comentario"></i>
                <a href="amigo_detail.php?id=<?= $comentario['id_utilizador'] ?>"><h6
                            class="text-white font-weight-bold pt-2"><?= $comentario['nome'] ?> <i
                                class="fas fa-reply-all ml-2"></i></h6></a>
                <p id="texto-comentario" class="text-white"><?= $comentario['comentario'] ?></p>
                <p id="data-comentario" class="text-white text-right mb-2"><?= $comentario['data'] ?></p>
                <hr class="mt-1">
            </article>
        </section>

        <?php
    }
} else {
    ?>

    <section class="row justify-content-center mt-4">
        <article class="col-12 text-center cinzento-escuro">
            <h3>Sê o primeiro a comentar!</h3>
        </article>
    </section>

    <?php
}
?>

<form action="scripts/post_comentario.php?id_evento=<?= $id_evento ?>" method="post"
      class="form-row align-items-start justify-content-end p-3">
    <input class="input-comentario form-control ml-4 col-12" name="comentario" type="text"
           placeholder="Insere o teu comentário...">
    <button id="cancelar-comentario" class="col-4 button-4-broto p-1 mr-2 mt-3 bg-transparent" type="reset">CANCELAR
    </button>
    <button id="submeter-comentario" class="col-4 button-4-broto p-1 mt-3 text-white" type="submit">COMENTAR</button>
</form>

<!-- GERAR QR CODE -->
<?php
    if($_SESSION['user']['papel'] == 1){
        ?>
        <?php $pagina = "Check In <i class=\"pl-1 fas fa-qrcode\"></i>"; include "components/barra_de_pagina.php"?>
        <section class="row justify-content-center mt-4">
            <article class="col-6 text-center">
                <div id="qrcode" class="img-fluid"></div>
            </article>
        </section>
        <?php
        echo "<script> var texto = '$check_in'</script>"
        ?>
        <script>
            jQuery('#qrcode').qrcode({
                width: 128,
                height: 128,
                text	: texto
            });
        </script>
        <?php
    }
?>


<div class="mb-5 pb-5"></div>
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
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