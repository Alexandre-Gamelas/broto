<?php

if(!isset($_SESSION)||!isset($_SESSION['user']['nome'])){
header("location: ../index.php?msg=0");
}

if($_SESSION['user']['papel']!=1){
    header("location: ../index.php?msg=4 ");
}

