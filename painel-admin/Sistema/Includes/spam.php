
<?php
ob_start();




if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {




require_once('Sistema/Classes/bancodeDados.inc.php');
$DB = new dbConnect();

//CONECTA NO BANCO
echo $DB->conectMysql();

$Banco = mysql_real_escape_string($_GET['banco']);
$Status = mysql_real_escape_string($_GET['status']);
$Pagina = $_GET['pagina'];
$Id = mysql_real_escape_string($_GET['id']);


$result = mysql_query("SHOW COLUMNS FROM ".$Banco);
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}

		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				
				if($row['Extra'] == 'auto_increment') {
					
					$Colun = $row['Field'];
					
				}
				
			}
		}

if(isset($_GET['Id_Princ'])) {

	$Id_Princ_url = '&Id_Princ='.mysql_real_escape_string($_GET['Id_Princ']);
	
}else{

	$Id_Princ_url = '';

}

if($_GET['pagid'] == true and $_GET['pagid'] != '' ) {

	$Pag_retorno = '&id_pag='.mysql_real_escape_string($_GET['pagid']);
	
	};

if($Status == 'OFF') { $STAT = 'ON'; } else { $STAT = 'OFF'; }

echo $Banco;

$sql = mysql_query("UPDATE ".$Banco." SET spam = '$STAT' WHERE ".$Colun." = '$Id' ")or(die(mysql_error()));

if($sql) {
	
	if($Id == true and $Id != "") { $Pagina_Retorno = $Pagina.'&id='.$Id.$Pag_retorno; } else { $Pagina_Retorno = $Pagina; }
	
	header('Location: index.php?pg='.$Pagina_Retorno.$Id_Princ_url.'');
	
	
} else {
	
	echo 'Não foi possivel alteral';
	
	
}


}else{
	
	header('location: ../../login.php');
	
}



ob_end_flush();
?>