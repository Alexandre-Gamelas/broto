<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php






?>

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
                <h1 class="h3 mb-2 text-gray-800">EDITAR EVENTO</h1>


                <!-- DataTales Example -->

                        <?php
                            require_once "connections/connection.php";

                            if (isset($_GET['id'])) {
                                $registo = $_GET['id'];
                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query = "SELECT * FROM eventos WHERE id_eventos = ?";
                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $registo);
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $participantes, $alcance, $super, $ref_categorias, $ref_acessibilidade, $fotografia);
                                        while (mysqli_stmt_fetch($stmt)) {
                                            ?>
                                                   <div class='card shadow mb-4'>
                                                                    <div class='card-header py-3'>
                                                                        <h6 class='m-0 font-weight-bold text-success'>Detalhes do Evento: <i class="font-italic"><?=$nome?></i></h6>
                                                                    </div>
                                                    <div class='card-body'>                                            
                                                         <form class='form row justify-content-center' id='form_evento' method='post' action='scripts\altera_evento.php'>
                                                         <input readonly class='col-8 form-control inputRegistar mt-4' type='text' name='id_eventos' placeholder='id_eventos' value='<?= $id_eventos ?>'>
                                                            <input autofocus class='col-8 form-control inputRegistar mt-4' type='text' name='nome' placeholder='nome' value='<?= $nome ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='descricao' placeholder='descricao' value='<?= $descricao ?>"'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='data_inicio' placeholder='data_inicio' value='<?= $data_inicio ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='data_fim' placeholder='data_fim' value='<?= $data_fim ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='latitude' placeholder='latitude' value='<?= $latitude ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='longitude' placeholder='longitude' value='<?= $longitude ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='participantes' placeholder='participantes' value='<?= $participantes ?>'>
                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='alcance' placeholder='alcance' value='<?= $alcance ?>'>

                                                             <select type="text" title="categorias" class="col-8 form-control inputRegistar mt-4"  name="categorias" >
                                                                 <?php
                                                                     $stmt = mysqli_stmt_init($link);

                                                                     $query = "SELECT id_categorias, nome FROM categorias";
    
                                                                     if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                                                         mysqli_stmt_execute($stmt); // Execute the prepared statement

                                                                         mysqli_stmt_bind_result($stmt, $id, $cate); // Bind results

                                                                         while (mysqli_stmt_fetch($stmt)) { // Fetch values


                                                                             if($id == $ref_categorias)
                                                                                 echo "<option selected value='$id'>$cate</option>";
                                                                             else
                                                                                 echo "<option value='$id'>$cate</option>";

                                                                         }
                                                                         mysqli_stmt_close($stmt); // Close statement
                                                                     }
                                                                 ?>
                                                             </select>

                                                             <select type="text" title="acessibilidade" class="col-8 form-control inputRegistar mt-4"  name="acessibilidade" >
                                                                 <?php
                                                                 $stmt = mysqli_stmt_init($link);

                                                                 $query = "SELECT id_acessibilidade, descricao FROM acessibilidade";

                                                                 if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                                                     mysqli_stmt_execute($stmt); // Execute the prepared statement

                                                                     mysqli_stmt_bind_result($stmt, $id, $desc); // Bind results

                                                                     while (mysqli_stmt_fetch($stmt)) { // Fetch values


                                                                         if($id == $ref_acessibilidade)
                                                                             echo "<option selected value='$id'>$desc</option>";
                                                                         else
                                                                             echo "<option value='$id'>$desc</option>";

                                                                     }
                                                                     mysqli_stmt_close($stmt); // Close statement
                                                                 }
                                                                 ?>
                                                             </select>

                                                            <input class='col-8 form-control inputRegistar mt-4' type='text' name='super' placeholder='super' value='<?= $super ?>'>
                                                             <a class='col-8 form-control inputRegistar mt-4' data-toggle="modal" data-target="#fotografiaModal">
                                                                 <?php
                                                                 if ($fotografia != null)
                                                                     echo $fotografia;
                                                                 else
                                                                     echo "Fotografia";
                                                                 ?>
                                                             </a>
                                                            <button class='col-5 inputRegistar mt-4 p-2' type='submit'>Gravar</button>
                                                        </form> 
                                                </div>
                                            </div>

                                        <?php
                                        }
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                    mysqli_stmt_close($stmt);
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
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tem a certeza que pretende terminar sessão?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabe2">Editar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Introduza a nova informação</div>

                <input class="m-5" type="text" >

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="#" data-dismiss="modal">Confirmar</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabe3">Apagar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tem a certeza que pretende apagar este desafio</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="#" data-dismiss="modal">Apagar</a>
            </div>
        </div>
    </div>
</div>

<!-- Fotografia Modal-->
<div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="modalFotos"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form class="row justify-content-center pb-5" action="scripts/uploadFoto.php?id=<?= $registo ?>&tipo=evento" enctype="multipart/form-data" method="post">
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