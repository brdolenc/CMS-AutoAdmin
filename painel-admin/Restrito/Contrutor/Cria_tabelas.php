

<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {



    //CHAMA AS CLASSES
	include ("Restrito/Contrutor/Classe_Criar.php");

	if((isset($_POST['validar'])) and ((!empty($_POST['validar'])))) {
	
	//QUANTIDADE DE CAMPOS CADASTRADOS
	$QTD = $_POST['quantidade'];	
	
	//RECUPERA TODOS OS CAMPOS
	$Referencia     = $_POST['Referencia'];
	$Campo          = $_POST['campo'];
	$Tipo           = $_POST['tipo'];
	$Tamanho        = $_POST['tamanho'];
	$Nome_tabela    = $_POST['Nome_tabela'];
	$galeria        = $_POST['galeria'];
	$upload         = $_POST['upload'];
	$Sitema_comente    = $_POST['sistema_comente'];
	$categorias        = $_POST['categorias'];
	$post_destaque        = $_POST['post_destaque'];

	$INT->CadAutoComplete($Campo,1,'auto_comp_campo_tab');

	$CLS = new Trata_variaveis();
    	$CLS->Resgata('Referencia',$Referencia,'Campo',$Campo,'Tipo',$Tipo,'Tamanho',$Tamanho,$QTD,$Nome_tabela,$galeria,$upload,$post_destaque,$Sitema_comente,$categorias);	
	}


                
?>

<br /><br />
<script type="text/javascript">
	setTimeout(function(){ $(location).attr('href', 'index.php?pg=Contrutor/EditarFerramentas') }, 4000); 
</script>
<div style="margin:0; text-align:center;">
Criando... Aguarde<br />
você será redirecionado<br />
<img src="Arquivos/imagens/loader.gif" title="Editar"/>
</div>




<?php


}else{
	
	echo "<div class='aviso erro'><p>Permissão negada</div>";
	
}

}else{
	
	header('location: ../../login.php');
	
}

?>



