<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {

	$Pagina      = $_GET['pagina'];
	$Ferramenta  = $_GET['ferramenta'];
	$NomeCampo   = $_GET['nome'];
	$Campo       = $_GET['campo'];
	$CampoP_Cad  = $_GET['CampoP_Cad'];
	$NomeDocampo = $_GET['NomeDocampo'];

	
	function MudarCampoCad($Pg,$Cp,$Ncp,$Cpnew,$Ferr){
		
		$arquivo = fopen('Restrito/paginas/'.$Ferr.'/'.$Pg.'_cadastrar.php','r+');
			if ($arquivo) {
				while(true) {
					$linha = fgets($arquivo);
					
					if ($linha==null) break;
					
					
					if(preg_match('/name="'.$Ncp.'"/', $linha)) {

						
						$string .= str_replace($Cp, $Cpnew, $linha);
						
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
	
	
	function MudarCampoEdt($Pg,$Cp,$Ncp,$Cpnew,$Ferr){
		
		$arquivo = fopen('Restrito/paginas/'.$Ferr.'/'.$Pg.'_editar.php','r+');
			if ($arquivo) {
				while(true) {
					$linha = fgets($arquivo);
					
					if ($linha==null) break;
					
					
					if(preg_match('/name="'.$Ncp.'"/', $linha)) {

						
						$string .= str_replace($Cp, $Cpnew, $linha);
						
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
		
		$Pagina         = $_POST['Pagina'];
		$Ferramenta     = $_POST['Ferramenta'];
		$NomeCampo      = $_POST['NomeCampo'];
		$Script         = $_POST['Script'];
		$ScriptEditar   = $_POST['ScriptCad'];
		$CampoP_Cad     =  str_replace('!@','"',$_POST['CampoP_Cad']);
		
		$Campo = str_replace('!@','"',$_POST['Campo']);
		$Campo = str_replace('(@@)','<?php echo ',$Campo);
   		$Campo = str_replace('(@)','?>',$Campo);
  		$Campo = str_replace("@!","'",$Campo);
   		$Campo = str_replace('!@','"',$Campo);
		
		$ScriptEditar = str_replace('<@@?','<?',$ScriptEditar);
		
		$PaginaAlt =  $Ferramenta;
	
		//echo '<textarea>'.$CampoP_Cad.'</textarea>';
		
		$EditarCad = MudarCampoCad($PaginaAlt,$CampoP_Cad,$NomeCampo,$Script,$Ferramenta);
		$EditarEdt = MudarCampoEdt($PaginaAlt,$Campo,$NomeCampo,$ScriptEditar,$Ferramenta);
		
		
			if($EditarCad = true and $EditarEdt == true) {
				
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
		   
		   
		   else {campo.submit.disabled=true; campo.submit.value="Clique em gera codigo"; }
   
}


</script>

<script>


var ValoresQuant = 0;
var xFor = 0;
var ValoresInput = new Array();
var OptionsSel = '';
var OptionsCheck = '';
var OptionsRadio = '';

var OptionsSelCad = '';
var OptionsCheckCad = '';
var OptionsRadioCad = '';

function AddCampo() {
		var d = document.createElement("div");
        var file = document.createElement("input");
        file.setAttribute("type", "text");
        file.setAttribute("name", "Valores");
        file.setAttribute("id", "Valores");
		file.setAttribute("class", "mws-textinput small");
		d.appendChild(file);
        document.getElementById("AddCampo").appendChild(d);
        ValoresQuant++;	
}

function CriaCampo() {
	for(xFor;xFor<=ValoresQuant;xFor++){
		ValoresInput[xFor] = $("input").eq(xFor+5).val();
	}
	if(ValoresInput[0] == false) {
		if(((ValoresInput.length)-1) != false){
			GerarCodigo();
			verifica();
		}
	}else{
		GerarCodigo();
		verifica();
	}
	
	
	
}

function GerarCodigo() {
	var NomeInput = document.getElementById("NomeCampo").value;
	var TrocDe = $('input[name=TrocarDe]:checked').val();
	var TrocPara = $('input[name=TrocarPara]:checked').val();
	
	
	ValoresInput.splice(0,0);
	
	
		for(xFor=0;xFor<=ValoresQuant;xFor++){
		
			OptionsSelCad += '<option value="'+ValoresInput[xFor]+'"'+"<@@? if('"+ValoresInput[xFor]+"' == $retorna['<?php echo $NomeCampo?>']) {echo 'selected=selected';} ?>"+' >'+ValoresInput[xFor]+'</option>';
			
			OptionsSel += '<option value="'+ValoresInput[xFor]+'" >'+ValoresInput[xFor]+'</option>';
			
		}
		for(xFor=0;xFor<=ValoresQuant;xFor++){
		
OptionsCheckCad += '<input name="'+NomeInput+'[]" id="'+NomeInput+'" type="checkbox" value="'+ValoresInput[xFor]+'"'+"<@@? Testar('"+ValoresInput[xFor]+"',$Nome_Banco,$_GET['id'],'<?php echo $NomeDocampo?>'); ?> />"+ValoresInput[xFor]+'';
			
			OptionsCheck += '<input name="'+NomeInput+'[]" id="'+NomeInput+'" type="checkbox" value="'+ValoresInput[xFor]+'" />'+ValoresInput[xFor]+'';
			
		}
		for(xFor=0;xFor<=ValoresQuant;xFor++){
		
			OptionsRadioCad += '<input name="'+NomeInput+'" id="'+NomeInput+'" type="radio" value="'+ValoresInput[xFor]+'"'+"<@@? if('"+ValoresInput[xFor]+"' == $retorna['<?php echo $NomeCampo?>']) {echo 'checked=checked';} ?> />"+ValoresInput[xFor]+'';
			
			OptionsRadio += '<input name="'+NomeInput+'" id="'+NomeInput+'" type="radio" value="'+ValoresInput[xFor]+'" />'+ValoresInput[xFor]+'';
			
		}
	
		
		switch(TrocPara){
			case '1': var InputCria = '<select name="'+NomeInput+'" id="'+NomeInput+'"><option value="">Selecione</option>'+OptionsSel+'</select>'; 
						  InputCriaCad = '<select name="'+NomeInput+'" id="'+NomeInput+'"><option value="">Selecione</option>'+OptionsSelCad+'</select>'; break;	
			
			
			case '2': var InputCria = OptionsRadio;
						  InputCriaCad = OptionsRadioCad; break;
			
			
			case '3': var InputCria = OptionsCheck; 
						  InputCriaCad = OptionsCheckCad; break;	
			
			
			default: break;
		}
		
	document.getElementById("CogidoPronto").innerHTML = InputCria;

	$('#CodigoPr').val(InputCria);
	$('#CogidoProntoMostra').text(InputCria);
	$('#CodigoPrCad').val(InputCriaCad.replace("@@?","?"));
	



OptionsSel = '';
OptionsCheck = '';
OptionsRadio = '';
OptionsSelCad = '';
OptionsCheckCad = '';
OptionsRadioCad = '';

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


<form name="CriaCodigo" enctype="multipart/form-data" method="post" action="index.php?pg=Contrutor/EditarCampos">
	
<label>Novo campo:</label><br />

<input name="TrocarPara" type="radio" value="1"  checked="checked"/>Select
<input name="TrocarPara" type="radio" value="2" />Radio
<input name="TrocarPara" type="radio" value="3" />CheckBox

<br />
<br />
    
<label>Valores:</label><br /><br />
<input type="button"  onclick="AddCampo()"  value="Add+" class="Bt-blue"/><input type="button" onclick="CriaCampo()"  value="Gerar Codigo" class="Bt-green"/>

<br />

<input name="Valores" id="Valores" type="text" value="" class="mws-textinput small" />
<div id="AddCampo"></div>

<br />

<br />
    

<label>Exemplo:</label><br /><br />
    
<div id="CogidoPronto">Clique em Gera Codigo</div><br /><br />
    

<label>Script:</label><br /><br />
<div id="CogidoProntoMostra" style="border:1px solid #CCC; height:200px; width:400px;">Clique em Gera Codigo</div><br /><br /> 
 
<input type="text" id="CodigoPr" name="Script" class="mws-textinput medium" hidden="hidden"><br />
<input type="text" id="CodigoPrCad" name="ScriptCad" class="mws-textinput medium" hidden="hidden"><br />

    
<input type="submit" name="submit" value="Clique em Gera Codigo" class="Bt-blue" disabled/>
    





   <input type="text" name="NomeCampo" id="NomeCampo" value="<?php echo $NomeCampo?>"  hidden="hidden"/>
   <input type="text" name="Ferramenta" id="Ferramenta" value="<?php echo $Ferramenta?>"  hidden="hidden"/>
   <input type="text" name="Pagina" id="Pagina" value="<?php echo $Pagina?>"  hidden="hidden"/>
   <input type="text" name="NomeDocampo" id="NomeDocampo" value="<?php echo $NomeDocampo?>"  hidden="hidden"/>
   
   
   <?php
   
   $CampoP_Cad = str_replace('"','!@',$CampoP_Cad);
   
   
   ?>
   
   <input type="text" name="CampoP_Cad" id="CampoP_Cad" value="<?php echo $CampoP_Cad?>"  hidden="hidden"/>
   

   <?php
   
   $Campo = str_replace('<?php echo ','(@@)',$Campo);
   $Campo = str_replace('?>','(@)',$Campo);
   $Campo = str_replace("'","!@",$Campo);
   $Campo = str_replace('"','!@',$Campo);
   
   
   ?>
   
  <input type="text" name="Campo" id="Campo" value="<?php echo $Campo?>"  hidden="hidden"/>


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