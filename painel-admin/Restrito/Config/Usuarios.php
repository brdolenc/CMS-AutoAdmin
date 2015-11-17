
<?php 

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

?>

<?php

	if(isset($_POST['submit'])){
	
		if(strstr($_POST['log_senha'], " ") or strstr($_POST['log_name'], " ") 
		or strstr($_POST['log_senha'], "'") or strstr($_POST['log_name'], "'") 
		or strstr($_POST['log_senha'], '"') or strstr($_POST['log_name'], '"')
		or strstr($_POST['log_senha'], "<") or strstr($_POST['log_name'], "<")
		or strstr($_POST['log_senha'], ">") or strstr($_POST['log_name'], ">")
		or strstr($_POST['log_senha'], "=") or strstr($_POST['log_name'], "=")) {
		
			echo "<div class='aviso erro'><p>Não use espaço e os caracteres (<,>,=,',\")</p></div>";
		
		}else{
			
			if($_POST['log_senha'] == $_POST['log_repita']) {

				$CadLog = new sistemaLogin;
				$CadLog->Login        = $_POST['log_name'];
				$CadLog->Senha        = $_POST['log_senha'];
				$CadLog->PaginaLogin  = 'index.php?pg=Config/Usuarios';
				$CadLog->Permissao    = $_POST['log_permi'];
				$CadLog->Nome         = $_POST['usuario_name'];
					if($CadLog->CadLogin()==true) {
						echo "<div class='aviso certo'><p>Usuário cadastrado com sucesso!</div>";
					}else{
						echo "<div class='aviso erro'><p>Não foi possível cadastrar! ( verifique se o login digitado já exite )</div>";
					}
				
			}else{
				
				echo "<div class='aviso erro'><p>Repita a senha corretamente</p></div>";
				
			}				
				
		}
	}
	
	
	
	if(isset($_POST['editarlogin'])){
	
		if(strstr($_POST['log_senha'], " ") or strstr($_POST['log_name'], " ") 
		or strstr($_POST['log_senha'], "'") or strstr($_POST['log_name'], "'") 
		or strstr($_POST['log_senha'], '"') or strstr($_POST['log_name'], '"')
		or strstr($_POST['log_senha'], "<") or strstr($_POST['log_name'], "<")
		or strstr($_POST['log_senha'], ">") or strstr($_POST['log_name'], ">")
		or strstr($_POST['log_senha'], "=") or strstr($_POST['log_name'], "=")) {
		
			echo "<div class='aviso erro'><p>Não use espaço e os caracteres (<,>,=,',\")</p></div>";
		
		}else{
			
			if($_POST['novasenha'] == $_POST['log_repita']) {

				$CadLog = new sistemaLogin;
				$CadLog->Login        = $_POST['log_name'];
				$CadLog->Senha        = $_POST['log_senha'];
				$CadLog->PaginaLogin  = 'index.php?pg=Config/Usuarios';
				$CadLog->Permissao    = $_POST['log_permi'];
				$CadLog->Nome         = $_POST['usuario_name'];
				$CadLog->Novasenha    = $_POST['novasenha'];
				$CadLog->Id_edit      = $_POST['Id_edit'];
				$CadLog->Log_atual      = $_POST['Log_atual'];
					if($CadLog->EditLogin()==true) {
						echo "<div class='aviso certo'><p>Usuário editado com sucesso!</div>";
					}else{
						echo "<div class='aviso erro'><p>Não foi possível editar ( verifique se a senha atual esta correta )!</div>";
					}
				
			}else{
				
				echo "<div class='aviso erro'><p>Repita a senha corretamente</p></div>";
				
			}				
				
		}
	}
	
	
	
	if(isset($_GET['ex'])) {
		
		$id_ex = mysql_real_escape_string($_GET['ex']);
		
		$Del = mysql_query("DELETE FROM tbl_login WHERE id_login = '$id_ex'")or(die(mysql_error()));
		
		if($Del) {
							  echo "<div class='aviso certo'><p>Excluido com sucesso!</div>";
							}else{
							  echo "<div class='aviso erro'><p>Não foi possível excluir!</div>";;
							}
		
		
	}

?>

<div class="Box box_Paginas">	


<ul class="Menu-acoes">
                <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a>   
                <?php if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) { ?><a href="?pg=Config/Usuarios"><li>Cadastrar Novo usuário</li></a><?php } ?>         
</ul>
            



<?php
	
	if(empty($_GET['edit']) and verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {

?>


<div class="Titulo_box">
    Cadastrar Usuários
</div>
<div class="Body_box">

	<form action="" method="post" enctype="multipart/form-data">
    
    	<label>Nome do usuário</label><br />
        <input type="text" name="usuario_name" id="usuario_name"  style="width: 300px;" /><br /><br />
    
    	<label>Login</label><br />
        <input type="text" name="log_name" id="log_name"  /><br /><br />
        
        <label>Senha</label> <br />
        <input type="password" name="log_senha" id="log_senha"  /><br /><br />
        
        <label>Repita Senha</label> <br />
        <input type="password" name="log_repita" id="log_repita"  /><br /><br />
        
        <label>Permissão</label><br />
        <input type="radio" name="log_permi" value="1"/>Administrador<br />
        <input type="radio" name="log_permi" value="2" checked="checked"/>Conta Simples<br /><br />
        
                
        <input type="submit" value="Cadastrar usuário" name="submit" class="bt-blue"/>
        
    </form>


<?php 

	}else{
		
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {	
		$sqlEdit = mysql_query("SELECT * FROM tbl_login WHERE id_login = '".mysql_real_escape_string($_GET['edit'])."'")or(die(mysql_error()));
	}else{
		$sqlEdit = mysql_query("SELECT * FROM tbl_login WHERE id_login = '".$_SESSION['idLogin']."'")or(die(mysql_error()));
	}
    $retornaEdit = mysql_fetch_array($sqlEdit);
    
		
?>

<div class="Titulo_box">
    Editar Usuários
</div>
<div class="Body_box">


	<form action="" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="Id_edit" id="Id_edit" value="<?php echo $retornaEdit['id_login']?>"  />
        <input type="hidden" name="Log_atual" id="Log_atual" value="<?php echo $retornaEdit['sql_login']?>"  />
    
    	<label>Nome do usuário</label><br />
        <input type="text" name="usuario_name" id="usuario_name" value="<?php echo $retornaEdit['nome_usuario']?>"  style="width: 300px;" /><br /><br />
    
    	<label>Login</label><br />
        <input type="text" name="log_name" id="log_name" value="<?php echo $retornaEdit['sql_login']?>"  /><br /><br />
        
        <label>Senha Atual</label> <br />
        <input type="password" name="log_senha" id="log_senha"  /><br /><br />
        
        <label>Nova Senha</label> <br />
        <input type="password" name="novasenha" id="novasenha"  /><br /><br />
        
        <label>Repita a Nova Senha</label> <br />
        <input type="password" name="log_repita" id="log_repita"  /><br /><br />
        
        <label>Permissão</label><br />
        <?php if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) { ?>
        <input type="radio" name="log_permi" value="1" <?php if($retornaEdit['sql_nivel'] == 1){ echo 'checked="checked"'; } ?> />Administrador<br />
        <?php } ?>
        <input type="radio" name="log_permi" value="2" <?php if($retornaEdit['sql_nivel'] == 2){ echo 'checked="checked"'; } ?> />Conta Simples<br /><br />
        
                
        <input type="submit" value="Editar usuário" name="editarlogin" class="bt-blue"/>
        
    </form>


<?php } ?>

</div>
</div> 






<ul class="Menu-acoes">
                    <a href="#"  onclick="window.location.reload()"><li>Atualizar</li></a> 		
</ul>
                    
                   
                  
                     
                        <table class="mws-table">
                       	 <thead>
                        	<tr>
                            	 <th width="30%" align="left" valign="top">Nome</th>
                            	 <th width="20%" align="left" valign="top">Login</th>
                       			 <th width="20%" align="left" valign="top">Nível</th>
								 <th width="30%" align="right" valign="top"></th>
                           </tr>
                        </thead>
						
						
                        <tbody>
							
                        	<?
							
							if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
								$sql = mysql_query("SELECT * FROM tbl_login ORDER BY id_login DESC")or(die(mysql_error()));
							}else{
								$sql = mysql_query("SELECT * FROM tbl_login WHERE id_login = '".$_SESSION['idLogin']."' ORDER BY id_login DESC")or(die(mysql_error()));
							} 
							
							$Cont = mysql_num_rows($sql);
							
							
							$sqladmin = mysql_query("SELECT * FROM tbl_login WHERE sql_nivel = '1'")or(die(mysql_error()));
							$Contadmin = mysql_num_rows($sqladmin);
							
							
                            while($retorna = mysql_fetch_array($sql)) {
                            if(($xLinhasCor++)%2 == 0 ) { $CorLinha = 'class="tdColor"'; }else{ $CorLinha = "";  };
                            ?>
							
							<tr <?php echo $CorLinha?>>
                            
                            <td align="left" valign="middle">
                             		<?php
										echo $retorna['nome_usuario'];
									?>
							 </td>
                            
                              <td align="left" valign="middle">
                             		<?php
										echo $retorna['sql_login'];
									?>
							 </td>
                            
                           	 <td align="left" valign="middle">
                             		<?php
										if($retorna['sql_nivel']==1){
											echo 'Administrador';
										}elseif($retorna['sql_nivel']==2){
											echo 'Conta Simples';
										}
									?>
							 </td>
                            
                             
							 
							 <td align="left" valign="middle">
                             
                             		<a href="?pg=Config/Usuarios&edit=<?php echo $retorna['id_login']?>" target="_self"><img src="Arquivos/css/grey/Pencil.png" title="Editar"/></a>
                                    
                                    <?php
									
										if($Contadmin > 1) {
											if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
									?>
                                         		<a href="?pg=Config/Usuarios&ex=<?php echo $retorna['id_login']?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
                                    <?php
											}
										}elseif($Contadmin == 1 and $retorna['sql_nivel']==1) { } else {
											if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
										
									?>
                                    
                                    	<a href="?pg=Config/Usuarios&ex=<?php echo $retorna['id_login']?>" target="_self"><img src="Arquivos/css/grey/delete.png" title="Excluir"/></a>
                                      
                                     <?php } } ?>
                                        
                                        
                                        
                            	
                             </td>

									
							
							</tr>
                            
                            
                            <?php } ?>
                            
                            
                        
                        </tbody>
         			 </table>                    
             
<?php 

}else{
	header('location: ../../login.php');
}

?>         
            
         

         
         
         
       
         
           
    