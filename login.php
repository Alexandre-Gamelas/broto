<!doctype html>
<html lang="en">
<?php include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<section class="row">
    <article class="col-12 position-relative h-15">
        <img src="assets/img/frontend/login_img.jpg" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
        <img src="assets/img/frontend/wave_logo.png" alt="" class="wave-logo">
    </article>
</section>

<!-- bem vindo -->
<section class="row">
    <article class="col-12 text-center mt-5">
        <p class="titulo-1-broto cinzento-escuro">Faz o teu login!</p>
    </article>
</section>

<!-- form login -->
<form action="scripts/login.php" class="row justify-content-center text-center">
    <input required type="text" name="email" placeholder="Email" class="col-8 mt-3 form-control button-2-broto">
    <input required type="text" name="password" placeholder="Password" class="col-8 mt-3 form-control button-2-broto">
    <button class="col-6 button-1-broto gradient-broto text-white mt-5">Entrar</button>
</form>


<?php include_once "components/firebase.php" ?>
</body>
</html>