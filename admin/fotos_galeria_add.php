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


            <article class="col-12">
                <h3>Adicionar Fotografias a Evento</h3>
                <?php
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

                        case "fotoNao":
                            $message = "Ocorreu um erro no update, por favor tente novamente";
                            $class = "alert-warning";
                            break;

                        case "fotoSim":
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
            </article>

            <form class="row justify-content-center pb-5" action="scripts/uploadFoto.php?id=0&tipo=galeria&from=admin" enctype="multipart/form-data" method="post">
                <select title="eventos" name="id" class="col-8 form-control">
                    <?php include "scripts/get_eventos.php"?>
                </select>
                <input style="cursor: pointer!important;" class="col-8 p-3 pb-5 form-control inputRegistar mt-4" type="file" placeholder="File" name="fileToUpload" id="fileToUpload">
                <input class="col-8 form-control inputRegistar mt-4" type="submit" value="Upload" name="submit">
            </form>


            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once "componentes/footer.php"?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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