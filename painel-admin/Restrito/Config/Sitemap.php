
<? 

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {


?>

<?php

if($_GET['msg'] == 1){
	echo "<div class='aviso certo'><p>SiteMap editado com sucesso!</div>";
	echo "<div class='aviso info'><p>Evite atualizar o SiteMap frequentemente! </div>";
}else if($_GET['msg'] == 2){
	echo "<div class='aviso erro'><p>Não foi possível editar o SiteMap!</div>";
}


if(isset($_GET['Gerar'])){
	
	
	
$UrlSiteConfig = mysql_query("SELECT * FROM tbl_configs")or(die(mysql_error()));
$retornaUrlSite = mysql_fetch_array($UrlSiteConfig);	 
	

$ConteudoSitamap .= false;

$ConteudoSitamap .= '<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';




$sqlGera = mysql_query("SELECT * FROM tbl_sitemap ORDER BY id ASC")or(die(mysql_error()));
while($retornaGera = mysql_fetch_array($sqlGera)) {	   
	   
$ConteudoSitamap .= '	<url>
		<loc>'.$retornaGera['url'].'</loc>
		<lastmod>'.$retornaGera['data_edit'].'</lastmod>
		<priority>'.$retornaGera['prioridade'].'</priority>
	</url>
';


}

$ConteudoSitamap .= '</urlset>';

$CriarMaps = fopen ("../Sitemap.xml", "w");
if(fwrite($CriarMaps,$ConteudoSitamap)){
	header ('location: index.php?pg=Config/Sitemap&msg=1');
	
}else{
	header ('location: index.php?pg=Config/Sitemap&msg=2');
	
}

}

	if(isset($_POST['submit'])){
		
		$desc = $_POST['desc'];
		$url = $_POST['url'];
		if($_POST['prioridade'] == '' or $_POST['prioridade'] == false) {
			$prioridadeInicio = '1';
		}else{
			$prioridadeInicio = $_POST['prioridade'];
		}
		$prioridade = '0.'.$prioridadeInicio;
		
		
		$QueryCad = mysql_query("INSERT INTO tbl_sitemap SET descricao = '$desc', url = '$url', prioridade = '$prioridade', data_edit = NOW()")or(die(mysql_error()));
		
					if($QueryCad) {
						echo "<div class='aviso certo'><p>URL Cadastrada com sucesso!</div>";
					}else{
						echo "<div class='aviso erro'><p>Não foi possível cadastradar a URL!</div>";
					}	
		
	}
	
	if(isset($_GET['ex'])) {
		
		$id_ex = mysql_real_escape_string($_GET['ex']);
		
		$Del = mysql_query("DELETE FROM tbl_sitemap WHERE id = '$id_ex'")or(die(mysql_error()));
		
		if($Del) {
							  echo "<div class='aviso certo'><p>Excluido com sucesso!</div>";
							}else{
							  echo "<div class='aviso erro'><p>Não foi possível excluir!</div>";;
							}
		
		
	}
	
	
	if(isset($_POST['editarlogin'])){
	
		$desc = $_POST['desc'];
		$url = $_POST['url'];
		if($_POST['prioridade'] == '' or $_POST['prioridade'] == false) {
			$prioridadeInicio = '1';
		}else{
			$prioridadeInicio = $_POST['prioridade'];
		}
		$prioridade = '0.'.$prioridadeInicio;
		$Id_edit = $_POST['Id_edit'];
		
		
		
		$QueryEdit = mysql_query("UPDATE tbl_sitemap SET descricao = '$desc', url = '$url', prioridade = '$prioridade', data_edit = NOW() WHERE id = '$Id_edit'")or(die(mysql_error()));
		
					if($QueryEdit) {
						echo "<div class='aviso certo'><p>URL editado com sucesso!</div>";
					}else{
						echo "<div class='aviso erro'><p>Não foi possível editar a URL!</div>";
					}
			
	}
	
	

	
?>

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
				<a href="index.php?pg=Config/Sitemap&Gerar=ok"><li style="background-color:#F00;">Gerar Site Map</li></a>
				<a href="index.php?pg=Config/Sitemap"><li>Cadastrar nova URL</li></a>
                <a href="index.php?pg=Config/Sitemap"><li>Atualizar</li></a> 
                        
</ul>
            



<?php
	
	if(empty($_GET['edit']) and verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {

?>


<div class="Titulo_box">
    Cadastrar Url no Sitemap
</div>
<div class="Body_box">

	<form action="" method="post" enctype="multipart/form-data">
    
    	<label>Descrição</label><br />
        <input type="text" name="desc" id="desc"  style="width: 500px;" /><br /><br />
    
    	<label>Url</label><br />
        <input type="text" name="url" id="url"  style="width: 650px;"/><br /><br />
        
        <label>Prioridade</label> <br />
        <input type="text" name="prioridade" id="prioridade" maxlength="1"  style="width: 40px;" onkeyup="validar_prioridade(this,'num');"/><br /><br />
        
       
        
                
        <input type="submit" value="Cadastrar URL" name="submit" class="bt-blue"/>
        
    </form>


<? 

	}else{
		

	$sqlEdit = mysql_query("SELECT * FROM tbl_sitemap WHERE id = '".mysql_real_escape_string($_GET['edit'])."'")or(die(mysql_error()));
    $retornaEdit = mysql_fetch_array($sqlEdit);
    
		
?>

<div class="Titulo_box">
    Editar Url no Sitemap
</div>
<div class="Body_box">

	<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="Id_edit" id="Id_edit" value="<?=$retornaEdit['id']?>"  />
            
    	<label>Descrição</label><br />
        <input type="text" name="desc" id="desc"  style="width: 500px;" value="<?=$retornaEdit['descricao']?>"/><br /><br />
    
    	<label>Url</label><br />
        <input type="text" name="url" id="url"  style="width: 650px;" value="<?=$retornaEdit['url']?>"/><br /><br />
        
        <label>Prioridade</label> <br />
        <input type="text" name="prioridade" id="prioridade" maxlength="1"  style="width: 40px;" onkeyup="validar_prioridade(this,'num');" value="<?=str_replace('0.','',$retornaEdit['prioridade'])?>"/><br /><br />
        
       
        
                
        <input type="submit" value="Editar URL" name="editarlogin" class="bt-blue"/>
        
    </form>



<? } ?>

</div>
</div> 






<ul class="Menu-acoes">
					<a href="index.php?pg=Config/Sitemap&Gerar=ok"><li style="background-color:#F00;">Gerar Site Map</li></a>
					<a href="index.php?pg=Config/Sitemap"><li>Cadastrar nova URL</li></a>
                    <a href="index.php?pg=Config/Sitemap"><li>Atualizar</li></a> 		
</ul>
                    
                   
                  
                     
                        <table class="mws-table">
                       	 <thead>
                        	<tr>
                            	 <th width="40%" align="left" valign="top">Descrição</th>
                            	 <th width="45%" align="left" valign="top">Url</th>
                       			 <th width="5%" align="left" valign="top">Prioridade</th>
								 <th width="10%" align="right" valign="top"></th>
                           </tr>
                        </thead>
						
						
                        <tbody>
                        
                        
							
                        	<?
							

							$sql = mysql_query("SELECT * FROM tbl_sitemap ORDER BY id DESC")or(die(mysql_error()));
							
							$Cont = mysql_num_rows($sql);
							
                            while($retorna = mysql_fetch_array($sql)) {
                            if(($xLinhasCor++)%2 == 0 ) { $CorLinha = 'class="tdColor"'; }else{ $CorLinha = "";  };
							
                            ?>
                            
                            
                            <? if($Cont == 0) { ?>
                        	
                            <tr>
                            	<td align="left" valign="middle"></td>
                                <td align="left" valign="middle">Não existe cadastros!</td>
                                <td align="left" valign="middle"></td>
								<td align="left" valign="middle"></td>

                                <td></td>
                          </tr>
                            
                         <? 
						 
						 } else { ?>
							
							<tr <?=$CorLinha?>>
                            
                            <td align="left" valign="middle">
                             		<?php
										echo $retorna['descricao'];
									?>
							 </td>
                            
                              <td align="left" valign="middle">
                             		<?php
										echo $retorna['url'];
									?>
							 </td>
                            
                           	 <td align="left" valign="middle">
                             		<?php
										echo $retorna['prioridade'];
									?>
							 </td>
                            
                             
							 
							 <td align="left" valign="middle">
                             
                             		<a href="?pg=Config/Sitemap&edit=<?=$retorna['id']?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                                    <a href="?pg=Config/Sitemap&ex=<?=$retorna['id']?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>

                            	
                             </td>

									
							
							</tr>
                            
                            
                            <? } }?>
                            
                            
                        
                        </tbody>
         			 </table>                    
             
             
             
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

             
             
<? 

}

}else{
	header('location: ../../login.php');
}

?>         
            
         

         
         
         
       
         
           
    