<?php

	if(isset($_POST['submit'])) {
				
		$servidor  = $_POST['servidor'];
		$usuario  = $_POST['usuario'];
		$banco   = $_POST['banco'];
		$senha = $_POST['senha'];
		$repetir_senha = $_POST['repetir_senha'];
		
		$url_site   = str_replace("http://","",$_POST['url_site']);
		
		$ContURL = strlen($url_site);
		if(substr($url_site,($ContURL-1),1)=='/'){
			$url_site = substr($url_site,0,($ContURL-1));
		}


		
		$login_admin   = $_POST['login_admin'];
		$senha_admin = $_POST['senha_admin'];
		$repetir_senha_admin = $_POST['repetir_senha_admin'];
		
		if($servidor=="" || $usuario=="" || $banco=="" || $senha_admin=="" || $repetir_senha_admin=="" || $url_site=="" || $login_admin=="") {
		
			$ErroA = "<div class='erro'>Preencha todos os campos</div>";
			
		}else{
				if($senha!=$repetir_senha){
					$ErroB = "<div class='erro'>Banco de dados: repita a senha corretamente</div>";
				}else{
						if($senha_admin!=$repetir_senha_admin){
							$ErroC = "<div class='erro'>Admin: repita a senha corretamente</div>";
						}else{
							
									$conecta = mysql_connect($servidor,$usuario,$senha,$banco);
										if($conecta){
												mysql_select_db($banco,$conecta);
												$ErroF = '<div class="certo">Banco de dados Conectado</div>';
												
												
												
												$sqlSitemap = mysql_query("
													CREATE TABLE `tbl_sitemap` (
													  `id` int(9) NOT NULL auto_increment,
													  `descricao` text NOT NULL,
													  `url` text NOT NULL,
													  `prioridade` varchar(3) NOT NULL,
													  `data_edit` date NOT NULL,
													  PRIMARY KEY  (`id`)
													) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
												")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));
												
												
												if($sqlSitemap){
												
												
														$sqlAcoes = mysql_query("
															CREATE TABLE `tbl_acoes` (
																  `idLogin` int(9) NOT NULL,
																  `nomeLogin` varchar(100) NOT NULL,
																  `tabelaFerramenta` varchar(200) NOT NULL,
																  `id_ferramenta` int(9) NOT NULL,
																  `tituloAcao` varchar(300) NOT NULL,
																  `acao` varchar(100) NOT NULL,
																  `LinkFerramenta` varchar(500) NOT NULL,
																  `permalink` varchar(200) NOT NULL,
																  `data_acao` datetime NOT NULL
																) ENGINE=InnoDB DEFAULT CHARSET=latin1;
														")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));
														
		
														
														if($sqlAcoes){
															
															$sqlInt = mysql_query("
																CREATE TABLE `tbl_inteligencia` (
																  `auto_comp_campo_tab` varchar(200) NOT NULL
																) ENGINE=InnoDB DEFAULT CHARSET=latin1;
															")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));	
															
																if($sqlInt){
																	
																		$sqlPage = mysql_query("
																			CREATE TABLE `tbl_paginas` (
																			  `id` int(9) NOT NULL auto_increment,
																			  `nome_ferramenta` varchar(200) NOT NULL,
																			  `status` varchar(5) NOT NULL,
																			  `sub` varchar(5) NOT NULL,
																			  `sub_de` varchar(50) NOT NULL,
																			  PRIMARY KEY  (`id`)
																			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
																		")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));	
																		
																		if($sqlPage){
																			
																				$sqlConfig = mysql_query("
																					CREATE TABLE `tbl_configs` (
																					  `urlGeral` varchar(500) NOT NULL,
																					  `url_site` varchar(500) NOT NULL,
																					  `titulo_site` varchar(200) NOT NULL,
																					  `frase` text NOT NULL,
																					  `palavras` text NOT NULL,
																					  `email` varchar(200) NOT NULL,
																					  `arquivo` text NOT NULL,
																					  `datamod` date NOT NULL
																					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
																				")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));	
																				
																				if($sqlConfig){
																					
																					$sqlConfigADD = mysql_query("
																						INSERT INTO `tbl_configs` (`urlGeral`, `url_site`, `titulo_site`, `frase`, `palavras`, `email`) VALUES 
																						('http://".$url_site."/painel-admin/', 'http://".$url_site."', '', '', '', '');
																					")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));	
																					
																					
																					if($sqlConfigADD){
																						
																						$sqlLogin = mysql_query("
																							CREATE TABLE `tbl_login` (
																							  `id_login` int(11) NOT NULL auto_increment,
																							  `nome_usuario` varchar(100) NOT NULL,
																							  `sql_salt` varchar(200) NOT NULL,
																							  `sql_senha` varchar(200) NOT NULL,
																							  `sql_login` varchar(200) NOT NULL,
																							  `sql_nivel` int(1) NOT NULL,
																							  PRIMARY KEY  (`id_login`)
																							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
																						")or(die('<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>'));
																						
																						
																						if($sqlLogin){
																							
																							require_once('painel-admin/Sistema/Classes/login.inc.php');
																							$CadLog = new sistemaLogin;
																							$CadLog->Login        = $login_admin;
																							$CadLog->Senha        = $senha_admin;
																							$CadLog->PaginaLogin  = 'index.php?pg=Config/Usuarios';
																							$CadLog->Permissao    = 1;
																							$CadLog->Nome         = $login_admin;
																								if($CadLog->CadLogin()==true) {
		
		$ConteudoPageBanco = '																							
		<?php
			class  dbConnect{
				var $localhost = false;
				var $username  = false;
				var $password  = false;
				var $db_name   = false;
																										 
					public function conectMysql(){
						$this->localhost = \''.$servidor.'\';
						$this->username  = \''.$usuario.'\';
						$this->password  = \''.$senha.'\';
						$this->db_name   = \''.$banco.'\';
						$this->conecta = mysql_connect($this->localhost,$this->username,$this->password,$this->db_name);
							if($this->conecta){
									mysql_select_db($this->db_name,$this->conecta);
							}else{
									die( \'<div class=\"aviso erro\">\' . mysql_error() . \'</div>\');
								 }
					}
																									
						function fechaConexao(){
								mysql_close($this->conecta);
																											 
						}
		}  
		?>
		';
																									
																									$CriarpageBanco = fopen ("painel-admin/Sistema/Classes/bancodeDados.inc.php", "w");
																									if(fwrite($CriarpageBanco,$ConteudoPageBanco)){
																										$ErroG = '<div class="certo">Banco criado com sucesso!</div>';
																										$ErroH = '<div class="atencao">Exclua esse arquivo, a não exclusão desse arquivo pode comprometer a segurança do sistema!</div>';
																										
																									}else{
																										$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																										
																										
																									}
																									
																									
																									
																								}else{
																									$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																								}
						
																							
																						}else{
																							$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																						}
																						
																							
																					}else{
																						$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																					}
																					
																				}else{
																					$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																				}
																		
																		}else{
																			$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																		}	
																			
																	
																}else{
																	$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
																}
															
														}else{
															$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
														}
												
												}else{
													$ErroG = '<div class="erro">Não foi possível criar o banco</div>';
												}
												
												
										}else{
												$ErroD = '<div class="erro">Não foi possível conectar: ' . mysql_error() . '</div>';
										}
							
						}
				}
				
		}
		
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Começando :.</title>
</head>

<body>


<style>

table {
	border-collapse:collapse;
	border:1px solid #CCC;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#666;
}

tr {
	border-collapse:collapse;
	border:1px solid #CCC;
}

input {
	padding:5px;
	color:#666;
	outline:none;
	border:0;
	border:1px solid #CCC;
	width:300px;
}

input[name="submit"] {
	cursor:pointer;
	background-color:#3dc0e6;
	border:0;
	border-bottom:4px solid #136279;
	padding:12px;
	width:300px;
	color:#FFF;
}

div.erro { background-color:#ffd7d7; border:1px dashed #db6a6b; color:#000; padding:10px; margin-bottom:10px; }

div.certo { background-color:#dbf4d8; border:1px dashed #6fc166; color:#000; padding:10px; margin-bottom:10px; }

div.atencao { background-color:#faffd0; border:1px dashed #d6cb19;  color:#000; padding:10px; margin-bottom:10px; }


</style>

	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border:0;">
          <tr style="border:0;">
            <td style="padding:0;"><?=$ErroA?><?=$ErroB?><?=$ErroD?><?=$ErroF?><?=$ErroG?><?=$ErroH?></td>
          </tr>
        </table>

	<form action="install.php" method="post" enctype="multipart/form-data" />
        <table width="600" border="0" cellspacing="0" cellpadding="8" align="center">
          <tr>
            <td colspan="2" bgcolor="#F4F4F4">Banco de dados</td>
          </tr>
          <tr>
            <td width="113" align="left" valign="middle">Servidor</td>
            <td width="487" align="left" valign="middle"><input type="text" name="servidor" value="<?=$_POST['servidor']?>" /></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Banco</td>
            <td align="left" valign="middle"><input type="text" name="banco"  value="<?=$_POST['banco']?>"/></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Usuário</td>
            <td align="left" valign="middle"><input type="text" name="usuario"  value="<?=$_POST['usuario']?>"/></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Senha</td>
            <td align="left" valign="middle"><input type="password" name="senha"  /></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Repetir Senha</td>
            <td align="left" valign="middle"><input type="password" name="repetir_senha"  /></td>
          </tr>
        </table>
        
        <br /><br />
        
        <table width="600" border="0" cellspacing="0" cellpadding="8" align="center">
          <tr>
            <td colspan="2" bgcolor="#F4F4F4">Configurações</td>
          </tr>
          <tr>
            <td width="113" align="left" valign="middle">Url Site</td>
            <td width="487" align="left" valign="middle"><input type="text" name="url_site"  value="<?=$_POST['url_site']?>"/></td>
          </tr>
        </table>
        
        <br /><br />
        
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border:0;">
          <tr style="border:0;">
            <td style="padding:0;"><?=$ErroC?></td>
          </tr>
        </table>
        
        <table width="600" border="0" cellspacing="0" cellpadding="8" align="center">
          <tr>
            <td colspan="2" bgcolor="#F4F4F4">Admin</td>
          </tr>
          <tr>
            <td width="113" align="left" valign="middle">Login</td>
            <td width="487" align="left" valign="middle"><input type="text" name="login_admin"  value="<?=$_POST['login_admin']?>"/></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Senha</td>
            <td align="left" valign="middle"><input type="password" name="senha_admin" /></td>
          </tr>
          <tr>
            <td align="left" valign="middle">Repetir Senha</td>
            <td align="left" valign="middle"><input type="password" name="repetir_senha_admin"  /></td>
          </tr>
        </table>
        
        <br /><br />
        
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="border:0;">
          <tr style="border:0;">
            <td style="padding:0;"><input type="submit" value="Instalar Ferramenta" name="submit" /></td>
          </tr>
        </table>
     </form>



</body>
</html>

