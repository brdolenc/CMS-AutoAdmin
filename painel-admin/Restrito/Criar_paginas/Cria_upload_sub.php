
<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$upload_Criar .= '

<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
?>

<? require_once( "Sistema/Classes/alertas.inc.php"); ?>

<?php 


	$Ferramenta_principal = \''.$sub_ferramenta.'\';
	

	$Titulo_banco = \''.$Titulo_banco.'\';

	
	$id_Principal = mysql_real_escape_string($_GET[\'Id_Princ\']);

    $Banco = \'tbl_upload_'.$Titulo_banco.'\';
	
	
    $Pagina = \'paginas/'.$Titulo_banco.'/Up_'.$Titulo_banco.'\';
	
	
	$Pagina_home = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'\';
	
	$PastaArqs = \'../Arquivos/Upload/\';
	
	
	if(isset($_POST[\'submit\'])) {
	
		require_once(\'Sistema/Classes/upload.inc.php\');
		$UP = new Upload;
      	$UP->Pasta   	  = $PastaArqs;
      	$UP->Tamanho      = 1024 * 1024 * 2; //*2= 2mb, *4=4mb
      	$UP->Extensoes    = false; //true: imagens png, gif, jpg //false: todos arquivos
        $UP->Arquivo      = $_FILES[\'arquivo\'];
		$UP->Banco        = $Banco;
		$UP->IdPai        = $_GET[\'id\'];
		echo $UP->UploadArquivo();
	
	}
	
	if($_GET[\'idEx\'] == true and $_GET[\'idEx\'] != \'\') {
		
		$IdEx = mysql_real_escape_string($_GET[\'idEx\']);
		$sqlEx = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
		$retornaEx = mysql_fetch_array($sqlEx);
		$ArquivoEx = $retornaEx[\'arquivo\'];
	
		if(file_exists($PastaArqs.$ArquivoEx)) {
				$link_img = unlink($PastaArqs.$ArquivoEx);
					if($link_img) {
						   $del = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
							
							if($del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
							
					}
			
		}else {
			$del = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
				if($del) {
						echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
				}else{
						echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
				}
					 
		}
	
	}
	
	
	
?>

Ferramentas > <a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><?=$Ferramenta_principal?></a> > <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><?=$Titulo_banco?></a>  > upload

<div class="Box box_Paginas">	



<ul class="Menu-acoes">
                <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?=$Titulo_banco?></li></a>
          		<a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?=$Ferramenta_principal?></li></a>
				
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>

<div class="Titulo_box">
    Editar categoria
</div>
<div class="Body_box">  
            

<form  action="?pg=<?=$Pagina?>&cad=1&id=<?=$_GET[\'id\']?>&Id_Princ=<?=$id_Principal?>" enctype="multipart/form-data" name="galeria" class="mws-form" method="post">


<label>Arquivo:</label><br />
<input type="file" name="arquivo" id="arquivo" class="mws-textinput"/><br />


<input type="submit" name="submit" value="Enviar Arquivo" class="Bt-blue" />
</form>

</div>    	
</div>




<table class="mws-table">
                       	 <thead>
                        	<tr>
                            	 <th width="95%" align="left" valign="top">Upload</th>
								 <th width="5%" align="left" valign="top"></th>

                           </tr>
                        </thead>



<tbody>
              
                        
							
                            
                            <?

							$id_Gal = mysql_real_escape_string($_GET[\'id\']);
							
							$Pasta = \'/arquivos/Doc/\';
							
							$sql = mysql_query("SELECT * FROM ".$Banco." WHERE id_princ = \'$id_Gal\'")or(die(mysql_error()));
							
							while($retorna = mysql_fetch_array($sql)) {
							
								
									$Foto = $retorna[\'arquivo\'];
									$id   = $retorna[\'id\'];
									
									if(($xLinhasCor++)%2 == 0 ) { $CorLinha = \'class="tdColor"\'; }else{ $CorLinha = "";  };
		
						   ?>
                            
                            
                            
                            <tr <?=$CorLinha?>>
                            
                            <td>
                             
                             <a href="<?=$UrlGeral[0]?><?=$PastaArqs.$Foto?>" target="_blank"><?=$UrlGeral[0]?><?=$PastaArqs.$Foto?></a>
                             
                             </td>
                            
                            
                            <td>
                            
                            <a href="?pg=<?=$Pagina?>&id=<?=$_GET[\'id\']?>&idEx=<?=$retorna[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
							
                            </td>
                           
                           
                           
                            </tr>
                            
                            
                            <? } ?>
                            
                            
                        
                        </tbody>
                        </table>
						
						
						
<br />
<br />
<br style="clear:both" />



<?php


}else{
	
	header(\'location: ../../login.php\');
	
}

?>





';

$Criar = fopen ("Restrito/paginas/".$pagina."/Up_".$pagina.".php", "w");
	
fwrite($Criar,$upload_Criar);


}else{
	
	header('location: ../../login.php');
	
}


?>









