<!doctype html>
<html lang="en">
<?php
session_start();
if(isset($_SESSION['user']))
    header("location: menu.php");
include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<?php $logo=true; include_once "components/header_top.php"; ?>
<!-- bem vindo -->
<section class="row mt-4 mb-4">
    <article class="col-12 text-center" style="z-index: 200000">
        <p class="titulo-1-broto cinzento-escuro">Faz o teu login!</p>
    </article>
</section>

<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 1:
            $message = "Esta conta está bloqueada";
            $class = "alert-danger";
            break;
        case 2: case 4:
            $message = "Ocorreu um erro no login";
            $class = "alert-warning";
            break;
        case 3:
            $message = "Registo efectuado com sucesso, faça login!";
            $class = "alert-success";
            break;

        default:
            $msg_show = false;
            break;
    }

    echo "<div class=\"alert $class alert-dismissible fade show mx-5\" role=\"alert\">
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
<!-- form login -->
<form action="scripts/script_login.php" class="row justify-content-center text-center" method="post">
    <input required type="text" name="email" placeholder="Email" class="col-8 mt-3 form-control button-2-broto">
    <input required type="password" name="password" placeholder="Password" class="col-8 mt-3 form-control button-2-broto">
    <button class="col-6 button-1-broto gradient-broto text-white mt-5">Entrar</button>
    <a href="registar.php" class="col-8 pt-3">Ainda não tem conta? Registe-se aqui!</a>
</form>


<?php include_once "components/firebase.php" ?>
</body>
</html>