<?php

ob_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);


require_once('Sistema/Classes/bancodeDados.inc.php');
$DB = new dbConnect();
require_once('Sistema/Classes/configs.inc.php');
$CONF = new configs();
require_once('Sistema/Classes/menu.inc.php');
$MENU = new MenuListas();
require_once('Sistema/Classes/login.inc.php');
$LOG = new sistemaLogin;



//CONECTA NO BANCO
echo $DB->conectMysql();

//RETORNA CONFIGURACOES
$UrlGeral = $CONF->DadosCondig();


$VarVerificacao = true; //TODAS A PAGINAS POSSUEM ESSA VARIAVEL, PARA NÃO SEREM ACESSADAS SEPARADAMENTOS DO INDEX 

include 'Sistema/Includes/Funcoes.php';


$LOG->FechaCookies();
header('location: index.php');


ob_end_flush();

?>
