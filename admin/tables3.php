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
                        <h6 class="m-0 font-weight-bold text-success">Tabela de Eventos</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID Evento</th>
                                    <th>Nome</th>
                                    <th>Data de início </th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Descrição</th>
                                    <th>Participantes</th>
                                    <th>Alcance</th>
                                    <th>Super</th>
                                    <th>acessibilidade</th>
                                    <th>Desafio</th>
                                    <th>Categoria</th>
                                    <th>Apagar</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID Evento</th>
                                    <th>Nome</th>
                                    <th>Data de início </th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Descrição</th>
                                    <th>Participantes</th>
                                    <th>Alcance</th>
                                    <th>Super</th>
                                    <th>acessibilidade</th>
                                    <th>Desafio</th>
                                    <th>Categoria</th>
                                    <th>Apagar</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Plantar Lousada</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>01-05-2019</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button> posição Long.</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>posição Lat.</td>
                                    <td>Plantação de árvores em Lousada</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>50</td>
                                    <td>500 árvores</td>
                                    <td>1000 árvores</td>
                                    <td>AAA</td>
                                    <td>Plantar 20 árvores</td>
                                    <td>Plantação</td>
                                    <td><button class="btn-success" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-eraser "></i></button></td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>Campus sem Filtros</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>01-05-2019</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button> posição Long.</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>posição Lat.</td>
                                    <td>Recolha de beatas de cigarro do campus da UA</td>
                                    <td><button class="btn-success mr-1" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit "></i></button>35</td>
                                    <td>5000</td>
                                    <td>7500</td>
                                    <td>AAA</td>
                                    <td>Recolher 150 filtros</td>
                                    <td>Recolha de lixo</td>
                                    <td><button class="btn-success" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-eraser "></i></button></td>
                                </tr>
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
