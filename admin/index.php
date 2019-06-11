<!DOCTYPE html>
<html lang="en">
<?php

//se temos session start no navbar nao precisamos de ter aqui novamente, mas vou deixar comentado por agora - AG
//session_start();

//get dados para pagina princiapl
include_once "connections/connection.php";

//++++++++++ NUMERO DE CONTAS +++++++++//
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT(utilizadores.id_utilizadores) FROM utilizadores";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $num); // Bind results

    if (mysqli_stmt_fetch($stmt)) { // Fetch values
        $num_contas = $num;
    }
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection

//++++++++++ NUMERO DE CONTAS CRIADAS RECENTEMENTE, ULTIMO MES +++++++++//
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT(utilizadores.id_utilizadores) FROM utilizadores WHERE utilizadores.data_entrada LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt,'s', $data); // Bind variables by type to each parameter
    $data = date("Y-m")."%";
    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $num); // Bind results

    if (mysqli_stmt_fetch($stmt)) { // Fetch values
        $num_contas_recentes = $num;
    }
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection


//+++++++ EVENTO COM MAIS PARTICIPAÇÕES ++++//
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT nome FROM eventos ORDER BY participantes desc";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $nome); // Bind results

    if (mysqli_stmt_fetch($stmt)) { // Fetch values
        $evento_participantes_max = $nome;
    }
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection


//++++++ CATEGORIA COM MAIS PESO ++++++++//
$link = new_db_connection(); // Create a new DB connection

$stmt = mysqli_stmt_init($link);

$query = "SELECT SUM(utilizadores_has_categorias.peso) AS weight , categorias.nome FROM utilizadores_has_categorias
  INNER JOIN categorias ON utilizadores_has_categorias.ref_categorias = categorias.id_categorias GROUP BY categorias.nome ORDER BY weight desc";

if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $peso, $nome); // Bind results

    if (mysqli_stmt_fetch($stmt)) { // Fetch values
        $categoria_mais_famosa = $nome;
    }
    mysqli_stmt_close($stmt); // Close statement
}
mysqli_close($link); // Close connection

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Broto - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once "componentes/sidemenu.php"; ?>
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Geral</h1>
                    <!-- TODO GENERATE REPORT
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a><
                    -->
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nº de contas
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_contas ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tree fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Contas criadas recentemente
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $num_contas_recentes ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-seedling fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Categoria mais Popular</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $categoria_mais_famosa ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Evento com mais participações
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=  $evento_participantes_max ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-xl-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Contas Criadas ao Longo do Último Ano</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>

                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


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




<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<?php
    //dados para o gráfico de contas
    $datas = array();
    for($i = 1; $i<=12; $i++){
        $link = new_db_connection(); // Create a new DB connection

        $stmt = mysqli_stmt_init($link);

        $query = "SELECT COUNT(data_entrada) as entradas from utilizadores WHERE data_entrada LIKE ?";

        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
            mysqli_stmt_bind_param($stmt,'s', $data); // Bind variables by type to each parameter
            if($i < 10)
                $data = "2019-0".$i."%";
            else
                $data = "2019-".$i."%";
            mysqli_stmt_execute($stmt); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt, $numero); // Bind results

            if (mysqli_stmt_fetch($stmt)) { // Fetch values
               array_push($datas, $numero);
            }
            mysqli_stmt_close($stmt); // Close statement
        }
        mysqli_close($link); // Close connection
    }

?>
            <script>
                var datas = <?php echo json_encode($datas); ?>;
                //console.log(datas);
            </script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
