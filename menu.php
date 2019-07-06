<!doctype html>
<html lang="en">
<?php
session_start();


if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>

<body>
<?php
    include "scripts/get_eventos_prop.php";
   // var_dump($eventos_recomendados)
    $contador = 0;

?>

<div id="carouselMenu" class="carousel slide mt-0" data-ride="carousel">
    <div class="carousel-inner">

        <?php
        foreach ($eventos_recomendados as $eventos){
            if($contador > 0)
                $class = "";
            else
                $class = "active";
            ?>

        <div class='carousel-item <?=$class?>'>

        <?php
                $id_evento = $eventos['id_eventos'];
                $nome = $eventos['nome'];
                $fotografia = $eventos['fotografia'];
                $data = $eventos['data_inicio'];

                $inicio = explode("-", $data);
                $dia = $inicio[2];
                $mes = $inicio[1];
                $mes = substr(date('F', mktime(0, 0, 0, $mes, 10)), 0, 3);
                include "components/header_evento.php";
                $contador++;
            ?>

        </div>

            <?php
        }
        ?>

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
    











<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>
