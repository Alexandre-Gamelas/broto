<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Broto - Admin</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .img-user{
            height: 100px!important;
            width: 100px!important;
            border-radius: 50%;
            display: inline;
            margin-left: 20px;
        }
    </style>
</head>

<body id="page-top">



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once "componentes/sidemenu.php"?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include_once "componentes/navbar.php"?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">EDITAR UTILIZADOR</h1>


                <!-- DataTales Example -->

                <?php
                require_once "connections/connection.php";

                if (isset($_GET['id'])) {
                    $registo = $_GET['id'];
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT id_utilizadores, utilizadores.nome, utilizadores.email, utilizadores.data_nascimento, utilizadores.data_registo, utilizadores.fotografia, utilizadores.is_blocked, nacionalidades.nome, papeis.nome FROM utilizadores
                                INNER JOIN nacionalidades ON utilizadores.ref_nacionalidades = id_nacionalidades
                                INNER JOIN papeis ON utilizadores.ref_papeis = id_papeis 
                                WHERE id_utilizadores = ?";
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $registo);
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $id, $nome, $mail, $data_nascimento, $data_registo, $fotografia, $blocked, $nacionalidade, $papel);
                            if (mysqli_stmt_fetch($stmt)) {
                                    if($blocked === 0){
                                        $blocked = "Não está bloqueado";
                                    } else {
                                        $blocked = "Está bloqueado";
                                    }
                               ?>

                                <div class='card shadow mb-4'>
                                    <div class='card-header py-3'>
                                        <h6 class='m-0 font-weight-bold text-success'><?= $nome ?> <img src="<?=$fotografia ?>" alt="" class="img-user"></h6>

                                    </div>
                                    <div class='card-body'>
                                        <form class='form row justify-content-center align-items-center' id='form_evento' method='post' action='scripts\altera_user.php'>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">ID</label>
                                                <input readonly class='form-control inputRegistar' type='text' name='id' placeholder='id' value='<?= $id ?>'>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Nome</label>
                                                <input autofocus class='form-control inputRegistar' type='text' name='nome' placeholder='Nome' value='<?= $nome ?>'>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Email</label>
                                                <input class='form-control inputRegistar' type='text' name='mail' placeholder='Email' value='<?= $mail ?>'>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Nacionalidade</label>
                                                <select type="text" title="nacionalidades" class="form-control inputRegistar"  name="nacionalidade" >
                                                    <?php include_once "componentes/lista_nacional.php" ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Perfil</label>
                                                <select type="text" title="papeis" class="form-control inputRegistar"  name="papel" >
                                                    <?php include_once "componentes/lista_papeis.php" ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Data de Nascimento</label>
                                                <input class='form-control inputRegistar' type='text' name='nascimento' placeholder='Data Nascimento' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY-MM-DD" value='<?= $data_nascimento ?>'>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Data de Registo</label>
                                                <input class='form-control inputRegistar' type='text' name='registo' placeholder='Data do Registo' pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" title="Enter a date in this format YYYY-MM-DD" value='<?= $data_registo ?>'>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label for="">Fotografia</label>
                                                <a class='form-control inputRegistar' data-toggle="modal" data-target="#fotografiaModal">
                                                    <?php
                                                    if ($fotografia != null)
                                                        echo $fotografia;
                                                    else
                                                        echo "Fotografia";
                                                    ?>
                                                </a>
                                            </div>

                                            <div class="form-group col-8 mt-2">
                                                <label>Estado</label>
                                                <div class="checkbox">
                                                    <label>
                                                        <?php if($blocked==1){
                                                            echo'<input type="checkbox" name="block" checked>Bloqueado';
                                                        }else{
                                                            echo '<input type="checkbox" name="block">Bloqueado';
                                                        }?>

                                                    </label>
                                                </div>
                                            </div>

                                            <button class='col-5 inputRegistar mt-4 p-2' type='submit'>Gravar</button>
                                        </form>
                                    </div>
                                </div>

                        <?php
                            }
                        } else {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                } else {
                    header("location:../index.php");
                } ?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once "componentes/footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Fotografia Modal-->
    <div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <form class="row justify-content-center pb-5" action="scripts/uploadFoto.php?id=<?= $registo ?>&tipo=user&from=admin" enctype="multipart/form-data" method="post">
                        <input style="cursor: pointer!important;" class="col-8 p-3 pb-5 form-control inputRegistar mt-4" type="file" placeholder="File" name="fileToUpload" id="fileToUpload">
                        <input class="col-8 form-control inputRegistar mt-4" type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div>
        </div>

<?php

if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    switch ($msg) {
        case "updateSim":
            echo "<script>alert('Update efetuado com sucesso!')</script>";
            break;
        case "updateNao":
            echo "<script>alert('Update falhado!')</script>";
            break;
        case "fotoNao":
            echo "<script>alert('Foto falhada!')</script>";
            break;
        case "fotoSim":
            echo "<script>alert('Foto submetida!')</script>";
            break;
        case "1":
            echo "<script>alert('A fotografia que tentou submeter não é uma fotografia!')</script>";
            break;
        case "2":
            echo "<script>alert('A fotografia que tentou submeter já existe!')</script>";
            break;
        case "3":
            echo "<script>alert('A fotografia que tentou submeter é demasiado grande!')</script>";
            break;
        case "4":
            echo "<script>alert('O formato da fotografia que tentou submeter não é suportado!')</script>";
            break;
        case "5":
            echo "<script>alert('Por favor tente novamente!')</script>";
            break;
    }
}
?>



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
