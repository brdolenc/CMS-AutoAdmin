<?php

ob_start();
session_start("LogAdmin");
error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

require_once('Sistema/Classes/bancodeDados.inc.php');
$DB = new dbConnect();
require_once('Sistema/Classes/configs.inc.php');
$CONF = new configs();
require_once('Sistema/Classes/menu.inc.php');
$MENU = new MenuListas();
require_once('Sistema/Classes/inteligencia.inc.php');
$INT = new Inteligencia();
require_once('Sistema/Classes/login.inc.php');



//CONECTA NO BANCO
echo $DB->conectMysql();

//RETORNA CONFIGURACOES
$UrlGeral = $CONF->DadosCondig();


$VarVerificacao = true; //TODAS A PAGINAS POSSUEM ESSA VARIAVEL, PARA NÃO SEREM ACESSADAS SEPARADAMENTOS DO INDEX 

include 'Sistema/Includes/Funcoes.php';

include 'Sistema/Includes/Header.php'; 

if(isset($_GET['pg'])) {
		include 'Restrito/'.getPaginas($_GET['pg']).'.php'; 
	}else{
		include 'Restrito/home.php'; 
	}

include 'Sistema/Includes/Fotter.php'; 

}else{
	
	header('location: login.php');
	
}
 

ob_end_flush();

?>
