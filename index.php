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

<?php
if (isset($_GET["msg"])) {
$msg_show = true;
switch ($_GET["msg"]) {
    case 0:
        $message = "Sessão expirada ou não iniciada";
        $class = "alert-warning";
        break;
    case 1:
        $message = "Esta conta está bloqueada";
        $class = "alert-danger";
        break;
    case 2:
        $message = "Logout efetuado com sucesso!";
        $class = "alert-success";
        break;
    case 3:
        $message = "Registo efectuado com sucesso, faça login!";
        $class = "alert-success";
        break;
    case 4:
        $message="Esta conta não tem permissões de administrador";
        $class="alert-danger";
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
</body>
</html>