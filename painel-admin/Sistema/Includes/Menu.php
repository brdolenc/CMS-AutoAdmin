<?php

if(isset($_SESSION['idLogin']) and isset($_SESSION['UserLogin']) and isset($_SESSION['NivelLogin'])) {

?> 

<link href="../../Arquivos/css/layout.css" rel="stylesheet" type="text/css" />
<ul class="Menu">
	<a href="?pg=home" class="Linha"><li class="icon ico-home"></li></a>
    <a href="#"><li class="icon ico-config">
        <ul class="submenu">
            <a href="?pg=Config/Config" class="LkBranco"><li class="MenuSub">Alterar Dados</li></a>
            <?php
		
				if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
				
			 ?>
            <a href="?pg=Config/Sitemap" class="LkBranco"><li class="MenuSub">Sitemap</li></a>
             <?php } ?>
            <a href="?pg=Config/Usuarios" class="LkBranco"><li class="MenuSub">Usuários</li></a>
        </ul>
    </li></a>
    
     <?php
		
		if(verificaNivel($_SESSION['idLogin'],$_SESSION['NivelLogin'])==true) {
		
	 ?>
     
     
     <a href="#"><li class="icon ico-ferramenta">
        <ul class="submenu">
            <a href="?pg=Contrutor/EditarFerramentas" class="LkBranco"><li class="MenuSub">Editar Ferramentas</li></a>
            <a href="?pg=Contrutor/Construtor_ADM" class="LkBranco"><li class="MenuSub">Criar Ferramenta</li></a>
            <a href="?pg=Contrutor/Construtor_ADM_sub" class="LkBranco"><li class="MenuSub">Criar Sub-Ferramenta</li></a>
        </ul>
    </li></a>
    
    <?php } ?>
    
    
    <a href="#"><li class="icon ico-paginas">
        <ul class="submenu">
            <?php echo $MENU->Paginas('Restrito/paginas/'); ?>
        </ul>
    </li></a>
    
    
    <!--<a href="#"><li class="icon ico-email">
        <ul class="submenu">
            <a href="#" class="LkBranco"><li class="MenuSub">Criar E-mail</li></a>
            <a href="#" class="LkBranco"><li class="MenuSub">E-mails Site</li></a>
            <a href="#" class="LkBranco"><li class="MenuSub">Lista de E-mails</li></a>
            <a href="#" class="LkBranco"><li class="MenuSub">E-mail de Resposta</li></a>
            <a href="#" class="LkBranco"><li class="MenuSub">E-mail Marketing</li></a>
        </ul>
    </li></a>-->
    
    
    
    <!--<a href="#"><li class="icon ico-tel"></li></a>
    <a href="#"><li class="icon ico-grafico"></li></a>-->
    
    <a href="logout.php"><li class="icon ico-sair"></li></a>
</ul>


<div id="SombraMenu"></div>

	
   
<?php

}else{
	
	header('location: ../../login.php');
	
}


?> 
 

	
    
 