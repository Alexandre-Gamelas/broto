<section class="row position-relative">
    <article class="col-12 position-relative h-15 header1">
        <img src="admin/<?= $fotografia ?>" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
        <?php
        if(!isset($recomendacoes)){
        ?>
        <img src="assets/img/frontend/wave_nav.png" alt="" class="wave-perfil">
        <?php } ?>
    </article>

    <article class="col-9 m-4 position-absolute" style="z-index: 1001">
        <h4 class="nome text-white font-weight-bold mb-3 pr-4"><?= $nome?></h4>
        <p class="text-white mb-0"><i class="fas fa-map-marker-alt "></i> <?= $local?></p>
        <?php
        $data = date("Y-m-d");
        if(isset($data_inicio) && $data_inicio < $data && isset($participou) && !$participou && !isset($recomendacoes)){
            ?>
            <p class="text-white">Foste a este evento? <a href="scripts/check_in.php?check_in=<?=$check_in?>&from=detail" class="font-weight-bold font-italic text-white">Faz o teu check in!</a></p>
            <?php
        }

        ?>
    </article>

    <div id="data" class="text-center text-white" style="z-index: 1001">
        <div class="pos-center">
            <h5 class="mb-0 text-uppercase font-weight-bold"><?= $mes ?></h5>
            <p class="mb-0"><?= $dia ?></p>
        </div>
    </div>
</section>

<?php
if(isset($recomendacoes)) {
    ?>
    <script>
        $(".nome").click(function () {
            window.location = "evento_detail.php?id=<?= $id_evento ?>"
        })
    </script>
    <?php
}