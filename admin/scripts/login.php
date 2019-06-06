<?php
session_start();
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$query= "SELECT id_users, ref_id_roles, password_hash, active FROM users WHERE username LIKE ? ";
if(mysqli_stmt_prepare($stmt, $query)){
    mysqli_stmt_bind_param($stmt, 's', $username);
    $username=$_POST["username"];
    $password=$_POST["password"];
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_user,$perfil, $password_hash,$active);
    if(mysqli_stmt_fetch($stmt)){
        if($active==1){
            if(password_verify($password, $password_hash)){
                $_SESSION["role"]=$perfil;
                $_SESSION["username"]=$username;
                $_SESSION["id_user"]=$id_user;
                $url="../index.php?msg=3";
            }else{
                $url="../index.php?msg=2#login";
            }
        }else{$url="../index.php?msg=4#login";

        }}else{
        $url="../index.php?msg=2#login";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);

}

header("location:".$url);