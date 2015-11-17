<?php 


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$campos_para_cad .= false;

$Conteudo_Pagina_Edit .= '

<?php if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {


require_once( "Sistema/Classes/alertas.inc.php"); 
require_once( "Sistema/Classes/PermaLink.inc.php"); 



?>



<?php 

		$Ferramenta_principal = \''.$sub_ferramenta.'\';
	

		$Titulo_banco = \''.$Titulo_banco.'\';

		$id_Principal = $_GET[\'Id_Princ\'];

        $Nome_primitivo = \''.$Titulo_banco.'\';
		$Nome_Pagina = \''.$Titulo_banco.'_editar\';
		$Nome_Banco = \'tbl_'.$Titulo_banco.'\';
		$Nome_Pagina_Principal = \''.$Titulo_banco.'\';
		$Titulo_Pagina = \'Editar '.$Titulo_banco.'\';
		
		$Principal = \''.$Campo_principal.'\';
	
		$Referencial = \''.$Campo_Referencial.'\';
		
       
	   if($_GET[\'edit\'] == true) {
		   
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

$Conteudo_Pagina_Edit .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2);
'; 

}elseif(strtolower($Matriz['Tipo'][$x]) == 'datetime'){
	
$Conteudo_Pagina_Edit .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2).\' \'. substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],10,9);
';

}elseif(strtolower($Matriz['Tipo'][$x]) == 'timestamp'){
	
$Conteudo_Pagina_Edit .= '        $'.strtolower($Matriz['Campo'][$x]).' = substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],6,4).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],3,2).\'-\'.substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],0,2).\' \'. substr($_POST[\''.strtolower($Matriz['Campo'][$x]).'\'],10,9);
';

}else{
	
$Conteudo_Pagina_Edit .= '        $'.strtolower($Matriz['Campo'][$x]).' = $_POST[\''.strtolower($Matriz['Campo'][$x]).'\'];


		if (!is_array($'.$Campo_principal.')) {
				$ParmaLK = permalinkCad($'.$Campo_principal.',$Nome_Banco);
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
				$ParmaLK = permalinkCad($'.strtolower($Matriz['Campo'][$x]).',$Nome_Banco);	 
			 }
		}
		
		}
 	
';

}

}

}
	
}

$Conteudo_Pagina_Edit .= '
       $cad = mysql_query("UPDATE ".$Nome_Banco." SET permalink = \'".$ParmaLK."\',
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
				
					$Conteudo_Pagina_Edit .= ' '.strtolower($Matriz['Campo'][$x]).' = \'$'.strtolower($Matriz['Campo'][$x]).'\''.$virgula.'
					';
				
				}
			}
		
	   }
	   
	   
	   
	   
$Conteudo_Pagina_Edit .= ' WHERE '.$Campo_Referencial.' = \'".$_GET[\'id\']."\'")or(die(\'Erro SQL\'.mysql_error()));';

 
$Conteudo_Pagina_Edit .= '

		GravaAcoes($_SESSION[\'idLogin\'],$_SESSION[\'UserLogin\'],$Nome_Banco,"Editar",$'.$Campo_principal.',$Permalink,$id_Principal);
}

if($cad) {

	echo \'<script type="text/javascript"> location.href="?pg=paginas/\'.$Nome_Pagina_Principal.\'/\'.$Nome_Pagina.\'&alert_edit=1&id=\'.$_GET[\'id\'].\'&Id_Princ=\'.$id_Principal.\'"; </script>\';
					
}

?>

';

	
$Conteudo_Pagina_Edit .= '


Ferramentas > <a href="?pg=paginas/<?php echo $Ferramenta_principal?>/<?php echo $Ferramenta_principal?>"><?php echo $Ferramenta_principal?></a> > <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>&Id_Princ=<?php echo $_GET[\'Id_Princ\']?>"><?php echo $Titulo_banco?></a>  > editar
		
<div class="Box box_Paginas">


<ul class="Menu-acoes">
                <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>&Id_Princ=<?php echo $_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?php echo $Titulo_banco?></li></a>
          		<a href="?pg=paginas/<?php echo $Ferramenta_principal?>/<?php echo $Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?php echo $Ferramenta_principal?></li></a>
				
				
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Editar
</div>
<div class="Body_box">

	
            	
                     <form action="index.php?pg=paginas/<?php echo $Nome_Pagina_Principal?>/<?php echo $Nome_Pagina?>&edit=ok&id=<?php echo $_GET[\'id\']?>&Id_Princ=<?php echo $id_Principal?>" class="mws-form" method="post" enctype="multipart/form-data">
					 
					 <?php $Sql_Rec = mysql_query("SELECT * FROM ".$Nome_Banco." WHERE '.$Campo_Referencial.' = \'".$_GET[\'id\']."\'")or(die(mysql_error())); $retorna = mysql_fetch_array($Sql_Rec); 
					 
					 function Testar($ValorInput,$nameBD,$idGet,$nameCp) {
	
						 $Sql = mysql_query("SELECT * FROM ".$nameBD." WHERE '.$Campo_Referencial.' = \'".$idGet."\'")or(die("Erro: ".mysql_error()));
						 $SqlCont = mysql_num_rows($Sql);
						 $Mostra = mysql_fetch_array($Sql);
								
						 $Retorna = explode("|", $Mostra[$nameCp]);
						 $ContArray = count($Retorna);
				
				
							
							  for($x=0;$x<=$ContArray;$x++){
										if($Retorna[$x] == $ValorInput) { echo "checked=checked" ; break; }
							  }
							  
						}
					 
					 
					 
					 
					 ?>
                          
'; ?>

                       
                        <?php 
						
						 $Conteudo_Pagina_Edit .= false;
						 $Mascaras_Criadas_editar .= false;
						 
						 for($x=1;$x <= $QTD;$x++) {
							 
							 if(strtolower($Matriz['Tipo'][$x]) == 'date') {
								 
							 $Mascaras_Criadas_editar .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999\');
							 ';	 
								 
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'datetime') {
								 
							 $Mascaras_Criadas_editar .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999 99:99:99\');
							 ';	 
								 
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'time') {
							
							 $Mascaras_Criadas_editar .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99:99:99\');
							 ';	 	 
								
							 }elseif(strtolower($Matriz['Tipo'][$x]) == 'timestamp') {
								
							 $Mascaras_Criadas_editar .= '$(\'#'.strtolower($Matriz['Campo'][$x]).'\').mask(\'99/99/9999 99:99:99\');
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
								 
								  if(strtolower($Matriz['Tipo'][$x]) == 'text') { $Tipo_Input = '<textarea rows="10" style="width: 100%;" name="'.strtolower($Matriz['Campo'][$x]).'" id="'.strtolower($Matriz['Campo'][$x]).'" ><?php echo $retorna[\''.strtolower($Matriz['Campo'][$x]).'\']?></textarea>'; } 
												 
														else { 
														
														if(strtolower($Matriz['Tipo'][$x]) == 'date') {  
														
														$Masc_Value = '<?php echo substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],8,2).\'/\'.substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],5,2).\'/\'.substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],0,4);?>';}
														
														elseif(strtolower($Matriz['Tipo'][$x]) == 'datetime'){ 
														
														$Masc_Value = '<?php echo substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],8,2).\'/\'.substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],5,2).\'/\'.substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],0,4).\' \'.substr($retorna[\''.strtolower($Matriz['Campo'][$x]).'\'],10,9);?>';}
														
														else{
														
														$Masc_Value = '<?php echo $retorna[\''.strtolower($Matriz['Campo'][$x]).'\']?>';}
														
														
														
														$Tipo_Input = '<input type="text" value="'.$Masc_Value.'" name="'.strtolower($Matriz['Campo'][$x]).'" id="'.strtolower($Matriz['Campo'][$x]).'" class="mws-textinput '.$Tamanha_campo.'"/>'; }
								 
								 
								 
								 
							 

											$Conteudo_Pagina_Edit .= '<label>'.ucfirst($Matriz['Campo'][$x]).'</label><br>
											';
											

												  $Conteudo_Pagina_Edit .= $Tipo_Input.'<br>
												  ';
										
										
							  } 
						   }
					  
					  } 
					 
$Conteudo_Pagina_Edit .= '
                    		
                            	
<input type="submit" value="Salvar" class="Bt-blue" />                    			
<input type="reset" value="Limpar" class="Bt-red" />
                                                    			
</form>


<script type="text/javascript">
	
$(document).ready(function(){

	'.$Mascaras_Criadas_editar.'
							 
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

$Criar_CAD = fopen ("Restrito/paginas/".$Titulo_banco."/".$Titulo_banco."_editar.php", "w");
	
fwrite($Criar_CAD,$Conteudo_Pagina_Edit);

$Conteudo_Pagina_Edit = false;


}else{
	
	header('location: ../../login.php');
	
}


?>


















