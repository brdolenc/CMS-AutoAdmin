<?php
	require_once('bancodeDados.inc.php');
		$DB = new dbConnect();
		echo $DB->conectMysql();
	require_once('login.inc.php');
		$LG = new sistemaLogin;
		$LG->Login        = $_POST['inp_login'];
		$LG->Senha        = $_POST['inp_senha'];
		$LG->PaginaLogin  = 'index.php';
		$LG->Permissao    = 1;
		if($LG->VerificaDados()==true) {
			setcookie('idLogin', $_POST['inp_login'], (time() + (2 * 3600))); // durar 2 horas
			header('location: index.php');
		}
		
		echo $_COOKIE['idLogin'];
		
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="inp_login" /><br />
    <input type="password" name="inp_senha" /><br />
    <input type="submit" name="submit" value="Cadastrar" /><br />
</form>

