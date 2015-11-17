<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {

	$Ferramenta  = $_GET['ferramenta'];
	$NomeCampo   = $_GET['nome'];

	
	function AddMascCad($idMasc,$UrlPage,$Script){
		
		$PastaArqs = 'Restrito/paginas/'.$UrlPage.'/';
		$PgEditar = $UrlPage.'_editar.php';
		$PgCadastrar = $UrlPage.'_cadastrar.php';
		
		$arquivo = fopen($PastaArqs.$PgCadastrar,'r+');
			if ($arquivo) {
				while(true) {
					$linha = fgets($arquivo);
					
					if ($linha==null) break;
					
					
					if(preg_match('/InicioMasc/', $linha)) {

						
						$string .= str_replace('var InicioMasc = false;', 'var InicioMasc = false;
						
						'.$Script.'', $linha);
						
					} else {
						
						$string.= $linha;
					}
				}
				rewind($arquivo);
				
				ftruncate($arquivo, 0);
				
				if (!fwrite($arquivo, $string)) { return false; } else { return true; }
				fclose($arquivo);
			}
			
	}
	
	
	function AddMascEdit($idMasc,$UrlPage,$Script){
		
		$PastaArqs = 'Restrito/paginas/'.$UrlPage.'/';
		$PgEditar = $UrlPage.'_editar.php';
		$PgCadastrar = $UrlPage.'_cadastrar.php';
			
			$arquivo = fopen($PastaArqs.$PgEditar,'r+');
			if ($arquivo) {
				while(true) {
					$linha = fgets($arquivo);
					
					if ($linha==null) break;
					
					
					if(preg_match('/InicioMasc/', $linha)) {

						
						$string .= str_replace('var InicioMasc = false;', 'var InicioMasc = false;
						
						'.$Script.'', $linha);
						
					} else {
						
						$string.= $linha;
					}
				}
				rewind($arquivo);
				
				ftruncate($arquivo, 0);
				
				if (!fwrite($arquivo, $string)) { return false; } else { return true; }
				fclose($arquivo);
			}


	}
	
	
	if(isset($_POST['submit'])) {?>
		
		
		<script>
		var campo = document.CriaCodigo;
		campo.submit.disabled=true;
		</script>
		
		
		<?
		
		$Ferramenta     = $_POST['Ferramenta'];
		$NomeCampo      = $_POST['NomeCampo'];
		$Script         = $_POST['Script'];
			
		$EditarCad  = AddMascCad($NomeCampo,$Ferramenta,$Script);
		$EditarEdit = AddMascEdit($NomeCampo,$Ferramenta,$Script);

		
		
			if($EditarCad == true and $EditarEdit == true) {
				
				echo '<script type="text/javascript"> location.href="?pg=paginas/'.$_POST['Ferramenta'].'/'.$_POST['Ferramenta'].'&alert_edit=1"; </script>';
				
			}else{
				
				echo '<script type="text/javascript"> location.href="?pg=paginas/'.$_POST['Ferramenta'].'/'.$_POST['Ferramenta'].'&alert_edit=2"; </script>';
				
			}
		

		
		
	}else{
		
		?>
		
		
		<script>
		var campo = document.CriaCodigo;
		campo.submit.disabled=false;
		</script>
		
		
		<?
	}
	
	
?>




<script type="text/javascript">

function verifica() {
	var campo = document.CriaCodigo;
		if(
			campo.Script.value!="" 
		
		)  { campo.submit.disabled=false;campo.submit.value="Editar campo"; } 
		   
		   
		   else {campo.submit.disabled=true; campo.submit.value="Clique em gerar codigo"; }
   
}


</script>

<script>


function GerarCodigo() {
	var MascaraCode = document.getElementById("Valores").value;
	
	
	
	if(MascaraCode != '') {

	ScriptMasc = "$('#<?php echo $NomeCampo?>').mask('"+MascaraCode+"');";
	
		$('#CodigoPr').val(ScriptMasc);

	verifica();
	
	}else {
		$('#CodigoPr').val('Campo Mascara vazio');

	}



}


</script>


<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Editar Mascaras
</div>
<div class="Body_box">


<form name="CriaCodigo" enctype="multipart/form-data" method="post" action="index.php?pg=Contrutor/EditarMascaras">
	

<label>Mascara:</label><br />
<input name="Valores" id="Valores" type="text" value="" class="Campos" onkeyup="validar_titulo_mask(this,'caracter');"/>
<input type="button" onclick="GerarCodigo()"  value="Gerar Codigo" class="Bt-green"/><br />

Ex: 99/99-999.999 p/ Numeros <br />Ex: aa-999 p/ Numeros e Letras  <br />Ex:  AAAAA-AAA p/ Letras<br /><br />
    

<label>Script:</label><br />    
<input type="text"  name="Script" id="CodigoPr" class="mws-textinput medium" /><br />  
 
    

<input type="submit" name="submit" value="Clique em Gerar Codigo" class="Bt-blue" /><br /><br /> 

<input type="text" name="NomeCampo" id="NomeCampo" value="<?php echo $NomeCampo?>"  hidden="hidden"/>
<input type="text" name="Ferramenta" id="Ferramenta" value="<?php echo $Ferramenta?>"  hidden="hidden"/>


</form>

</div>
</div>
<br style="clear:both;">
<br />


<?php 

}else{
	
	echo "<div class='aviso erro'><p>Permissão negada</div>";
	
}

}else{
	
	header('location: ../../login.php');
	
}

?>