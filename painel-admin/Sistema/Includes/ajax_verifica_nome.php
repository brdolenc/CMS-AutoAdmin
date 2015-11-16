<?php

		$DIR = "../../Restrito/paginas/";
			$Final_Ver_erro = 0;
			$Final_Ver_ok = 0;

			$path=$DIR; 

		$diretorio=dir($path); 
			while ($arquivo = $diretorio->read()) 
			{ 
				if((!strstr($arquivo,'.'))) {
					
					$nome_muda = ucfirst($_GET['DSG']);
					if(ucfirst($arquivo) == $nome_muda and ucfirst($arquivo) == $nome_muda) {
						$Final_Ver_erro = 1 + $Final_Ver_erro;
						
					}else {

					    $Final_Ver_ok = 1 + $Final_Ver_ok;
					}

		}

		 
		}


			if(
			$_GET['DSG'] == 'configuracao' or
			$_GET['DSG'] == 'ferramentas' or
			$_GET['DSG'] == 'grupo' or
			$_GET['DSG'] == 'marcadagua' or
			$_GET['DSG'] == 'log' or
			$_GET['DSG'] == 'paginas' or
			$_GET['DSG'] == 'login_verifica' or
			$_GET['DSG'] == 'status_usuario' or
			$_GET['DSG'] == 'usuario' or
			$_GET['DSG'] == 'visitas_clientes' or
			$_GET['DSG'] == 'visitas_paginas') {

				$Final_Ver_erro = 1 + $Final_Ver_erro;
				
			}else {

			    $Final_Ver_ok = 1 + $Final_Ver_ok;

			}


			if($Final_Ver_erro >= 1) {

				echo '<input type="button" value="Escolha outro nome para tabela" class="Bt-red" /><input type="button" value="Verificar nome" class="Bt-blue" />';
				
			}else {

			    echo '<input type="submit" name="submit" value="Avançar próxima etapa" class="Bt-green">';

			}

?>

