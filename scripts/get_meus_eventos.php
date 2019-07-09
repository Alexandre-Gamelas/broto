<?php
require_once "./connections/connection.php";
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
$query2 = "SELECT ref_eventos FROM utilizadores_has_eventos WHERE ref_utilizadores = ?";
if (mysqli_stmt_prepare($stmt2, $query2)) {
    mysqli_stmt_bind_param($stmt2, 'i', $id_user);
    if(!isset($amigo))
        $id_user = $_SESSION['user']['id_user'];
    if (mysqli_stmt_execute($stmt2)) {
        mysqli_stmt_bind_result($stmt2, $id_evento);
        //Para dar a class active
        $contador = 0;
        while (mysqli_stmt_fetch($stmt2)) {
            $contador++;
            if($contador == 1)
                $class = 'active';
            else
                $class = '';
            include "get_event.php";

            ?>

            <div class='carousel-item <?=$class?>'>
                <img class='d-block w-100' src='admin/<?=$fotografia?>'>
                <a href="evento_detail.php?id=<?= $id_evento ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?=$nome?></h5></a>
            </div>

            <?php
        }
        if($contador == 0){
            ?>
            <div class='carousel-item active'>
                <img class='d-block w-100' src='admin/img/fotosEvento/maissugestoes.jpg'>
                <a href="mapa.php"><h5 class="text-center nome-evento pb-3 pt-3 mb-0">Ainda não participaste em nenhum evento! Dá uma olhada no <span class="font-weight-bold font-italic">mapa!</span></h5></a>
            </div>
            <?php
        }
    } else {
        echo "wtf";
        mysqli_stmt_error($stmt2);
    }
} else {
    mysqli_stmt_error($stmt2);
}
mysqli_stmt_close($stmt2);
mysqli_close($link2);
?>
