	var xmlhttp = getXmlHttpRequest();
	
	function getXmlHttpRequest() {
		if (window.XMLHttpRequest) {
			return new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	
function Carrega_Design(url,ID){
  document.getElementById("mostra_design").innerHTML = "<font color='#CCC' style='font-size:12px;'>Carregando...</font>";
  xmlhttp.open("GET", url + '?DSG=' + ID, true);
  xmlhttp.onreadystatechange = function(){
  
   if (xmlhttp.readyState == 4){
   
   var texto = xmlhttp.responseText;
   texto = texto.replace(/\+/g," ");
   texto = unescape(texto);
	document.getElementById("mostra_design").innerHTML = xmlhttp.responseText;
   }
  } 
  xmlhttp.send(null);
 }
 
 
 function Carrega_mkt(url,ID){
  document.getElementById("imagem_mkt").innerHTML = "<font color='#CCC' style='font-size:12px;'>Carregando...</font>";
  xmlhttp.open("GET", url + '?DSG=' + ID, true);
  xmlhttp.onreadystatechange = function(){
  
   if (xmlhttp.readyState == 4){
   
   var texto = xmlhttp.responseText;
   texto = texto.replace(/\+/g," ");
   texto = unescape(texto);
	document.getElementById("imagem_mkt").innerHTML = xmlhttp.responseText;
   }
  } 
  xmlhttp.send(null);
 }
 
 
  
 function Carrega_tbl(url,ID){
  document.getElementById("mostra_tbl").innerHTML = "<font color='#CCC' style='font-size:12px;'>Carregando...</font>";
  xmlhttp.open("GET", url + '?DSG=' + ID, true);
  xmlhttp.onreadystatechange = function(){
  
   if (xmlhttp.readyState == 4){
   
   var texto = xmlhttp.responseText;
   texto = texto.replace(/\+/g," ");
   texto = unescape(texto);
	document.getElementById("mostra_tbl").innerHTML = xmlhttp.responseText;
   }
  } 
  xmlhttp.send(null);
 }
 
 
  function Carrega_previsao(url,ID){
  document.getElementById("previsao_tempo").innerHTML = "<font color='#CCC' style='font-size:12px;'>Carregando...</font>";
  xmlhttp.open("GET", url + '?DSG=' + ID, true);
  xmlhttp.onreadystatechange = function(){
  
   if (xmlhttp.readyState == 4){
   
   var texto = xmlhttp.responseText;
   texto = texto.replace(/\+/g," ");
   texto = unescape(texto);
	document.getElementById("previsao_tempo").innerHTML = xmlhttp.responseText;
   }
  } 
  xmlhttp.send(null);
 }
 
 
 function Carrega_verificacao(url,ID){
  document.getElementById("mostra_verificacao").innerHTML = "<font color='#CCC' style='font-size:12px;'>Carregando...</font>";
  xmlhttp.open("GET", url + '?DSG=' + ID, true);
  xmlhttp.onreadystatechange = function(){
  
   if (xmlhttp.readyState == 4){
   
   var texto = xmlhttp.responseText;
   texto = texto.replace(/\+/g," ");
   texto = unescape(texto);
	document.getElementById("mostra_verificacao").innerHTML = xmlhttp.responseText;
   }
  } 
  xmlhttp.send(null);
 }
 

 
 
 
 
 
 

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}