<?php


		
		function VerificaTables($Tabela){


			$DIR = "Restrito/paginas/";
				$Final_Ver_erro = 0;
				$Final_Ver_ok = 0;

				$path=$DIR; 

			$diretorio=dir($path); 
				while ($arquivo = $diretorio->read()) 
				{ 
					if((!strstr($arquivo,'.'))) {
						
						$nome_muda = ucfirst($Tabela);
						if(ucfirst($arquivo) == $nome_muda and ucfirst($arquivo) == $nome_muda) {
							$Final_Ver_erro = 1 + $Final_Ver_erro;
							
						}else {

						    $Final_Ver_ok = 1 + $Final_Ver_ok;
						}

			}

			 
			}


				if(
				$Tabela == '' or	
				$Tabela == 'configuracao' or
				$Tabela == 'ferramentas' or
				$Tabela == 'grupo' or
				$Tabela == 'marcadagua' or
				$Tabela == 'log' or
				$Tabela == 'paginas' or
				$Tabela == 'login_verifica' or
				$Tabela == 'status_usuario' or
				$Tabela == 'usuario' or
				$Tabela == 'visitas_clientes' or
				$Tabela == 'visitas_paginas') {

					$Final_Ver_erro = 1 + $Final_Ver_erro;
					
				}else {

				    $Final_Ver_ok = 1 + $Final_Ver_ok;

				}


				if($Final_Ver_erro >= 1) {

					return false;
					
				}else {

				    return true;

				}
			}
			
			
			
			function getPaginas($PageUrl) {
				$RetornaUrl = str_replace('http://','',$PageUrl); 
				$RetornaUrl = str_replace('www','',$PageUrl); 
				$RetornaUrl = str_replace('.php','',$PageUrl);
				$RetornaUrl = str_replace('.html','',$PageUrl);
				$RetornaUrl = str_replace('.js','',$PageUrl);
				$RetornaUrl = str_replace('.css','',$PageUrl);
				$RetornaUrl = str_replace('.xml','',$PageUrl);
				$RetornaUrl = str_replace('.asp','',$PageUrl);
					return $RetornaUrl;
						
			}
			
			
			
			
			function verificaNivel($Id_Log,$Nivel){
				$sql = mysql_query("SELECT * FROM tbl_login WHERE id_login = '$Id_Log'")or(die(mysql_error()));
				$retorna = mysql_fetch_array($sql);
    			if($retorna['sql_nivel']==1 and $Nivel==1){ return true; } else { return false; }
			}
			
			
			function GravaAcoes($idLogin,$nomeLogin,$tabelaFerramenta,$acao,$tituloAcao,$permalink,$SubFerramenta) {
				//TRATA AS VARIAVEIS
				$Banco = $tabelaFerramenta;
				$NomeFerramenta = ucfirst(str_replace("tbl_","",$tabelaFerramenta));
				
				if($SubFerramenta == false) {
						$LinkFerramenta = "?pg=paginas/".str_replace("tbl_","",$tabelaFerramenta)."/".str_replace("tbl_","",$tabelaFerramenta);
				}else{
						$LinkFerramenta = "?pg=paginas/".str_replace("tbl_","",$tabelaFerramenta)."/".str_replace("tbl_","",$tabelaFerramenta).'&Id_Princ='.$SubFerramenta;
				}
					
					//RECUPERA ID DA FERRAMENTA QUE EXECUTOU A AÇÃO (EDITAR OU CADASTRAR) 
					$sqlRecId = mysql_query("SELECT * FROM ".$Banco." WHERE permalink = '".$permalink."' ")or(die(mysql_error()));
						$retornId = mysql_fetch_array($sqlRecId);
							$IdFerramentaAcao = $retornId['id'];


							$sqlVerifica = mysql_query("SELECT count(*) as ContTotal FROM tbl_acoes WHERE id_ferramenta = '$IdFerramentaAcao' AND tabelaFerramenta = '$tabelaFerramenta'")or(die(mysql_error()));
							$Cont = mysql_fetch_array($sqlVerifica);


								if($Cont['ContTotal'] == 1) {


									   //ATAULIZA A AÇÃO EXECUTADA
										$sqlCad = mysql_query("UPDATE tbl_acoes SET  idLogin = '$idLogin',
																					 nomeLogin = '$nomeLogin',
																					 tabelaFerramenta = '$tabelaFerramenta',
																					 id_ferramenta = '$IdFerramentaAcao',
																					 tituloAcao = '$tituloAcao',
																					 acao = '$acao',
																					 LinkFerramenta = '$LinkFerramenta',
																					 permalink = '$permalink',
																					 data_acao = NOW() WHERE id_ferramenta = '$IdFerramentaAcao' AND tabelaFerramenta = '$tabelaFerramenta'")or(die(mysql_error()));		


								}else{

										//CADASTRA A AÇÃO EXECUTADA
										$sqlCad = mysql_query("INSERT INTO tbl_acoes SET idLogin = '$idLogin',
																						 nomeLogin = '$nomeLogin',
																						 tabelaFerramenta = '$tabelaFerramenta',
																						 id_ferramenta = '$IdFerramentaAcao',
																						 tituloAcao = '$tituloAcao',
																						 acao = '$acao',
																						 LinkFerramenta = '$LinkFerramenta',
																						 permalink = '$permalink',
																						 data_acao = NOW()")or(die(mysql_error()));		

								}
				
							
				
			}
			
			
			
			//GERA O LINK PERMALINK A PARTIR A URL ATUAL
			function urlLink($Number) {
	
				$NumberCont = $Number - 1;
			  
				$Raiz = str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
				$Size = strlen($Raiz);
				if(substr($Raiz, $Size-1, 1) == '/') {
					$Raiz = substr($Raiz, 0 , $Size-1); 
				}
				$Raiz = explode("/",$Raiz); 
				array_shift($Raiz); 
				$Cont = count($Raiz);
				 
			
				  $parte1 = strrchr($_SERVER['REQUEST_URI'],"?");
				  $parte2 = str_replace($parte1,"",$_SERVER['REQUEST_URI']);
				  $url = explode("/",$parte2);
				  array_shift($url);
			
				
				  if($Cont >= 1) {
					  for($x=0;$x<$Cont;$x++) {
						  unset($url[$x]);
					  }
					  
					  
					  $ContURL = count($url);
					  $ArrayTemp = array();
					  
					  $Zerar = 0;
					  for($x=$Cont;$x<$ContURL+$Cont;$x++) {
							$ArrayTemp[$Zerar++] = $url[$x];	  
					  }
					  
					  $url = array();
					  for($x=0;$x<$ContURL;$x++) {
							$url[$x] = $ArrayTemp[$x];
					  }
					  
					}
					
					
					
					$ContExists = count($url);
								if($url[$NumberCont] == '' or $url[$NumberCont] == false or $ContExists < $Number and $Number != 1) {
									$Stp = false;
									for($x=$NumberCont;$x<=$ContExists;$x++) {
										if($url[$x] != '') { $url[$NumberCont] = $url[$x]; $Stp = true; break; };
									}
									if($Stp==false){
										for($x=$NumberCont;$x<=$ContExists;$x--) {
											if($url[$x] != '') { $url[$NumberCont] = $url[$x]; $Stp = true; break; };
											if($x <= 0) { break; }
										}
									}
								}
						
				//RETORNA A URL SOLICITADA COM O NUMERO DE REFERENCIA	  
				   return $url[$NumberCont];
						
			}
			
			
			//GERA LINK DA PAGINA PARA O META NA CONFIGURAÇÂO DOS BUSCADORES
			function geraCanonical() {
				
				$z=1;
				$Tfim = false;
				while(1<>2){
					if(urlLink($z) != ''){
					}else{
						break;
					}
					$z++;
				}
				
				$y=1;
				$Canonical = false;
				while(1<>2){
					if(urlLink($y) != ''){
						if($z-1 != $y){
							if($y==1){
								$Canonical .= urlLink($y);
							}else{
								$Canonical .= '/'.urlLink($y);
							}
						}
					}else{
						break;
					}
					$y++;
				}
				return $Canonical;
			}
			
			
			//GERA O TITULO DO SITE
			function geraSitename($Tsite){
				$z=1;
				$Tfim = false;
				while(1<>2){
					if(urlLink($z) != ''){
						if($z==1){
							$Tfim = urlLink($z);
						}else{
							$Tfim = urlLink($z);
						}
					}else{
						break;
					}
					$z++;
				}
				if(urlLink(1)==''){
					return $Tsite;
				}else{
					return $Tsite.' - '.$Tfim;
				}
			}
			

?>

