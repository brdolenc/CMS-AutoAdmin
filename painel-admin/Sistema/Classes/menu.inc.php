<?php


	class  MenuListas{


		function Paginas($DIR) {
			$path=$DIR;
			$diretorio=dir($path);
				while ($arquivo = $diretorio->read()){
					if((!strstr($arquivo,'.')))  {
						$sql_Fers = mysql_query("SELECT * FROM tbl_paginas WHERE nome_ferramenta = '".strtolower($arquivo)."'")or(die(mysql_error()));
						$retorna_Ferramentas = mysql_fetch_array($sql_Fers);
							if ($retorna_Ferramentas['sub'] != '0') {
							if ($retorna_Ferramentas['status'] == 'ON') {
								echo '<a href="?pg=paginas/'.$arquivo.'/'.$arquivo.'" class="LkBranco"><li class="MenuSub">'.ucfirst($arquivo).'</li></a>';
								
							}
							}
					}
			}
		}
        
	        
  	}  

?>