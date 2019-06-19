<!doctype html>
<html lang="en">
<?php
session_start();
include_once "components/head.php";
?>
<body>
<?php include_once "components/header_perfil.php" ?>

<section  class="row align-items-center align-content-center pt-1">
    <article id="pagina" class="col-4 p-1">
        <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Meu Perfil</p>
    </article>
</section>

<section class="row justify-content-center mt-4">
    <article class="col-10">
        <p><?= $_SESSION['user']['nome']?> <i class="ml-2 fas fa-pencil-alt"></i></p>
        <hr class="img-fluid">
        <p>Portugal</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam aspernatur corporis dignissimos earum eveniet expedita, explicabo magni minus nam nihil non nulla pariatur, placeat quasi quo reprehenderit repudiandae soluta? Eius est, qui. Commodi debitis dolor quis quo, sequi veniam voluptas voluptate! A accusamus architecto corporis, cum delectus error laborum minima molestiae mollitia odit placeat, qui repellendus sequi similique totam? Ad adipisci blanditiis corporis eum excepturi fugit incidunt iusto magni minima nisi possimus, provident quisquam repellendus, sapiente sit soluta totam veritatis! Aperiam obcaecati odio quis voluptatum! Assumenda, deleniti deserunt est expedita impedit laborum maiores non officiis quos unde ut, voluptates.</p>
    </article>
</section>



<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>