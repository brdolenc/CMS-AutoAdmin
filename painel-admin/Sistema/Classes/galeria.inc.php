<?php


class Upload{

		var $Pasta = false;
		var $Tamanho = false;
		var $Extensoes = false;
		var $Renomeia = false;
		var $Arquivo = false;
		var $Banco = false;
		var $IdPai = false;
		
		function __construct(){
          
      			$this->Pasta   		= $Pasta;
      			$this->Tamanho      = $Tamanho;
      			$this->Extensoes    = $Extensoes;
            	$this->Arquivo      = $Arquivo;
				$UP->Banco          = $Banco;
				$UP->IdPai          = $IdPai;

		}
		
		
		public function VerificaError() {
			
			$this->UPerror['erros'][0] = 'Não houve erro';
			$this->UPerror['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$this->UPerror['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$this->UPerror['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$this->UPerror['erros'][4] = 'Não foi feito o upload do arquivo';
			
			if ($this->Arquivo['error'] != 0) {
				$this->MsgErro = die('<div class="aviso atencao"><p><strong>Erro!</strong>Não foi possível fazer o upload, erro: ' . $this->UPerror['erros'][$this->Arquivo['error']] . '</p></div>');
				return $this->MsgErro;
			}else{
				return true;
			}
		}
		
		
		public function Extensao() {
			if($this->Extensoes == true) {
				@$extensao = strtolower(end(explode('.', $this->Arquivo['name'])));
				 $this->ExtensoesArray = array ('jpg','png','gif');
				 
					if (array_search($extensao, $this->ExtensoesArray) === false) {
						return false;
					}else {
						return true;
					}
			}else{
				return true;
			}
		}
		

		
		public function TamanhaArquivo() {
			if ($this->Tamanho < $this->Arquivo['size']) {
				return false;
			}else{
				return true;
			}
		}
		
		
	
		public function UploadArquivo() {
			$this->nome_final = 'ARQ'.rand(99,9999).'-'.$this->Arquivo['name'];
	
			if($this->VerificaError()==true) {
				if($this->Extensao()==true) {
					if($this->TamanhaArquivo()==true) {
				
							if (move_uploaded_file($this->Arquivo['tmp_name'], $this->Pasta . $this->nome_final)) {
								chmod($this->Pasta . $this->nome_final, 0777);
								
									$this->SqlMysql = mysql_query("SELECT posicao,id FROM ".$this->Banco."")or(die(mysql_error()));
									while ($this->RetornPosicoes = mysql_fetch_array($this->SqlMysql)) {
										$this->PosAtual = (int)((int)$this->RetornPosicoes['posicao']+(int)1);
										$this->mysql_up = mysql_query("UPDATE ".$this->Banco." SET posicao = '".$this->PosAtual."' WHERE id = '".$this->RetornPosicoes['id']."'")or(die(mysql_error()));
									}
									
								
									$sql_up = mysql_query("INSERT INTO ".$this->Banco." SET id_princ= '".$this->IdPai."', posicao = '1', arquivo = '".$this->nome_final."', data = NOW()")or(die('<div class="aviso erro"><p><strong>Sucesso!</strong>'.mysql_error().'</p></div>'));
									
									if($sql_up) {
										return '<div class="aviso certo"><p><strong>Sucesso!</strong> Upload efetuado com sucesso!</p></div>';
									}else{
										return '<div class="aviso erro"><p><strong>Erro!</strong> Não foi possível enviar o arquivo, tente novamente.</p></div>';
									}
								
							}else{
									return '<div class="aviso erro"><p><strong>Erro!</strong> Não foi possível enviar o arquivo, tente novamente.</p></div>';
							}
							
					}else{
						return  '<div class="aviso atencao"><p><strong>Erro!</strong> Por favor, envie arquivos com no maximo: '.(($this->Tamanho/1024)/1024).'mb</p></div>';
					}
				}else{
					return '<div class="aviso atencao"><p><strong>Erro!</strong> Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif</p></div>';
				}
			}else{
				return $this->VerificaError();
			}
			
	 }


}

?>