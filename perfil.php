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
        <p class="cinzento-escuro"><?= $_SESSION['user']['bio'] ?></p>
    </article>
</section>



<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>