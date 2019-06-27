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
                    <hr class="img-fluid">
                    <h5 class="cinzento-escuro"><?= $nacionalidade ?></h5>
                    <p class="cinzento-escuro"><?= $bio ?></p>
                </article>
            </section>

            <div id="carouselPerfil" class="carousel slide mt-0 ml-4 mr-4 mb-5 pb-5" data-ride="carousel">
                <ol class="carousel-indicators mb-5">
                    <li data-target="#carouselPerfil" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselPerfil" data-slide-to="1"></li>
                    <li data-target="#carouselPerfil" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner carouselPerfil ">
                    <article id="pagina" class="col-4 p-1 paginaCarousel">
                        <p class="text-right text-white mb-0 pr-1" style="font-size: 4vmin">Meus Eventos</p>
                    </article>
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/frontend/placeholderperfil.jpeg" alt="Third slide">
                    </div>
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
