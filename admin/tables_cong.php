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


    <script>
        function transfere_nac(indice, texto) {
            document.getElementById("nac_id_alterar").value = indice;
            document.getElementById("nac_nome_alterar").value = texto;
        }

        function transfere_cp(indice, texto) {
            document.getElementById("cp_id_alterar").value = indice;
            document.getElementById("cp_nome_alterar").value = texto;
        }

        function transfere_acc(indice, texto) {
            document.getElementById("acc_id_alterar").value = indice;
            document.getElementById("acc_nome_alterar").value = texto;
        }
    </script>

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
                <h1 class="h3 mb-2 text-gray-800">Tabelas de Congruência</h1>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tabela de Nacionalidades <?php if (isset($_GET['msg'])) {echo " - ".$_GET['msg']."";}?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <select id="lista_paises" onchange="transfere_nac(this.value, this.options[this.selectedIndex].text);">
                                <?php include "componentes/lista_nacional.php";?>
                            </select>
                            <form id="form_nacional" method="post" action="scripts\altera_nacional.php">
                                <input readonly type="text" id="nac_id_alterar" name="id_nacionalidades">
                                <input type="text" id="nac_nome_alterar" name="nome">
                                <button class="btn-success mr-1" type="submit"><i class="fas fa-edit "></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tabela de Códigos Postais <?php if (isset($_GET['msg'])) {echo " - ".$_GET['msg']."";}?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <select id="lista_cp" onchange="transfere_cp(this.value, this.options[this.selectedIndex].text);">
                                <?php include "componentes/lista_cp.php";?>
                            </select>
                            <form id="form_nacional" method="post" action="scripts\altera_cp.php">
                                <input readonly type="text" id="cp_id_alterar" name="id_postais">
                                <input type="text" id="cp_nome_alterar" name="postal">
                                <button class="btn-success mr-1" type="submit"><i class="fas fa-edit "></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tabela de Acessibilidade <?php if (isset($_GET['msg'])) {echo " - ".$_GET['msg']."";}?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <select id="lista_cp" onchange="transfere_acc(this.value, this.options[this.selectedIndex].text);">
                                <?php include "componentes/lista_acc.php";?>
                            </select>
                            <form id="form_nacional" method="post" action="scripts\altera_acc.php">
                                <input readonly type="text" id="acc_id_alterar" name="id_acessibilidade">
                                <input type="text" id="acc_nome_alterar" name="descricao">
                                <button class="btn-success mr-1" type="submit"><i class="fas fa-edit "></i></button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

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
            <form class="form row justify-content-center" id="form_nacional" method="post" action="scripts\altera_nacional.php">
                <input readonly class="m-5" type="text" id='id_nacionalidades' name="id_nacionalidades" >
                <input class="m-5" type="text" name="nome" >
                <button class="btn btn-primary" type="submit">Gravar</button>
                </form>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
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