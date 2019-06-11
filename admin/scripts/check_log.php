<?php



if(!isset($_SESSION)||!isset($_SESSION["nome"])){
header("location: login.php?msg=0");
}
