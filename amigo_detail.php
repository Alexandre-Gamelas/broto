<!doctype html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>
<body>
<?php
require_once "connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT utilizadores.nome, utilizadores.email, utilizadores.fotografia, utilizadores.bio,  nacionalidades.nome FROM utilizadores INNER JOIN nacionalidades ON utilizadores.ref_nacionalidades = nacionalidades.id_nacionalidades WHERE utilizadores.id_utilizadores LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    $id_user = $_GET["id"];
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)) {
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $nome, $email, $foto, $bio, $nacionalidade);
        if (mysqli_stmt_fetch($stmt)) {

            include_once "components/header_amigo.php";
            ?>


            <section class="row justify-content-center mt-4 align-items-center">
                <article class="col-10">
                    <h4 class="cinzento-escuro font-weight-bold"><?= $nome ?> <a class="cinzento-escuro ml-2 fas fa-user-plus" href="scripts/script_add_amigo.php?id=<?= $id_user?>"></a></h4>
                    <?php
                    if (isset($_GET["msg"])) {
                        $msg_show = true;
                        switch ($_GET["msg"]) {
                            case 0:
                                $message = "Já segues esta pessoa";
                                $class = "alert-warning";
                                break;
                            case 1:
                                $message="Seguido com successo";
                                $class="alert-success";
                            default:
                                $msg_show = false;
                                break;
                        }

                        echo "<div class=\"alert $class alert-dismissible fade show my-3 \" role=\"alert\">
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
                    <hr class="img-fluid">
                    <h5 class="cinzento-escuro"><?= $nacionalidade ?></h5>
                    <p class="cinzento-escuro"><?= $bio ?></p>
                </article>
            </section>

            <div id="carouselPerfil" class="carousel slide mt-4 ml-4 mr-4 pb-5" style="margin-bottom: 5rem" data-ride="carousel">
                <div class="carousel-inner carouselPerfil">
                    <article id="pagina" class="col-4 p-1 paginaCarousel">
                        <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Meus Eventos</p>
                    </article>
                    <?php $amigo = true;?>
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
        } else {
            ?>
            <p>Não existe este perfil</p>

            <?php
        }
    }
}
include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
