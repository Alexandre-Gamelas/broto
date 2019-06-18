<!doctype html>
<html lang="en">
<?php include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<?php $logo=false; include_once "components/header_top.php"; ?>
<!-- bem vindo -->
<section class="row">
    <article class="col-12 text-center" style="z-index: 200000">
        <p class="titulo-1-broto cinzento-escuro mb-0">Regista-te!</p>
    </article>
</section>

<!-- Form --->
<form action="scripts/script_registar.php" class="row justify-content-center text-center" method="post">
    <input required type="text" name="nome" placeholder="Nome" class="col-8 mt-3 form-control button-2-broto">
    <input required type="text" name="email" placeholder="Email" class="col-8 mt-3 form-control button-2-broto">
    <input required type="password" name="password" placeholder="Password" class="col-8 mt-3 form-control button-2-broto">
    <input required type="password" placeholder="Verificar a Password" class="col-8 mt-3 form-control button-2-broto">
    <button class="col-6 button-1-broto gradient-broto text-white mt-4">REGISTAR</button>
</form>

<?php include_once "components/firebase.php" ?>
</body>
</html>