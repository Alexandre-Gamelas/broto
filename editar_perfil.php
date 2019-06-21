<!doctype html>
<html lang="en">
<body>

<?php
session_start();
include_once "components/head.php";
if($_GET['id'] != $_SESSION['user']['id_user'])
    Header("Location: scripts/script_logout.php");
?>
<?php include_once "components/header_perfil.php" ?>

<section class="row justify-content-center mt-4 align-items-center">
    <article class="col-10" >
        <h4 class="cinzento-escuro font-weight-bold"><?= $_SESSION['user']['nome']?></h4>
        <hr class="img-fluid">
    </article>
</section>

<form action="scripts/script_editarPerfil.php" class="row justify-content-center text-center mb-5 pb-5" method="post">
    <input required type="text" name="nome" value="<?= $_SESSION['user']['nome']?>" placeholder="Nome" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <input required type="email" name="email" value="<?=$_SESSION['user']['email']?>" placeholder="E-mail" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <input required type="text" name="data" placeholder="Data de Nascimento" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <input type="text" name="fotografia"value="<?= $_SESSION['user']['fotografia'] ?>" placeholder="Fotografia" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">

    <textarea class="button-2-broto form-control col-8 mt-3" placeholder="Biografia" name="bio" id="bio" cols="30" rows="5"></textarea>

    <button class="col-6 button-1-broto gradient-broto text-white mt-5 mb-5">Alterar</button>
</form>










<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>