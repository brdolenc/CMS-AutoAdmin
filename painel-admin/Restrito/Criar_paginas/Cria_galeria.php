
<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$galeria_Criar .= '

<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
?>

<? require_once( "Sistema/Classes/alertas.inc.php"); ?>





<?php 

    $Banco = \'tbl_galeria_'.$Titulo_banco.'\';
	
	
    $Pagina = \'paginas/'.$Titulo_banco.'/Gal_'.$Titulo_banco.'\';
	
	
	$Pagina_home = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'\';
	
	
	$PastaArqs = \'../Arquivos/Imgs/\';
	
	
	if(isset($_POST[\'submit\'])) {
	
		require_once(\'Sistema/Classes/galeria.inc.php\');
		$UP = new Upload;
      	$UP->Pasta   	  = $PastaArqs;
      	$UP->Tamanho      = 1024 * 1024 * 2; //*2= 2mb, *4=4mb
      	$UP->Extensoes    = true; //true: imagens png, gif, jpg //false: todos arquivos
        $UP->Arquivo      = $_FILES[\'arquivo\'];
		$UP->Banco        = $Banco;
		$UP->IdPai        = $_GET[\'id\'];
		echo $UP->UploadArquivo();
	
	}	
	
	
	if(isset($_POST[\'editar\'])) {
		
		$Titulo      =  mysql_real_escape_string($_POST[\'titulo\']);
		$Texto       =  mysql_real_escape_string($_POST[\'texto\']);
		$id_edit     =  mysql_real_escape_string($_POST[\'id_edit\']);
		
		
			$UpTexto = mysql_query("UPDATE ".$Banco." SET titulo= \'$Titulo\', texto= \'$Texto\' WHERE id = \'$id_edit\'")or(die(mysql_error()));
			
				if($UpTexto) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_edit=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_edit=2"; </script>\';
				}
		
	}
	
	
	if($_GET[\'idEx\'] == true and $_GET[\'idEx\'] != \'\') {
		
		$IdEx =  mysql_real_escape_string($_GET[\'idEx\']);
		$sqlEx = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
		$retornaEx = mysql_fetch_array($sqlEx);
		$ArquivoEx = $retornaEx[\'arquivo\'];
	
		if(file_exists($PastaArqs.$ArquivoEx)) {
				$link_img = unlink($PastaArqs.$ArquivoEx);
					if($link_img) {
						   $del = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
							
							if($del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=2"; </script>\';
							}
							
					}
			
		}else {
			$del = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$IdEx\'")or(die(mysql_error()));
				if($del) {
						echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=1"; </script>\';
				}else{
						echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id=\'.$_GET[\'id\'].\'&alert_ex=2"; </script>\';
				}
					 
		}
	
	}
	
	
?>


<script type="text/javascript">
     
	  
	$(document).ready(function(){
			$(function() {
				$( "#sortable" ).sortable(
					{
					placeholder: "Imagens_box",
					opacity: 0.8, cursor: \'move\', update: function() {
							var order = $(this).sortable("serialize") + \'&update=update&banco=<?=$Banco?>\'; 
							$.post("Sistema/Includes/updateGaleria.php", order, function(theResponse){
							}); 															 
						}								  
						}
				);
				$( "#sortable" ).disableSelection();
			  });
	});	
</script>


<div class="aviso info" id="aviso"><p>Mova as imagens para alterar sua posição</p></div>


Ferramentas > <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>">'.$Titulo_banco.'</a> > galeria

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="?pg=<?=$Pagina_home?>"><li>Pagina Principal</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
       
       
<div class="Titulo_box">
    Galeria
</div>
<div class="Body_box">


<form  action="?pg=<?=$Pagina?>&cad=1&id=<?=$_GET[\'id\']?>" enctype="multipart/form-data" name="galeria" class="mws-form" method="post">


<label>Imagens:</label><br />
<input type="file" name="arquivo" id="arquivo" class="mws-textinput"/><br />

<input type="submit" name="submit" value="Enviar Arquivo" class="Bt-blue" />
                       
</form>


</div>
</div>





<?php if(isset($_GET[\'texto\'])) { ?> 

<div class="Box box_Paginas">	
      
<div class="Titulo_box">
    Editar texto da imagem 
</div>
<div class="Body_box">
 
<?php

	$sqlEdit = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'". mysql_real_escape_string($_GET[\'texto\'])."\'")or(die(mysql_error()));
	$retornaEdit = mysql_fetch_array($sqlEdit);
	
	echo \'<img src="\'.$PastaArqs.$retornaEdit[\'arquivo\'].\'" height="100" width="120" border="0" class="imagem_galeria" >\';
	
?>
<br /><br />
<form  action="?pg=<?=$Pagina?>&cad=1&id=<?=$_GET[\'id\']?>" enctype="multipart/form-data" name="galeria" class="mws-form" method="post">

<input type="hidden" name="id_edit" id="id_edit" value="<?=$retornaEdit[\'id\']?>"/>


    <label>Titulo:</label><br />
    <input type="text" name="titulo" id="titulo" value="<?=$retornaEdit[\'titulo\']?>" class="mws-textinput medium"/><br />
    
    <label>Texto:</label><br />
    <textarea name="texto" id="texto"  class="mws-textinput" style="width:100%;" rows="10"/><?=$retornaEdit[\'texto\']?></textarea><br />
    
    <input type="submit" name="editar" value="Salvar alteração" class="Bt-blue" />
                       
</form>


</div>
</div>

<?php } ?> 

    





<div class="Box box_Paginas">	
     

<div class="Titulo_box">
    Imagens
</div>
<div class="Body_box">



<ul id="sortable">
<?

$id_Gal =  mysql_real_escape_string($_GET[\'id\']);

$sql = mysql_query("SELECT * FROM ".$Banco." WHERE id_princ = \'$id_Gal\' ORDER BY posicao")or(die(mysql_error()));

while($retorna = mysql_fetch_array($sql)) {

	
		$Foto =  mysql_real_escape_string($retorna[\'arquivo\']);
		$id   =  mysql_real_escape_string($retorna[\'id\']);
		

		echo \'<li class="Imagens_box" id="arrayorder_\'.$id.\'">\';
			
			echo \'<div class="Imagens_box_IMG">\';		
				 echo \'<img src="\'.$PastaArqs.$Foto.\'" height="130" width="160" border="0" class="imagem_galeria" >\';
			echo \'</div>\';

			
			echo "<a href=\'?pg=".$Pagina."&id=".$_GET[\'id\']."&texto=".$retorna[\'id\']."\'>";
				echo "<div class=\'bt_imagemBox bt_texto\'>Adicionar Texto</div>";
			echo \'</a>\';
			
			?>
            
            <? if ($retorna[\'capa\'] == \'ON\') { ?>

            <a href="?pg=../Sistema/Includes/capa&banco=<?=$Banco?>&status=<?=$retorna[\'capa\']?>&pagina=<?=$Pagina?>&id_gal=<?=$retorna[\'id\']?>&id=<?=$id_Gal?>">
				<div class=\'bt_imagemBox bt_capa\'>Definir Capa</div>
			</a>
            <? } else { ?>
            <a href="?pg=../Sistema/Includes/capa&banco=<?=$Banco?>&status=<?=$retorna[\'capa\']?>&pagina=<?=$Pagina?>&id_gal=<?=$retorna[\'id\']?>&id=<?=$id_Gal?>">
				<div class=\'bt_imagemBox bt_capa_off\'>Definir Capa</div>
			</a>
            <? } ?>
			
			
			
            <?
			echo "<a href=\'?pg=".$Pagina."&id=".$_GET[\'id\']."&idEx=".$retorna[\'id\']."\'>";
				echo "<div class=\'bt_imagemBox bt_excluir\'>Excluir</div>";
			echo \'</a>\';
		
		echo \'</li>\';


}



?>

</ul>


<br style="clear:both;" /></div>

</div>
</div>

<?php

	}else{
	
	header(\'location: ../../login.php\');
	
}

?>







';

$Criar = fopen ("Restrito/paginas/".$pagina."/Gal_".$pagina.".php", "w");
	
fwrite($Criar,$galeria_Criar);


	}else{
	
	header('location: ../../login.php');
	
}


?>









