																							
		<?php
			class  dbConnect{
				var $localhost = false;
				var $username  = false;
				var $password  = false;
				var $db_name   = false;
																										 
					public function conectMysql(){
						$this->localhost = 'localhost';
						$this->username  = 'root';
						$this->password  = '';
						$this->db_name   = 'teste';
						$this->conecta = mysql_connect($this->localhost,$this->username,$this->password,$this->db_name);
							if($this->conecta){
									mysql_select_db($this->db_name,$this->conecta);
							}else{
									die( '<div class=\"aviso erro\">' . mysql_error() . '</div>');
								 }
					}
																									
						function fechaConexao(){
								mysql_close($this->conecta);
																											 
						}
		}  
		?>
		