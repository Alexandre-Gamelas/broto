<section id="side-menu" class="row justify-content-center m-0 side-menu align-content-start">
    <!-- SETA DE SAIDA-->
    <a href="#" class="seta-sair-broto fas fa-arrow-right text-white"></a>

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
            "Perfil",
            "Game Hub",
            "Mapa",
            "Loja",
            "Admin",
            "Logout"
        );

        foreach ($menu as $link) {
            ?>

            <p class="mb-4"><a href="#" class="text-white"><?= $link ?></a></p>

            <?php
        }
        ?>
    </article>

</section>

<script>
    let menuState = false;
    console.log("ola jarbasia");
    $("#side-menu").css("width", 0);
    $("#side-menu > *").css("opacity", 0);

    $("#menu").click(function () {
        if (!menuState) {
            menuState = true;
            $("#side-menu").animate({
                width: '75vw'
            }, 400);

            $("#side-menu > *").animate({
                opacity: '1'
            }, 1000);


        } else {
            menuState = false;
            $("#side-menu").animate({
                width: '0'
            }, 400);

            $("#side-menu > *").animate({
                opacity: '0'
            }, 200);
        }
    })
</script>