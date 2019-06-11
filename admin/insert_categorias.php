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
                <h1 class="h3 mb-2 text-gray-800">CATEGORIAS</h1>


                <!-- DataTales Example -->

                <?php
                require_once "connections/connection.php";
                $link = new_db_connection();
                ?>

                <div class='card shadow mb-4'>
                    <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-success'>Inserir Nova Categoria <img src="" alt=""
                                                                                                   class="img-user">
                        </h6>

                    </div>
                    <div class='card-body'>
                        <form class='form row justify-content-center align-items-center' id='form_evento' method='post'
                              action='scripts\inserir_cate.php'>

                            <div class="form-group col-8 mt-2">
                                <label for="">ID</label>
                                <input readonly class='form-control inputRegistar' type='text' name='id'
                                       placeholder='Gerado Automáticamente' value=''>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Nome</label>
                                <input autofocus class='form-control inputRegistar' type='text' name='nome'
                                       placeholder='Nome' value='' required>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Tipo de Categoria</label>
                                <select type="text" title="papeis" class="form-control inputRegistar" name="tipo" required>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT id_tipos, nome_tipo FROM tipos_categorias";

                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                                        mysqli_stmt_bind_result($stmt, $id, $tipo_select); // Bind results

                                        while (mysqli_stmt_fetch($stmt)) { // Fetch values

                                            echo "<option value='$id'>$tipo_select</option>";

                                        }
                                        mysqli_stmt_close($stmt); // Close statement
                                    }
                                    ?>
                                </select>
                            </div>

                            <button class='col-5 inputRegistar mt-4 p-2' type='submit'>Inserir</button>
                        </form>
                    </div>
                </div>
                <?php

                mysqli_close($link);

                ?>
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
