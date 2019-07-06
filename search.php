<!doctype html>
<html lang="en">
<?php
session_start();


if (!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
require_once "connections/connection.php";
?>
<body>
<div class="row justify-content-center mt-4 mb-5">
    <button id="btn_pessoas" class="col-5 cem-broto gradient-broto button-3-broto text-white mr-3 search-active">
        Pessoas
    </button>
    <button id="btn_eventos" class="col-5 cem-broto gradient-broto button-3-broto text-white search-deactive"> Eventos</button>
</div>
<?php


$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_utilizadores, nome, email, fotografia FROM utilizadores WHERE nome LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 's', $name);
    $name = "%" . $_POST["search"] . "%";
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)) {
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_user, $nome, $email, $foto);

        echo '<div id="pessoas" class="mb-5 pb-5">';;
        if (!mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="row align-items-center search_carta m-3 mt-5">
                <h3 class="font-weight-bold text-gradient m-4">Não há resultados!</h3>
            </div>


            <?php
        } else {
            if ($id_user != $_SESSION['user']['id_user']) {
                $foto = "admin/" . $foto;
                ?>
                <a href="amigo_detail.php?id=<?= $id_user ?>">
                    <div class="row align-items-center search_carta m-3 ">

                        <div class="w-25">
                            <img src="<?= $foto ?>" class="mw-100 curva" alt="...">
                        </div>
                        <div class="w-75  pl-3">
                            <h5 class="m-0 text-search"><?= $nome ?> &nbsp <i
                                        class="fas fa-1x fa-user-circle text-gradient"></i></h5>

                        </div>
                    </div>
                </a>
                <?php
            } else {
                ?>
                <a href="perfil.php">
                    <div class="row align-items-center search_carta m-3 ">

                        <div class="w-25">
                            <img src="<?= $_SESSION['user']['fotografia'] ?>" class="mw-100 curva" alt="...">
                        </div>
                        <div class="w-75  pl-3">
                            <h5 class="m-0 text-search"><?= $nome ?> - Tu &nbsp <i
                                        class="fas fa-1x fa-user-circle text-gradient"></i></h5>

                        </div>
                    </div>
                </a>
                <?php
            }

            while (mysqli_stmt_fetch($stmt)) {
                if ($id_user == $_SESSION['user']['id_user']) {
                    ?>
                    <a href="perfil.php">
                    <div class="row align-items-center search_carta m-3 ">

                        <div class="w-25">
                            <img src="<?= $_SESSION['user']['fotografia'] ?>" class="mw-100 curva" alt="...">
                        </div>
                        <div class="w-75  pl-3">
                            <h5 class="m-0 text-search"><?= $nome ?> - Tu &nbsp <i
                                        class="fas fa-1x fa-user-circle text-gradient"></i></h5>

                        </div>
                    </div>
                    </a><?php } else {
                    $foto = "admin/" . $foto; ?>
                    <a href="amigo_detail.php?id=<?= $id_user ?>">
                        <div class="row align-items-center search_carta m-3">

                            <div class="w-25">
                                <img src="<?= $foto ?>" class="mw-100 curva" alt="...">
                            </div>
                            <div class="w-75  pl-3">
                                <h5 class="m-0 text-search"><?= $nome ?> &nbsp <i
                                            class="fas fa-1x fa-user-circle text-gradient"></i></h5>

                            </div>
                        </div>
                    </a>
                    <?php
                }

            }
        }
        echo "</div>";

    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);


$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_eventos, nome, data_inicio, descricao, fotografia FROM eventos WHERE nome LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 's', $name);
    $name = "%" . $_POST["search"] . "%";
    /* execute the prepared statement */
    if (mysqli_stmt_execute($stmt)) {
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_evento, $nome, $data_inicio, $descricao, $foto);
        echo '<div id="eventos" class="mb-5 pb-5">';
        if (!mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="row align-items-center search_carta m-3 mt-5">
                <h3 class="font-weight-bold text-gradient m-4">Não há resultados!</h3>
            </div>


            <?php
        } else {
            $foto = "admin/" . $foto ?>
            <a href="evento_detail.php?id=<?= $id_evento ?>">
                <div class="row align-items-center search_carta m-3">

                    <div class="w-25">
                        <img src="<?= $foto ?>" class="mw-100 curva_evento" alt="...">
                    </div>
                    <div class="w-75  pl-3">
                        <h5 class="m-0 text-search"><?= $nome ?> <i class="fas fa-user-circle text-gradient"></i></h5>


                    </div>
                </div>
            </a>
            <?php
            while (mysqli_stmt_fetch($stmt)) {
                $foto = "admin/" . $foto;
                ?><a href="evento_detail.php?id=<?= $id_evento ?>">
                <div class="row align-items-center search_carta m-3">

                    <div class="w-25">
                        <img src="<?= $foto ?>" class="mw-100 curva_evento" alt="...">
                    </div>
                    <div class="w-75  pl-3">
                        <h5 class="m-0 text-search"><?= $nome ?> <i class="fas fa-user-circle text-gradient"></i></h5>


                    </div>
                </div>
                </a>
                <?php
            }
        }

        echo "</div>";
    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo mysqli_stmt_error($stmt);
}
mysqli_close($link);


include_once "components/bot_menu.php";
include_once "components/side_menu.php";
include_once "components/firebase.php"
?>
<script src="js/search.js"></script>
<script>
    var pessoas = true;

    $("#btn_pessoas").click(function () {
        if (!pessoas) {
            $(this).removeClass("search-deactive");
            $(this).addClass("search-active");
            $("#btn_eventos").addClass("search-deactive");
            $("#btn_eventos").removeClass("search-active");

            pessoas = true;
        }
    })

    $("#btn_eventos").click(function () {
        if (pessoas) {
            $(this).removeClass("search-deactive");
            $(this).addClass("search-active");

            $("#btn_pessoas").addClass("search-deactive");
            $("#btn_pessoas").removeClass("search-active");

            pessoas = false;
        }
    })


</script>
</body>
