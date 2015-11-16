function CambiarEstilo(id,id2,id3,id4) {
	
	var elemento = document.getElementById(id);
	var elemento2 = document.getElementById(id2);
	var elemento3 = document.getElementById(id3);
	var elemento4 = document.getElementById(id4);
	
		if (elemento.className == "styleswitch") {
			
			elemento.className  = "styleswitch current";
			elemento2.className = "styleswitch";
			elemento3.className = "styleswitch";
			elemento4.className = "styleswitch";
			
			
			}else {
				
			elemento.className = "styleswitch";
		}
}


function validar_titulo_tbl(dom,tipo){
					 
		var regex=/[#&?'~`.,&^%@!¿ç´¶«»¬éÉíÍóÓúÚáÁÄäëËïÏöÖüÜàÀèÈìÌòÒùÙãÃõÕÂâÊêÎîÔôÛû$]/g;
								
								
								
					  
		dom.value=dom.value.replace(regex,'');
		dom.value=dom.value.replace(' ','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('--','_');
		dom.value=dom.value.replace('---','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace('-','_');	
						
					
}

function validar_palavras(dom,tipo){
					 
		dom.value=dom.value.replace(' ',',');
						
					
}
				

function validar(dom,tipo){
        switch(tipo){
                case'num':var regex=/[A-Za-z]/g;break;
                case'text':var regex=/\d/g;break;
				case'caracter':var regex=/[#&?]/g;  break;
				
				
				
        }
        dom.value=dom.value.replace(regex,'');
		 dom.value=dom.value.replace('"',"'");
		 
	
		
}


function validar_prioridade(dom,tipo){
       
	     var regex=/[A-Za-z]/g;
	   	 var CaracTER=/[#&?'~`.,&^%@!¿ç´¶«»¬éÉíÍóÓúÚáÁÄäëËïÏöÖüÜàÀèÈìÌòÒùÙãÃõÕÂâÊêÎîÔôÛû$]/g;
		 
		 dom.value=dom.value.replace('"',"'");
		 dom.value=dom.value.replace('0',"1");
		 dom.value=dom.value.replace(CaracTER,"");
		 dom.value=dom.value.replace(regex,"");
		 
	
		
}


function validar_php(dom,tipo){
        switch(tipo){
                case'num':var regex=/[A-Za-z]/g;break;
                case'text':var regex=/\d/g;break;
				case'caracter':var regex=/[#&?]/g;  break;
				
				
				
        }
       
		 dom.value=dom.value.replace('"',"'");
		 
	
		
}


function validar_titulo(dom,tipo){
        switch(tipo){
                case'num':var regex=/[A-Za-z]/g;break;
                case'text':var regex=/\d/g;break;
				case'caracter':var regex=/[#&?'~`.,&^%@!¿ç´¶«»¬éÉíÍóÓúÚáÁÄäëËïÏöÖüÜàÀèÈìÌòÒùÙãÃõÕÂâÊêÎîÔôÛû$]/g;  break;
				
				
				
        }
        dom.value=dom.value.replace(regex,'');
		dom.value=dom.value.replace('-','_');
		dom.value=dom.value.replace(' ','_');
	
}

function validar_titulo_mask(dom,tipo){
        switch(tipo){
                case'num':var regex=/[A-Za-z]/g;break;
                case'text':var regex=/\d/g;break;
				case'caracter':var regex=/[#&?'~`,&^%@!¿ç´¶«»¬éÉíÍóÓúÚáÁÄäëËïÏöÖüÜàÀèÈìÌòÒùÙãÃõÕÂâÊêÎîÔôÛû$]/g;  break;

        }
        dom.value=dom.value.replace(regex,'');
	
		
}

function SomenteNumero(dom) {
	var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}





function Quantidade_ADD_GAL() {
		var campo = document.galeria;
	
		
			 var valor = parseFloat(campo.quantidade.value); 
			 
			 var novo = valor+1;
			 
			 
			 if(novo == 5) {
				 
				var novoTexto = '';

				document.getElementById("Verifica_quantidade").innerHTML = novoTexto;
				 
			 }
			
		
			
		    campo.quantidade.value=novo;
		   
		  
   
}


function Quantidade_ADD() {
		var campo = document.cadastro;
	
		
			 var novo = campo.quantidade.value+1; 
			
		
			
		    campo.quantidade.value=novo;
		   
		  
   
}





function adicionarFile() {

	var novoTexto = '<input type="file" name="img[]" id="img[]" style="margin-right:20px; width:254px; margin-top:10px;"/>';

	document.getElementById("Campo").innerHTML += novoTexto;

}













