<!doctype html>
<html lang="en">
<?php include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<?php $logo=false; include_once "components/header_top.php"; ?>
<!-- bem vindo -->
<section class="row">
    <article class="col-12 text-center" style="z-index: 200000">
        <p class="titulo-1-broto cinzento-escuro">Regista-te!</p>
    </article>
</section>

<!-- Form --->
<form action="scripts/registar.php" class="row justify-content-center text-center">
    <input required type="text" name="email" placeholder="Nome" class="col-8 mt-3 form-control button-2-broto">
    <input required type="text" name="password" placeholder="Email" class="col-8 mt-3 form-control button-2-broto">
    <input required type="text" name="email" placeholder="Password" class="col-8 mt-3 form-control button-2-broto">
    <input required type="text" name="password" placeholder="Verificar a Password" class="col-8 mt-3 form-control button-2-broto">
    <button class="col-6 button-1-broto gradient-broto text-white mt-3">REGISTAR</button>
</form>

<?php include_once "components/firebase.php" ?>
</body>
</html>