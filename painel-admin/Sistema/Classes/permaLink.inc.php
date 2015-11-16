<?php


function permalink($str,$banco,$Tabela,$id){
	
	$SqlPr = mysql_query("SELECT * FROM ".$banco." WHERE ".$Tabela." = ".$id."")or(die(mysql_error()));
	$Retorna = mysql_fetch_array($SqlPr);
	
	if($Retorna['permalink'] != $str) {
		
	$Ex = explode("-",$Retorna['permalink']);
	$ContEX = count($Ex);
	$StrEx = $str.'-'.$Ex[$ContEX-1];
	if($Retorna['permalink'] != $StrEx)	{
		
	if($str == false or $str == '') {
		
	$Sql = mysql_query("SELECT permalink FROM ".$banco."")or(die(mysql_error()));
	$Cont = mysql_num_rows($Sql);
	
		for($x=0;$x<=$Cont;$x++) {
			
			$PlinkNumber = rand(0,999999);
			$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber'")or(die(mysql_error()));
			$ContV = mysql_num_rows($SqlV);
			
			if($ContV == 0) { $res = $PlinkNumber; break; }
				
			
			}
		
	}else{
	
	$arr = array('.','´','`','¨','^','~','$','!',',',';',':','?',
	'[','@','#','%','&','*','(',')','_','|','+','{','}','<','>','/',
	'=','º','ª','¹','²','³','£','¢','¬','§',']',"'");
	$str = str_replace($arr, '-', $str);

	$acentosA   = array('À','Á','Â','Ã','Ä','Å');
	$acentosAm  = array('à','á','â','ã','ä','å');
	$acentosE   = array('È','É','Ê','Ë');
	$acentosEm  = array('è','é','ê','ë');
	$acentosI   = array('Ì','Í','Î','Ï');
	$acentosIm  = array('ì','í','î','ï');
	$acentosO  = array('Ò','Ó','Ô','Õ','Ö');
	$acentosOm  = array('ò','ó','ô','õ','ö');
	$acentosU  = array('Ù','Ú','Û','Ü');
	$acentosUm = array('ù','ú','û','ü');
	$acentosYm = array('ý'.'ÿ/');
	$acentosTrace = array(' ','"'.'ˆ'.'´'.'•');
	
	$res = str_replace($acentosA, 'A', $str);
	$res = str_replace($acentosAm, 'a', $res);
	$res = str_replace($acentosE, 'E', $res);
	$res = str_replace($acentosEm, 'e', $res);
	$res = str_replace($acentosI, 'I', $res);
	$res = str_replace($acentosIm, 'i', $res);
	$res = str_replace($acentosO, 'O', $res);
	$res = str_replace($acentosOm, 'o', $res);
	$res = str_replace($acentosOm, 'o', $res);
	$res = str_replace($acentosU, 'U', $res);
	$res = str_replace($acentosUm, 'u', $res);
	$res = str_replace($acentosYm, 'Y', $res);
	$res = str_replace($acentosTrace, '-', $res);
	
	$res = str_replace('Ç', 'C', $res);
	$res = str_replace('ç', 'c', $res);
	$res = str_replace('Ñ', 'N', $res);
	$res = str_replace('ñ', 'n', $res);
	$res = str_replace('Ý', 'Y', $res);
	$res = str_replace('ª', 'a', $res);
	$res = str_replace('º', 'o', $res);

	$res = str_replace('---------------', '-', $res);
	$res = str_replace('--------------', '-', $res);
	$res = str_replace('-------------', '-', $res);
	$res = str_replace('------------', '-', $res);
	$res = str_replace('-----------', '-', $res);
	$res = str_replace('----------', '-', $res);
	$res = str_replace('---------', '-', $res);
	$res = str_replace('--------', '-', $res);
	$res = str_replace('-------', '-', $res);
	$res = str_replace('------', '-', $res);
	$res = str_replace('-----', '-', $res);
	$res = str_replace('----', '-', $res);
	$res = str_replace('---', '-', $res);
	$res = str_replace('--', '-', $res);
	
	
	$Sql = mysql_query("SELECT permalink FROM ".$banco."")or(die(mysql_error()));
	$Cont = mysql_num_rows($Sql);

		for($x=0;$x<=$Cont;$x++) {

			$PlinkNumber = $res;
			$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber' AND ".$Tabela." != ".$id."")or(die(mysql_error()));
			$ContV = mysql_num_rows($SqlV);

			if($ContV == 0) { $res = $PlinkNumber; break; } else { $TwoFor = true; };
		}
		
		if($TwoFor == true) {
		
			for($x=0;$x<=$Cont;$x++) {
	
				$PlinkNumber = $res.'-'.rand(0,999);
				$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber' AND ".$Tabela." != ".$id."")or(die(mysql_error()));
				$ContV = mysql_num_rows($SqlV);
	
				if($ContV == 0) { $res = $PlinkNumber; break; }
			}
	
		}
	
	

	}
	
	return strtolower($res);
	
	}else{
		return $Retorna['permalink'];
	}
	
	}else{
		return $Retorna['permalink'];
	}
	
	
}




function permalinkCad($str,$banco){
	


		
	if($str == false or $str == '') {
		
	$Sql = mysql_query("SELECT permalink FROM ".$banco."")or(die(mysql_error()));
	$Cont = mysql_num_rows($Sql);
	
		for($x=0;$x<=$Cont;$x++) {
			
			$PlinkNumber = rand(0,999999);
			$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber'")or(die(mysql_error()));
			$ContV = mysql_num_rows($SqlV);
			
			if($ContV == 0) { $res = $PlinkNumber; break; }
				
			
			}
		
	}else{
	
	$arr = array('.','´','`','¨','^','~','$','!',',',';',':','?',
	'[','@','#','%','&','*','(',')','|','_','+','{','}','<','>','/',
	'=','º','ª','¹','²','³','£','¢','¬','§',']',"'");
	$str = str_replace($arr, '-', $str);

	$acentosA   = array('À','Á','Â','Ã','Ä','Å');
	$acentosAm  = array('à','á','â','ã','ä','å');
	$acentosE   = array('È','É','Ê','Ë');
	$acentosEm  = array('è','é','ê','ë');
	$acentosI   = array('Ì','Í','Î','Ï');
	$acentosIm  = array('ì','í','î','ï');
	$acentosO  = array('Ò','Ó','Ô','Õ','Ö');
	$acentosOm  = array('ò','ó','ô','õ','ö');
	$acentosU  = array('Ù','Ú','Û','Ü');
	$acentosUm = array('ù','ú','û','ü');
	$acentosYm = array('ý'.'ÿ/');
	$acentosTrace = array(' ','"'.'ˆ'.'´'.'•');
	
	$res = str_replace($acentosA, 'A', $str);
	$res = str_replace($acentosAm, 'a', $res);
	$res = str_replace($acentosE, 'E', $res);
	$res = str_replace($acentosEm, 'e', $res);
	$res = str_replace($acentosI, 'I', $res);
	$res = str_replace($acentosIm, 'i', $res);
	$res = str_replace($acentosO, 'O', $res);
	$res = str_replace($acentosOm, 'o', $res);
	$res = str_replace($acentosOm, 'o', $res);
	$res = str_replace($acentosU, 'U', $res);
	$res = str_replace($acentosUm, 'u', $res);
	$res = str_replace($acentosYm, 'Y', $res);
	$res = str_replace($acentosTrace, '-', $res);
	
	$res = str_replace('Ç', 'C', $res);
	$res = str_replace('ç', 'c', $res);
	$res = str_replace('Ñ', 'N', $res);
	$res = str_replace('ñ', 'n', $res);
	$res = str_replace('Ý', 'Y', $res);
	$res = str_replace('ª', 'a', $res);
	$res = str_replace('º', 'o', $res);

	$res = str_replace('---------------', '-', $res);
	$res = str_replace('--------------', '-', $res);
	$res = str_replace('-------------', '-', $res);
	$res = str_replace('------------', '-', $res);
	$res = str_replace('-----------', '-', $res);
	$res = str_replace('----------', '-', $res);
	$res = str_replace('---------', '-', $res);
	$res = str_replace('--------', '-', $res);
	$res = str_replace('-------', '-', $res);
	$res = str_replace('------', '-', $res);
	$res = str_replace('-----', '-', $res);
	$res = str_replace('----', '-', $res);
	$res = str_replace('---', '-', $res);
	$res = str_replace('--', '-', $res);
	
	
	$Sql = mysql_query("SELECT permalink FROM ".$banco."")or(die(mysql_error()));
	$Cont = mysql_num_rows($Sql);

		for($x=0;$x<=$Cont;$x++) {

			$PlinkNumber = $res;
			$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber'")or(die(mysql_error()));
			$ContV = mysql_num_rows($SqlV);

			if($ContV == 0) { $res = $PlinkNumber; break; } else { $TwoFor = true; };
		}
		
		if($TwoFor == true) {
		
			for($x=0;$x<=$Cont;$x++) {
	
				$PlinkNumber = $res.'-'.rand(0,999);
				$SqlV = mysql_query("SELECT permalink FROM ".$banco." WHERE permalink = '$PlinkNumber'")or(die(mysql_error()));
				$ContV = mysql_num_rows($SqlV);
	
				if($ContV == 0) { $res = $PlinkNumber; break; }
			}
	
		}
	
	

	}
	
	return strtolower($res);
	

	
	
}


?>
