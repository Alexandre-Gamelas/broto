<?php
if($logo)
    $src= "assets/img/frontend/wave_logo.png";
else
    $src= "assets/img/frontend/wave_registar.png";

?>

<section class="row">
    <article class="col-12 position-relative h-15 header1">
        <img src="assets/img/frontend/login_img.jpg" alt="" class="img-fluid">
        <div class="gradient-broto position-absolute"></div>
        <img src="<?= $src?>" alt="" class="wave-logo">
    </article>
</section>