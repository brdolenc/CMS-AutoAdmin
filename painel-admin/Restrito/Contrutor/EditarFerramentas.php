

<? 


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {

require_once( "Sistema/Classes/alertas.inc.php"); 

?>


<?php


	if(isset($_GET['PgRestar'])) {
		
		
		$PastaArqs = 'Restrito/paginas/'.$_GET['PgRestar'].'/';
		$PgEditar = $_GET['PgRestar'].'_editar_restaurar.php';
		$PgCadastrar = $_GET['PgRestar'].'_cadastrar_restaurar.php';
		
		$Pagina_Restaurar_editar = file_get_contents($PastaArqs.$PgEditar);

		$RestauraEdit = fopen ($PastaArqs.$_GET['PgRestar']."_editar.php", "w"); fwrite($RestauraEdit,$Pagina_Restaurar_editar);
		
		
		$Pagina_Restaurar_cad = file_get_contents($PastaArqs.$PgCadastrar);

		$RestauraCadastro = fopen ($PastaArqs.$_GET['PgRestar']."_cadastrar.php", "w"); fwrite($RestauraCadastro,$Pagina_Restaurar_cad);
		
		if($RestauraEdit == true and $RestauraCadastro == true) { 
		
			 echo '<script type="text/javascript"> location.href="?pg=Contrutor/EditarFerramentas&alert_edit=1"; </script>';
			
		
		}else{
			
			echo '<script type="text/javascript"> location.href="?pg=Contrutor/EditarFerramentas&alert_edit=2"; </script>';
			
		}
		
	}
	
	
	if(isset($_GET['NomeFerr'])){
		$ferrTest = mysql_query("SELECT * FROM tbl_paginas WHERE nome_ferramenta = '".$_GET['NomeFerr']."'")or(die(mysql_error()));
		$CountFerramentas = mysql_num_rows($ferrTest);
		
			if($CountFerramentas == 1) {
				
					$Diretorio = 'Restrito/paginas/'.$_GET['NomeFerr'].'/';
					
					$tabelas_consulta = mysql_query('SHOW TABLES');
					while ($tabelas_linha = mysql_fetch_row($tabelas_consulta)) {
						$tabelas[] = $tabelas_linha[0];
					}
	
					if (in_array("tbl_".$_GET['NomeFerr']."", $tabelas)) {
						@$SqlDrop = mysql_query("DROP TABLE tbl_".$_GET['NomeFerr']."");
					}
					
					if (in_array("tbl_cat_".$_GET['NomeFerr']."", $tabelas)) {
						@$SqlDrop = mysql_query("DROP TABLE tbl_cat_".$_GET['NomeFerr']."");
					}
					
					if (in_array("tbl_comentarios_".$_GET['NomeFerr']."", $tabelas)) {
						@$SqlDrop = mysql_query("DROP TABLE tbl_comentarios_".$_GET['NomeFerr']."");
					}
					
					if (in_array("tbl_galeria_".$_GET['NomeFerr']."", $tabelas)) {
						@$SqlDrop = mysql_query("DROP TABLE tbl_galeria_".$_GET['NomeFerr']."");
					}
					
					if (in_array("tbl_upload_".$_GET['NomeFerr']."", $tabelas)) {
						@$SqlDrop = mysql_query("DROP TABLE tbl_upload_".$_GET['NomeFerr']."");
					}
					
					if (file_exists($Diretorio.$_GET['NomeFerr'].'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'.php');
					}
					if (file_exists($Diretorio.$_GET['NomeFerr'].'_cadastrar'.'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'_cadastrar'.'.php');
					}
					if (file_exists($Diretorio.$_GET['NomeFerr'].'_cadastrar_restaurar'.'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'_cadastrar_restaurar'.'.php');
					}
					if (file_exists($Diretorio.$_GET['NomeFerr'].'_editar'.'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'_editar'.'.php');
					}
					if (file_exists($Diretorio.$_GET['NomeFerr'].'_editar_restaurar'.'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'_editar_restaurar'.'.php');
					}
					if (file_exists($Diretorio.$_GET['NomeFerr'].'_mudar'.'.php')) {
						@unlink($Diretorio.$_GET['NomeFerr'].'_mudar'.'.php');
					}
					if (file_exists($Diretorio.'Cat_'.$_GET['NomeFerr'].'.php')) {
						@unlink($Diretorio.'Cat_'.$_GET['NomeFerr'].'.php');
					}
					if (file_exists($Diretorio.'Comentarios_'.$_GET['NomeFerr'].'.php')) {
						@unlink($Diretorio.'Comentarios_'.$_GET['NomeFerr'].'.php');
					}
					if (file_exists($Diretorio.'Gal_'.$_GET['NomeFerr'].'.php')) {
						@unlink($Diretorio.'Gal_'.$_GET['NomeFerr'].'.php');
					}
					if (file_exists($Diretorio.'Up_'.$_GET['NomeFerr'].'.php')) {
						@unlink($Diretorio.'Up_'.$_GET['NomeFerr'].'.php');
					}				
					if (file_exists($Diretorio)) {
						@rmdir('Restrito/paginas/'.$_GET['NomeFerr']);
					}
					
					$ExAcoes = mysql_query("DELETE FROM tbl_acoes WHERE tabelaFerramenta = 'tbl_".$_GET['NomeFerr']."'")or(die(mysql_error()));
					
					$ExFerr = mysql_query("DELETE FROM tbl_paginas WHERE nome_ferramenta = '".$_GET['NomeFerr']."'")or(die(mysql_error()));
					
						if($ExFerr){
							echo '<script type="text/javascript"> location.href="?pg=Contrutor/EditarFerramentas&alert_ex=1"; </script>';
						}else{
							echo '<script type="text/javascript"> location.href="?pg=Contrutor/EditarFerramentas&alert_ex=1"; </script>';
						}
				
			}else{
				echo '<div class="aviso info"><p><strong>Informação!</strong> Essa ferramenta não exite ou já foi excluida.</p></div>';
			}
	}
	
	
	
?>



<script type="text/javascript">

function confirmAction(PaginaRest){
      var confirmed = confirm("Essa ação vai apagar todas as alterações feitas, deseja continuar?");
	  	  
	  if(confirmed) {
	  	location.href='index.php?pg=Contrutor/EditarFerramentas&PgRestar='+PaginaRest;
	  }
}

</script>

                        
							
			<ul class="Menu-acoes">
                    <a href="?pg=Contrutor/Construtor_ADM"><li>Criar Ferramenta</li></a>
                    <a href="?pg=Contrutor/Construtor_ADM_sub"><li>Criar Sub Ferramenta</li></a>
                    <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>
						
            </ul>
                    
                   
                  <?php 
				  		$ferr = mysql_query("SELECT * FROM tbl_paginas WHERE sub = 1")or(die(mysql_error()));
						$contador = mysql_num_rows($ferr);
				  ?>
                     
                        <table class="mws-table">
                       	 <thead>
                        	<tr>
								 <th width="60%" align="left" valign="top">Ferramentas</th>
                                 <th width="30%" align="left" valign="top"></th>
                                 <th width="10%" align="left" valign="top"></th>

                           </tr>
                        </thead>
						
						
                        <tbody>
                        
                        
                        <? if($contador == 0) { ?>
                          <tr>
                            	<td align="left" valign="middle">Não existe cadastros!</td>
                                <td align="left" valign="middle"></td>
                                <td align="left" valign="middle"></td>

                          </tr>
                        <?php
						
						}else{
							
							while($Retorna_ferr = mysql_fetch_array($ferr)) {
								 if(($xLinhasCor++)%2 == 0 ) { $CorLinha = 'class="tdColor"'; }else{ $CorLinha = "";  };
						
						?>
							<tr <?=$CorLinha?>>
                                    <td><?=$Retorna_ferr['nome_ferramenta']?></td>
                                    <td align="right">
                                    
                         <? if ($Retorna_ferr['status'] == 'ON') { ?>							
								<a href="?pg=../Sistema/Includes/status&banco=tbl_paginas&status=<?=$Retorna_ferr['status']?>&pagina=Contrutor/EditarFerramentas&id=<?=$Retorna_ferr['id']?>" target="_self"><font color="#009900" >Desinstalar</font> | </a>
                            <? } else { ?>
								<a href="?pg=../Sistema/Includes/status&banco=tbl_paginas&status=<?=$Retorna_ferr['status']?>&pagina=Contrutor/EditarFerramentas&id=<?=$Retorna_ferr['id']?>" target="_self"><font color="#333333">Instalar</font> | </a>
                            <? } ?>
                                 
                                  <a href="#" onclick="confirmAction('<?=$Retorna_ferr['nome_ferramenta']?>');"><font color="#333333" >Restaurar</font> | </a>
                                  
                                  
                                  
                                  <? if ($Retorna_ferr['status'] == 'ON') { ?>							
								 <a href="?pg=paginas/<?=$Retorna_ferr['nome_ferramenta']?>/<?=$Retorna_ferr['nome_ferramenta']?>"><font color="#333333" >Ver</font> | </a>
                            <? } else { ?>
								
                            <? } ?>
                                 
                                  
                                  
                                  </td>
                                  <td align="right">
                                  
                                  
                                  <a href="?pg=paginas/<?=$Retorna_ferr['nome_ferramenta']?>/<?=$Retorna_ferr['nome_ferramenta']?>_mudar" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                                  <a href="index.php?pg=Contrutor/EditarFerramentas&NomeFerr=<?=$Retorna_ferr['nome_ferramenta']?>" oncLick="return confirm('Essa ação apaga por completo a ferramenta <?=$Retorna_ferr['nome_ferramenta']?>, deseja continuar?');" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
                                     
                                    
                                    </td>
							</tr>
                            
                            			
                                        
                         <?php
						
							$ferr_SUB = mysql_query("SELECT * FROM tbl_paginas WHERE sub_de = '".$Retorna_ferr['nome_ferramenta']."'")or(die(mysql_error()));
							while($Retorna_ferr_SUB = mysql_fetch_array($ferr_SUB)) {
								 if(($xLinhasCor++)%2 == 0 ) { $CorLinha = 'class="tdColor"'; }else{ $CorLinha = "";  };
						
						?>
							<tr <?=$CorLinha?>>
                                    <td>--<?=$Retorna_ferr_SUB['nome_ferramenta']?></td>
                                    <td align="right">
                                    
                         <? if ($Retorna_ferr_SUB['status'] == 'ON') { ?>							
								<a href="?pg=../Sistema/Includes/status&banco=tbl_paginas&status=<?=$Retorna_ferr_SUB['status']?>&pagina=Contrutor/EditarFerramentas&id=<?=$Retorna_ferr_SUB['id']?>" target="_self"><font color="#009900" >Desinstalar</font> | </a>
                            <? } else { ?>
								<a href="?pg=../Sistema/Includes/status&banco=tbl_paginas&status=<?=$Retorna_ferr_SUB['status']?>&pagina=Contrutor/EditarFerramentas&id=<?=$Retorna_ferr_SUB['id']?>" target="_self"><font color="#333333">Instalar</font> | </a>
                            <? } ?>
                                 
                                  <a href="#" onclick="confirmAction('<?=$Retorna_ferr_SUB['nome_ferramenta']?>');"><font color="#333333" >Restaurar</font> | </a>
                                  
                                  
                                  
                                  <? if ($Retorna_ferr_SUB['status'] == 'ON') { ?>							
								  <!--<a href="?pg=paginas/<?=$Retorna_ferr_SUB['nome_ferramenta']?>/<?=$Retorna_ferr_SUB['nome_ferramenta']?>"><font color="#333333" >Ver</font> | </a>-->
                            <? } else { ?>
								
                            <? } ?>
                                 
                                  
                                  
                                  </td>
                                  <td align="right">
                                  
                                  
                                  <a href="?pg=paginas/<?=$Retorna_ferr_SUB['nome_ferramenta']?>/<?=$Retorna_ferr_SUB['nome_ferramenta']?>_mudar" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                                  <a href="index.php?pg=Contrutor/EditarFerramentas&NomeFerr=<?=$Retorna_ferr_SUB['nome_ferramenta']?>" oncLick="return confirm('Essa ação apaga por completo a ferramenta <?=$Retorna_ferr_SUB['nome_ferramenta']?>, deseja continuar?');" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
                                     
                                    
                                    </td>
							</tr>

						<?php } ?>

						<?php }  }?>
                        </tbody>
         			 </table>
                   
    
      
 
     
 

<?php 

}else{
	
	echo "<div class='aviso erro'><p>Permissão negada</div>";
	
}

}else{
	
	header('location: ../../login.php');
	
}

?>













