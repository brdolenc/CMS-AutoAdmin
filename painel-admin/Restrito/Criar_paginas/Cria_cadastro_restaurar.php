<?php 


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$campos_para_cad .= false;

$Conteudo_Pagina_Cad .= '


<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
?>


<?php 

require_once( "Sistema/Classes/alertas.inc.php"); 
require_once( "Sistema/Classes/PermaLink.inc.php"); 

?>



<?php 

        $Nome_primitivo = \''.$Titulo_banco.'\';
		$Nome_Pagina = \''.$Titulo_banco.'_cadastrar\';
		$Nome_Banco = \'tbl_'.$Titulo_banco.'\';
		$Nome_Pagina_Principal = \''.$Titulo_banco.'\';
		$Titulo_Pagina = \'Cadastrar '.$Titulo_banco.'\';
		
		$Principal = \''.$Campo_principal.'\';
	
		$Referencial = \''.$Campo_Referencial.'\';
		
       
	   if($_GET[\'cad\'] == true) {
		   
';

for($x=1;$x <= $QTD;$x++) {


	$FirstChar = substr($Matriz['Campo'][$x],0,1);
					  $CharEmpty = array('0','1','2','3','4','5','6','7','8','9','-','_',' ');
					  if(in_array($FirstChar, $CharEmpty)){
						  $CharIncorrect = 1;
					  }else{
						  $CharIncorrect = 0;
					  }
				  
	if($Matriz['Campo'][$x] != '' and $Matriz['Campo'][$x] != false and $CharIncorrect  == 0) {


		if($Campo_Referencial != $Matriz['Campo'][$x]) { 
			
				if(strtolower($Matriz['Tipo'][$x]) == 'date') { 

				$Conteudo_Pagina_Cad .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2);
				'; 

				}elseif(strtolower($Matriz['Tipo'][$x]) == 'datetime'){
					
				$Conteudo_Pagina_Cad .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2).\' \'. substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],10,9);
				';

				}elseif(strtolower($Matriz['Tipo'][$x]) == 'timestamp'){
					
				$Conteudo_Pagina_Cad .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2).\' \'. substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],10,9);
				';

				}else{
					
				$Conteudo_Pagina_Cad .= '        $'.strtolower($Matriz['Campo'][$x]).' = $_POST[\''.strtolower($Matriz['Campo'][$x]).'\'];


							if (!is_array($'.$Campo_principal.')) {
								$Permalink = permalinkCad($'.$Campo_principal.',$Nome_Banco);
							}

						if (is_array($'.strtolower($Matriz['Campo'][$x]).')) { 	

						$ValoresArrayCont = array();
						$ContArrayEdit    = 1;
						
						foreach($'.strtolower($Matriz['Campo'][$x]).' as $ValueArray) {
							if($ContArrayEdit == 1) { $DivisorArrayCont = ""; }  else { $DivisorArrayCont = "|"; }
							$ValoresArrayCont[$ContArrayEdit++] = $DivisorArrayCont.$ValueArray;
						}
						
						$'.strtolower($Matriz['Campo'][$x]).'  = false;
						for($x=1;$x<=$ContArrayEdit;$x++){
							 
							$'.strtolower($Matriz['Campo'][$x]).' .= $ValoresArrayCont[$x];
							
							if("'.strtolower($Matriz['Campo'][$x]).'" == "'.$Campo_principal.'") {
								$Permalink = permalinkCad($'.strtolower($Matriz['Campo'][$x]).',$Nome_Banco);	 
							 }
						}
						
						}

						

				';

				}

		}

	}
	
}

$Conteudo_Pagina_Cad .= '

	  
	   
		
       $cad = mysql_query("INSERT INTO ".$Nome_Banco." SET permalink = \'".$Permalink."\',
	   ';
	   
	   
	   for($x=1;$x <= $QTD;$x++) {
		   
		   $FirstCharVerf = substr($Matriz['Campo'][$x],0,1);
					  $CharEmptyVerf = array('0','1','2','3','4','5','6','7','8','9','-','_',' ');
					  if(in_array($FirstCharVerf, $CharEmptyVerf)){
						  $CharIncorrectVerf = $CharIncorrectVerf+1;
					  }else{
						  $CharIncorrectVerf = 0;
						  if(strlen(str_replace(' ','',$Matriz['Campo'][$x])) <= 0) {
								$CharIncorrectVerf = $CharIncorrectVerf+1;
						  }
					  }
			
			
	   }
	   
	   for($x=1;$x <= $QTD;$x++) {
		   
		   $FirstChar = substr($Matriz['Campo'][$x],0,1);
					  $CharEmpty = array('0','1','2','3','4','5','6','7','8','9','-','_',' ');
					  if(in_array($FirstChar, $CharEmpty)){
						  $CharIncorrect = 1;
					  }else{
						  $CharIncorrect = 0;
					  }
				  
			if($Matriz['Campo'][$x] != '' and $Matriz['Campo'][$x] != false and $CharIncorrect  == 0) {
		   
				if(($QTD-$CharIncorrectVerf) == $x) { $virgula = ''; } else { $virgula = ','; }
		
				if($Campo_Referencial != $Matriz['Campo'][$x]) { 
				
					$Conteudo_Pagina_Cad .= ' '.strtolower($Matriz['Campo'][$x]).' = \'$'.strtolower($Matriz['Campo'][$x]).'\''.$virgula.'
					';
				
				}
			}
		
	   }
	   
	   
	   
	   
$Conteudo_Pagina_Cad .= '")or(die(\'Erro SQL\'.mysql_error()));';

 
$Conteudo_Pagina_Cad .= '

	GravaAcoes($_SESSION[\'idLogin\'],$_SESSION[\'UserLogin\'],$Nome_Banco,"Cadastrar",$'.$Campo_principal.',$Permalink,false);


}

if($cad) {
					
	echo \'<script type="text/javascript"> location.href="?pg=paginas/\'.$Nome_Pagina_Principal.\'/\'.$Nome_Pagina_Principal.\'&alert_inc=1"; </script>\';
					
}

?>

';

	
$Conteudo_Pagina_Cad .= '

Ferramentas > <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>"><?php echo $Nome_primitivo?></a> > cadastro
		

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="?pg=paginas/<?php echo $Nome_Pagina_Principal?>/<?php echo $Nome_Pagina_Principal?>"><li>Pagina Principal</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Cadastrar
</div>
<div class="Body_box">
                    	
<form action="index.php?pg=paginas/<?php echo $Nome_Pagina_Principal?>/<?php echo $Nome_Pagina?>&cad=ok" class="mws-form" method="post" enctype="multipart/form-data">

'; ?>

                       
                        <?php 
						
						 $Conteudo_Pagina_Cad .= false;
						 
						 $Mascaras_Criadas .= false;
						 
						 for($x=1;$x <= $QTD;$x++) {
							 
							 if(strtolower($Matriz['Tipo'][$x]) == 'date') {
								 
							 $Mascaras_Criadas .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999\');
							 ';	 
								 
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'datetime') {
								 
							 $Mascaras_Criadas .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999 99:99:99\');
							 ';	 
								 
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'time') {
							
							 $Mascaras_Criadas .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99:99:99\');
							 ';	 	 
								
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'timestamp') {
								
							 $Mascaras_Criadas .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999 99:99:99\');
							 ';	  
								
							 }
							 
							 
						 }
						 
						 for($x=1;$x <= $QTD;$x++) {
							 
							 
							 $FirstChar = substr($Matriz['Campo'][$x],0,1);
											  $CharEmpty = array('0','1','2','3','4','5','6','7','8','9','-','_',' ');
											  if(in_array($FirstChar, $CharEmpty)){
												  $CharIncorrect = 1;
											  }else{
												  $CharIncorrect = 0;
											  }
										  
							if($Matriz['Campo'][$x] != '' and $Matriz['Campo'][$x] != false and $CharIncorrect  == 0) {
									
							 
								 if(strtolower($Campo_Referencial) != strtolower($Matriz['Campo'][$x])) { 
								 
								 
								 if($Matriz['Tamanho'][$x] <= 100) { $Tamanha_campo = 'small'; } 
									elseif($Matriz['Tamanho'][$x] > 100 and $Matriz['Tamanho'][$x] <= 200) { $Tamanha_campo = 'medium'; } 
										elseif($Matriz['Tamanho'][$x] > 200) { $Tamanha_campo = 'large'; } 
								 else { $Tamanha_campo = 'small'; };
								 
								  if(strtolower($Matriz['Tipo'][$x]) == 'text') { $Tipo_Input = '<textarea rows="10" style="width: 100%;"  name="'.strtolower($Matriz['Campo'][$x]).'" id="'.strtolower($Matriz['Campo'][$x]).'" ></textarea>'; } 
												 
														else { $Tipo_Input = '<input type="text" name="'.strtolower($Matriz['Campo'][$x]).'" id="'.strtolower($Matriz['Campo'][$x]).'" class="mws-textinput '.$Tamanha_campo.'" />'; }
								 
								 
								 
								 
							 
									

											$Conteudo_Pagina_Cad .= '<label>'.ucfirst($Matriz['Campo'][$x]).'</label><br>
											';
											
												  $Conteudo_Pagina_Cad .= $Tipo_Input.'<br>
												  ';
											
										
										
							  } 
							  
							}
					  
					  } 
					 
$Conteudo_Pagina_Cad .= '
                    		
<input type="submit" value="Cadastrar" class="Bt-blue" />                    			
<input type="reset" value="Limpar" class="Bt-red" />
                                                    			
</form>


</div>
</div>
<br style="clear:both;">
<br />


<script type="text/javascript">
	
$(document).ready(function(){

	'.$Mascaras_Criadas.'
							 
  var InicioMasc = false;
  
  	  $(\'#fim\').mask(\'99/99/9999 99:99:99\');
  	  $(\'#inicio\').mask(\'99/99/9999 99:99:99\');
 	  $(\'#data_msg\').mask(\'99/99/9999 99:99:99\');
      $(\'#nacimento\').mask(\'99/99/9999\');
	  $(\'#rg\').mask(\'99.999.999-99\');
	  $(\'#cnpj\').mask(\'99.999.999/9999-99\');
      $(\'#cpf\').mask(\'999.999.999-99\');
	  $(\'#cep\').mask(\'99999-999\');
      $(\'#telefone\').mask(\'(99) 9999-9999\');
	  $(\'#fax\').mask(\'(99) 9999-9999\');
	  $(\'#celular\').mask(\'(99) 9999-9999\');
	  $(\'#ddd\').mask(\'(999)\');

   });
   

$("#preco").maskMoney({symbol:\'R$ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#promocao").maskMoney({symbol:\'R$ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#real").maskMoney({symbol:\'R$ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#dolar").maskMoney({symbol:\'$ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#euro").maskMoney({symbol:\'€ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#libra").maskMoney({symbol:\'£ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
$("#iene").maskMoney({symbol:\'¥ \', showSymbol:true, thousands:\'.\', decimal:\',\', symbolStay: true});
   
</script>

<?php

}else{
	
	header(\'location: ../../login.php\');
	
}

?>

';

$Criar_CAD = fopen ("Restrito/paginas/".$Titulo_banco."/".$Titulo_banco."_cadastrar_restaurar.php", "w");
	
fwrite($Criar_CAD,$Conteudo_Pagina_Cad);


$Conteudo_Pagina_Cad = false;


}else{
	
	header('location: ../../login.php');
	
}

?>


















