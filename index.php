<?php
session_start();
if(isset($_SESSION['user']))
    header("location: menu.php");

var_dump($_SESSION['user'])

?>
<!doctype html>
<html lang="en">
<?php include_once "components/head.php" ?>
<body>
<!-- HEADER -->
<?php $logo = true; include_once "components/header_top.php";
?>

<!-- bem vindo -->
<section class="row">
    <article class="col-12 text-center mt-5">
        <p class="titulo-1-broto cinzento-escuro">Bem vindo!</p>
    </article>
</section>

<!-- NAVEGAÇÃO --->
<section class="row justify-content-center mt-5">
    <article class="col-8">
            <a href="login.php" class="">
                <button class="cem-broto gradient-broto button-1-broto text-white">Login</button>
            </a>
    </article>

    <article class="col-8 mt-3">
        <a href="registar.php" class="">
            <button class="cem-broto gradient-broto button-1-broto text-white">Registar</button>
        </a>
    </article>
</section>
<?php include_once "components/firebase.php" ?>
</body>
</html>