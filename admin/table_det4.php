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
                <h1 class="h3 mb-2 text-gray-800">EDITAR CATEGORIA</h1>


                <!-- DataTales Example -->

                        <?php
                            require_once "connections/connection.php";

                            if (isset($_GET['id'])) {
                                $registo = $_GET['id'];
                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query = "SELECT categorias.*, tipos_categorias.nome_tipo FROM categorias
                                      INNER JOIN tipos_categorias ON categorias.ref_tipos_categorias = id_tipos
                                      WHERE id_categorias = ?";
                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $registo);
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $id_categorias, $nome, $ref_tipos_categorias, $descricao, $imagem, $tipo);
                                        while (mysqli_stmt_fetch($stmt)) {

                                       ?>
                                            <div class='card shadow mb-4'>
                                                                    <div class='card-header py-3'>
                                                                        <h6 class='m-0 font-weight-bold text-success'>Detalhes da Categoria: <?=$nome?></h6>
                                                                    </div>
                                                    <div class='card-body'>
                                                         <form class='form row justify-content-center' id='form_evento' method='post' action='scripts\altera_categoria.php'>
                                                             <div class="form-group col-8 mt-2">
                                                                 <label for="">ID</label>
                                                                 <input readonly class='form-control inputRegistar' type='text' name='id_categorias' placeholder='id_eventos' value='<?=$id_categorias?>'>
                                                             </div>

                                                             <div class="form-group col-8 mt-2">
                                                                 <label for="">Nome</label>
                                                                 <input autofocus class='form-control inputRegistar' type='text' name='nome' placeholder='nome' value='<?=$nome?>'>
                                                             </div>

                                                             <div class="form-group col-8 mt-2">
                                                                 <label for="">Descricao</label>
                                                                 <input class='form-control inputRegistar' type='text' name='descricao' placeholder='descricao' value='<?= $descricao ?>'>
                                                             </div>

                                                             <div class="form-group col-8 mt-2">
                                                                 <label for="">Tipo de Categoria</label>
                                                                 <select type="text" title="papeis" class="form-control inputRegistar"  name="ref_tipos_categorias" >
                                                                     <?php
                                                                     $stmt = mysqli_stmt_init($link);

                                                                     $query = "SELECT id_tipos, nome_tipo FROM tipos_categorias";

                                                                     if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                                                         mysqli_stmt_execute($stmt); // Execute the prepared statement

                                                                         mysqli_stmt_bind_result($stmt, $id, $tipo_select); // Bind results

                                                                         while (mysqli_stmt_fetch($stmt)) { // Fetch values


                                                                             if($tipo_select == $tipo)
                                                                                 echo "<option selected value='$id'>$tipo_select</option>";
                                                                             else
                                                                                 echo "<option value='$id'>$tipo_select</option>";

                                                                         }
                                                                         mysqli_stmt_close($stmt); // Close statement
                                                                     }
                                                                     ?>
                                                                 </select>
                                                             </div>



                                                             <div class="form-group col-8 mt-2">
                                                                 <label for="">Fotografia</label>
                                                                 <a class='form-control inputRegistar' data-toggle="modal" data-target="#fotografiaModal">
                                                                     <?php
                                                                     if ($imagem != null)
                                                                         echo $imagem;
                                                                     else
                                                                         echo "Fotografia";
                                                                     ?>
                                                                 </a>
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
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                            } else {
                                header("location:../index.php");
                            } ?>


            </div>
            <!-- /.container-fluid -->
a
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once "componentes/footer.php" ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>





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
                    <form class="row justify-content-center pb-5" action="scripts/uploadFoto.php?id=<?= $registo ?>&tipo=categoria" enctype="multipart/form-data" method="post">
                        <input style="cursor: pointer!important;" class="col-8 p-3 pb-5 form-control inputRegistar mt-4" type="file" placeholder="File" name="fileToUpload" id="fileToUpload">
                        <input class="col-8 form-control inputRegistar mt-4" type="submit" value="Upload" name="submit">
                    </form>
                </div>
            </div>
        </div>


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
