<?php
session_start();
require_once "../connections/connection.php";

if(isset($_POST["email"]) && isset($_POST["password"])){
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query= "SELECT id_utilizadores, nome, password, ref_papeis, fotografia, is_blocked FROM utilizadores WHERE email LIKE ? ";
    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, 's', $mail);
        $mail=$_POST["email"];
        $password=$_POST["password"];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_user,$nome, $password_crypt, $papel, $foto, $block );
        if(mysqli_stmt_fetch($stmt)){
            if($papel==2){
                if($block==0){
                    if(password_verify($password, $password_crypt)){

                        $_SESSION['user']["nome"]=$nome;
                        $_SESSION['user']["id_user"]=$id_user;
                        $_SESSION['user']["papel"]=$papel;
                        $_SESSION['user']["fotografia"]=$foto;
                        $_SESSION['user']['email'] = $_POST["email"];

                        $way="../menu.php";
                    }else{
                        $way="../login.php?msg=2";
                    }
                }else{
                    $way="../login.php?msg=1";
                }
            }else{
                $way="../login.php?msg=4";}



        }else{
            $way="../login.php?msg=2";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);

    }

    header("location:".$way);
} else {
    header("Location: ../login.php?error=1");
}
