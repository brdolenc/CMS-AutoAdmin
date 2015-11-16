<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>3 Cora&ccedil;&otilde;es</title>
<meta http-equiv="pragma" content="public" />
<meta name="robots" content="NOARCHIVE"/>
<meta name="author" content="3 Corações" />
<meta name="copyright" content="3 Corações" />
<meta name="content-language" content="pt-br" />
<meta name="title" content="3 Corações" />
<meta name="description" content="" />
<meta name="keywords" content="café, torrado, moído, refresco, achocolatado, milho" />

<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<link href="css/screen.css" rel="stylesheet" type="text/css" />
<link href="css/footer3cor.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="css/iehacks6.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/iehacks7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/iehacks8.css" />
<![endif]-->
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'pt-BR'}
</script>


<style type="text/css">
.footer { float:left; clear:both; width:970px; background-repeat:repeat-x; background-position:top; margin-top:0px; margin-left:0px; height:50px; }
.footer .miniMenu { clear:both; float:left; margin-top:5px; width:960px; }
.footer .miniMenu ul { float:right; margin:5px 0 0 0; padding:0px; padding-left:10px; }
</style>
<meta property="og:title" content="Grupo 3corações" />
<meta property="og:description" content="A essência da nossa marca está no prazer das coisas simples, nas sensações agradáveis que experimentamos com os nossos sentidos, na espontaneidade do que é natural e verdadeiro." />
<meta property="og:image" content="http://www.3coracoes.com.br/img/logo.png" />
<meta property="og:type" content="company" />
<meta property="fb:admins" content="1545052582"/>


<!-- Código da LandingPage -->

<link href="css/landing_home.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
<script type="text/javascript">

function openLand()
{
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	
	$('#mask').css({'width':maskWidth,'height':maskHeight});

	$('#mask').fadeIn(800);	
	$('#mask').fadeTo("slow",0.4);	
	
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
              
	$("#dialog").css('top',  winH/2-$("#dialog").height()/2);
	$("#dialog").css('left', winW/2-$("#dialog").width()/2);
	
	$("#dialog").fadeIn(2000); 
	
	$('.window .btClose').click(function (e) {
		e.preventDefault();
		$('#mask').hide();
		$('.window').hide();
	});	
	
	$('.window .portal').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});		
	
	$('.botao').click(function (e) {
		e.preventDefault();
		$(this).toggleClass("off");
		
		if($(this).hasClass("off")){
			$.ajax({
				url:"services/home_landpage.php?allow_landpage=0",
				success: function(response){
					
				}
			});
		}else{
			$.ajax({
				url:"services/home_landpage.php?allow_landpage=1",
				success: function(response){
					
				}
			});
		}
		
		return false;
	});
}

$(document).ready(function(){
		
	<? if($_COOKIE['3coracoes_allow_landpage'] != "0"){ ?>
		openLand();
	<? } ?>
	
});

</script>


</head>

<body>

<!-- LANDING -->

<div id="boxes">

    <div id="dialog" class="window">
    
        <div class="boxArea">
    
            <a href="#" class="btClose">Fechar</a>
            
            <div class="texto"><img src="img/landing/texto.gif" width="623" height="105" /></div>
            
            <ul>
                <li><a href="#" class="portal">Navegar no portal institucional</a></li>
                <li><a href="http://www.cafe3coracoes.com.br/" class="trescor">Site do Café 3corações</a></li>
                <li><a href="http://www.cafesantaclara.com.br/" class="staClara last">Site do Café Santa Clara</a></li>
            </ul>
            
            <div class="cookies">
            
                <a href="" class="botao">on</a> <p>Sempre mostrar esta mensagem <em>(Seu browser deve ter 'cookies' habilitado)</em></p>
                
            </div>
    
        </div>
        
    </div>

</div>

<div id="mask"></div>

<!--HOME -->

    <div id="wrapper"><!--wrapper inicio -->
    
		<?php include "includes/header.php" ?>   
        
   	  	<div class="areaPrincipal2"><!--areaPrincipal inicio -->
        
            <div class="bannerHome"><!--bannerHome inicio -->
                
              <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1200" height="455">
                <param name="movie" value="swf/banner_home.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <param name="swfversion" value="6.0.65.0" />
                <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                <param name="expressinstall" value="Scripts/expressInstall.swf" />
                <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="swf/banner_home.swf" width="1200" height="455">
                  <!--<![endif]-->
                  <param name="quality" value="high" />
                  <param name="wmode" value="transparent" />
                  <param name="swfversion" value="6.0.65.0" />
                  <param name="expressinstall" value="Scripts/expressInstall.swf" />
                  <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                  <div>
                    <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                    <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                  </div>
                  <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
              </object>
      </div><!--bannerHome fim -->
            
            <div class="conteudo" id="conteudohome"><!--conteudo inicio -->
            
            	<div class="colunaHome">
                
                	<div class="tituloTop"><h2 class="conheca">Conheça nossas marcas &amp; produtos</h2></div>
                    
                    <div class="imgProduto"><img src="img/melhore-e-maiores.png" width="277" style="margin-top:23px;"  alt="Grupo 3 Corações ganha prêmio Melhores e Maiores nas categorias agronegócio e café da revista Exame" title="Grupo 3 Corações ganha prêmio Melhores e Maiores nas categorias agronegócio e café da revista Exame" /></div>
                    
                    <h4>Destaque</h4>
                  	<h3 class="titAzul">Grupo 3 Corações ganha prêmio Melhores e Maiores nas categorias agronegócio e café da revista Exame</h3>
                    
                    <p>
O Grupo 3 Corações foi destaque do prêmio Melhores e Maiores nas categorias agronegócio e café, promovido pela revista Exame. A empresa, que tem patrimônio líquido avaliado em 154,9 milhões de dólares, ocupa a posição 86º entre 400 que fazem parte da lista.<br /><br />

Presente em 320.000 postos de vendas em diferentes partes do Brasil, o grupo registrou faturamento de 2,2 bilhões de reais em 2012, 10% a mais na comparação com o ano anterior e venda de 240.000 sacas de café por mês.  A receita apenas da marca 3 Corações totalizou 980 milhões de reais no mesmo período, 5,7% maior em relação a 2011. A liderança deste mercado foi conquistada no ano passado (2012) e, atualmente, ela detém mais de 20% de participação desse setor no país.


                  
                    </p>
                    
      			<div class="subArea1">
                    
                    	<h3 class="titVerde">Nossas Marcas</h3>
                        
                        <div class="logoBox"><a href="http://www.cafe3coracoes.com.br/"><img src="img/marca/3corHome.png" width="106" height="108" border="0" title="Logo 3 Corações" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.cafesantaclara.com.br/"><img src="img/marca/staClara01Home.png" width="106" height="108" border="0" title="Logo Santa Clara" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.pimpinela.com.br/"><img src="img/marca/pimpinelaHome.png" width="106" height="108" border="0" title="Logo Pimpinela" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.cafekimimo.com.br/"><img src="img/marca/kiminoHome.png" width="106" height="108" border="0" title="Logo Kimimo" alt="Três Corações" /></a></div>

                        <div class="logoBox"><a href="http://www.cafeleticia.com.br/"><img src="img/marca/leticiaHome.png" width="106" height="108" border="0" title="Logo Letícia" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/cafe-fort/"><img src="img/marca/cafeforte.png" width="106" height="108" border="0" title="Logo Letícia" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.finograo.com.br/"><img src="img/marca/finograoHome.png" width="106" height="108" border="0" title="Logo Fino Grão" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/divinopolis/"><img src="img/marca/divinopolisHome.png" width="106" height="108" border="0" title="Logo Divinópolis" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/cafe-do-doutor/"><img src="img/marca/doutorHome.png" width="106" height="108" border="0" title="Logo Café do Doutor" alt="Café do Doutor" /></a></div>
                                                <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/bangu/"><img src="img/marca/bangu.png" width="106" height="108" border="0" title="Café Bangu" alt="Café Bangu" /></a></div>  
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/geronymo/"><img src="img/marca/geronymo.png" width="106" height="108" border="0" title="Geronymo" alt="Geronymo" /></a></div> 
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/cafe/cafebh/"><img src="img/marca/cafebh.png" width="106" height="108" border="0" title="Café BH" alt="Café BH" /></a></div> 
                        <div class="logoBox"><a href="http://www.3coracoes.com.br/produtos/achocolatado/achocolatto/"><img src="img/marca/AchocolattoHome.png" width="106" height="108" border="0" title="Logo Achocolatto" alt="Logo Achocolatto" /></a></div>
          				<div class="logoBox"><a href="http://www.claralate.com.br/"><img src="img/marca/claralateHome.png" width="106" height="108" border="0" title="Logo Claralate" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.donaclara.santaclara.com.br/"><img src="img/marca/DonaClaraHome.png" width="106" height="108" border="0" title="Dona Clara" alt="Dona Clara" /></a></div>  

                        
                        <div class="logoBox"><a href="http://www.frisco.com.br"><img src="img/marca/friscoHome.png" width="106" height="108" border="0" title="Logo Frisco" alt="Três Corações" /></a></div>
                        <div class="logoBox"><a href="http://www.refrescotornado.com.br/"><img src="img/marca/tornadoHome.png" width="106" height="108" border="0" title="Logo Tornado" alt="Três Corações" /></a></div>
 
                    </div>
                
                </div>
            
            	<div class="colunaHome">
                
                	<div class="tituloTop"><h2 class="promo">Novidades</h2></div>
                    
                    <!--noticia 01 -->
                    
                    <div class="imageBox"><a href="http://www.3coracoes.com.br/companhia/novidades/trofeu-empreendedores.php" target="_blank"><img src="img/cecafe-novidades-home.jpg" width="277" height="218" 
                      alt="Grupo 3corações ganha troféu Empreendedores do Café da CeCafé"  border="0" /></a></div>
                    
                    <h4>Novidades</h4>
                    <h3 class="titVerde"><a href="http://www.3coracoes.com.br/companhia/novidades/trofeu-empreendedores.php" target="_blank">Grupo 3corações ganha troféu Empreendedores do Café da CeCafé </a></h3>
                    
                    <p class="linkp"><a href="http://www.3coracoes.com.br/companhia/novidades/trofeu-empreendedores.php" target="_blank">
                    	O Grupo 3corações leva Troféu de Empreendedores do Café, com o destaque “Indústria”, oferecido pelo CeCafé (Conselho de Exportadores de Café do Brasil). A homenagem foi dada às personalidades que contribuíram de modo decisivo para o desenvolvimento e fortalecimento do café no Brasil e aos que influenciaram ações de interesse da sociedade do país. <br /><br />

O presidente da 3corações, Pedro Lima, recebeu o troféu das mãos de Jorge Esteve, vice presidente do Conselho Deliberativo do CeCafé. A entrega aconteceu durante o 5º Fórum & Coffee Dinner, realizado no dia 28 de maio em São Paulo, SP. O evento reuniu produtores, cooperativas, indústrias, importadores do grão, além de entidades relacionadas e autoridades federais e estaduais.
</a></p>

					<p><a href="http://www.3coracoes.com.br/companhia/novidades/trofeu-empreendedores.php" target="_blank">Saiba mais »</a></p>
                    
                    <!--noticia 02 -->
                    
                    <!--<div class="imageBox"><a href="companhia/novidades/cappuccino_italia.php" target="_blank"><img src="img/novidades/capitalia_home.gif" width="277" height="218" alt="Concurso Perfeito para te levar à Italia" title="Concurso Perfeito para te levar à Italia"  border="0" /></a></div> -->
                    
                    <!--<h4>Novidades</h4>
                    <h3 class="titVerde"><a href="companhia/novidades/cappuccino_italia.php" target="_blank">Concurso cultural Perfeito para te levar à Itália</a></h3>
                    
                    <p class="linkp"><a href="companhia/novidades/cappuccino_italia.php" target="_blank">Antes de chegar à Itália contamos a você um pouquinho da história do cappuccino. Diz a lenda que em meados de 1500, na Itália, frades franciscanos da ordem dos <strong>Capuchinhos</strong> foram a inspiração para o nome da bebida. Esses frades consumiam uma mistura de café com leite vaporizado e espuma de leite que se assemelhava muito à cor do hábito com capuz que vestiam.</a></p>

					<p><a href="companhia/novidades/cappuccino_italia.php" target="_blank">Saiba mais »</a></p> -->
                    
                    
                    
                    
                    
                    
                    <div class="subArea1">
                    
<!--<object id="FlashID2" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="310" height="241">
                              <param name="movie" value="swf/formSimples.swf" />
                              <param name="quality" value="high" />
                              <param name="wmode" value="transparent" />
                              <param name="swfversion" value="6.0.65.0" />
                              <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                              <!--<param name="expressinstall" value="Scripts/expressInstall.swf" />
                              <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                              <!--[if !IE]>-->
                              <!--<object type="application/x-shockwave-flash" data="swf/formSimples.swf" width="310" height="241">
                                <!--<![endif]-->
                                <!--<param name="quality" value="high" />
                                <param name="wmode" value="transparent" />
                                <param name="swfversion" value="6.0.65.0" />
                                <param name="expressinstall" value="Scripts/expressInstall.swf" />
                                <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                               <!-- <div>
                                  <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                                  <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                              </div>
                                <!--[if !IE]>-->
                            <!--</object>
                              <!--<![endif]-->
                          <!--</object>-->
                      
           		  </div>
                  
                  
                  
                  
                  
                  
                    
                      <h2 class="responsabi" style="padding-top:0px;">Responsabilidade Social</h2>
                  
                      <div class="responsa" style="background-image:url(img/fotoResp.png);">
                      <!--aqui, o css que está inline (bg-image) é onde fica a imagem dinâmica que vai entrar aqui nessa área. o PHP precisa alterar apenas essa imagem, a que está dentro do div abaixo (imgResponsa) fica intacta -->
                            
                          <div class="imgResponsa"><img src="img/pictureFrame.png" width="315" height="300" /></div>  
                      
                            <h3 class="titVerde"><a href="companhia/responsabilidade-social/trilha_coracao.php">Projeto Trilhas do Coração</a></h3>
                            
                            <p class="linkp"><a href="companhia/responsabilidade-social/trilha_coracao.php">Com o projeto Trilhas do Coração, a 3corações abre as portas de suas fábricas em Eusébio (CE), Natal (RN) e Mossoró (RN) e permite que você conheça de perto o processo de beneficiamento dos grãos de café!</a></p>
        
                            <p><a href="companhia/responsabilidade-social/trilha_coracao.php">Conheça o projeto »</a></p>
                          
                      </div>            
                
          		</div>
            
            	<div class="colunaHome">
					<?php $numberposts = 3 ?>
                	<?php include "includes/mexido.php" ?>
                </div>
                
			<?php include "includes/footer.php" ?>