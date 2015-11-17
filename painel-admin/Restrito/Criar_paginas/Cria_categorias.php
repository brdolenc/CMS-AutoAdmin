
<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$categoria_Criar .= '


<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
	?>

<?php require_once( "Sistema/Classes/alertas.inc.php");  ?>



<?php



    $Banco = \'tbl_cat_'.$Titulo_banco.'\';
	
	
    $Pagina = \'paginas/'.$Titulo_banco.'/Cat_'.$Titulo_banco.'\';
	
	
	$Pagina_home = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'\';




if(isset($_GET[\'EX\'])) {

    $id = mysql_real_escape_string($_GET[\'EX\']);
	
	$DEL = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$id\' ")or(die(mysql_error()));
	
	
	if($DEL) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=2"; </script>\';
							}


}

if(isset($_POST[\'acao\'])) {

	$categoria = mysql_real_escape_string($_POST[\'categoria\']);
	$sub_cat   = mysql_real_escape_string($_POST[\'sub_cat\']);
	
    $CAD = mysql_query("INSERT INTO ".$Banco." SET titulo = \'$categoria\', id_sub = \'$sub_cat\'")or(die(mysql_error()));
	
	
				if($CAD) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_inc=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_inc=2"; </script>\';
							}
	
	
	
}

if(isset($_POST[\'id_EDIT\'])) {

	$categoria = mysql_real_escape_string($_POST[\'categoria\']);
	$sub_cat   = mysql_real_escape_string($_POST[\'sub_cat\']);
	$id        = mysql_real_escape_string($_POST[\'id_EDIT\']);

	$UP = mysql_query("UPDATE ".$Banco." SET titulo = \'$categoria\', id_sub = \'$sub_cat\' WHERE id = \'$id\'")or(die(mysql_error()));
	
	if($UP) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=2"; </script>\';
							}

}


if(isset($_GET[\'Limpar\'])) {
		
		
		$Del = mysql_query("DELETE FROM ".$Banco."")or(die(mysql_error()));
		
		if($Del) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=1"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=2"; </script>\';
							}
		
		
	}



?>








<?php if(isset($_GET[\'EDI\'])) { 

$EDI = mysql_real_escape_string($_GET[\'EDI\']);

$sql_cat_ED = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'$EDI\'")or(die(mysql_error()));
$retorna_ED = mysql_fetch_array($sql_cat_ED);



?>


Ferramentas > <a href="?pg=paginas/<?php echo $Titulo_banco?>/<?php echo $Titulo_banco?>">'.$Titulo_banco.'</a>  > categorias

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="?pg=<?php echo $Pagina_home?>"><li>Pagina Principal</li></a>
                <a href="?pg=<?php echo $Pagina?>&Limpar=ok" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Editar categoria
</div>
<div class="Body_box">

<form action="?pg=<?php echo $Pagina?>" class="mws-form" method="post" name="cadastro"  enctype="multipart/form-data">


<label>Categoria</label><br/>
<input name="categoria" id="categoria" class="mws-textinput" style="width:330px;" value="<?php echo $retorna_ED[\'titulo\']?>" type="text" /><br/>


<input name="id_EDIT" id="id_EDIT" style="width:290px;" value="<?php echo $retorna_ED[\'id\']?>" type="hidden" />



<label>Sub Categoria de:</label>
<select name="sub_cat" id="sub_cat">

<option value="0">Escolha</option>

<?php $sql_cat = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = 0 ")or(die(mysql_error()));
while($retorna = mysql_fetch_array($sql_cat)) { ?>

<option value="<?php echo $retorna[\'id\']?>" <?php if($retorna[\'id\'] == $retorna_ED[\'id_sub\']) { echo \'selected="selected"\'; } ?> ><?php echo $retorna[\'titulo\']?></option>

<?php }  ?>

</select><br/>

                    			
<input type="submit" value="Salvar" class="Bt-blue" /><br/>
                    			

                                
</form>

</div>    	
</div>





<?php } else { ?>




<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="?pg=<?php echo $Pagina_home?>"><li>Pagina Principal</li></a>
                <a href="?pg=<?php echo $Pagina?>&Limpar=ok" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Cadastrar categoria
</div>
<div class="Body_box">

<form action="?pg=<?php echo $Pagina?>" method="post" class="mws-form" name="cadastro"  enctype="multipart/form-data">


<label>Categoria</label><br />
<input name="categoria" id="categoria" class="mws-textinput" style="width:330px;" type="text" /><br />


<input name="acao" id="acao" value="cadastrar" type="hidden" />


<label>Sub Categoria de:</label><br />

<select name="sub_cat" id="sub_cat">

<option>Escolha</option>

<?php $sql_cat = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = 0 ")or(die(mysql_error()));

while($retorna = mysql_fetch_array($sql_cat)) { ?><option value="<?php echo $retorna[\'id\']?>" ><?php echo $retorna[\'titulo\']?></option><?php }  ?>

</select><br />


                    			
<input type="submit" value="Cadastrar" class="Bt-blue" /><br />
                    			

                                
</form>

</div>    	
</div>




<?php } ?>


<table class="mws-table">
                       	 <thead>
                        	<tr>
								 <th width="40%" align="left" valign="top">Titulo</th>
								 <th width="30%" align="left" valign="top" class="StatusCategoris"></th>
                        		 <th width="30%" align="left" valign="top"></th>

                           </tr>
                        </thead>



<tbody>

<?php 

$sql_cat = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = 0 ")or(die(mysql_error()));
$contador = mysql_num_rows($sql_cat); ?>

<?
							if($contador == 0) {
                            
                            ?>
                            
                            <tr>
                            	<td></td>
                                <td>Não existe cadastros!</td>
                                <td></td>
                            </tr>
                            
                            
                            <?php } ?>


<?
while($retorna = mysql_fetch_array($sql_cat)) {
$id = $retorna[\'id\']; 

if(($xLinhasCor++)%2 == 0 ) { $CorLinha = \'class="tdColor"\'; }else{ $CorLinha = "";  };

?>

<tr <?php echo $CorLinha?>>

<td><?php echo $retorna[\'titulo\']?></td>

<td>



<?php if ($retorna[\'status\'] == \'ON\') { ?>

<a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>" target="_self" ><font color="#009900" >Publicado</font></a>
<?php } else { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna[\'id\']?>" target="_self" ><font color="#333333" style="text-decoration:line-through;">Publicado</font></a>
<?php } ?>



</td>

<td>

<a href="?pg=<?php echo $Pagina?>&EDI=<?php echo $retorna[\'id\']?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
<a href="?pg=<?php echo $Pagina?>&EX=<?php echo $retorna[\'id\']?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>

</td>

</tr>



<?php 

$sql_cat_sub = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = \'$id\' ")or(die(mysql_error()));
while($retorna_sub = mysql_fetch_array($sql_cat_sub)) {
	
		if(($xLinhasCor++)%2 == 0 ) { $CorLinha = \'class="tdColor"\'; }else{ $CorLinha = "";  }; 

?>



<tr <?php echo $CorLinha?>>

<td><font color="#0099FF">---- <?php echo $retorna_sub[\'titulo\']?></font></td>

<td>



<?php if ($retorna_sub[\'status\'] == \'ON\') { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna_sub[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna_sub[\'id\']?>" target="_self"><font color="#009900" >Publicado</font></a>
<?php } else { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?php echo $Banco?>&status=<?php echo $retorna_sub[\'status\']?>&pagina=<?php echo $Pagina?>&id=<?php echo $retorna_sub[\'id\']?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Publicado</font></a>
<?php } ?>







</td>

<td>

<a href="?pg=<?php echo $Pagina?>&EDI=<?php echo $retorna_sub[\'id\']?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
<a href="?pg=<?php echo $Pagina?>&EX=<?php echo $retorna_sub[\'id\']?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>

</td>

</tr>


<?php } } ?>



      
 
 
 
      
</tbody>
</table>
 
 <?php
   
}else{
	
	header(\'location: ../../login.php\');
	
}

?>


';



$Criar = fopen ("Restrito/paginas/".$pagina."/Cat_".$pagina.".php", "w");
	
fwrite($Criar,$categoria_Criar);


}else{
	
	header('location: ../../login.php');
	
}


?>









