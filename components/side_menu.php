<script>
    $("#side-menu").hide();
</script>
<!-- BLUR -->
<div id="blur" style="z-index: 9999"></div>

<section id="side-menu" class="row justify-content-center m-0 side-menu align-content-start" style="z-index: 10000">
    <!-- SETA DE SAIDA-->
    <i id="menu-close" class="seta-sair-broto fas fa-arrow-right text-white"></i>

    <!-- foto -->
    <article class="col-6 text-center profile-pic-broto" style="margin-top: 3rem">
        <div class="white-1"></div>
        <div class="white-2"></div>
        <img src="<?= $_SESSION['user']['fotografia'] ?>" alt="" class="profile-pic-broto">
    </article>

    <!-- NOME + EMAIL -->

    <article class="col-12 text-center mt-4 pt-3">
        <p class="text-white titulo-1-broto mb-2"><?= $_SESSION['user']['nome'] ?></p>
    </article>

    <article class="col-12 text-center">
        <p class="text-white text-uppercase spacing-broto" style="font-size: 3vmin"><?= $_SESSION['user']['email'] ?></p>
    </article>

    <!-- nav -->

    <article class="col-10 text-white titulo-2-broto pt-4 pl-4 mt-4" style="border-top: 2px solid white ">
        <?php

        $menu = array(
            "Perfil" => "perfil.php",
            "Mapa" => "mapa.php",
            "Logout" => "scripts/script_logout.php"
        );

        if($_SESSION['user']['papel']==1)
            $menu["Administrador"] = "admin/index.php";

        foreach ($menu as $nome => $link) {
            ?>

            <p class="mb-4"><a href="<?=$link?>" class="text-white"><?= $nome?></a></p>

            <?php
        }
        ?>
    </article>

</section>

<script>
    $("#blur").hide();
    $("#blur").css("opacity", 0);
    let menuState = false;
    $("#side-menu").css("width", 0);
    $("#side-menu > *").css("opacity", 0);

    $("#menu, #menu-close, #blur").click(function () {
        if (!menuState) {

            $("#side-menu").animate({
                width: '75vw'
            }, 400);

            $("#side-menu > *").animate({
                opacity: '1'
            }, 1000);

            $("#blur").show(function () {
                $(this).animate({
                    opacity: "0.6"
                }, 1000, function () {
                    menuState = true;
                });
            });

        } else {
            $("#side-menu").animate({
                width: '0'
            }, 400);

            $("#side-menu > *").animate({
                opacity: '0'
            }, 200);

            $("#blur").animate({
                opacity: "0"
            }, 1000, function () {
                $(this).hide(function () {
                    menuState = false;
                })
            });
        }
    })
</script>