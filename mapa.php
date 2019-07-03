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
        $query = "SELECT id_eventos, nome, latitude, longitude, descricao FROM eventos";
        $eventos = array();

        if (mysqli_stmt_prepare($stmt, $query)) {
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id, $nome, $long, $lat, $descricao);
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
       echo "<script>var locais = $eventos</script>"
?>
<script src="js/map.js"></script>
</body>
</html>
