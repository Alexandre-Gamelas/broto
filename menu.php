<!doctype html>
<html lang="en">
<?php
session_start();


if(!isset($_SESSION['user']))
    header("location: index.php?msg=0");
include_once "components/head.php";
?>

<body>
<?php include_once "components/bot_menu.php" ?>
<?php include_once "components/side_menu.php"; ?>
<?php include_once "components/firebase.php" ?>
</body>
</html>
