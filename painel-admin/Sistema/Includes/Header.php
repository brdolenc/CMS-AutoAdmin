<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel Adm V2</title>
</head>

<link type="text/css" href="<?php echo $UrlGeral[0]?>Arquivos/css/reset.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $UrlGeral[0]?>Arquivos/css/layout.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $UrlGeral[0]?>Arquivos/css/jquery-ui.css" />


<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/jquery-1.7.1.min.js"></script>	
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/jquery-ui.js"></script>	
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/layout.js"></script>
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/functions.js"></script>
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/nicEdit.js"></script>
<script type='text/javascript' src='<?php echo $UrlGeral[0]?>Arquivos/js/jquery.maskMoney.js'></script>
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo $UrlGeral[0]?>Arquivos/js/jquery.tablesorter.pager.js"></script>


<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<script type="text/javascript">
	function slideout(){
  			setTimeout(function(){
 			$(".aviso").slideUp("slow", function () {});
	  }, 6000);} 
	  slideout();
</script>


<script>

$(function() {
		var availableTags = [
		  <?php echo $INT->CampoAutoComplete('auto_comp_campo_tab',1); ?>
		  "fim"
		];
		$( "#campoTabelas" ).autocomplete({
		  source: availableTags
		});
  });

function AddTR() {
	var TrHtml = '<tr><td></td><td><input name="campo[]" class="campoTabelas1" style="width:171px;"  type="text" onkeyup="validar_titulo_tbl(this);" onchange="javascript:Carrega_tbl(\'Sistema/Includes/ajax_verifica_tabelas.php\',this.value);" /></td><td><select name="tipo[]" id="tipo" ><option value="VARCHAR" >VARCHAR</option><option value="TEXT" >TEXT</option><option value="DATE" >DATE</option><option value="INT" >INT</option><option value="DATETIME" >DATETIME</option><option value="TIME" >TIME</option></select></td><td><input name="tamanho[]" style="width:px;" type="text" /></td></tr>'; 

	$("#TableCamposDB").last().append(TrHtml);
	$(function() {
		var availableTags = [
		  <?php echo $INT->CampoAutoComplete('auto_comp_campo_tab',1); ?>
		  "fim"
		];
		$( ".campoTabelas1" ).autocomplete({
		  source: availableTags
		});
  });
	var ValorAtual =  parseInt($("#quantidade_Pre").val());
	$("#quantidade_Pre,#quantidade").val(ValorAtual+1);
	
}
</script>




<script type='text/javascript' src='<?php echo $UrlGeral[0]?>Arquivos/js/jquery.mask.js'></script>


<body>
<div id="Pricipal">
		<div id="MenuTopo">
    		<?php include 'Sistema/Includes/Menu.php'; ?>
    	</div>

    	<div id="Conteudo">
 		<?php
			if(!file_exists('../Sitemap.xml')){
				echo "<div class='aviso alerta'><p>Acesse o menu <strong>SiteMap</strong> e cadastre no mínimo uma URL, depois clique em <strong>GERA SITEMAP</strong></div>";
			}
			
			$UrlInicioConfis = mysql_query("SELECT * FROM tbl_configs")or(die(mysql_error()));
			$RetornConfis = mysql_fetch_array($UrlInicioConfis);
				if($RetornConfis['titulo_site']=="" || $RetornConfis['frase']=="" || $RetornConfis['palavras']=="" || $RetornConfis['email']==""){
					echo "<div class='aviso alerta'><p>Acesse o menu <strong>Alterar Dados</strong> e preencha todos os campos em branco!</div>";
				}
		?>

<?php

	}else{
	
	header('location: ../../login.php');
	
}

?>