<?php

ob_start();


if(isset($_COOKIE['idLogin']) and isset($_COOKIE['UserLogin']) and isset($_COOKIE['NivelLogin'])) { 

	header('location: index.php');

}else{


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

include 'Sistema/Includes/Headermenuoff.php'; 


if(isset($_POST['submit'])) {
	
	
	if(strstr($_POST['log_senha'], " ") or strstr($_POST['log_name'], " ") 
		or strstr($_POST['log_senha'], "'") or strstr($_POST['log_name'], "'") 
		or strstr($_POST['log_senha'], '"') or strstr($_POST['log_name'], '"')
		or strstr($_POST['log_senha'], "<") or strstr($_POST['log_name'], "<")
		or strstr($_POST['log_senha'], ">") or strstr($_POST['log_name'], ">")
		or strstr($_POST['log_senha'], "=") or strstr($_POST['log_name'], "=")) {
		
			echo "<div class='aviso erro' style='width:300px; margin: 0 auto;'><p>Login ou senha incorretos</p></div>";
		
	}else{
		

	
		$LOG->Login        = $_POST['log_name'];
		$LOG->Senha        = $_POST['log_senha'];
		$LOG->PaginaLogin  = 'index.php';
		$LOG->Permissao    = 1;
			if($LOG->VerificaDados()==true) {
				
					if($LOG->criaCookies()==true) {
						header('location: index.php');
					}else{
						echo "<div class='aviso erro' style='width:300px; margin: 0 auto;'><p>não foi possivel iniciar a sessão</p></div>";
					}
			}else{
				echo "<div class='aviso erro' style='width:300px; margin: 0 auto;'><p>Login ou senha incorretos</p></div>";
			}
			
			
	}
}

?>

<div class="Box box_InfoFerramenta" style="margin:0 auto; float:none; width:300px;">
            <div class="Titulo_box">
                Paindel Administrativo
            </div>
            <div class="Body_box">
				<form action="login.php"  class="mws-form" method="post" name="login"  enctype="multipart/form-data"> 
                 <label>Login:</label><br>
                 <input type="text" name="log_name" id="log_name" class="mws-textinput medium" style="width:90%;"/><br>
                 <label>Senha:</label><br>
                 <input type="password" name="log_senha" id="log_senha" class="mws-textinput medium" style="width:90%;"><br>
                 <input type="submit" name="submit" value="Entrar no painel" class="Bt-green" />  
                 </form>
            </div>
         </div>

<?

include 'Sistema/Includes/Fotter.php'; 
 
 

}

ob_end_flush();

?>
