<section class="row position-relative">
    <article class="col-12 position-relative h-15 header1">
        <img src="assets/img/frontend/login_img.jpg" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
        <img src="assets/img/frontend/wave_nav.png" alt="" class="wave-perfil">
    </article>

    <article class="col-6 text-center profile-pic-broto-2" style="z-index: 1001">
        <a data-toggle="modal" data-target="#fotografiaModal"><div class="white-1"></div>
        <div class="white-2"></div>
        <img src="<?= $_SESSION['user']['fotografia'] ?>" alt="" class="main-profile-pic">
        <i class="far fa-edit edit-foto fa-2x text-success text-center"></i></a>
    </article>
</section>


<?php $pagina = "Meu perfil"; include "./components/barra_de_pagina.php" ?>