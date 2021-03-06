<?php
session_start();

//aqui escolhem a pasta para onde vai o ficheiro
if (isset($_GET['tipo'])){
    $tipo = $_GET['tipo'];
    switch ($tipo){
        case "user":
            $target_dir = "../img/fotosUser/";
            break;
        case "evento": case "galeria":
            $target_dir = "../img/fotosEvento/";
            break;
        case "categoria":
            $target_dir = "../img/fotosCategoria/";
            break;
    }
}
//aqui fazem a concatenação do diretorio com o nome do ficheiro
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$target_file = $target_dir . uniqid() . "." . $imageFileType;

$message = 10;
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $message = 1;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    $message = 2;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    $message = 3;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $message = 4;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

    if (isset($_GET['tipo'])){
        switch ($tipo){
            case "user":
                if($_GET['from']=='app')
                    header("Location: ../../editar_perfil.php?id=".$_GET['id']."&msg=$message");
                else
                    header("Location: ../tabela_edit_utilizadores.php?id=".$_GET['id']."&msg=$message");
                break;
            case "evento":
                header("Location: ../table_det3.php?id=".$_GET['id']."&msg=&msg=$message");
                break;
            case "categoria":
                header("Location: ../table_det4.php?id=".$_GET['id']."&msg=&msg=$message");
                break;
        }
    }
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        include_once "../connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        if (isset($_GET['tipo'])){
            switch ($tipo){
                case "user":
                    $query = "UPDATE utilizadores SET fotografia = ? WHERE id_utilizadores LIKE ?";
                    break;
                case "evento":
                    $query = "UPDATE eventos SET fotografia = ? WHERE eventos.id_eventos LIKE ?";
                    break;
                case "categoria":
                    $query = "UPDATE categorias SET imagem = ? WHERE categorias.id_categorias LIKE ?";
                    break;
                case "galeria":
                    $query = "INSERT INTO galeria_eventos (fotografia, ref_eventos) VALUES (?, ?)";
                    break;
            }
        }

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ss', $foto, $id);
            $foto = substr($target_file, 3);
            if($_GET['tipo'] == "galeria")
                $id=$_POST['id'];
            else
                $id = $_GET['id'];
            if (mysqli_stmt_execute($stmt)) {
                if (isset($_GET['tipo'])){
                    $message = 6;
                    switch ($tipo){
                        case "user":
                            if ($id==$_SESSION["user"]["id_user"]){
                                if($_GET['from'] == 'app')
                                    $_SESSION['user']['fotografia'] = "admin/". $foto;
                                else
                                    $_SESSION['user']['fotografia']=$foto;
                            }
                            if($_GET['from']=='app')
                                header("Location: ../../editar_perfil.php?id=".$_GET['id']."&msg=$message");
                            else
                                header("Location: ../tabela_edit_utilizadores.php?id=".$_GET['id']."&msg='fotoSim'");
                            break;
                        case "evento":
                            header("Location: ../table_det3.php?id=".$_GET['id']."&msg=fotoSim");
                            break;
                        case "categoria":
                            header("Location: ../table_det4.php?id=".$_GET['id']."&msg=fotoSim");
                            break;
                        case "galeria":
                            header("Location: ../fotos_galeria_add.php?msg=fotoSim");
                            break;
                    }
                }

            } else {
                echo "<script>alert('error')</script>";
            }
        }

    } else {
        echo "Sorry, there was an error uploading your file.";
        $message = 5;
        if (isset($_GET['tipo'])){
            switch ($tipo){
                case "user":
                    if($_GET['from']=='app')
                        header("Location: ../../editar_perfil.php?id=".$_GET['id']."&msg=$message");
                    else
                        header("Location: ../tabela_edit_utilizadores.php?id=".$_GET['id']."&msg=$message");
                    break;
                case "evento":
                    header("Location: ../table_det3.php?id=".$_GET['id']."&msg=&msg=$message");
                    break;
                case "categoria":
                    header("Location: ../table_det4.php?id=".$_GET['id']."&msg=&msg=$message");
                    break;
                case "galeria":
                    header("Location: ../fotos_galeria_add.php?msg=$message");
                    break;
            }
        }
    }
}

} else {
    echo "no file";
}
