<?php

require_once '../vendor/autoload.php';

$file = file($_FILES['arquivo']['tmp_name']);
$file = array_map('str_getcsv', $file);
array_shift($file);

$max = 30;
$html = '';

foreach ($file as $name) {
    $name = $name[0];
    $leng = strlen($name);

    if($leng > $max) {
        $names = explode(" ", $name);
        $names[2] = substr($names[2], 0 , 1) . ".";
        $name = implode(" ", $names);
    }

    $html .= '<img src="image/Certificado.jpg" style="width: 350px"/>
        <p style="margin-top:-90px;margin-left: 20px;font-family:arial;
        font-weight:bold;color:firebrick;font-size:14px">' . $name . '<br><br><br><br><br></p>';

}

$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 2,
    'margin_left' => 2,
    'margin_right' => 2,
    'margin_bottom' => 2,
    'format' => 'A3'
]);
$mpdf->SetColumns(3);
$mpdf->WriteHTML($html);
$mpdf->Output();

?>