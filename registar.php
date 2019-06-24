<!doctype html>
<html lang="en">
<?php
session_start();
if(isset($_SESSION['user']))
    header("location: menu.php");
include_once "components/head.php" ?>
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
    <input required type="password" name="password" placeholder="Password" id="pass" class="col-8 mt-3 form-control button-2-broto">
    <input required type="password" placeholder="Verificar a Password" id="ver_pass" class="col-8 mt-3 form-control button-2-broto">
    <button id="btn_registar" class="col-6 button-1-broto gradient-broto text-white mt-4" >REGISTAR</button>
    <a href="login.php" class="col-8 pt-3">Já tem conta? Clique aqui!</a>
</form>


<?php include_once "components/firebase.php" ?>
<script src="js/Verificar_Pass.js"></script>
</body>
</html>