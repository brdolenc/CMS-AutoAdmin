<?php

class Inteligencia{
		
		public function CampoAutoComplete($NomeCampo,$ValRetorno) {
			$AutoComp = mysql_query("SELECT ".$NomeCampo." FROM tbl_inteligencia ORDER BY ".$NomeCampo." ASC")or(die(mysql_error()));
			$xCont = 1;
			$CamposComp = array();
			$CamposCompPrt = false;
			while($MostraAutoComp = mysql_fetch_array($AutoComp)) {
				$CamposComp[$xCont++] = $MostraAutoComp[$NomeCampo];
				$CamposCompPrt .= '"'.$MostraAutoComp[$NomeCampo].'",';
				
			}
			
			if($ValRetorno==1){
				return $CamposCompPrt;
			}else{
				return $CamposCompPrt;
			}
		}
		


		public function CadAutoComplete($CamposRetr,$Oper,$NomeCampoTab) {
			if($Oper==1) {
			  foreach($CamposRetr as $valor){
				  $VerCampos = mysql_query("SELECT ".$NomeCampoTab." FROM tbl_inteligencia WHERE ".$NomeCampoTab." = '".$valor."' ")or(die(mysql_error()));
				  $Count_VerCampos = mysql_num_rows($VerCampos);
				  	if($Count_VerCampos==0) {
						$CadCampoAuto = mysql_query("INSERT INTO tbl_inteligencia SET ".$NomeCampoTab." = '".$valor."' ")or(die(mysql_query()));
					}
              }
			}else{
				  $VerCampos = mysql_query("SELECT ".$NomeCampoTab." FROM tbl_inteligencia WHERE ".$NomeCampoTab." = '".$CamposRetr."' ")or(die(mysql_error()));
				  $Count_VerCampos = mysql_num_rows($VerCampos);
				  	if($Count_VerCampos==0) {
						$CadCampoAuto = mysql_query("INSERT INTO tbl_inteligencia SET ".$NomeCampoTab." = '".$CamposRetr."' ")or(die(mysql_query()));
					}
			}
	
		}
}

?>