<!doctype html>
<html lang="en">
<?php
session_start();


if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>

<body>
<!-- RECOMENDAÇÕES -->
<?php
    include "scripts/get_eventos_prop.php";
   // var_dump($eventos_recomendados)
    $contador = 0;

?>

<div id="carouselMenu" class="carousel slide mt-0" data-ride="carousel">
    <div class="carousel-inner">

        <?php
            foreach ($eventos_recomendados as $eventos) {
                if ($contador > 0)
                    $class = "";
                else
                    $class = "active";
                ?>

                <div class='carousel-item <?= $class ?>'>

                    <?php
                    $id_evento = $eventos['id_eventos'];
                    $nome = $eventos['nome'];
                    $fotografia = $eventos['fotografia'];
                    $data = $eventos['data_inicio'];
                    $local = $eventos['localizacao'];

                    $inicio = explode("-", $data);
                    $dia = $inicio[2];
                    $mes = $inicio[1];
                    $mes = substr(date('F', mktime(0, 0, 0, $mes, 10)), 0, 3);
                    $recomendacoes = true;
                    include "components/header_evento.php";
                    $contador++;
                    ?>

                </div>

                <?php
            }

            if(sizeof($eventos_recomendados) < 6){
                /// EMPURRAR O SLIDE DE SUGESTAO MAPA!!!
                ?>
                    <div class="carousel-item">
                        <section class="row position-relative">
                            <article class="col-12 position-relative h-15 header1">
                                <img src="admin/img/fotosEvento/maissugestoes.jpg" alt="" class="img-fluid">
                                <div class="gradient-broto position-absolute"></div>
                            </article>

                            <article class="col-9 m-4 position-absolute" style="z-index: 1001">
                                <h4 class="nome text-white font-weight-bold mb-3">Reparamos que ainda não participaste em muitos eventos!</h4>
                                <a href="mapa.php"><p class="text-white mb-0"><i class="fas fa-map-marker-alt "></i> Dá uma olhada no nosso <span class="font-weight-bold font-italic">mapa!</span></p></a>
                            </article>
                        </section>
                    </div>
                <?php
            }
        ?>
        <img src="assets/img/frontend/wave_nav.png" alt="" class="wave-perfil">
    </div>
    <a class="carousel-control-prev mt-5 pt-4" href="#carouselMenu" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next mt-5 pt-4" href="#carouselMenu" role="button" data-slide="next" style="z-index: 1000">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    
<!--- top categorias -->
<?php
$pagina="Top Categorias";
include "components/barra_de_pagina.php";
include "scripts/get_meus_categorias.php";
if($existe_cat==true){
    foreach ($categorias as $categoria){
    ?>

    <section class="row caixa-categoria col-10 align-items-center pl-0 pr-0">

        <article class="col-4 pl-0 pr-0">
            <img class="img-fluid pl-0" src="admin/<?= $categoria[2] ?>" alt="">
        </article>

        <article class="col-8 pr-0 pl-2">
            <h5 class="font-italic font-weight-bold texto-cat"><?= $categoria[0] ?></h5>
            <h6 class="font-weight-light texto-cat"><?= $categoria[1] ?></h6>
        </article>

    </section>


    <?php
}}else{
        ?>
        <section class="row caixa-categoria col-10 align-items-center pl-0 pr-0">

            <article class="col-4 pl-0 pr-0">
                <img class="img-fluid pl-0" src="admin/img/fotosCategoria/cat_notfound.svg" alt="">
            </article>

            <article class="col-8 pr-0 pl-2">
                <h5 class="font-italic font-weight-bold texto-cat">Não há dados para definir as suas categorias principais</h5>

            </article>

        </section>
<?php
    }
?>

<div class="mt-5 pt-5 pb-5"></div>
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
</body>
</html>
