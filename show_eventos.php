<!doctype html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>
<body>
<?php include_once "components/header_props.php" ?>

<section class="row justify-content-center mt-4 mb-5 align-items-center">

</section>

<div id="carouselPerfil" class="carousel slide mt-0 ml-4 mr-4 mb-5" data-ride="carousel">
    <div class="carousel-inner carouselPerfil">
        <article id="pagina" class="col-4 p-1 paginaCarousel">
            <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Eventos de Interesse</p>
        </article>

        <?php  include_once "scripts/get_eventos_prop.php" ?>

    </div>
    <a class="carousel-control-prev" href="#carouselPerfil" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselPerfil" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php
//FEEDBACK
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case "eventoNao":
            $message = "O evento em que tentou fazer Check In não existe.";
            $class = "alert-danger";
            break;
        case "eventoJa":
            $message = "Tentativa de Check in Duplicado!";
            $class = "alert-warning";
            break;
        case "checkinErro":
            $message = "Erro no check in, por favor tente novamente";
            $class = "alert-warning";
            break;
        case "checkinSim":
            $message = "Check in efetuado com sucesso!";
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
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>