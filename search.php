
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
        while (mysqli_stmt_fetch($stmt)) {
            ?>

<div class="row align-items-center search_carta m-3">

    <div class="w-25">
        <img src="<?=$foto?>" class="mw-100 curva" alt="...">
    </div>
    <div class="w-75  pl-3">
        <h5 class="m-0 text-b2"><?=$nome?> <a href="amigo_detail.php?id=<?=$id_user?>" class="fas fa-user-circle text-cinzento"></a></h5>

    </div>
    </div>


            <?php
        }

    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo mysqli_stmt_error($stmt);
} mysqli_close($link);


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
        while (mysqli_stmt_fetch($stmt)) {
            ?><div class="row align-items-center search_carta m-3">

            <div class="w-25">
                <img src="<?=$foto?>" class="mw-100 curva" alt="...">
            </div>
            <div class="w-75  pl-3">
                <h5 class="m-0 text-b2"><?=$nome?> <a href="evento_detail.php?id=<?=$id_evento?>" class="fas fa-user-circle text-cinzento"></a></h5>


            </div>
            </div>
            <?php
        }
    } else {
        echo mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo mysqli_stmt_error($stmt);
} mysqli_close($link);



include_once  "components/bot_menu.php";
 include_once "components/bot_menu.php";
 include_once "components/side_menu.php";
 include_once "components/firebase.php"
?>
</body>
