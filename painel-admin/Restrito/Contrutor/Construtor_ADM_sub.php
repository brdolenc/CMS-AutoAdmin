
         
           
<?php 

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {
	
	
	if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {


if(empty($_GET['PR'])) { 

	if($_GET['erro']=='campo_invalido') {
		echo '<div class="aviso erro"><p><strong>Erro!</strong> Verifique se digitou o nome da tabela, ou digite outro nome!</p></div>';
	}
	if($_GET['erro']=='sub_invalido') {
		echo '<div class="aviso erro"><p><strong>Erro!</strong> Selecione uma ferramenta!</p></div>';
	}
	if($_GET['erro']=='principalFalse') {
		echo '<div class="aviso erro"><p><strong>Erro!</strong> O campo principal na próxima etapa precisa ser preenchido, caso contrário voltará para essa tela!</p></div>';
	}

?>


		 <div class="Box box_InfoFerramenta">
            <ul class="Menu-acoes">
                <a href=""><li>Atualizar</li></a>       
            </ul>
            <div class="Titulo_box">
                Dados da Sub-ferramenta
            </div>
            <div class="Body_box">
            <?php 
			
				$SqlContSub = mysql_query("SELECT * FROM tbl_paginas")or(die(mysql_error())); 
				$contSub = mysql_num_rows($SqlContSub); 
					if($contSub == 0) {
						echo "<br /><br /><br />Nenhuma ferramenta foi criada, crie um ferramenta antes de criar a sub-ferramenta<br /><br /><br /><br />";
					}else{
				
			?>
            
				 <form action="?pg=Contrutor/Construtor_ADM_sub&PR=2"  class="mws-form" method="post" name="cadastro_PR1"  enctype="multipart/form-data"> 
                 <label>Nome da Tabela:</label><br>
                 <input name="Nome_tabela" class="mws-textinput" style="width:500px;"  type="text" onkeyup="validar_titulo(this,'caracter');" onchange="javascript:Carrega_verificacao('Sistema/Includes/ajax_verifica_nome.php',this.value);"/>
                 
                 <label>Sub Ferramenta de:</label><br>
                    <select name="sub_ferramenta" id="sub_ferramenta" style="width:500px;">
                        <option value="">Selecione</option>
                        <?
                        $sql_Fers = mysql_query("SELECT * FROM tbl_paginas WHERE sub != '0'")or(die(mysql_error()));
                            while($retorna_Ferramentas = mysql_fetch_array($sql_Fers)){
                                $Titulo_Fer = $retorna_Ferramentas['nome_ferramenta'];				
                                echo '<option value="'.$retorna_Ferramentas['nome_ferramenta'].'" >'.$retorna_Ferramentas['nome_ferramenta'].'</option>';
                                    $sql_Fers_sub = mysql_query("SELECT * FROM tbl_paginas WHERE sub_de = '$Titulo_Fer'")or(die(mysql_error()));
                                        while($retorna_Ferramentas_sub = mysql_fetch_array($sql_Fers_sub)){
                                            echo '<option value="'.$retorna_Ferramentas_sub['nome_ferramenta'].'" >--'.$retorna_Ferramentas_sub['nome_ferramenta'].'</option>';
                                        }
                        }
                        ?>
                    </select>
                 
                 <div class="OpFerramentas"><input name="categorias"  type="checkbox" value="1" />Criar sistema de Categorias</div>
                 <div class="OpFerramentas"><input name="galeria" type="checkbox" value="1" />Criar Galeria de Imagens</div>
                 <div class="OpFerramentas"><input name="upload" type="checkbox" value="1" />Criar Sistema de upload de arquivos</div>
                 <div class="OpFerramentas"><input name="sistema_comente" type="checkbox" value="1" />Criar Sistema de Comentarios</div>
                 <div class="OpFerramentas"><input name="post_destaque" type="checkbox" value="1" />Criar Campo Destaque</div>
                 <div id="mostra_verificacao"><input type="button" disabled="disabled" value="Avançar próxima etapa" class="Bt-gray" /><input type="button" value="Verificar nome" class="Bt-blue" /></div>
                 </form>
                 
             <?php } ?>
            </div>
         </div>
    
         
           
<?php } ?> 
         
         
 <?php 
 
 if(isset($_GET['PR'])) { 
 
 if(VerificaTables(strtolower($_POST['Nome_tabela']))) {}else{
		header('location: index.php?pg=Contrutor/Construtor_ADM_sub&erro=campo_invalido');
	}
 if($_POST['sub_ferramenta'] == '' or $_POST['sub_ferramenta'] == false) {
	 	header('location: index.php?pg=Contrutor/Construtor_ADM_sub&erro=sub_invalido');
 }
 
 
 ?>
         

<div class="aviso info"><p><strong>Informação!</strong> Os campos em brancos não serão criados, preencha os campos corretamente.</p></div>
<div class="aviso atencao"><p><strong>Importante!</strong> Toda vez que alterar algum campo clique em ( Verificar Campos ) antes de avançar.</p></div>
<div class="aviso atencao"><p><strong>Importante!</strong> Todos os campos devem obrigatóriamente começar com letra, caso contrario o campo não será criado.</p></div>

<div class="Box box_CamposBancos">
    <ul class="Menu-acoes">
                       
                       <a><li><input name="quantidade_Pre" id="quantidade_Pre" value="1" readonly="readonly" type="text" /></li></a> 
                       <a  onclick="AddTR();" ><li>Adicionar Campo</li></a> 
</ul>
            
<div class="Titulo_box">
            Dados Da ferramenta
        </div>    
        <div class="Body_box" style="overflow: auto;">
          
           <form action="?pg=Contrutor/Cria_tabelas_sub" method="post" name="cadastro"  enctype="multipart/form-data">

           <input name="Nome_tabela" id="Nome_tabela" value="<?php echo strtolower($_POST['Nome_tabela'])?>" type="hidden" />
           <input name="sub_ferramenta" id="sub_ferramenta" value="<?php echo $_POST['sub_ferramenta']?>" type="hidden" />
           <input name="galeria" id="galeria" value="<?php echo $_POST['galeria']?>" type="hidden" />
           <input name="upload" id="upload" value="<?php echo $_POST['upload']?>" type="hidden" />
           <input name="sistema_comente" id="sistema_comente" value="<?php echo $_POST['sistema_comente']?>" type="hidden" />
           <input name="categorias" id="categorias" value="<?php echo $_POST['categorias']?>" type="hidden" />
           <input name="post_destaque" id="post_destaque" value="<?php echo $_POST['post_destaque']?>" type="hidden" />
           
           <input name="validar" id="validar" value="EXE" type="hidden" />
           <input name="quantidade" id="quantidade" value="1" type="hidden" />
           <div class="Form_ADM"></div>
           
           
           <table  border="0" cellspacing="0" cellpadding="0" class="TableCamposDB" id="TableCamposDB">
             
             <thead> 
              <tr>
                <td>Referência</td>
                <td>Campo</td>
                <td>Tipo</td>
                <td>Tamanho</td>
               
              </tr>
               </thead>


            <tbody>



              <tr>
                <td>
				     <select name="Referencia[]" id="Referencia"  >
                        <option value="1" selected="selected">Campo de indetificação</option>
                     </select>

                </td>
                <td>
					<input name="campo[]" id="campoTabelas" style="width:171px;"  type="text" onkeyup="validar_titulo_tbl(this);" onchange="javascript:Carrega_tbl('Sistema/Includes/ajax_verifica_tabelas.php',this.value);" />
				</td>
                <td>
            		<select name="tipo[]" id="tipo" >
								 <option value="VARCHAR" >VARCHAR</option>
                                 <option value="TEXT" >TEXT</option>
                                 <option value="DATE" >DATE</option>
                                 <option value="INT" >INT</option>
                                 <option value="DATETIME" >DATETIME</option>
                                 <option value="TIME" >TIME</option>
                     </select>
                </td>
                 <td>
                    <input name="tamanho[]" style="width:px;" type="text" maxlength="6" onkeypress="return SomenteNumero(event)"/>
                </td>
              </tr>


          </tbody>

     </table>

	 <div id="mostra_tbl" style="float:left;"><input type="button" value="Verificar Campos" class="Bt-blue" /></div>
          
      </form>

    </div>
                
</div>
            
            
 <?php } ?>         
            
           
         

<?php 

}else{
	
	echo "<div class='aviso erro'><p>Permissão negada</div>";
	
}

}else{
	
	header('location: ../../login.php');
	
}

?>
           
    