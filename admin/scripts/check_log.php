<?php
session_start();


if(!isset($_SESSION)||!isset($_SESSION["nome"])||$_SESSION["papel"]!=1){
header("location: login.php");
}