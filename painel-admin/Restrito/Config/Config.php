
<?php 

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	

?>

<?php

	if(isset($_POST['submit'])){
		$titulo_site = mysql_real_escape_string($_POST['titulo_site']);
		$url_site = mysql_real_escape_string($_POST['url_site']);
		$urlGeral = mysql_real_escape_string($_POST['url_admin']);
		$frase = mysql_real_escape_string($_POST['frase_busca']);
		$email = mysql_real_escape_string($_POST['email']);
		$palavras = mysql_real_escape_string($_POST['palavras_busca']);
		
		$ContURL = strlen($url_site);
		if(substr($url_site,($ContURL-1),1)=='/'){
			$url_site = substr($url_site,0,($ContURL-1));
		}
		
		
			if($titulo_site == '' or $titulo_site == false 
			   or $url_site == '' or $url_site == false
			   or $urlGeral == '' or $urlGeral == false
			   or $frase == '' or $frase == false
			   or $palavras == '' or $palavras == false) {
				   
				   echo "<div class='aviso info'><p>Todos os campos são obrigatórios!</div>";
				   
			   }else{
				   
				   
				   
				   $palavras = str_replace(" ",",",$palavras);
				   
				   $palavras = str_replace(",,",",",$palavras);
				   $palavras = str_replace(",,,",",",$palavras);
				   $palavras = str_replace(",,",",",$palavras);
				   
				   
				   $palavras = str_replace(",,",",",$palavras);
				   $palavras = str_replace(",,,",",",$palavras);
				   $palavras = str_replace(",,",",",$palavras);
				   
				   $CountCaracteres = strlen($palavras);
				   for($i=0;$i<=strlen($palavras);$i++){
				   		if(substr($palavras,$CountCaracteres-1,1) == ',') {
							$palavras = substr($palavras,0,-1);
						}else{
							break;
						}
				   }
				   
				  
				  if(substr($url_site,strlen($url_site)-1,1) == '/') {
					 $url_site = substr($url_site,0,strlen($url_site)-1);
				  }
				  
				  $contentRobot = false;
$contentRobot .= 'User-agent: *
';
$contentRobot .= 'Sitemap: '.$url_site.'/Sitemap.xml';
			
				   
				   
				   		$UrlCheck = mysql_query("SELECT url_site FROM tbl_configs")or(die(mysql_error()));
						$RetornCheck = mysql_fetch_array($UrlCheck);
							
							if($RetornCheck['url_site'] != $url_site) {
								$CriarRbts = fopen ("../robots.txt", "w");
								fwrite($CriarRbts,$contentRobot);
							}

				   
				   if($RetornCheck['url_site'] != $url_site) {
					   $SqlEditar = mysql_query("UPDATE tbl_configs SET 
												titulo_site = '$titulo_site',
												url_site = '$url_site',
												urlGeral = '$urlGeral',
												frase = '$frase',
												email = '$email',
												palavras = '$palavras',
												datamod = NOW()
												")or(die(mysql_error()));
				   }else{
					    $SqlEditar = mysql_query("UPDATE tbl_configs SET 
												titulo_site = '$titulo_site',
												url_site = '$url_site',
												urlGeral = '$urlGeral',
												frase = '$frase',
												email = '$email',
												palavras = '$palavras'
												")or(die(mysql_error()));

				   }
							
							if($SqlEditar) {
								echo "<div class='aviso certo'><p>Configurações alteradas com sucesso!</div>";
							}else{
								echo "<div class='aviso info'><p>Não foi possível alterar!</div>";
							}
				   
			   }
		
	}


	///////////UPLOAD DO LOGO////////////////////////////////
	$PastaArqs = '../Arquivos/Imgs/';

	if(isset($_POST['submitImg'])) {

		
	
		require_once('Sistema/Classes/imagem.inc.php');
		$UP = new Upload;
      	$UP->Pasta   	  = $PastaArqs;
      	$UP->Tamanho      = 1024 * 1024 * 2; //*2= 2mb, *4=4mb
      	$UP->Extensoes    = true; //true: imagens png, gif, jpg //false: todos arquivos
        $UP->Arquivo      = $_FILES['arquivo'];
		$UP->Banco        = 'tbl_configs';
		$UP->Campo        = 'arquivo';
		echo $UP->UploadArquivo();
	
	}	
	///////////UPLOAD DO LOGO////////////////////////////////
	
	$sql = mysql_query("SELECT * FROM tbl_configs")or(die(mysql_error()));
    $retorna = mysql_fetch_array($sql);
	
?>

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>


<div class="Titulo_box">
    Configurações
</div>
<div class="Body_box">


	<form action="" method="post" enctype="multipart/form-data">

    	<label>Logo do site</label><br />
        <input type="file" name="arquivo" id="arquivo" class="mws-textinput"/>

        <input type="submit" value="Salvar Imagem" name="submitImg" class="bt-green"/><br />

        
        <?php 
		if($retorna['arquivo']!=''){
		if(file_exists($PastaArqs.$retorna['arquivo'])) { ?>
        <label>Logo atual</label><br />
        <img src="<?php echo $PastaArqs.$retorna['arquivo']?>" width="120">
        <?php } } ?>
        
    </form>

    <br /><br />

	<form action="" method="post" enctype="multipart/form-data">
    
    	<label>Titulo Site</label><br />
        <input type="text" name="titulo_site" id="titulo_site" value="<?php echo $retorna['titulo_site']?>"  style="width: 300px;" /><br /><br />
        
        
        <?php
		
		if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
		
		?>
    
    	<label>Url Site</label><br />
        <input type="text" name="url_site" id="url_site"  value="<?php echo $retorna['url_site']?>" style="width: 500px;" /><br /><br />
        
        <label>Url Painel Administrador</label> <br />
        <input type="text" name="url_admin" id="url_admin" value="<?php echo $retorna['urlGeral']?>"  style="width: 500px;" /><br /><br />
        
        
        <?php } else { ?>
        
        <label>Url Site</label><br />
        <input type="text" value="<?php echo $retorna['url_site']?>" disabled="disabled" style="width: 500px;" /><br /><br />
         <input type="hidden" name="url_site" id="url_site"  value="<?php echo $retorna['url_site']?>"/>
        
        <label>Url Administrador</label> <br />
        <input type="text"  value="<?php echo $retorna['urlGeral']?>" disabled="disabled"  style="width: 500px;" /><br /><br />
        <input type="hidden" name="url_admin" id="url_admin" value="<?php echo $retorna['urlGeral']?>"/>
        
        <?php } ?>
        
         <label>E-mail</label> <br />
        <input type="text" name="email" id="email" value="<?php echo $retorna['email']?>"  style="width: 300px;" /><br /><br />
        
        <label>Frase buscadores</label><br />
        <input type="text" name="frase_busca" id="frase_busca" value="<?php echo $retorna['frase']?>" style="width: 650px;"b/><br /><br />
        
        <label>Palavras chaves ( separadas por virgula )</label><br />
        <input type="text" name="palavras_busca" id="palavras_busca" onkeyup="validar_palavras(this,'caracter');" value="<?php echo $retorna['palavras']?>" style="width: 800px;"b/><br /><br />
        
                
        <input type="submit" value="Editar Configurações" name="submit" class="bt-blue"/>
        
    </form>



</div>
</div> 




             
<?php 

}else{
	header('location: ../../login.php');
}

?>         
            
         

         
         
         
       
         
           
    