<!doctype html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>
<body>
<?php include_once "components/header_perfil.php" ?>

<section class="row justify-content-center mt-4 align-items-center">
    <article class="col-10" >
        <h4 class="cinzento-escuro font-weight-bold"><?= $_SESSION['user']['nome']?> <a class="cinzento-escuro ml-2 fas fa-pencil-alt" href="editar_perfil.php?id=<?= $_SESSION['user']['id_user']?>"></a></h4>
        <hr class="img-fluid">
        <h5 class="cinzento-escuro"><?= $_SESSION['user']['nacionalidade']?></h5>
        <p class="cinzento-escuro mt-3 mb-3"><?= $_SESSION['user']['bio'] ?></p>
    </article>
</section>

<div id="carouselPerfil" class="carousel slide mt-0 ml-4 mr-4 mb-4" data-ride="carousel">
    <ol class="carousel-indicators mb-5">
        <li data-target="#carouselPerfil" data-slide-to="0" class="active"></li>
        <li data-target="#carouselPerfil" data-slide-to="1"></li>
        <li data-target="#carouselPerfil" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner carouselPerfil">
        <article id="pagina" class="col-4 p-1 paginaCarousel">
            <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Meus Eventos</p>
        </article>
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselPerfil" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselPerfil" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- QR CODE BUTTON -->
<section class="row justify-content-center mb-5 pb-5 ">
    <article data-toggle="modal" data-target="#qrModal" class="col-8 text-center">
        <a id="qrcode" class="far fa-calendar-plus fa-9x text-white bg-success p-5" style="border-radius:19px"></a>
    </article>
</section>

<!-- MODAL SCANNER -->

    <section id='janelaQr' class="row justify-content-center align-items-center animated d-none" style="z-index: 10001">
        <article id='videoQr' class="col-12 p-0">
            <i id="qrClose" class="text-white mb-1 fas fa-times bg-success p-3" data-dismiss="modal"></i>
            <video class="img-fluid" id="preview"></video>
        </article>
    </section>


<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>

<!-- SCRIPT QRCODE -->
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>
<script type="text/javascript" src="js/qrcode.min.js"></script>
<script type="text/javascript" src="js/myScanner.js"></script>
</html>