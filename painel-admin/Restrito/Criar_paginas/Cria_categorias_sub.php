
<?php


if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

$pagina = $Titulo_banco;

$categoria_Criar .= '


<?php

if(isset($_SESSION[\'idLogin\']) and isset($_SESSION[\'UserLogin\']) and isset($_SESSION[\'NivelLogin\'])) {
	
	?>

<? require_once( "Sistema/Classes/alertas.inc.php"); ?>




<?php

	$Ferramenta_principal = \''.$sub_ferramenta.'\';
	

	$Titulo_banco = \''.$Titulo_banco.'\';

	$id_Principal = mysql_real_escape_string($_GET[\'Id_Princ\']);

    $Banco = \'tbl_cat_'.$Titulo_banco.'\';
	
	
    $Pagina = \'paginas/'.$Titulo_banco.'/Cat_'.$Titulo_banco.'\';
	
	
	$Pagina_home = \'paginas/'.$Titulo_banco.'/'.$Titulo_banco.'\';




if(isset($_GET[\'EX\'])) {

    $id = mysql_real_escape_string($_GET[\'EX\']);
	
	$DEL = mysql_query("DELETE FROM ".$Banco." WHERE id = \'$id\' ")or(die(mysql_error()));
	
	
	if($DEL) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_ex=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?gp=\'.$Pagina.\'&alert_ex=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}


}

if(isset($_POST[\'acao\'])) {

	$categoria = mysql_real_escape_string($_POST[\'categoria\']);
	$sub_cat   = mysql_real_escape_string($_POST[\'sub_cat\']);
	
    $CAD = mysql_query("INSERT INTO ".$Banco." SET titulo = \'$categoria\', id_sub = \'$sub_cat\'")or(die(mysql_error()));
	
	
				if($CAD) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_inc=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_inc=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}
	
	
	
}

if(isset($_POST[\'id_EDIT\'])) {

	$categoria = mysql_real_escape_string($_POST[\'categoria\']);
	$sub_cat   = mysql_real_escape_string($_POST[\'sub_cat\']);
	$id        = mysql_real_escape_string($_POST[\'id_EDIT\']);

	$UP = mysql_query("UPDATE ".$Banco." SET titulo = \'$categoria\', id_sub = \'$sub_cat\' WHERE id = \'$id\'")or(die(mysql_error()));
	
	if($UP) {
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=1&Id_Princ=\'.$id_Principal.\'"; </script>\';
							}else{
							  echo \'<script type="text/javascript"> location.href="?pg=\'.$Pagina.\'&alert_edit=2&Id_Princ=\'.$id_Principal.\'"; </script>\';
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



?>








<? if(isset($_GET[\'EDI\'])) { 

$EDI = mysql_real_escape_string($_GET[\'EDI\']);

$sql_cat_ED = mysql_query("SELECT * FROM ".$Banco." WHERE id = \'$EDI\'")or(die(mysql_error()));
$retorna_ED = mysql_fetch_array($sql_cat_ED);



?>

Ferramentas > <a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><?=$Ferramenta_principal?></a> > <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><?=$Titulo_banco?></a>  > categorias

<div class="Box box_Paginas">


	


<ul class="Menu-acoes">
               <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?=$Titulo_banco?></li></a>
          		<a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?=$Ferramenta_principal?></li></a>
				
                <a href="?pg=<?=$Pagina?>&Limpar=ok&Id_Princ=<?=$id_Principal?>" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Editar categoria
</div>
<div class="Body_box">


<form action="?pg=<?=$Pagina?>&Id_Princ=<?=$id_Principal?>" class="mws-form" method="post" name="cadastro"  enctype="multipart/form-data">


<label>Categoria</label><br/>
<input name="categoria" id="categoria" class="mws-textinput" style="width:330px;" value="<?=$retorna_ED[\'titulo\']?>" type="text" /><br/>


<input name="id_EDIT" id="id_EDIT" style="width:290px;" value="<?=$retorna_ED[\'id\']?>" type="hidden" />


<label>Sub Categoria de:</label><br/>

<select name="sub_cat" id="sub_cat">

<option value="0">Escolha</option>

<? $sql_cat = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = 0 ")or(die(mysql_error()));
while($retorna = mysql_fetch_array($sql_cat)) { ?>

<option value="<?=$retorna[\'id\']?>" <? if($retorna[\'id\'] == $retorna_ED[\'id_sub\']) { echo \'selected="selected"\'; } ?> ><?=$retorna[\'titulo\']?></option>

<? }  ?>

</select><br/>

                    			
<input type="submit" value="Salvar" class="Bt-blue" /><br/>
                    			
                        
</form>

</div>    	
</div>





<? } else { ?>

Ferramentas > <a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><?=$Ferramenta_principal?></a> > <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><?=$Titulo_banco?></a>  > categorias


<div class="Box box_Paginas">	





<ul class="Menu-acoes">
                <a href="?pg=paginas/<?=$Titulo_banco?>/<?=$Titulo_banco?>&Id_Princ=<?=$_GET[\'Id_Princ\']?>"><li style="background-color:#e67700"><?=$Titulo_banco?></li></a>
          		<a href="?pg=paginas/<?=$Ferramenta_principal?>/<?=$Ferramenta_principal?>"><li style="background-color:#09C">Voltar para <?=$Ferramenta_principal?></li></a>
				
                <a href="?pg=<?=$Pagina?>&Limpar=ok&Id_Princ=<?=$id_Principal?>" oncLick="return confirm(\'Essa ação apaga todos os dados armazenados, deseja continuar ?\');"><li>Limpar</li></a>
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>         
</ul>
            

<div class="Titulo_box">
    Cadastrar categoria
</div>
<div class="Body_box">

<form action="?pg=<?=$Pagina?>&Id_Princ=<?=$id_Principal?>" method="post" class="mws-form" name="cadastro"  enctype="multipart/form-data">



<label>Categoria</label><br/>
<input name="categoria" id="categoria" class="mws-textinput" style="width:330px;" type="text" /><br/>


<input name="acao" id="acao" value="cadastrar" type="hidden" />




<label>Sub Categoria de:</label><br/>

<select name="sub_cat" id="sub_cat">

<option>Escolha</option>

<? $sql_cat = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = 0 ")or(die(mysql_error()));

while($retorna = mysql_fetch_array($sql_cat)) { ?><option value="<?=$retorna[\'id\']?>" ><?=$retorna[\'titulo\']?></option><? }  ?>

</select><br/>


                    			
<input type="submit" value="Cadastrar" class="Bt-blue" /> <br />
                    			
                                
</form>

</div>    	
</div>




<? } ?>


<table class="mws-table">
                       	 <thead>
                        	<tr>
								 <th width="40%" align="left" valign="top">Titulo</th>
								 <th width="30%" align="left" valign="top" class="StatusCategoris"></th>
                        		 <th width="30%" align="left" valign="top"></th>

                           </tr>
                        </thead>



<tbody>


<? 

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
                            
                            
                            <? } ?>


<?
while($retorna = mysql_fetch_array($sql_cat)) { 
$id = $retorna[\'id\']; 

if(($xLinhasCor++)%2 == 0 ) { $CorLinha = \'class="tdColor"\'; }else{ $CorLinha = "";  };

?>


<tr <?=$CorLinha?>>

<td><?=$retorna[\'titulo\']?></td>

<td>



<? if ($retorna[\'status\'] == \'ON\') { ?>

<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#009900" >Publicado</font></a>
<? } else { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Publicado</font></a>
<? } ?>

</td>

<td>

<a href="?pg=<?=$Pagina?>&EDI=<?=$retorna[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
<a href="?pg=<?=$Pagina?>&EX=<?=$retorna[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>

</td>

</tr>



<? 

$sql_cat_sub = mysql_query("SELECT * FROM ".$Banco." WHERE id_sub = \'$id\' ")or(die(mysql_error()));
while($retorna_sub = mysql_fetch_array($sql_cat_sub)) { 


if(($xLinhasCor++)%2 == 0 ) { $CorLinha = \'class="tdColor"\'; }else{ $CorLinha = "";  };

?>


<tr <?=$CorLinha?>>

<td><font color="#0099FF">---- <?=$retorna_sub[\'titulo\']?></font></td>

<td>



<? if ($retorna_sub[\'status\'] == \'ON\') { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna_sub[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna_sub[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#009900" >Publicado</font></a>
<? } else { ?>
<a href="?pg=../Sistema/Includes/status&banco=<?=$Banco?>&status=<?=$retorna_sub[\'status\']?>&pagina=<?=$Pagina?>&id=<?=$retorna_sub[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><font color="#333333" style="text-decoration:line-through;">Publicado</font></a>
<? } ?>







</td>

<td>

<a href="?pg=<?=$Pagina?>&EDI=<?=$retorna_sub[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
<a href="?pg=<?=$Pagina?>&EX=<?=$retorna_sub[\'id\']?>&Id_Princ=<?=$id_Principal?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>

</td>

</tr>


<? } } ?>



      
 
 
 
      
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








