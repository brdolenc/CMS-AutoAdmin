<?php
ob_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

require_once('Sistema/Classes/bancodeDados.inc.php');
$DB = new dbConnect();

//CONECTA NO BANCO
echo $DB->conectMysql();

$Banco = mysql_real_escape_string($_GET['banco']);
$Status = mysql_real_escape_string($_GET['status']);
$Pagina = $_GET['pagina'];
$Id = mysql_real_escape_string($_GET['id']);
$id_gal = mysql_real_escape_string($_GET['id_gal']);


if(isset($_GET['Id_Princ'])) {

	$Id_Princ_url = '&Id_Princ='.mysql_real_escape_string($_GET['Id_Princ']);
	
}else{

	$Id_Princ_url = '';

}

if($_GET['pagid'] == true and $_GET['pagid'] != '' ) {
		$Pag_retorno = '&id_pag='.mysql_real_escape_string($_GET['pagid']);
};


$sqlUpAll = mysql_query("UPDATE ".$Banco." SET capa = 'OFF'")or(die(mysql_error()));

if($sqlUpAll) {

	if($Status == 'OFF' or $Status == '') { $STAT = 'ON'; } else { $STAT = 'OFF'; }
	
	
	$sql = mysql_query("UPDATE ".$Banco." SET capa = '$STAT' WHERE id = '$id_gal' ")or(die(mysql_error()));
	
	if($sql) {
		
		if($Id == true and $Id != "") { $Pagina_Retorno = $Pagina.'&id='.$Id.$Pag_retorno; } else { $Pagina_Retorno = $Pagina; }
		
		header('Location: index.php?pg='.$Pagina_Retorno.$Id_Princ_url.'');
		
		
	} else {
		
		echo 'Não foi possivel alteral';
		
		
	}
	
} else {
		
		echo 'Não foi possivel alteral';
		
		
}



	}else{
	
	header('location: ../../login.php');
	
}


ob_end_flush();
?>