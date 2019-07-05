<?php

require_once "./scripts/eventos_proposta.php";
$user = $_SESSION['user']["id_user"];

$Evento = ev_mais_participado();
    ?>
    <div class='carousel-item active'>
        <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
    </div>
    <?php

    $Evento = ev_cat_favorita($user);
    ?>
<div class='carousel-item '>
    <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
</div>
<?php

$Evento = ev_suacat_mais_participada($user);
?>
<div class='carousel-item '>
    <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
</div>
<?php

$Evento = ev_mais_amigos($user);
?>
<div class='carousel-item '>
    <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
</div>
<?php

$Evento = ev_suacat_mais_amigos($user);
?>
<div class='carousel-item '>
    <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
</div>
<?php

$Evento = ev_next_mais_amigos($user);
?>
<div class='carousel-item '>
    <img class='d-block w-100' src='admin/<?= $Evento["fotografia"] ?>'><a href="evento_detail.php?id=<?= $Evento["id_eventos"] ?>"><h5 class="text-center nome-evento pb-3 pt-3 mb-0"><?= $Evento["nome"] ?></h5></a>
</div>
<?php


?>
