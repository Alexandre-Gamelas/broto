<!doctype html>
<html lang="en">
<?php include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<section class="row">
    <article class="col-12 position-relative">
        <img src="assets/img/frontend/login_img.jpg" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
    </article>
</section>

<!-- bem vindo -->
<section class="row">
    <article class="col-12 text-center mt-5">
        <p class="titulo-1-broto cinzento-escuro">Bem vindo!</p>
    </article>
</section>

<!-- NAVEGAÇÃO --->
<section class="row justify-content-center mt-5">
    <article class="col-8">
        <button class="cem-broto gradient-broto button-1-broto">
            <a href="login.php" class="text-white">Login</a>
        </button>
    </article>

    <article class="col-8 mt-3">
        <button class="cem-broto gradient-broto button-1-broto">
            <a href="registar.php" class="text-white">Registar</a>
        </button>
    </article>
</section>
<?php include_once "components/firebase.php" ?>
</body>
</html>