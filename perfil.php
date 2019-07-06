<!doctype html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
require_once "connections/connection.php";
?>
<body>
<?php include_once "components/header_perfil.php"


?>

<section class="row justify-content-center mt-4 mb-5 align-items-center">
    <article class="col-10" >
        <h4 class="cinzento-escuro font-weight-bold"><?= $_SESSION['user']['nome']?> <a class="cinzento-escuro ml-2 fas fa-pencil-alt" href="editar_perfil.php?id=<?= $_SESSION['user']['id_user']?>"></a></h4>
        <div class="row">
        <a href="seguidores.php" class="col-5"><span class="cinzento-escuro font-weight-bold">Seguidores:</span>
            <?php
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            $query = "SELECT COUNT(ref_amigos) FROM utilizadores_has_amigos WHERE ref_amigos = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, "i",  $id);
                $id=$_SESSION['user']['id_user'];
            if (mysqli_stmt_execute($stmt)) {
            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $seguidores);
            if (mysqli_stmt_fetch($stmt)) {
                echo "<span class='cinzento-escuro font-weight-normal'>$seguidores</span>";
            }else{
                echo mysqli_stmt_error($stmt);
            }
            }else{
                echo mysqli_stmt_error($stmt);
            }}else{
                echo mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);?>
        </a>
            <a href="seguidos.php" class="col-5"><span class="cinzento-escuro font-weight-bold">A Seguir:</span>
                <?php
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT COUNT(ref_utilizadores) FROM utilizadores_has_amigos WHERE ref_utilizadores = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, "i",  $id);
                    $id=$_SESSION['user']['id_user'];
                    if (mysqli_stmt_execute($stmt)) {
                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $seguidores);
                        if (mysqli_stmt_fetch($stmt)) {
                            echo "<span class='cinzento-escuro font-weight-normal'>$seguidores</span>";
                        }else{
                            echo mysqli_stmt_error($stmt);
                        }
                    }else{
                        echo mysqli_stmt_error($stmt);
                    }}else{
                    echo mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);?>
            </a></div>
        <hr class="img-fluid">
        <h5 class="cinzento-escuro"><?= $_SESSION['user']['nacionalidade']?></h5>
        <p class="cinzento-escuro mt-3 mb-3"><?= $_SESSION['user']['bio'] ?></p>
    </article>
</section>

<div id="carouselPerfil" class="carousel slide mt-0 ml-4 mr-4 mb-5" data-ride="carousel">
    <div class="carousel-inner carouselPerfil">
        <article id="pagina" class="col-4 p-1 paginaCarousel">
            <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Meus Eventos</p>
        </article>

        <?php include_once "scripts/get_meus_eventos.php" ?>

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


<!-- QR CODE BUTTON -->
<?php $pagina='Faça check in!'; include "components/barra_de_pagina.php"?>
<section class="row justify-content-center mb-5 pb-5 mt-2 ">
    <article data-toggle="modal" data-target="#qrModal" class="col-8 text-center">
        <a id="qrcode" class="fas fa-qrcode fa-9x p-5" style="border-radius:50%; border: 10px solid rgba(31, 171, 137, 1); color: rgba(31, 171, 137, 1);"></a>
    </article>
</section>

<!-- MODAL SCANNER -->

<section id='janelaQr' class="row justify-content-center align-items-center animated d-none" style="z-index: 10001">
    <article id='videoQr' class="col-12 p-0">
        <i id="qrClose" class="text-white mb-1 fas fa-times bg-success p-3" data-dismiss="modal"></i>
        <video class="img-fluid" id="preview"></video>
    </article>
</section>


<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>

<!-- SCRIPT QRCODE -->
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>
<script type="text/javascript" src="js/qrcode.min.js"></script>
<script type="text/javascript" src="js/myScanner.js"></script>
</html>