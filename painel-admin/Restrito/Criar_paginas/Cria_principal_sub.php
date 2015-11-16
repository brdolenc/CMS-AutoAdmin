
<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$Principal_Criar .= '


<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
	?>

<? 

require_once( "Sistema/Classes/alertas.inc.php"); 
require_once( "Sistema/Classes/PermaLink.inc.php"); 


?>


<script>
function envio() {
var r=confirm("Tem certeza que deseja enviar as informações?");
if (r==true) {
window.location="";
teste.submit();
}
}
</script>


<script language="javascript">
var win = null;
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = \'height=\'+h+\',width=\'+w+\',top=\'+TopPosition+\',left=\'+LeftPosition+\',scrollbars=\'+scroll+\',resizable\'
	win = window.open(pagina,nome,settings);
}
</script>


<?

	$id_Principal = $_GET[\'Id_Princ\'];
	
	$Ferramenta_principal = \''.$sub_ferramenta.'\';
	

	$Titulo_banco = \''.$Titulo_banco.'\';
	
 
    $Banco = \'tbl_'.$Titulo_banco.'\';
	
	
    $Pagina = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'&Id_Princ=\'.$id_Principal;
	
	
	$Pagina_editar = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'_editar&Id_Princ=\'.$id_Principal;
	
	
	$Pagina_cadastrar = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'_cadastrar&Id_Princ=\'.$id_Principal;
	
	
	$Banco_cat = \'tbl_cat_'.$Titulo_banco.'\';
	
	
	$Banco_coment = \'tbl_comentarios_'.$Titulo_banco.'\';
	
	
	$Banco_galeria = \'tbl_galeria_'.$Titulo_banco.'\';
	
	
	$Banco_upload = \'tbl_upload_'.$Titulo_banco.'\';
				
				
	$Pagina_coment = \'paginas/'.$Titulo_banco.'/Comentarios_'.$Titulo_banco.'&Id_Princ=\'.$id_Principal;
	
	
	$Pagina_gal = \'paginas/'.$Titulo_banco.'/Gal_'.$Titulo_banco.'&Id_Princ=\'.$id_Principal;
	
	
	$Pagina_up = \'paginas/'.$Titulo_banco.'/Up_'.$Titulo_banco.'&Id_Princ=\'.$id_Principal;
	
	
	$Pagina_cat = \'paginas/'.$Titulo_banco.'/Cat_'.$Titulo_banco.'\';
	
	
	$Pagina_galeria = \'paginas/'.$Titulo_banco.'/Gal_'.$Titulo_banco.'&Id_Princ=\'.$id_Principal;
	
	
	
	$SubFerramentas = array();
	

	
	$ContSubFer = count($SubFerramentas);
	
	
	
	$Categoria_criar = \''.$Cat_Cria_menus.'\';
	
	$Galeria_criar = \''.$Gal_Cria_menus.'\';
	
	$Upload_criar = \''.$Up_Cria_menus.'\';
	
	$Destaque_criar = \''.$Destaque_Cria_menus.'\';
	
	$Comentarios_criar = \''.$Com_Cria_menus.'\';
	
	
	$Principal = \''.$Campo_principal.'\';
	
	$Referencial = \''.$Campo_Referencial.'\';
	
	
	
	
	
	
	
	if(isset($_GET[\'ex\'])) {
		
		$id_ex = mysql_real_escape_string($_GET[\'ex\']);
		
		$SqlREC = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'$id_ex\'")or(die(mysql_error()));
		$RetornaRec = mysql_fetch_array($SqlREC);
		
		GravaAcoes($_SESSION[\'idLogin\'],$_SESSION[\'UserLogin\'],$Banco,"Excluir",$RetornaRec[$Principal],$RetornaRec[\'permalink\'],$id_Principal);
		
		$Del = mysql_query("DELETE FROM ".$Banco." WHERE '.$Campo_Referencial.' = \'$id_ex\'")or(die(mysql_error()));
		
		if($Del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
		
		
	}
	
	
	if(isset($_GET[\'Limpar\'])) {
		
		
		$Del = mysql_query("DELETE FROM ".$Banco."")or(die(mysql_error()));
		
		if($Del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
		
		
	}
	
	
	
	
	if(isset($_GET[\'editar\'])) {
		

	  $contador = $_POST[\'contador\'];
	  $id = $_POST[$Referencial];
	  $nome = $_POST[$Principal];
	  $categoria = $_POST[\'categoria\'];
	  
	  if($id == true) {
	  
	  $i=1;
	  
	  foreach($id as $valor) { $id_array[$i++] = $valor; }
	  
	  $i=1;
	  
	  foreach($nome as $valor) { $nome_array[$i++] = $valor; }
	  
	  
	  
	  if($categoria == true) {
	  
	  $i=1;
	  
	  foreach($categoria as $valor) { $categoria_array[$i++] = $valor; }
	  
	  for($y=1; $y <= $contador; $y++) {
		  
      $SqlVerificaEdicao = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'".$id_array[$y]."\'")or(die(mysql_error()));
	  $RetornaIdEdicao = mysql_fetch_array($SqlVerificaEdicao);  
		  
	  $ParmaLK = permalink($nome_array[$y],$Banco,$Referencial,$id_array[$y]);	  
	  
	  $edit = mysql_query("UPDATE ".$Banco." SET ".$Principal." = \'".$nome_array[$y]."\', id_cat = ".$categoria_array[$y].", permalink = \'".$ParmaLK."\'  WHERE '.$Campo_Referencial.' = \'".$id_array[$y]."\'")or(die(mysql_error()));
	  
	  
	  if($edit) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							  
							  if($nome_array[$y] != $RetornaIdEdicao[$Principal]) {
							  		GravaAcoes($_SESSION[\'idLogin\'],$_SESSION[\'UserLogin\'],$Banco,"Editar",$nome_array[$y],$ParmaLK,$id_Principal);
							  }
							  
							  
							  
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
	  
	  }
	
    
	  }
	  
	  } 
	  
	  if($nome == true and $categoria == false) {
		  
		  
	  for($y=1; $y <= $contador; $y++) {
	  
	  $ParmaLK = permalink($nome_array[$y],$Banco,$Referencial,$id_array[$y]);
	  	  
	  $edit = mysql_query("UPDATE ".$Banco." SET ".$Principal." = \'".$nome_array[$y]."\', permalink = \'".$ParmaLK."\' WHERE '.$Campo_Referencial.' = \'".$id_array[$y]."\'")or(die(mysql_error()));
	  
	  
	  if($edit) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
	  
	  }
	
    
	  }  
		
		
	}
	
	
?>





<form action="index.php?pg=<?=$Pagina?>&editar=ok&Id_Princ=<?=$id_Principal?>"  method="post" enctype="multipart/form-data" name="frm1" onSubmit="return _jsSubmit();">
                    
                    
     <? 
                            
       	$sql = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = \'$id_Principal\' ORDER BY id DESC")or(die(mysql_error()));
		$contador = mysql_num_rows($sql);
							
	?>
            Ferramentas > <a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><?=$Ferramenta_principal?></a> > <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><?=$Titulo_banco?></a>                 
                            
            <ul class="Menu-acoes">
          			<a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?=$Titulo_banco?></li></a>
          			<a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?=$Ferramenta_principal?></li></a>
                    <a href="#" onclick="document.frm1.submit();"><li>Editar</li></a>
                    <a href="?pg=<?=$Pagina_cadastrar?>"><li>Cadastrar</li></a>
                    <a href="?pg=<?=$Pagina?>&Limpar=ok&Id_Princ=<?=$id_Principal?>" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                    <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>
                    <a href="#"  onclick="window.location.reload()"><li><input type="text" name="contador" id="resultados_table" class="edite_titulos" value="<?=$contador?>">resultado(s)</li></a>
					
					<? if($Categoria_criar == 1) { ?>
                    	<a href="?pg=<?=$Pagina_cat?>&Id_Princ=<?=$id_Principal?>"><li>Cadastrar categoria</li></a>
					<? }?>     		
            </ul>
                    
                   
                  
                     
                        <table class="mws-table">
                       	 <thead>
                        	<tr>
                       			 <th width="5%" align="left" valign="top">Id</th>
								 <th width="25%" align="left" valign="top">Titulo</th>
                        		 <th width="50%" align="left" valign="top" class="StatusCategoris"></th>
                        		 <th width="20%" align="left" valign="top"></th>

                           </tr>
                        </thead>


                        <tbody>
							<?
							if($contador == 0) {
                            
                            ?>
                            
                            <tr>
                            	<td></td>
                                <td>Não existe cadastros!</td>
                                <td></td>
								<td></td>
                            </tr>
                            
                            
                            <? } ?>


                     <? 
							
                            while($retorna = mysql_fetch_array($sql)) {
                            $id     = $retorna[\'\'.$Referencial.\'\'];
							$id_Cat = $retorna[\'id_cat\']; 
							$nome = $retorna[\'\'.$Principal.\'\'];
                            
                            ?>

						
					<tr <?=$CorLinha?>>
                            
                        <td align="left" valign="top" class="Font_zero">
                             	<input type="text" name="'.$Campo_Referencial.'[]" value="<?=$id?>"  readonly="readonly" class="edite_titulos"><?=$id?>
						</td>
							 
						<td class="Font_zero">
                            	<input type="text"  class="edite_titulos" style="width:100%" name="'.$Campo_principal.'[]" value="<?=$nome?>"><?=$nome?>
                        </td>

							
						<td align="left" valign="middle">
                        
						
                           
                            <? if($Categoria_criar == 1) { ?>                            
                            <?    
                            $Cat = mysql_query("SELECT * FROM ".$Banco_cat." WHERE id = \'$id_Cat\'")or(die(mysql_error()));
                            $Categoria = mysql_fetch_array($Cat);	
								$id_Cat_Verific = $Categoria[\'id\']
                            ?>
                            <select name="categoria[]" id="categoria" style=" height:25px; margin:0;">
                            	<option value="0">escolha</option>
                            	<? 
									$sql_cat = mysql_query("SELECT * FROM ".$Banco_cat." WHERE id_sub = 0  AND status = \'ON\'")or(die(mysql_error()));
		                            while($retorna_cat = mysql_fetch_array($sql_cat)) { 
									$id_Principal_b = $retorna_cat[\'id\'];
								?>
                            		<option  value="<?=$retorna_cat[\'id\']?>" <? if($retorna_cat[\'id\'] == $id_Cat_Verific) { echo \'selected="selected"\'; } ?> ><?=$retorna_cat[\'titulo\']?></option>
                            	<? 
									$sql_Sub = mysql_query("SELECT * FROM ".$Banco_cat." WHERE id_sub = \'$id_Principal_b\'  AND status = \'ON\' ")or(die(mysql_error()));
		                            while($retorna_sub = mysql_fetch_array($sql_Sub)) { 
									$id_Principal_b = $retorna_sub[\'id\'];
								?>
                            		<option value="<?=$retorna_sub[\'id\']?>" <? if($retorna_sub[\'id\'] == $id_Cat_Verific) { echo \'selected="selected"\'; } ?> >--<?=$retorna_sub[\'titulo\']?></option>
                            <?  }  ?>                          
                            <?  }  ?>
                            </select>
                            <? } ?>
							
							
							
							
							
							
							<?php 
                                
                                if($ContSubFer > 0) {
                                	for($xs=1;$xs <= $ContSubFer; $xs++) {
										$sql_Fers = mysql_query("SELECT * FROM tbl_paginas WHERE nome_ferramenta = \'".$SubFerramentas[$xs]."\'")or(die(mysql_error()));
										$retornaSub = mysql_fetch_array($sql_Fers);
											if ($retornaSub[\'status\'] == \'ON\') {
                                        
                            ?>  
                              <a href="?pg=paginas/<?=$SubFerramentas[$xs]?>/<?=$SubFerramentas[$xs]?>&Id_Princ=<?=$id?>" target="_self"><?=ucfirst($SubFerramentas[$xs])?></a>												
                            <? } } } ?>
							


                            <? if ($retorna[\'status\'] == \'ON\') { ?>							
								<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\''.$Campo_Referencial.'\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#009900" >Publicado</font> | </a>
                            <? } else { ?>
								<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\''.$Campo_Referencial.'\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Publicado</font> | </a>
                            <? } ?>
                            
                            

                            <? if( $Destaque_criar == 1) { ?>
							
								<? if ($retorna[\'destaque\'] == \'ON\') { ?>
									<a href="?pg=../Sistema/Includes/destaque&banco=<?=$Banco?>&status=<?=$retorna[\'destaque\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\''.$Campo_Referencial.'\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#009900" >Destaque</font> | </a>
								<? } else { ?>
									<a href="?pg=../Sistema/Includes/destaque&banco=<?=$Banco?>&status=<?=$retorna[\'destaque\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\''.$Campo_Referencial.'\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Destaque</font> | </a>
								<? } ?>
							
							
                            <? } ?>
                            
							
							
							</td>
                            
                            <td align="left" valign="middle">
                            
                            
                           <? if( $Galeria_criar == 1) { ?>
                           <? 
                            
                           $Gal = mysql_query("SELECT * FROM ".$Banco_galeria." WHERE id_princ = \'$id\'")or(die(mysql_error()));
						   $galeria = mysql_num_rows($Gal);
							
						   ?>
                            
                           <a href="?pg=<?=$Pagina_galeria?>&id=<?=$id?>" target="_self"><img src="Arquivos/css/grey/Image_2.png" title="Galeria (<?=$galeria?>)"/></a>
                           <? } ?>
							
							
							
							
							<? if( $Upload_criar == 1) { ?>
                            <? 
                            
                            $Gal = mysql_query("SELECT * FROM ".$Banco_upload." WHERE id_princ = \'$id\'")or(die(mysql_error()));
							$galeria = mysql_num_rows($Gal);
							
							

                            ?>
                            
                            <a href="?pg=<?=$Pagina_up?>&id=<?=$id?>" target="_self"><img  src="Arquivos/css/grey/Box_Incoming.png" title="Upload (<?=$galeria?>)"/></a>
							
                            <? } ?>
                            
                            
                            
                            <? if($Comentarios_criar == 1) { ?>

                            <? 
                            
                            $Com = mysql_query("SELECT * FROM ".$Banco_coment." WHERE id_princ = \'$id\' AND status = \'OFF\'")or(die(mysql_error()));
							$cont = mysql_num_rows($Com);
							
							

                            ?>
                            
							
							<? if($cont == 0) {?>
                            <a href="?pg=<?=$Pagina_coment?>&id_pag=<?=$id?>" target="_self"><img src="Arquivos/css/grey/Speech_Bubble.png" title="Comentarios (<?=$cont?>)"/></a>
                            <? }else{ ?>
                            <a href="?pg=<?=$Pagina_coment?>&id_pag=<?=$id?>" target="_self"><img src="Arquivos/css/grey/Speech_Bubble_on.png" title="Comentarios (<?=$cont?>)"/></a>
                            <? } ?>
                            
                            
                            
                            <? } ?>
                            
                          
                            <a href="?pg=<?=$Pagina_editar?>&id=<?=$id?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                            <a href="?pg=<?=$Pagina?>&ex=<?=$id?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
                            
							</td>
							</tr>
                            
                            
                            <? } ?>
                            
                            
                        
                         
                        </tbody>
         			 </table>
                   </form>
                   
      
 
<style>
				
				#pager {
					position:relative !important;
					top:0 !important;
					float:left;
				}
				
				</style>   
                   
			<ul class="Menu-acoes pager" id="pager">
            		<a href="#"><li>Exibir <select class="pagesize" style="height:20px; border:0;">
                                                    <option selected="selected" value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option  value="40">40</option>
                                            </select></li></a>
                    <a href="#" class="first"><li>Primeira</li></a>
                    <a href="#" class="prev"><li>Anterior</li></a>
                    <a href="#"><li><input type="text" class="pagedisplay" readonly="readonly"></li></a> 
                    <a href="#" class="next"><li>Próximo</li></a>
                    <a href="#" class="last"><li>Última</li></a>	
                    <a href="#"><li>Pesquisar <input type="text" id="pesquisar" name="pesquisar" style="height:20px; border:0;"/></li></a> 
             </ul>        
    
      
<script>
    $(function(){

      $(\'form\').submit(function(e){ e.preventDefault(); });
      
      $(\'#pesquisar\').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $(\'table > tbody > tr\').each(function(){
          $(this).find(\'td\').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table") 
        .tablesorter({
          dateFormat: \'uk\',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
    });
</script>     
 

<?php



}else{
	
	header(\'location: ../../login.php\');
	
}


?>





';



$Criar = fopen ("Restrito/paginas/".$pagina."/".$pagina.".php", "w");
	
fwrite($Criar,$Principal_Criar);


}else{
	
	header('location: ../../login.php');
	
}


?>









