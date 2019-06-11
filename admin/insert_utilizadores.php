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
                <h1 class="h3 mb-2 text-gray-800">UTILIZADORES</h1>


                <!-- DataTales Example -->

                <?php
                require_once "connections/connection.php";
                $link = new_db_connection();
                ?>

                <div class='card shadow mb-4'>
                    <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-success'>Inserir Novo Utilizador <img src="" alt=""
                                                                                                   class="img-user">
                        </h6>

                    </div>
                    <div class='card-body'>
                        <form class='form row justify-content-center align-items-center' id='form_evento' method='post'
                              action='scripts\inserir_user.php'>

                            <div class="form-group col-8 mt-2">
                                <label for="">ID</label>
                                <input readonly class='form-control inputRegistar' type='text' name='id'
                                       placeholder='Gerado Automaticamente' value=''>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Nome</label>
                                <input autofocus class='form-control inputRegistar' type='text' name='nome'
                                       placeholder='Nome' value='' required>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Email</label>
                                <input class='form-control inputRegistar' type='text' name='mail' placeholder='Email'
                                       value='' required>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Password</label>
                                <input class='form-control inputRegistar' type='text' name='password' placeholder='Password'
                                       value='' required>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Nacionalidade</label>
                                <select type="text" title="nacionalidades" class="form-control inputRegistar"
                                        name="nacionalidade" required>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT id_nacionalidades, nome FROM nacionalidades";

                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                                        mysqli_stmt_bind_result($stmt, $id, $nac); // Bind results

                                        while (mysqli_stmt_fetch($stmt)) { // Fetch values

                                            echo "<option value='$id'>$nac</option>";

                                        }
                                        mysqli_stmt_close($stmt); // Close statement
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Perfil</label>
                                <select type="text" title="papeis" class="form-control inputRegistar" name="papel" required>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT id_papeis, nome FROM papeis";

                                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                                        mysqli_stmt_bind_result($stmt, $id, $papel_select); // Bind results

                                        while (mysqli_stmt_fetch($stmt)) { // Fetch values

                                            echo "<option value='$id'>$papel_select</option>";

                                        }
                                        mysqli_stmt_close($stmt); // Close statement
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label for="">Data de Nascimento</label>
                                <input class='form-control inputRegistar' type='text' name='nascimento'
                                       placeholder='Data Nascimento' value='' required
                                       pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                       title="Enter a date in this format YYYY-MM-DD">
                            </div>

                            <div class="form-group col-8 mt-2">
                                <label>Estado</label>
                                <div class="checkbox">
                                    <label>


                                           <input type="checkbox" name="block">Bloqueado


                                    </label>
                                </div>
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
