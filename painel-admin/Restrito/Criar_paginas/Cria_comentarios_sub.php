<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$comentarios_Criar .= '


<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
	?>


   <?php require_once( "Sistema/Classes/alertas.inc.php"); ?>
     
     
     	<?php 
		
				$Ferramenta_principal = \''.$sub_ferramenta.'\';
	

				$Titulo_banco = \''.$Titulo_banco.'\';
		
			   $id_Principal = mysql_real_escape_string($_GET[\'Id_Princ\']);
			
			   $Banco = \'tbl_comentarios_'.$Titulo_banco.'\';
				
				
			   $Pagina = \'paginas/'.$Titulo_banco.'/Comentarios_'.$Titulo_banco.'\';
			   
			   
			   $Pagina_home = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'\';

		
			   $id = mysql_real_escape_string($_GET[\'id_pag\']);
			
			
			if($_POST[\'excluir\'] == true and $_POST[\'excluir\']) {
			
				foreach($_POST[\'excluir\'] as $Valor) {
				
					$del = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$Valor\'")or(die(mysql_error()));
					
					if($del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id_pag=\'.$_GET[\'id_pag\'].\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id_pag=\'.$_GET[\'id_pag\'].\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
				
				}
			
			}
			
			
			
			if(isset($_GET[\'Limpar\'])) {
	
	
			$id = mysql_real_escape_string($_GET[\'id_pag\']);
			
			$del = mysql_query("DELETE FROM ".$Banco." WHERE id_princ = \'$id\'")or(die(mysql_error()));
			
			if($del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id_pag=\'.$_GET[\'id_pag\'].\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&id_pag=\'.$_GET[\'id_pag\'].\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
							 
			}
			
	   ?>
       
       
       
   

       
       
        <form action="?pg=<?php echo $Pagina?>&id_pag=<?php echo $id?>&Id_Princ=<?php echo $id_Principal?>" method="post" class="mws-form" name="coment" enctype="multipart/form-data"  >
		
		
		Ferramentas > <a href="?pg=paginas/<?php echo $Ferramenta_principal?>/<?php echo $Ferramenta_principal?>"><?php echo $Ferramenta_principal?></a> > <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>&Id_Princ=<?php echo $_GET[\'Id_Princ\']?>"><?php echo $Titulo_banco?></a>  > comentarios
		
		<ul class="Menu-acoes">
                <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>&Id_Princ=<?php echo $_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?php echo $Titulo_banco?></li></a>
          		<a href="?pg=paginas/<?php echo $Ferramenta_principal?>/<?php echo $Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?php echo $Ferramenta_principal?></li></a>
				
				
                <a href="?pg=<?php echo $Pagina?>&Limpar=ok&id_pag=<?php echo $_GET[\'id_pag\']?>&Id_Princ=<?php echo $id_Principal?>" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>   
                <a href="#"  onclick="document.coment.submit();"><li>Excluir comentarios selecionados</li></a>   		
		</ul>
           
         
        <?
			
			$sql = mysql_query("SELECT * FROM ".$Banco." WHERE id_princ = \'$id\'")or(die(mysql_error())); 
			
			$contadorCom = mysql_num_rows($sql); if($contadorCom == 0) {
			?>
            
            
            <table class="mws-table">
            <thead>
                   <tr>
                                             <th align="left" valign="top"></th>
                  </tr>
            </thead>
            <tbody>
                <tr>
                        <td>Não existe cadastro!</td>
                    </tr>
            </tbody>
            </table>
            
            <?
			
			}
			while($retorna = mysql_fetch_array($sql)) {
				
	    ?>
		 
<table class="mws-table">
<thead>
       <tr>
								 <th width="30%" align="left" valign="top"></th>
								 <th width="29%" align="left" valign="top"></th>
                        		 <th width="20%" align="left" valign="top"></th>
                                 <th width="20%" align="left" valign="top"></th>
                                 <th width="1%" align="left" valign="top"></th>

      </tr>
</thead>
<tbody> 
		
		<tr <?php if ($retorna[\'spam\'] == \'ON\') { ?> bgcolor="#ff8e8e" <?php } ?> <?php if ($retorna[\'status\'] == \'OFF\') { ?> bgcolor="#a8fdd8" <?php } ?> >
        <td><?php echo $retorna[\'nome\']?></td>
        <td><?php echo $retorna[\'email\'];?></td>
        <td><?php echo $retorna[\'data\'];?></td>
        <td>
		
			<?
            
            if ($retorna[\'status\'] == \'ON\') { ?>
            		 
			 <a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>&pagid=<?php echo $id?>&Id_Princ=<?php echo $id_Principal?>" target="_self" ><font color="#009900" >Publicado</font></a> |
			
            <?php } else { ?> 
            
			<a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>&pagid=<?php echo $id?>&Id_Princ=<?php echo $id_Principal?>" target="_self" ><font color="#333333" style="text-decoration:line-through;">Publicado</font></a> |
			
            <?
            
            } 
			
			?>
			
			
			
			
			
			 <?
            
            if ($retorna[\'spam\'] == \'ON\') { ?>
            
			 <a href="?pg=../Sistema/Includes/spam&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'spam\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>&pagid=<?php echo $id?>&Id_Princ=<?php echo $id_Principal?>" target="_self"><font color="#990000" >Spam</font></a> |
			
            <?php } else { ?> 
            
			<a href="?pg=../Sistema/Includes/spam&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'spam\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>&pagid=<?php echo $id?>&Id_Princ=<?php echo $id_Principal?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Spam</font></a> |
			
            <?
            
            } 
			
			?>
			
			
			
			
			
			
			
			
	 	</td>
        
        <td>
        
        <input name="excluir[]" type="checkbox" style="width:15px;" value="<?php echo $retorna[\'id\']?>" />
        </td>
        
        </tr>
        
        
        <tr>
        	<td colspan="5"><?php echo $retorna[\'comentario\']?></td>
        </tr>
        
              
		</tbody>
        </table> 
         
    <?php } ?>
			
			
            
		
             
                                            
</form>


<?php

}else{
	
	header(\'location: ../../login.php\');
	
}

?>
    
       
     ';
 
 
$Criar = fopen ("Restrito/paginas/".$pagina."/Comentarios_".$pagina.".php", "w");
	
fwrite($Criar,$comentarios_Criar);

}else{
	
	header('location: ../../login.php');
	
}

?>