<?php
require 'vendor/autoload.php';

$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'http://www.seleccionbaloncesto.es/inicio.aspx');
$altura = [];
$edad=[];
$nombre=[];

for($i=0;$i<=17;$i++){
    $response->filter("#_ctl0_plantillaListView_ctrl".$i."_nombreTd")->each(
        // le pasamos $precios por referencia para poder editarla dentro del closure
        function ($node) use (&$nombre) {
            $nombre[] = $node->text();
        }
    );
}

for($i=0;$i<=17;$i++){
    $response->filter("#_ctl0_plantillaListView_ctrl".$i."_alturaTd")->each(
        // le pasamos $precios por referencia para poder editarla dentro del closure
        function ($node) use (&$altura) {
            $altura[] = $node->text();
        }
    );
}

for($i=0;$i<=17;$i++){
    $response->filter("#_ctl0_plantillaListView_ctrl".$i."_edadTd")->each(
        // le pasamos $precios por referencia para poder editarla dentro del closure
        function ($node) use (&$edad) {
            $edad[] = $node->text();
        }
    );
}

$total=0;
foreach($altura as $alt){
    $alt = str_replace(",", "." , $alt);
    $total+= (float)$alt;
}
$mediaAlt=round($total/count($altura) ,2);

$total=0;
foreach($edad as $ed){
    $total= $total + $ed;
}
$mediaEd=$total/count($edad);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table border="3">
        <tr>
            <td>NOMBRE</td>
            <?php
                foreach($nombre as $nom){
                    echo "<td>".$nom."</td>";
                }?>
        </tr>
        <tr>
            <td>ALTURA: </td>
            <?php
                foreach($altura as $alt){
                    echo "<td>".$alt."</td>";
                }?>
        </tr>
        <tr>
            <td>EDAD:</td>
                <?php
                foreach($edad as $ed){
                    echo "<td>".$ed."</td>";
                }
            ?>
        </tr>
    </table>
    <p>La altura media es <?=$mediaAlt?></p>
    <p>La edad media es <?=$mediaEd?></p>
</body>
</html>