<?php

/*****************************************************************************************
**																						**
**					PAGINA PRINCIPAL DO TEMPLATE ( NÃO EXCLUIR )						**
**																						**
*****************************************************************************************/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			
            <title><?php echo geraSitename($_Titulosite); ?></title>

            <!--------CSS------------------>
            <link rel="stylesheet" href="<?php echo $_UrlSite ?>/template/css/reset.css" />
            
            <!--------JS------------------->
            <script src="<?php echo $_UrlSite ?>/template/js/jquery-1.10.1.min.js"></script>
            
            
            <!--------CONFIGURAÇÂO PARA BUSCADORES------------------------>
            <meta name="description" content="<?php echo $_FraseBusca; ?>"/>
            <meta name="keywords" content="<?php echo $_PalavrasBusca; ?>"/>
            <link rel="canonical" href="<?php echo $_UrlSite.'/'.geraCanonical(); ?>" />
            <meta property='og:locale' content='pt_BR'/>
            <meta property='og:title' content='<?php echo $_Titulosite; ?>'/>
            <meta property='og:description' content='<?php echo $_FraseBusca; ?>'/>
            <meta property='og:url' content='<?php echo $_UrlSite; ?>'/>
            <meta property='og:site_name' content='<?php echo $_Titulosite; ?>'/>
            <meta property='og:type' content='website'/>
            <meta property='og:image' content='<?php echo $_UrlSite.'/Arquivos/Imgs/'.$_LogoSitePrincipal; ?>'/>
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:title" content="<?php echo $_Titulosite; ?>" />
            <meta name="twitter:description" content="<?php echo $_FraseBusca; ?>" />
            <meta name="twitter:image" content="<?php echo $_UrlSite.'/Arquivos/Imgs/'.$_LogoSitePrincipal; ?>" />
                        
        </head>


			<?php if(urlLink(1) == '') { include("home.php"); } else { include(urlLink(1).".php"); } ?>
		
        
        <body>
        </body>
        </html>