<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {


    class Trata_variaveis
	{
	   
	  
	   function Resgata($N_Referencia,$V_Referencia,$N_campo,$V_campo,$N_Tipo,$V_Tipo,$N_Tamanho,$V_Tamanho,$QTD,$Titulo_banco,$Galeria,$Upload,$Post_destaque,$Sitema_comente,$categorias){

		  if($V_campo == true and $V_Tipo == true and $V_Tamanho) {
			  
			  
			  $i = 1;
			  foreach($V_Referencia as $valor){
                  $Matriz[$N_Referencia][$i++] = $valor;
              }
		  	  
			  $i = 1;
			  foreach($V_campo as $valor){
                  $Matriz[$N_campo][$i++] = $valor;
              }
			  
			  $i = 1;
			  foreach($V_Tipo as $valor){
                  $Matriz[$N_Tipo][$i++] = $valor;
              }
			  
			  $i = 1;
			  foreach($V_Tamanho as $valor){
                  $Matriz[$N_Tamanho][$i++] = $valor;
              }
			  
			  
			  for($x=1;$x <= $QTD;$x++) {
				  
				  if($Matriz[$N_Referencia][$x] == 1) {
				   
				   $Campo_principal = strtolower($Matriz[$N_campo][$x]);
				   
				   	if($Matriz[$N_campo][$x] == '') {
						$VarificaRef = true;
					}else{
						$VarificaRef = false;
					}
				   
				  }
				  
				  
			  }
			  
			  if($VarificaRef == true) {
				  header('location: index.php?pg=Contrutor/Construtor_ADM&erro=principalFalse');
			  }else{

			  //Referencia da tabela
			  $Campo_Referencial = 'id';
			  
			  
			  
			  
			  $SQL_Cria = false;

			  $SQL_Cria .= 'CREATE TABLE `tbl_'.$Titulo_banco.'` ( ';
			  
			  if($categorias == 1) { $SQL_Cria .= "`id_cat` int(11) NOT NULL,"; }
			  
			  $SQL_Cria .= "`id` int(11) NOT NULL auto_increment,";
			  
			  $SQL_Cria .= "`status` varchar(20) NOT NULL default 'OFF',";
			  
			  $SQL_Cria .= "`destaque` varchar(20) NOT NULL default 'OFF',";
			  
			  $SQL_Cria .= "`permalink` varchar(200) NOT NULL,";
			  
			  if($Galeria == 1) {   $SQL_Cria .= "`foto` text NOT NULL,"; }

			  $SQL_Cria .= "`data_cadastro` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,";



			  for($x=1;$x <= $QTD;$x++) {
				  
				  
					  $FirstChar = substr($Matriz['Campo'][$x],0,1);
					  $CharEmpty = array('0','1','2','3','4','5','6','7','8','9','-','_',' ');
					  if(in_array($FirstChar, $CharEmpty)){
						  $CharIncorrect = 1;
					  }else{
						  $CharIncorrect = 0;
					  }
  
				  if($Matriz['Campo'][$x] != '' and $Matriz['Campo'][$x] != false and $CharIncorrect == 0) {
			       
			  	    $SQL_Cria .= '`'.strtolower($Matriz['Campo'][$x]).'` ';
				    $SQL_Cria .= ' '.strtolower($Matriz['Tipo'][$x]).' ';


					if($Matriz['Tipo'][$x]=='TEXT' or $Matriz['Tipo'][$x]=='DATE' or $Matriz['Tipo'][$x]=='DATETIME' or  $Matriz['Tipo'][$x]=='TIME') {
								$SQL_Cria .= 'NOT NULL,';
					}else{
						if($Matriz['Tamanho'][$x] != '' and $Matriz['Tamanho'][$x] == true) {
							$SQL_Cria .= '('.$Matriz['Tamanho'][$x].'),';
						}else{
							if($Matriz['Tipo'][$x] == 'VARCHAR' and $Matriz['Tamanho'][$x] == '') {
								$SQL_Cria .= '(200),';
							} elseif($Matriz['Tipo'][$x] == 'INT' and $Matriz['Tamanho'][$x] == '') {
								$SQL_Cria .= '(11),';
							} else {
								$SQL_Cria .= '('.$Matriz['Tamanho'][$x].'),';
							}
						}
					}
					
				  }
					
			 }
			  
			  	$SQL_Cria .= 'PRIMARY KEY  (`id`)';
				
				
				if($Primary >= 1){
				$SQL_Cria .= ') ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
				} else {
			    $SQL_Cria .= ') ENGINE=InnoDB DEFAULT CHARSET=latin1;';	
				}
				
				
				$Cria_SQL = mysql_query($SQL_Cria)or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
				
				if($Cria_SQL){
			    	mysql_query("INSERT INTO tbl_paginas SET nome_ferramenta = '$Titulo_banco', status = 'OFF', sub = '1'")or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
		        }
				
				
				
				mkdir ("Restrito/paginas/".$Titulo_banco."/", 0777 );
				
				
				if($categorias == 1) { 
					$Cat_Cria_menus = 1;
					$Cria_SQL_Categoria = mysql_query('CREATE TABLE `tbl_cat_'.$Titulo_banco.'` (
													  `id` int(9) NOT NULL auto_increment,
													  `titulo` varchar(200) NOT NULL,
													  `id_sub` int(9) NOT NULL default "0",
													  `status` varchar(20) NOT NULL default "OFF",
													  PRIMARY KEY  (`id`)
													) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;')or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
					
					if($Cria_SQL_Categoria) { include 'Restrito/Criar_paginas/Cria_categorias.php'; }					
				}
				

				
				if($Galeria == 1) {  
					$Gal_Cria_menus = 1;
						$Cria_SQL_Galeria = mysql_query('CREATE TABLE `tbl_galeria_'.$Titulo_banco.'` (
												  `id` int(9) NOT NULL auto_increment,
												  `id_princ` int(9) NOT NULL,
												  `arquivo` text NOT NULL,
												  `titulo` varchar(200) NOT NULL,
												  `texto` text NOT NULL,
												  `data` datetime NOT NULL,
												  `capa` varchar(50) NOT NULL,
												  `posicao` int(9) NOT NULL,
												  PRIMARY KEY  (`id`)
												) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;')or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
	
					if($Cria_SQL_Galeria) { include 'Restrito/Criar_paginas/Cria_galeria.php'; }
				
				}
				
				if($Post_destaque == 1) {  
					$Destaque_Cria_menus = 1;
				}
				
				
				if($Upload == 1) {  
					$Up_Cria_menus = 1;
						$Cria_SQL_Galeria = mysql_query('CREATE TABLE `tbl_upload_'.$Titulo_banco.'` (
												  `id` int(9) NOT NULL auto_increment,
												  `id_princ` int(9) NOT NULL,
												  `arquivo` text NOT NULL,
												  `titulo` varchar(200) NOT NULL,
												  `texto` text NOT NULL,
												  `data` datetime NOT NULL,
												  PRIMARY KEY  (`id`)
												) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;')or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
											
					if($Cria_SQL_Galeria) { include 'Restrito/Criar_paginas/Cria_upload.php'; }
				
				}
				
				
				
				
				if($Sitema_comente == 1) {	
					$Com_Cria_menus = 1;									
						$Cria_SQL_Comente = mysql_query('CREATE TABLE `tbl_comentarios_'.$Titulo_banco.'` (
												  `id` int(11) NOT NULL auto_increment,
												  `id_princ` int(9) NOT NULL,
												  `nome` varchar(200) NOT NULL,
												  `email` varchar(200) NOT NULL,
												  `comentario` text NOT NULL,
												  `data` text NOT NULL,
												  `status` varchar(20) NOT NULL default "OFF",
												  `spam` varchar(3) NOT NULL default "OFF",
												  PRIMARY KEY  (`id`)
												) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;')or(die('<div class="aviso erro"><p>'.mysql_error().'</p></div>'));
					
				   if($Cria_SQL_Comente) { include 'Restrito/Criar_paginas/Cria_comentarios.php'; }
			   }
			   

			   if($Cria_SQL) {
				   include 'Restrito/Criar_paginas/Cria_principal.php';
				   include 'Restrito/Criar_paginas/Cria_cadastro.php';
				   include 'Restrito/Criar_paginas/Cria_cadastro_restaurar.php';
				   include 'Restrito/Criar_paginas/Cria_editar.php';
				   include 'Restrito/Criar_paginas/Cria_mudar.php';
				   include 'Restrito/Criar_paginas/Cria_editar_restaurar.php';
			   }	
				
			  if($Cria_SQL) { $Mostra_Alert = '<div class="aviso certo"><p><strong>Sucesso!</strong> Tabela criada com sucesso  !</p></div>'; }
			  else { $Mostra_Alert = '<div class="aviso erro"><p><strong>Erro!</strong>Não foi possível criar a Tabela principal.</p></div>'; }
			  
			  
			    if($categorias == 1) { 
			    if($Cria_SQL_Categoria) { $Mostra_Alert3 = '<div class="aviso certo"><p><strong>Sucesso!</strong> Tabela Categoria criada com sucesso  !</p></div>'; }
				else { $Mostra_Alert3 = '<<div class="aviso erro"><p><strong>Erro!</strong>Não foi possível criar a Tabela Categoria.</p></div>'; }
				}
				
				if($Galeria == 1) { 
				if($Cria_SQL_Galeria) { $Mostra_Alert1 = '<div class="aviso certo"><p><strong>Sucesso!</strong> Tabela Galeria criada com sucesso  !</p></div>'; }
				else { $Mostra_Alert1 = '<div class="aviso erro"><p><strong>Erro!</strong>Não foi possível criar Tabela Galeria.</p></div>'; }
				}
				
				if($Upload == 1) { 
				if($Cria_SQL_Galeria) { $Mostra_Alert4 = '<div class="aviso certo"><p><strong>Sucesso!</strong> Tabela Upload criada com sucesso  !</p></div>'; }
				else { $Mostra_Alert4 = '<div class="aviso erro"><p><strong>Erro!</strong>Não foi possível criar a tabela Upload.</p></div>'; }
				}
			    
				if($Sitema_comente == 1) {
				if($Cria_SQL_Comente) { $Mostra_Alert2 = '<div class="aviso certo"><p><strong>Sucesso!</strong> Tabela Comentarios criada com sucesso  !</p></div>'; } 
				else { $Mostra_Alert2 = '<div class="aviso erro"><p><strong>Erro!</strong>Não foi possível criar.</p></div>';} 
				
				}
				
				echo $Mostra_Alert;
				echo $Mostra_Alert1;
				echo $Mostra_Alert2;
				echo $Mostra_Alert3;
				echo $Mostra_Alert4;
			  
		   }
		   
		  }
			  
	   }
	}
	
	
	
?>







<?php 

}else{
	
	echo "<div class='aviso erro'><p>Permissão negada</div>";
	
}

}else{
	
	header('location: ../../login.php');
	
}

?>







