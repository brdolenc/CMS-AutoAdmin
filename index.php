<?php

	require_once('painel-admin/Sistema/Classes/bancodeDados.inc.php');
	$DB = new dbConnect();
	require_once('painel-admin/Sistema/Classes/configs.inc.php');
	$CONF = new configs();
	require_once('painel-admin/Sistema/Classes/menu.inc.php');
	$MENU = new MenuListas();
	require_once('painel-admin/Sistema/Classes/inteligencia.inc.php');
	$INT = new Inteligencia();
	require_once('painel-admin/Sistema/Classes/login.inc.php');
	
	//verifica se o arquivo install existe
	if(file_exists('install.php')){
		header('location: install.php');
	}
	
	//CONECTA NO BANCO
	echo $DB->conectMysql();
	
	//RETORNA CONFIGURACOES
	$Configs = $CONF->DadosCondig(1);
	
	$VarVerificacao = true; //TODAS A PAGINAS POSSUEM ESSA VARIAVEL, PARA NÃO SEREM ACESSADAS SEPARADAMENTOS DO INDEX 
	
	include 'painel-admin/Sistema/Includes/Funcoes.php';
	
	
	//DEFINE INFORMAÇÔES
	$_UrlSite = $Configs[1];
	$_Titulosite = $Configs[2];
	$_FraseBusca = $Configs[3];
	$_PalavrasBusca = $Configs[4];
	$_EmailPrincipal = $Configs[5];
	$_LogoSitePrincipal = $Configs[6];
	

	//CHAMA PAGINA PRINCIPAL
	include 'template/principal.php';

?>
