<?php

// localiza o arquivo do Autoload
require_once '../vendor/autoload.php';

// pega o arquivo CSV
$file = file($_FILES['arquivo']['tmp_name']);

// converte as linhas do arquivo para array
$file = array_map('str_getcsv', $file);

// remove a primeira linha do arquivo (Cabeçalho)
array_shift($file);

$html = '';

// funcao para abreviar os nomes
function abreviarNome($name) {
	// maximo de letras permitidas por nome
	$max = 30;
	// posicao do nome que sera abreviado
	$pos = 1;

	// loop que fica abreviando o nome até ele ficar dentro do tamanho aceitavel
	while (strlen($name) > $max) {

		// divide os nomes baseado nos espacos entre eles
		$names = explode(" ", $name);

		// se o nome ja estiver a previado, ou se for DA, DE, DO, DAS ou DOS, pula para o proximo nome
		if(strlen($names[$pos]) <= 3)
			$pos++;

		// abrevia o nome e transforma a letra abreviada em letra maiuscula
		$names[$pos] = strtoupper($names[$pos][0]) . ".";
		// junto os nomes, colocando o espaco entre eles
		$name = implode(" ", $names);
		// vai para a proxima posicao
		$pos++;
	}

	// retorna o nome 
	return $name;
}

// processa cada uma das linhas do arquivo
foreach ($file as $name) {
	// cria o codigo HTML de cada linha
	$html .= '<img src="image/Certificado.jpg" style="width: 350px"/>
		<p style="margin-top:-90px;margin-left: 20px;font-family:arial;padding-bottom:18px;
		font-weight:bold;color:firebrick;font-size:14px">' . abreviarNome($name[0]) . '</p>
		<br/><br/>';
}

// inicia o gerador de PDF
$mpdf = new \Mpdf\Mpdf([
	'margin_top' => 2,
	'margin_left' => 2,
	'margin_right' => 2,
	'margin_bottom' => 2,
	'format' => 'A3'
]);
// estipula o quantidade de colunas desejadas
$mpdf->SetColumns(3);
// coloca o HTML dentro do gerador de PDF
$mpdf->WriteHTML($html);
// da uma nome para o arquivo e gera o pdf
// 'I' = exibir	no navegador	'D'= faz o download automaticamente
$mpdf->Output('Certificados', 'I');

?>