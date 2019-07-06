<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body style="padding-bottom: 5rem">
<?php
//+++++++++++ método do professor
/*
function file_get_contents_utf8($fn) {
    $content = file_get_contents($fn);
    return mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ASCII', true));
}
$file = "../eventos.json";
var_dump(json_decode( file_get_contents_utf8($file)));
echo "<br>";
echo mb_detect_encoding($file);
*/

//++++++++++++++ir buscar conteudo ao JSON com Curl//
/*
$url = "localhost/broto/eventos.json";
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$dados=curl_exec($ch);
//var_dump($dados);
// Closing
curl_close($ch);
*/

//+++++++++++++++ir buscar conteudo ao JSON com get Files//
$dados = file_get_contents("../eventos.json");
//var_dump($dados);

//parse para array
$dados = json_decode($dados, true);

/*************DEBUG**********************/
/*
var_dump($dados);
echo "<br>";
echo json_last_error_msg();
*/

/*
foreach ($dados as $eventos){
    foreach ($eventos as $evento){
        $nome = $evento['name'];
        echo "<h3>$nome</h3>";

        if(isset($evento['place']['location'])) {
            $latitude = $evento['place']['location']['latitude'];
            $longitude = $evento['place']['location']['longitude'];
            echo "<h5>$latitude</h5>";
            echo "<h5>$longitude</h5>";
        } else {
            $local = $evento['place']['name'];
            echo "<h5>$local</h5>";

            //GEOCODING
            $address = $local;
            $geo = 'https://nominatim.openstreetmap.org/search/'.$address.'?format=json&addressdetails=1&limit=1&polygon_svg=1';
            $geo = json_decode($geo, true); // Convert the JSON to an array
            var_dump($geo);
        }

        $data_inicio = explode("T", $evento["start_time"])[0];
        echo "<p>Inicio: $data_inicio</p>";
        if(isset($evento["end_time"])){
            $data_fim = explode("T", $evento["end_time"])[0];
            echo "<p>Fim: $data_inicio</p>";
        }


        $descricao = $evento['description'];
        echo "<p>$descricao</p>";
        echo "<hr>";
    }
}

*/

function geocode($address){

    $address = urlencode($address);

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCJEImAaf8MDn8XMInuKvusvjuLSasqNaw";

    $resp_json = file_get_contents($url);

    $resp = json_decode($resp_json, true);

    if($resp['status']=='OK'){

        $latitude = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

        if($latitude && $longitude && $formatted_address){

            $data_arr = array();

            array_push(
                $data_arr,
                $latitude,
                $longitude,
                $formatted_address
            );

            return $data_arr;

        }else{
            return false;
        }

    }

    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}

function random_str($length, $keyspace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}


//INSERT NA BD
require_once "../connections/connection.php";
foreach ($dados as $eventos){
    foreach ($eventos as $evento){
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO eventos (nome, data_inicio, data_fim, longitude, latitude, descricao, check_in) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssddss', $nome, $data_inicio, $data_fim, $longitude, $latitude, $descricao, $check_in);
            if(isset($evento['name']))
                $nome = $evento['name'];
            //pensar num else?

            if(isset($evento["start_time"]))
                $data_inicio = explode("T", $evento["start_time"])[0];
            else
                $data_inicio = "0000-00-00";

            if(isset($evento["end_time"]))
                $data_fim = explode("T", $evento["end_time"])[0];
            else
                $data_fim = $data_inicio;

            if(isset($evento['place']['location']) && isset($evento['place']['location']['latitude']) && isset($evento['place']['location']['longitude'])) {
                $latitude = $evento['place']['location']['latitude'];
                $longitude = $evento['place']['location']['longitude'];
            } else {
                 //GEOCODE

                            $adress = $evento['place']['name'];
                            if(geocode($adress)[0])
                                $latitude = geocode($adress)[0];
                            else
                                $latitude = 0;

                            if(geocode($adress)[1])
                                $longitude = geocode($adress)[1];
                            else
                                $longitude = 0;
                        }

                        $descricao = $evento['description'];

            $check_in = random_str(6);

            if (mysqli_stmt_execute($stmt)) {

            } else {
              echo  mysqli_stmt_error($stmt);
            }
        } else {
            echo mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
}

?>
</body>
</html>
