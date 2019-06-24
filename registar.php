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
<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "Erro no registo";
            $class = "alert-warning";
            break;
        default:
            $msg_show = false;
            break;
    }

    echo "<div class=\"alert $class alert-dismissible fade show mx-5 mt-2\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
    if ($msg_show) {
        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
}
?>
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