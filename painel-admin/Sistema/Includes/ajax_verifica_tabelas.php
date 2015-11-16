<?
 

if($_GET['DSG'] == 'status' or  $_GET['DSG'] == 'data_cadastro' or $_GET['DSG'] == 'id_cat' or $_GET['DSG'] == 'destaque' or $_GET['DSG'] == 'foto'  or $_GET['DSG'] == 'id'  or $_GET['DSG'] == 'permalink') {
	
	
	echo '<input type="button" value="Escolha outro nome, '.$_GET['DSG'].' não é permitido" class="Bt-red" /><input type="button" value="Verificar Campos" class="Bt-blue" />';
	

}else {
	
	
	echo '<input type="submit" name="submit" value="Criar Ferramenta" class="Bt-green"><input type="button" value="Verificar Campos" class="Bt-blue" />';
	
}

?>

