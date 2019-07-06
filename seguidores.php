
<!doctype html>
<html lang="en">
<?php
session_start();


if (!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
require_once "connections/connection.php";

?><body>
<div class="row justify-content-center mt-4 mb-5">
<button class="col-8 cem-broto gradient-broto button-1-broto text-white mr-3 ">Seguidores</button>

</div>
<?php
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query = "SELECT id_utilizadores, nome, email, fotografia FROM utilizadores INNER JOIN utilizadores_has_amigos ON id_utilizadores=ref_utilizadores WHERE ref_amigos = ? ";

if (mysqli_stmt_prepare($stmt, $query)) {

mysqli_stmt_bind_param($stmt, 'i', $id);
$id = $_SESSION['user']['id_user'];
/* execute the prepared statement */
if (mysqli_stmt_execute($stmt)) {
/* bind result variables */
mysqli_stmt_bind_result($stmt, $id_user, $nome, $email, $foto);
    while (mysqli_stmt_fetch($stmt)) {
$foto="admin/".$foto;?>
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
</a><?php
    }}else {
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

</body>
