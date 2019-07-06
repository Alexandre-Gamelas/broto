<section class="row position-relative">
    <article class="col-12 position-relative h-15 header1">
        <img src="admin/<?= $fotografia ?>" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
        <img src="assets/img/frontend/wave_nav.png" alt="" class="wave-perfil">
    </article>

    <article class="col-9 m-4 position-absolute" style="z-index: 1001">
        <h4 class="text-white font-weight-bold mb-3"><?= $nome?></h4>
        <p class="text-white"><i class="fas fa-map-marker-alt"></i> Associação Bioliving</p>
    </article>

    <div id="data" class="text-center text-white" style="z-index: 1001">
        <div class="pos-center">
            <h5 class="mb-0 text-uppercase font-weight-bold"><?= $mes ?></h5>
            <p class="mb-0"><?= $dia ?></p>
        </div>
    </div>
</section>