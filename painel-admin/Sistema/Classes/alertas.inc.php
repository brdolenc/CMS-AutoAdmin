<?

if($_GET['alert_ex'] == 1) { 

	echo '
	
	<div class="aviso certo"><p><strong>Sucesso!</strong> Excluido com sucesso.</p></div>
	
	
	';

}elseif($_GET['alert_ex'] == 2) {

	echo '
	
	<div class="aviso erro"><p><strong>Erro!</strong> n�o foi poss�vel excluir.</p></div>
	
	';

}



if($_GET['alert_inc'] == 1) { 

	echo '
	
	<div class="aviso certo"><p><strong>Sucesso!</strong> Cadastrado com sucesso.</p></div>
	
	
	';

}elseif($_GET['alert_inc'] == 2) {

	echo '
	
	<div class="aviso erro"><p><strong>Erro!</strong> n�o foi poss�vel cadastrar.</p></div>
	
	';

}


if($_GET['alert_edit'] == 1) { 

	echo '
	
	<div class="aviso certo"><p><strong>Sucesso!</strong> Editado com sucesso.</p></div>
	
	
	';

}elseif($_GET['alert_edit'] == 2) {

	echo '
	
	<div class="aviso erro"><p><strong>Erro!</strong> n�o foi poss�vel editar.</p></div>
	
	';

}








?>