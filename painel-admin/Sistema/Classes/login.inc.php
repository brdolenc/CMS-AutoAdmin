<?php

class sistemaLogin{

		var $Login = false;
		var $Senha = false;
		var $PaginaLogin = false;
		var $Permissao  = false;
		var $Nome  = false;
		var $Novasenha = false;
		var $Id_edit = false;
		var $Log_atual = false;
		
		function __construct(){
      			$this->Login   		= $Login;
      			$this->Senha        = $Senha;
				$this->PaginaLogin  = $PaginaLogin;
				$this->Permissao    = $Permissao;
				$this->Nome         = $Nome;
				$this->Novasenha    = $Novasenha;
				$this->Id_edit      = $Id_edit;
				$this->Log_atual      = $Log_atual;
		}
		
		public function anti_sql_injection($str) {
			if (!is_numeric($str)) {
				$str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
				$str = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($str) : mysql_escape_string($str);
			}
			return $str;
		}
		
			
			public function recuperaSenha() {
				$Sql_Salt = mysql_query("SELECT sql_salt FROM tbl_login WHERE sql_login = '".$this->anti_sql_injection($this->Login)."'")or(die(mysql_error()));
				$Rec_Salt = mysql_fetch_array($Sql_Salt);
				$SaltRec  = $Rec_Salt['sql_salt'];
					$hashRec = md5($this->Senha . $SaltRec);
						for ($x = 0; $x < 1000; $x++) {
							$hashRec = md5($hashRec);
						} 
						return  $hashRec;				
			}
		
			public function VerificaDados() {
				$Sql_verify_Log = mysql_query("SELECT sql_login FROM tbl_login WHERE sql_login = '".$this->anti_sql_injection($this->Login)."'")or(die(mysql_error()));	
				$CountVerify_Log = mysql_num_rows($Sql_verify_Log);
					if($CountVerify_Log == 0){	
						$Sql_verify = mysql_query("SELECT sql_login FROM tbl_login WHERE sql_senha = '".$this->anti_sql_injection($this->recuperaSenha())."' AND sql_login = '".$this->anti_sql_injection($this->Login)."'")or(die(mysql_error()));
						$CountVerify = mysql_num_rows($Sql_verify);
						$RetornaVerify = mysql_fetch_array($Sql_verify);
							if($CountVerify == 0){
									return false;
							}elseif($CountVerify == 1){
									return true;
							}
					}else{
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
					
					$Sql_Cad = mysql_query("INSERT INTO tbl_login SET nome_usuario = '".$this->anti_sql_injection($this->Nome)."', sql_salt = '".$CaltCad."', sql_senha = '".$SenhaCad."', sql_login = '".$this->anti_sql_injection($this->Login)."', sql_nivel = '".$this->Permissao."'")or(die(mysql_error()));
					
					return true;
					
				}else{
					return false;
				}
				
			}
			
			
			
			public function VerificaDadosEditar() {
				$Sql_Salt = mysql_query("SELECT sql_salt FROM tbl_login WHERE sql_login = '".$this->anti_sql_injection($this->Log_atual)."'")or(die(mysql_error()));
				$Rec_Salt = mysql_fetch_array($Sql_Salt);
				$SaltRec  = $Rec_Salt['sql_salt'];
					$hashRec = md5($this->Senha . $SaltRec);
						for ($x = 0; $x < 1000; $x++) {
							$hashRec = md5($hashRec);
						} 
						$Sql_verify = mysql_query("SELECT sql_login FROM tbl_login WHERE sql_senha = '".$this->anti_sql_injection($hashRec)."'")or(die(mysql_error()));
						$CountVerify = mysql_num_rows($Sql_verify);
						$RetornaVerify = mysql_fetch_array($Sql_verify);
							if($CountVerify == 1){
									return false;
							}elseif($CountVerify == 0){
									return true;
							}
					
			}
			
			
			
			public function EditLogin() {
				if($this->VerificaDadosEditar() == false) {
					
					$SaltInicio = substr(sha1(mt_rand()), 0, 22);
					$CaltCad = $SaltInicio;
					
					$hash = md5($this->Novasenha . $CaltCad);
					for ($i = 0; $i < 1000; $i++) {
						$hash = md5($hash);
					}
					$SenhaCad = $hash;
					
					$Sql_Cad = mysql_query("UPDATE tbl_login SET nome_usuario = '".$this->anti_sql_injection($this->Nome)."', sql_salt = '".$CaltCad."', sql_senha = '".$SenhaCad."', sql_login = '".$this->anti_sql_injection($this->Login)."', sql_nivel = '".$this->Permissao."' WHERE id_login = '".$this->Id_edit."'")or(die(mysql_error()));
					
					return true;
					
				}else{
					return false;
				}
				
			}
			
			
			public function FechaCookies() {
				session_start("LogAdmin");
				session_unset("LogAdmin");
				session_destroy("LogAdmin"); 
			}
			
			public function criaCookies() {
				$SqlCookie = mysql_query("SELECT id_login,sql_nivel,sql_login FROM tbl_login WHERE sql_senha = '".$this->anti_sql_injection($this->recuperaSenha())."' AND sql_login = '".$this->anti_sql_injection($this->Login)."'")or(die(mysql_error()));
				$RetornaCookie = mysql_fetch_array($SqlCookie);
				session_start("LogAdmin");
				$_SESSION['idLogin'] = $RetornaCookie['id_login'];
				$_SESSION['UserLogin'] = $RetornaCookie['sql_login'];
				$_SESSION['NivelLogin'] = $RetornaCookie['sql_nivel'];
					if($_SESSION['idLogin']) {
						if($_SESSION['UserLogin']) {
							if($_SESSION['NivelLogin']) {
									return true;
							}else{
								return false;
							}
						}else{
							return false;
						}
					}else{
						return false;
					}
			}


}


?>