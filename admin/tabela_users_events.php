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

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Tabela</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tabela de relação Utilizador / Evento</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Utilizador</th>
                                    <th>Evento</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Utilizador</th>
                                    <th>Evento</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                include_once "connections/connection.php";
                                $link = new_db_connection(); // Create a new DB connection

                                $stmt = mysqli_stmt_init($link);

                                $query = "SELECT utilizadores_has_eventos.ref_utilizadores, utilizadores_has_eventos.ref_eventos, utilizadores.nome, eventos.nome FROM utilizadores_has_eventos
                                        INNER JOIN eventos ON utilizadores_has_eventos.ref_eventos = id_eventos
                                        INNER JOIN utilizadores ON utilizadores_has_eventos.ref_utilizadores = utilizadores.id_utilizadores";

                                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                                    mysqli_stmt_bind_result($stmt, $id_user, $id_evento, $user, $evento); // Bind results

                                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                                        ?>
                                        <tr>
                                            <th><a class="text-gray-600 text-decoration-none" href="tabela_edit_utilizadores.php?id=<?= $id_user?>"><?= $user ?></a></th>
                                            <th><a class="text-gray-600 text-decoration-none" href="table_det3.php?id=<?= $id_evento?>"><?= $evento ?></a></th>
                                        </tr>
                                        <?php
                                    }
                                    mysqli_stmt_close($stmt); // Close statement
                                }
                                mysqli_close($link); // Close connection

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
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
