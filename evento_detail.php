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
        <h3 class="text-white text-uppercase"><i class="fas fa-external-link-alt mr-2"></i>inscreve-te</h3>
        <p class="text-white"><?= $descricao ?></p>
    </article>
</section>

<div id="carouselEvento" class="carousel slide mt-0 ml-4 mr-4 mb-5 pb-5" data-ride="carousel">
    <ol class="carousel-indicators">
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

<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>