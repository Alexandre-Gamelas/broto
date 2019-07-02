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
                <h3>Sincronizar Eventos <a href="eventos_sync.php?work=1" style="text-decoration: none!important;" class="fas fa-plus-circle text-success ml-1"></a></h3>
            </article>
            <?php
            if(isset($_GET['work']) && $_GET['work'] == 1) {
                include_once "scripts/new_events.php";
                if(sizeof($new_events) > 0) {
                    foreach ($new_events as $evento) {
                        if(isset($evento['name']))
                            $nome = $evento['name'];
                        //pensar num else?

                        if(isset($evento["start_time"]))
                            $data_inicio = explode("T", $evento["start_time"])[0];
                        else
                            $data_inicio = "0000-00-00";

                        if(isset($evento["end_time"]))
                            $data_fim = explode("T", $evento["end_time"])[0];
                        else
                            $data_fim = $data_inicio;

                        if(isset($evento['place']['location']) && isset($evento['place']['location']['latitude']) && isset($evento['place']['location']['longitude'])) {
                            $latitude = $evento['place']['location']['latitude'];
                            $longitude = $evento['place']['location']['longitude'];
                        } else {
                            $latitude = 0;
                            $longitude = 0;
                        }

                        $descricao = $evento['description'];
                    }
                    ?>
                    <form class="form-row p-3 justify-content-center" action="" method="post">
                        <input class="col-6 form-control" name="nome" type="text" value="<?= $nome ?>">
                        <div class="col-12"></div>
                        <input class="col-6 form-control mt-3" name="data_inicio" type="text" value="<?= $data_inicio ?>">
                        <div class="col-12"></div>
                        <input class="col-6 form-control mt-3" name="data_fim" type="text" value="<?= $data_fim ?>">
                        <div class="col-12"></div>
                        <input class="col-6 form-control mt-3" name="latitude" type="text" value="<?= $latitude ?>">
                        <div class="col-12"></div>
                        <input class="col-6 form-control mt-3" name="longitude" type="text" value="<?= $longitude?>">
                        <div class="col-12"></div>
                        <textarea class="col-6 form-control mt-3" name="descricao" type="text" rows="15"><?= $descricao ?></textarea>
                    </form>
                    <hr class="col-12">
                    <?php
                }
            }
            ?>







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
            <div class="modal-body">Selecione o papel novo</div>

            <select class="m-3" name="papel">
                <option>Voluntário</option>
                <option>Colaborador</option>
                <option>Admin</option>
            </select>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="#" data-dismiss="modal">Confirmar</a>
            </div>
        </div>
    </div>
</div>

<!-- Block modal-->
<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabe3">Bloquear</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tem a certeza que pretende bloquear este utilizador</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-success" href="#" data-dismiss="modal">Bloquear</a>
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
