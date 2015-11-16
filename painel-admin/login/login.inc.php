<?php

class sistemaLogin{

		var $Login = false;
		var $Senha = false;
		var $PaginaLogin = false;
		var $Permissao  = false;
		
		function __construct(){
      			$this->Login   		= $Login;
      			$this->Senha        = $Senha;
				$this->PaginaLogin  = $PaginaLogin;
				$this->Permissao    = $PaginaLogin;
		}
		
			
			public function recuperaSenha() {
				$Sql_Salt = mysql_query("SELECT sql_salt FROM tbl_login WHERE sql_login = '".$this->Login."'")or(die(mysql_error()));
				$Rec_Salt = mysql_fetch_array($Sql_Salt);
				$SaltRec  = $Rec_Salt['sql_salt'];
					$hashRec = md5($this->Senha . $SaltRec);
						for ($x = 0; $x < 1000; $x++) {
							$hashRec = md5($hashRec);
						} 
						return  $hashRec;				
			}
		
			public function VerificaDados() {
				$Sql_verify = mysql_query("SELECT sql_login FROM tbl_login WHERE sql_senha = '".$this->recuperaSenha()."' AND sql_login = '".$this->Login."'")or(die(mysql_error()));
				$CountVerify = mysql_num_rows($Sql_verify);
				$RetornaVerify = mysql_fetch_array($Sql_verify);
					if($CountVerify == 0 or $CountVerify > 1){
							return false;
					}elseif($CountVerify == 1){
							return true;
					}
			}
			
			
			public function CadLogin() {
				if($this->VerificaDados() == false) {
					
					$SaltInicio = substr(sha1(mt_rand()), 0, 22);
					$CaltCad = $SaltInicio;
					
					$hash = md5($this->Senha . $CaltCad);
					for ($i = 0; $i < 1000; $i++) {
						$hash = md5($hash);
					}
					$SenhaCad = $hash;
					
					$Sql_Cad = mysql_query("INSERT INTO tbl_login SET sql_salt = '".$CaltCad."', sql_senha = '".$SenhaCad."', sql_login = '".$this->Login."', sql_nivel = '".$this->Permissao."'")or(die(mysql_error()));
				}else{
					return false;
				}
				
			}
			
			
			public function FechaCookies() {
				setcookie('idLogin');
			}


}


?>