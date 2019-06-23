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
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
<script src="js/map.js"></script>
</body>
</html>
