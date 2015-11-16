<?php



class configs{
		
		function DadosCondig(){
			$Sql = mysql_query("SELECT * FROM tbl_configs")or(die(mysql_error()));
			$Retorna = mysql_fetch_array($Sql);
			return array($Retorna['urlGeral'],$Retorna['url_site'],$Retorna['titulo_site'],$Retorna['frase'],$Retorna['palavras'],$Retorna['email'],$Retorna['arquivo']);
		}
		
	
	}
	
?>


 
 
