<!doctype html>
<html lang="en">
<body>

<?php
session_start();

if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";

if($_GET['id'] != $_SESSION['user']['id_user'])
    Header("Location: scripts/script_logout.php");
$user_id = $_GET['id'];
?>
<?php include_once "components/header_perfil.php" ?>
<!-- ICON EDITAR FOTO -->
<a data-toggle="modal" data-target="#fotografiaModal"x><i class="far fa-edit edit-foto fa-2x text-success"></i></a>


<?PHP
//FEEDBACK fotos
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case "1":
            $message = "O ficheiro que tentou submeter não é uma imagem!";
            $class = "alert-danger";
            break;
        case "2":
            $message = "Esse ficheiro já existe na base de dados!";
            $class = "alert-warning";
            break;
        case "3":
            $message = "Pedimos desculpa, essa imagem é demasiado grande.";
            $class = "alert-warning";
            break;
        case "4":
            $message = "Apenas são permitidos ficheiros JPG, JPEG, PNG & GIF.";
            $class = "alert-warning";
            break;
        case "5":
            $message = "Desculpe, ocorreu um erro na submissão do ficheiro!";
            $class = "alert-warning";
            break;
        case "6":
            $message = "Foto submetida com sucesso!";
            $class = "alert-success";
            break;

        case "updateNao":
            $message = "Ocorreu um erro no update, por favor tente novamente";
            $class = "alert-warning";
            break;

        case "updateSim":
            $message = "Update feito com sucesso!";
            $class = "alert-success";
            break;

        default:
            $msg_show = false;
            break;
    }

    echo "<div class=\"alert $class alert-dismissible fade show mx-5 mt-4\" role=\"alert\">
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

<section class="row justify-content-center mt-4 align-items-center">
    <article class="col-10" >
        <h4 class="cinzento-escuro font-weight-bold"><?= $_SESSION['user']['nome']?></h4>
        <hr class="img-fluid">
    </article>
</section>

<form action="scripts/script_editar.php" class="row justify-content-center text-center mb-5 pb-5" method="post">
    <input required type="text" name="nome" value="<?= $_SESSION['user']['nome']?>" placeholder="Nome" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <input required type="email" name="email" value="<?=$_SESSION['user']['email']?>" placeholder="E-mail" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <input type="text" name="data" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY-MM-DD" value="<?=$_SESSION['user']['data_nasc']?>" placeholder="Data de Nascimento" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">

    <select type="text" title="nacionalidades" class="mt-3 col-8 p-2 button-2-broto cinzento-escuro" name="nacionalidade">
        <?php include_once "components/lista_nacional.php" ?>
    </select>

    <input type="text" disabled name="fotografia" value="<?= $_SESSION['user']['fotografia'] ?>" placeholder="Fotografia" class="col-8 mt-3 form-control button-2-broto text-center cinzento-escuro">
    <textarea class="button-2-broto form-control col-8 mt-3" placeholder="Biografia" name="bio" id="bio" cols="30" rows="5"><?=$_SESSION['user']['bio']?></textarea>

    <button class="col-6 button-1-broto gradient-broto text-white mt-5 mb-5">Alterar</button>
</form>


<!-- Fotografia Modal-->
<div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form class="row justify-content-center pb-5" action="admin/scripts/uploadFoto.php?id=<?= $user_id ?>&tipo=user&from=app" enctype="multipart/form-data" method="post">
                    <input style="cursor: pointer!important;" class="col-8 p-3 pb-5 form-control button-2-broto mt-4" type="file" placeholder="File" name="fileToUpload" id="fileToUpload">
                    <input class="col-8 form-control button-2-broto p-0 mt-4" type="submit" value="Upload" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>