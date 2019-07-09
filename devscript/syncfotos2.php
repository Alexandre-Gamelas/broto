<?php
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);
$query2 = "INSERT INTO galeria_eventos (ref_eventos, fotografia) VALUES (?, ?)";
if (mysqli_stmt_prepare($stmt2, $query2))
    if (mysqli_stmt_bind_param($stmt2, 'is', $id_evento, $imagem))
        if (mysqli_stmt_execute($stmt2))
            echo "<p>OKAY</p>";
