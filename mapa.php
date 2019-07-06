<!doctype html>
<html lang="en">
<?php
session_start();

if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>

<div id="map"></div>

<body>
<script src="js/leaflet.markercluster.js"></script>
<style>
    <?php include 'css/MarkerCluster.css'; ?>
</style>
<style>
    <?php include 'css/MarkerCluster.Default.css'; ?>
</style>
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
<?php
        include_once "connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT id_eventos, nome, latitude, longitude, descricao, data_inicio FROM eventos";
        $eventos = array();
        $eventos_passado = array();
        $eventos_futuro = array();
        $current_date = date('Y-m-d');
    if (mysqli_stmt_prepare($stmt, $query)) {
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $nome, $long, $lat, $descricao, $data_inicio);
                while(mysqli_stmt_fetch($stmt)){
                    if($long != 0 && $lat != 0){
                        $evento = array(
                            "type" => "Feature",
                            "properties" => array(
                                    "name" => $nome,
                                "popupContent" => $descricao),

                            "geometry" => array(
                                "type" => "Point",
                                "coordinates" => [$lat, $long]
                            ),
                            "id" => $id
                        );

                        array_push($eventos, $evento);
                        if($data_inicio > $current_date)
                            array_push($eventos_futuro, $evento);
                        else
                            array_push($eventos_passado, $evento);
                    }
                }
            } else {
                echo  mysqli_stmt_error($stmt);
            }
        } else {
            echo mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        $eventos = json_encode($eventos);
        $eventos_futuro = json_encode($eventos_futuro);
        $eventos_passado = json_encode($eventos_passado);
        echo "<script>var locais = $eventos; var locais_futuro = $eventos_futuro; var locais_passado = $eventos_passado</script>;"
?>
<div id="options-mapa" class="btn-group dropright">
    <button type="button" class="btn dropdown-toggle pl-1 pr-1 pt-0 pb-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-filter text-success"></i>
    </button>
    <div class="dropdown-menu text-center">
        <a id="todos" class="mb-1 pt-2 pb-1">Todos</a>
        <hr>
        <a id="passado" class="mb-1 pb-1">Passado</a>
        <hr>
        <a id="futuro" class="mb-1 mb-2 pb-1">Futuro</a>
    </div>
</div>

<script src="js/map.js"></script>
</body>
</html>
