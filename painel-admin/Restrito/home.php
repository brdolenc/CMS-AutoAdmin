<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

?>        


       
							
			
                   
                   
                   
                   <?php
				   
				   		$Sql = mysql_query("SELECT * FROM tbl_acoes ORDER BY data_acao DESC")or(die(mysql_error()));
						$contador = mysql_num_rows($Sql);
				   
				   ?>
                   
                   
                   <ul class="Menu-acoes">
                        <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>
                        <a href="#"  onclick="window.location.reload()"><li><input type="text" name="contador" id="resultados_table" class="edite_titulos" value="<?=$contador?>">resultado(s)</li></a>		
            	   </ul>
                   
                  
                     
                        <table class="mws-table">
                       	 <thead>
                        	<tr>
								 <th width="15%" align="left" valign="top">Usuário</th>
                                 <th width="15%" align="left" valign="top">Ação</th>
                                 <th width="10%" align="left" valign="top">Ferramenta</th>
                                 <th width="40%" align="left" valign="top">Titulo</th>
                                 <th width="15%" align="left" valign="top">Modificado</th>
                                 <th width="5%" align="left" valign="top"></th>
                           </tr>
                        </thead>
						
						
                        <tbody>
                        
                        <? if($contador == 0) { ?>
                        	
                            <tr>
                            	<td align="left" valign="middle"></td>
                                <td align="left" valign="middle">Não existe cadastros!</td>
                                <td align="left" valign="middle"></td>
								<td align="left" valign="middle"></td>
                                <td align="left" valign="middle"></td>
                                <td></td>
                          </tr>
                            
                         <? 
						 
						 } else { 
						 
						 	while($Retorna = mysql_fetch_array($Sql)){
								if(($xLinhasCor++)%2 == 0 ) { $CorLinha = 'class="tdColor"'; }else{ $CorLinha = "";  };
						 
						 ?>   
							
							<tr <?=$CorLinha?>>
								<td align="left" valign="middle">
									<?=$Retorna['nomeLogin']?>
                                </td>
                                
                                <td align="left" valign="middle">
                                	<?php
										if($Retorna['acao'] == 'Excluir') {
											echo 'Excluio';
										}else if($Retorna['acao'] == 'Cadastrar') {
											echo 'Cadastrou';
										}else if($Retorna['acao'] == 'Editar'){
											echo 'Editou';
										}
									?>
                                </td>
                                
                                <td align="left" valign="middle">
                                	<?=str_replace("tbl_","",$Retorna['tabelaFerramenta'])?>
                                </td>
                                
                                <td align="left" valign="middle">
                                	<?=$Retorna['tituloAcao']?>
                                </td>
                                <td align="left" valign="middle">
                                	<?php echo substr($Retorna['data_acao'],8,2).'/'.substr($Retorna['data_acao'],5,2).'/'.substr($Retorna['data_acao'],0,4).' às '.substr($Retorna['data_acao'],11,5);?>
                                </td>
                              <td align="left" valign="top">
                              		<?php
									
										if(strstr($Retorna['LinkFerramenta'],'Id_Princ')) {
											$UrlSub = explode('&',$Retorna['LinkFerramenta']);
											$LinkFinal = $UrlSub[0].'_editar&'.$UrlSub[1].'&id='.$Retorna['id_ferramenta'];
										}else{
											$LinkFinal = $Retorna['LinkFerramenta'].'_editar&id='.$Retorna['id_ferramenta'];
										}
									?>
                                	<a href="<?=$LinkFinal?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                              </td>
							</tr> 

                        <? } } ?>    

                            
                        
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

      $('form').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table") 
        .tablesorter({
          dateFormat: 'uk',
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
          
 
 
     
<!--<div style="clear:both;"><br /><br /></div>     
         
         <div class="Box box_Atualizacoes">
         	<ul class="Menu-acoes">
                <a href=""><li>Atualizar</li></a>  		
            </ul>
            
            <div class="Titulo_box">
            	Atualizações
            </div>
            
            <div class="Body_box">
            	<p>Comentarios <span><a href="">30 novos</a></span></p>
                <p>Atualizações do sistema <span><a href="">1 novo</a></span></p>
                <p>Atualizações de segurança <span><a href="">2 novos</a></span></p>
                <p>Avisos <span><a href="">4 novos</a></span></p>
            </div>
            
         </div>-->
         
       


<?php

}else{
	
	header('location: ../login.php');
	
}


?>

