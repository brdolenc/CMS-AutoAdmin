<?php
ob_start();



require_once('../Classes/bancodeDados.inc.php');
$DB = new dbConnect();

//CONECTA NO BANCO
echo $DB->conectMysql();

	
$array	= $_POST['arrayorder'];
$banco	= $_POST['banco'];

if ($_POST['update'] == "update"){
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE ".$banco."  SET posicao = " . $count . " WHERE id = " . $idval;
		mysql_query($query) or die();
		$count ++;	
	}
}
echo '<div class="aviso certo"><p>Salvo com sucesso</p></div>';



ob_end_flush();
?>