/*
 * Documento JavaScript
 * Funcion para crear objeto ajax
*/
function objetoAjax() {
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
//Funcion para paginar resultados!
function Pagina(nropagina,Qpag) {
	//donde se mostrara los registros
	divContenido = document.getElementById('paginador');
	
	ajax=objetoAjax();
	//uso del medoto GET
	//indicamos el archivo que realizara el proceso de paginar
	//junto con un valor que representa el nro de pagina
	switch(Qpag) {
		case '1':ajax.open("GET", "paginador.php?pag="+nropagina);break; 
		case '2':ajax.open("GET", "paginador2.php?pag="+nropagina);break; 
		case '3':ajax.open("GET", "paginador3.php?pag="+nropagina);break;
		case '4':ajax.open("GET", "paginador4.php?pag="+nropagina);break; 
		case '5':ajax.open("GET", "paginador5.php?pag="+nropagina);break;
		case '6':ajax.open("GET", "paginador6.php?pag="+nropagina);break;
	}
	//divContenido.innerHTML= '<center><img src="img/cargando.gif"></center>';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divContenido.innerHTML = ajax.responseText;
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null ya que enviamos 
	//el valor por la url ?pag=nropagina
	ajax.send(null)
}
// Funcion para buscar cadenas de palabras.
function buscarDato(cual,donde) {
	divresul = document.getElementById(donde);
	ajax=objetoAjax();
	switch(cual) {
		case '0':
				bus1=document.getElementById('cedula').value;
				bus2=document.getElementById('estado1').value;
				bus3=document.getElementById('municipio1').value;
				ajax.open("POST", "validarbuscarproductor.php",true);
				break;
		case '1':
				bus1=document.getElementById('cedula').value;
				ajax.open("POST", "validarbuscarproductor-fact.php",true);
				break;
	}	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divresul.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	if(cual=='0') ajax.send("cedula="+bus1+"&estado1="+bus2+"&municipio1="+bus3);
	if(cual=='1') ajax.send("cedula="+bus1);
}
// Funcion que carga paginas sin recargar, dentro de un div, sin envio de parametros
function llamarasincronoget(url, div_padre, id_contenedor, comp)
{
	var pagina_requerida = objetoAjax();
	if(comprobar(comp)) {	//Comprobar campos vacios segun cual formulario es
		pagina_requerida.onreadystatechange=function()  // funcion de respuesta
		{
			cargarpagina(pagina_requerida, id_contenedor, div_padre);
		}
		pagina_requerida.open('GET', url, true); // asignamos los metodos open y send
		pagina_requerida.send(null);
	}
}

// Funcion que carga paginas sin recargar, dentro de un div, con envio de parametros
function llamarasincronopost(url, div_padre, id_contenedor, comp, valores)
{
	var pagina_requerida = objetoAjax();
	if(comprobar(comp)) { //Comprobar campos vacios segun cual formulario es
		pagina_requerida.open('POST', url, true); 
		// asignamos los metodos open y send
		pagina_requerida.onreadystatechange=function()  
		// funcion de respuesta
		{
			validacargarpagina(pagina_requerida, id_contenedor, div_padre);
		}	
		pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		pagina_requerida.send(valores);
		//alert("Recibi el resultado. Opcion: "+valores);
	} 
}
// todo es correcto y ha llegado el momento de poner la informacion requerida
// en su sitio en la pagina xhtml
function cargarpagina(pagina_requerida, id_contenedor,div_padre)
{
	if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
		document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;
}
function validacargarpagina(pagina_requerida, id_contenedor, div_padre)
{	
	var modif = '';
	if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1)) {	
		document.getElementById(id_contenedor).innerHTML = pagina_requerida.responseText;
		if(!document.getElementById(id_contenedor).firstChild.nodeValue) {
			//alert("Error: "+pagina_requerida.responseText.substring(22, 76));
			document.getElementById(id_contenedor).innerHTML = '20 - Error DB';
		} else {
			modif = document.getElementById(id_contenedor).firstChild.nodeValue.substring(0, 2);
		}
		if(modif=='23') {
			document.getElementById(id_contenedor).style.display='block';		
		}		
		mostrar_respuesta(id_contenedor,div_padre);
	}	
}

function mostrar_respuesta(id_contenedor,div_padre) {
	//alert('Respuesta:'+document.getElementById(id_contenedor).firstChild.nodeValue);
	recibe = document.getElementById(id_contenedor).firstChild.nodeValue.substring(0, 2);
	switch(recibe) {
		case '00':
				alert("Usuario o clave inválido!");
				eliminar_ele(id_contenedor);
				document.getElementById('clave').value="";
				document.getElementById('usuario').focus();
				crear_ele(div_padre,"div",id_contenedor);
				break;
		case '01':	// INICIO DE SESION EXITOSO						
				window.open("index.php","_self");
				break;
		case '02':
				alert("No Deje Campos Vacios!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
		case '03':
				alert("Productor Ya Existe!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
		case '04':	
				alert("Grabacion Exitosa!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				llamarasincronoget('productores.php','contenedor','centro','0');
				break;
		case '05':
				alert("Modificacion Exitosa!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				llamarasincronoget('productores.php','contenedor','centro','0');
				break;
		case '06':   //Error general!
				alert("Error al tratar de escribir los datos!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
		case '07':   //Error en los depositos!
				alert("Error al tratar de recibir los pagos!");
				document.getElementById('pagar1').style.display='block';
				document.getElementById('Cobrar').style.display='block';
				document.getElementById('recibido').value='NO';
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
		case '08':   //Grabacion exitosa en los depositos!
				alert("Pago recibido! Ya puede facturar! Recuerde que no se podran hacer modificaciones!");
				document.getElementById('pagar1').style.display='none';
				document.getElementById('pagar2').style.display='none';
				document.getElementById('pagar11').style.display='none';
				document.getElementById('pagar22').style.display='none';
				document.getElementById('pagar1').style.display='none';
				document.getElementById('pagar2').style.display='none';
				document.getElementById('Cobrar').style.display='none';
				document.getElementById('recibido').value='SI';
				document.getElementById('fpago1').disabled=true;
				document.getElementById('numero1').disabled=true;
				document.getElementById('fecha1').disabled=true;
				document.getElementById('monto1').disabled=true;
				document.getElementById('fpago2').disabled=true;
				document.getElementById('numero2').disabled=true;
				document.getElementById('fecha2').disabled=true;
				document.getElementById('monto2').disabled=true;
				document.getElementById('fpago3').disabled=true;
				document.getElementById('numero3').disabled=true;
				document.getElementById('fecha3').disabled=true;
				document.getElementById('monto3').disabled=true;
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
			case '09':   //GENERAR EL PDF DE LA FACTURA!
				alert("Generando Factura!");				
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				var url_id = "imprimirfactura.php?fact="+document.getElementById('id_factura').value;
				llamarasincronoget('productores.php','contenedor','centro','0');
				popupCentrado(url_id,'FACTURAR','800','600','0');
				break;
			case '10':   //GENERAR EL PDF DE LA PROFORMA!
				alert("Generando Proforma!");				
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				var url_id = "imprimirproforma.php?fact="+document.getElementById('id_proforma').value;
				popupCentrado(url_id,'PROFORMA','800','600','0');				
				llamarasincronoget('productores.php','contenedor','centro','0');
				break;
			case '11':   //GENERAR EL PDF DE LA REPOSICION!
				alert("Generando Reposicion!");				
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				var url_id = "imprimirreposicion.php?fact="+document.getElementById('id_reposicion').value;
				popupCentrado(url_id,'REPOSICION','800','600','0');				
				llamarasincronoget('reposicion.php','contenedor','centro','0');
				break;
			case '12':	// CREACION DE USUARIOS
				alert("Grabacion Exitosa!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				llamarasincronoget('usuarios.php','contenedor','centro','0');
				break;
			case '13':
				alert("No Deje Campos Vacios!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
			case '14':
				alert("Usuario Ya Existe!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				break;
			case '15':
				alert("Modificación Exitosa!");
				eliminar_ele(id_contenedor);crear_ele(div_padre,"div",id_contenedor);
				llamarasincronoget('usuarios.php','contenedor','centro','0');
				break;
			case '20':
				alert("¡Error de conexión al servidor de la Base de Datos!");
				eliminar_ele(id_contenedor);
				document.getElementById('clave').value="";
				document.getElementById('usuario').focus();
				crear_ele(div_padre,"div",id_contenedor);
				break;
	}

}
/*
Caracteres para los acentos en javascript:
\u00cm -> \r
\u00e1 -> á
\u00e9 -> é
\u00ed -> í
\u00f3 -> ó
\u00fa -> ú
\u00c1 -> Á
\u00c9 -> É
\u00cd -> Í
\u00d3 -> Ó
\u00da -> Ú
\u00f1 -> ñ
\u00d1 -> Ñ 
*/
function eliminar_ele(elemento) {
	// Obtenemos el elemento
	var ele = document.getElementById(elemento);
	// Obtenemos el padre de dicho elemento
	// con la propiedad parentNode
	var padre = ele.parentNode;
	// Eliminamos el hijo (el) del elemento padre
	padre.removeChild(ele);
}

function crear_ele(padre1,tipo,nombre) {
	ele_crea = document.createElement(tipo);
	ele_crea.setAttribute("id", nombre);
	document.getElementById(padre1).appendChild(ele_crea);
}
function confirma(cual)
{	
	switch(cual) {
		case '1':
				var acepta=confirm("Seguro que desea eliminar?");
				if(acepta)
					return true;
				else
					return false;
				break;
		case '2':
				var acepta=confirm("Seguro que desea actualizar?");
				if(acepta)
					return true;
				else
					return false;
				break;
		case '3':
				var acepta=confirm("Seguro que desea eliminar?");
				if(acepta)
					return true;
				else
					return false;
				break;
	}
	
}
function comprobar(cual)
{
	switch(cual) {
		case '1':  // OPCIONES PARA VALIDAR INICIO DE SESION
			if (document.getElementById('usuario').value == ''){
				alert('Por favor, debe ingresar el usuario!');
				return false;
			}
			if (document.getElementById('clave').value == ''){
				alert('Por favor, debe ingresar la clave!');
				return false;
			} else return true;
			break;
		case '2':  // OPCIONES PARA VALIDAR PRODUCTORES
			if (document.getElementById('razons').value == ''){
				alert('Por favor, debe elegir la razon social!');
				return false;
			}
			if (document.getElementById('cedula').value == ''){
				alert('Por favor, debe indicar su cedula!');
				return false;
			}
			if (document.getElementById('nombres').value == ''){
				alert('Por favor, debe ingresar el nombre!');
				return false;
			}
			if (document.getElementById('apellidos').value == ''){
				alert('Por favor, debe ingresar el apellido!');
				return false;
			}
			if (document.getElementById('direccion').value == ''){
				alert('Por favor, debe ingresar la direccion!');
				return false;
			} else return true;
			break;
		case '3':  // OPCIONES PARA CONFIRMAR LA ELIMINACION DE REGISTROS
				if(confirma('1')) {
					alert('Eliminacion exitosa!');	
					return true; 
				} else return false;
				break;
		case '4':  // OPCIONES PARA FACTURAR
			if (document.getElementById('cedula').value == '') { // || document.getElementById('ced1').value == ''){
				alert('Por favor, debe escribir la cedula!');
				return false;
			}
			if (document.getElementById('total').value == ''){
				alert('Por favor, debe indicar la compra y calcular el monto!');
				return false;
			}
			if (document.getElementById('recibido').value == 'NO'){
				alert('Por favor, debe cobrar los pagos antes de facturar!');
				return false;
			}
			if (document.getElementById('monto1').value == ''){
				alert('Por favor, debe ingresar algun pago!');
				return false;
			} else return true;
			break;
		case '5':  // OPCIONES PARA PAGOS / DEPOSITOS / CHEQUES
			if (document.getElementById('total').value == ''){
				alert('Por favor, debe calcular total!');
				return false;
			}
			if (document.getElementById('fpago1').value == ''){
				alert('Por favor, debe elegir la forma de pago!');
				return false;
			}
			if ((document.getElementById('fpago1').value == 'Cheque' || document.getElementById('fpago1').value == 'Deposito') && document.getElementById('numero1').value == ''){
				alert('Por favor, debe escribir el numero de cheque/deposito!');
				return false;
			}
			if ((document.getElementById('fpago2').value == 'Cheque' || document.getElementById('fpago2').value == 'Deposito') && document.getElementById('numero2').value == ''){
				alert('Por favor, debe escribir el numero de cheque/deposito!');
				return false;
			}
			if ((document.getElementById('fpago3').value == 'Cheque' || document.getElementById('fpago3').value == 'Deposito') && document.getElementById('numero3').value == ''){
				alert('Por favor, debe escribir el numero de cheque/deposito!');
				return false;
			}
			if (document.getElementById('fpago1').value != 'Efectivo' && document.getElementById('fecha1').value == ''){
				alert('Por favor, debe indicar la fecha del pago 1!');
				return false;
			}
			if (document.getElementById('monto1').value == '' || document.getElementById('monto1').value == '0'){
				alert('Por favor, debe ingresar el monto 1!');
				return false;
			}
			var montos = parseInt(document.getElementById('monto1').value) + parseInt(document.getElementById('monto2').value) + parseInt(document.getElementById('monto3').value);
			if (montos != document.getElementById('total').value){
				alert('Pagos no coinciden con el monto total: '+montos+' - Total: '+document.getElementById('total').value);
				return false;
			}			
			if ((document.getElementById('divoculto2').style.display == 'block' && document.getElementById('fpago2').value != 'Efectivo') && !document.getElementById('fpago2').disabled && document.getElementById('fecha2').value == '') {
				alert('Por favor, debe indicar la fecha del pago 2!');// total: '+document.getElementById('total').value+' montos:'+montos);
				return false;
			}
			if (document.getElementById('fpago2').value != '' && (document.getElementById('monto2').value == '' || document.getElementById('monto2').value == '0')){
				alert('Por favor, debe ingresar el monto 2!');
				return false;
			}
			if ((document.getElementById('divoculto3').style.display == 'block' && document.getElementById('fpago3').value != 'Efectivo') && !document.getElementById('fpago3').disabled && document.getElementById('fecha3').value == '') {
				alert('Por favor, debe indicar la fecha del pago 3!');// total: '+document.getElementById('total').value+' montos:'+montos);
				return false;
			}
			if (document.getElementById('fpago3').value != '' && (document.getElementById('monto3').value == '' || document.getElementById('monto3').value == '0')){
				alert('Por favor, debe ingresar el monto 3!');
				return false;
			} else return true;
			break;
		case '6':  // OPCIONES PARA DONATIVOS
			if (document.getElementById('cedula').value == '') {
				alert('Por favor, debe escribir la cedula!');
				return false;
			}
			if (document.getElementById('cant1').value == '' && document.getElementById('cant2').value == '' && document.getElementById('cant3').value == '') {
				alert('Por favor, debe especificar la cantidad!');
				return false;
			}
			if (document.getElementById('cant3').value != '' && document.getElementById('total').value == '') {
				alert('Por favor, debe totalizar y pagar!');
				return false;
			}
			if (document.getElementById('total').value != '' && document.getElementById('recibido').value == 'NO'){
				alert('Por favor, debe calcular el monto y pagar!');
				return false;
			} else return true;
			break;
		case '7':  // OPCIONES PARA VALIDAR ALMACEN
			if (document.getElementById('existencia1').value == ''){
				alert('Por favor, debe haber un minimo de existencia!');
				return false;
			}
			if (document.getElementById('precio1').value == ''){
				alert('Por favor, debe haber un precio!');
				return false;
			}
			if (document.getElementById('existencia2').value == ''){
				alert('Por favor, debe haber un minimo de existencia!');
				return false;
			}
			if (document.getElementById('precio2').value == ''){
				alert('Por favor, debe haber un precio!');
				return false;
			}
			if (document.getElementById('existencia3').value == ''){
				alert('Por favor, debe haber un minimo de existencia!');
				return false;
			}
			if (document.getElementById('precio3').value == ''){
				alert('Por favor, debe haber un precio!');
				return false;
			}
			if(confirma('2')) {
				alert('Almacen actualizado!');	
				return true; 
			} else return false;
			break;
		case '8':  // OPCIONES PARA PROFORMA
			if (document.getElementById('cedula').value == '') { // || document.getElementById('ced1').value == ''){
				alert('Por favor, debe escribir la cedula!');
				return false;
			}
			if (document.getElementById('total').value == ''){
				alert('Por favor, debe indicar la compra y calcular el monto!');
				return false;
			} else return true;
			break;
		case '9':  // OPCIONES PARA USUARIOS
			if (document.getElementById('usuario').value == '') { 
				alert('Por favor, debe escribir su nombre de usuario!');
				return false;
			}
			if (document.getElementById('clave').value == '') { 
				alert('Por favor, debe escribir la clave!');
				return false;
			}
			if ((document.getElementById('cclave').value == '') || (document.getElementById('cclave').value != document.getElementById('clave').value)) { 
				alert('Por favor, las claves deben coincidir!');
				return false;
			}
			if (document.getElementById('nombre').value == ''){
				alert('Por favor, debe escribir el nombre!');
				return false;
			} else return true;
			break;
			
		case '0':return true;
	}
}

function mostrarocultar(cualdiv) 
{
	switch(cualdiv) {
		case '1':
			document.getElementById('divoculto2').style.display = 'block';			
			document.getElementById('pagar1').style.display='none';
			document.getElementById('pagar11').style.display='none';
			document.getElementById('pagar2').style.display='block';	
			document.getElementById('fpago2').disabled=false;		
			break;
		case '2':
			document.getElementById('divoculto3').style.display = 'block';			
			document.getElementById('pagar1').style.display='none';
			document.getElementById('pagar11').style.display='none';
			document.getElementById('pagar2').style.display='none';
			document.getElementById('pagar22').style.display='block';
			document.getElementById('fpago3').disabled=false;
			break;
		case '3':
			document.getElementById('divoculto3').style.display = 'none';
			document.getElementById('fpago3').value='';
			document.getElementById('numero3').value='';
			document.getElementById('fecha3').value='';
			document.getElementById('monto3').value=0;
			document.getElementById('pagar11').style.display='block';
			document.getElementById('pagar22').style.display='none';
			document.getElementById('fpago3').disabled=true;
			break;
		case '4':
			document.getElementById('divoculto2').style.display = 'none';
			document.getElementById('fpago2').disabled='false';
			document.getElementById('fpago2').value='';
			document.getElementById('numero2').value='';
			document.getElementById('fecha2').value='';
			document.getElementById('monto2').value=0;
			document.getElementById('pagar11').style.display='none';
			document.getElementById('pagar1').style.display='block';
			document.getElementById('fpago2').disabled=true;
	}
}
function Redondea0(amount) 
{    var val = parseFloat(amount);
	 if (!val || val <= 0) { return "0.00" } 
	 else { return Math.ceil(val)+ ".00" }
}
//Calculo de la compra de alevines, juveniles y empaques
function calcula()
{
	var subt1,subt2,subt3,subt4,emp1,emp2,emp3,empt,trans;
	if(document.getElementById('transporte').value!='') {
		if(document.getElementById('cant1').value=='' && document.getElementById('cant2').value=='' && document.getElementById('cant3').value=='' && document.getElementById('cant4').value=='') {
			alert("Debe especificar las cantidades!");
		} else {
			if(document.getElementById('cant1').value!='') {

				if(document.getElementById('cant1').value<=200) emp1 = 1;
				else emp1 = parseInt(document.getElementById('cant1').value) / 200;
			
			} else emp1 = 0;
			if(document.getElementById('cant2').value!='') {
				
				if(document.getElementById('cant2').value<=200) emp2 = 1;
				else emp2 = parseInt(document.getElementById('cant2').value) / 200;
			
			} else emp2 = 0;
			if(document.getElementById('cant3').value!='') {
				
				if(document.getElementById('cant3').value<=50) emp3 = 1;
				else emp3 = parseInt(document.getElementById('cant3').value) / 50;
			
			} else emp3 = 0;
			trans = parseFloat(document.getElementById('transporte').value);
			empt = parseInt(Redondea0(emp1)) + parseInt(Redondea0(emp2)) + parseInt(Redondea0(emp3));
			document.getElementById('cant4').value = Redondea0(empt);
			if(document.getElementById('precio1')) {
				subt1 = parseFloat(document.getElementById('precio1').value) * parseInt(document.getElementById('cant1').value);
				subt2 = parseFloat(document.getElementById('precio2').value) * parseInt(document.getElementById('cant2').value);
				subt3 = parseFloat(document.getElementById('precio3').value) * parseInt(document.getElementById('cant3').value);
			} else {
				subt1 = 0;subt2 = 0;subt3 = 0;
			}
			subt4 = (Redondea0(empt) * parseInt(document.getElementById('precio4').value));
			if(document.getElementById('precio1')) {
				document.getElementById('p1').value = parseInt(Redondea0(subt1));
				document.getElementById('p2').value = parseInt(Redondea0(subt2));
				document.getElementById('p3').value = parseInt(Redondea0(subt3));
			}
			document.getElementById('p4').value = parseInt(Redondea0(subt4));
			document.getElementById('total').value = parseInt(Redondea0(subt1))+parseInt(Redondea0(subt2))+parseInt(Redondea0(subt3))+parseInt(Redondea0(subt4))+parseInt(Redondea0(trans));
		}
	} else {
		alert("Debe especificar el transporte!");
	}
}
function calcula_emp()
{
	var emp1,emp2,emp3,empt;
	empt = 0;
	if(document.getElementById('cant1').value=='' &&document.getElementById('cant2').value=='' && document.getElementById('cant3').value=='' && document.getElementById('cant4').value=='') {
		alert("Debe especificar las cantidades!");
	} else {
		if(document.getElementById('cant1').value!='') {

			if(document.getElementById('cant1').value<=200) emp1 = 1;
			else emp1 = parseInt(document.getElementById('cant1').value) / 200;
		
		} else emp1 = 0;
		if(document.getElementById('cant2').value!='') {
			
			if(document.getElementById('cant2').value<=200) emp2 = 1;
			else emp2 = parseInt(document.getElementById('cant2').value) / 200;
		
		} else emp2 = 0;
		if(document.getElementById('cant3').value!='') {
			
			if(document.getElementById('cant3').value<=50) emp3 = 1;
			else emp3 = parseInt(document.getElementById('cant3').value) / 50;
		
		} else emp3 = 0;
		empt = parseInt(Redondea0(emp1)) + parseInt(Redondea0(emp2)) + parseInt(Redondea0(emp3));
		if(empt!=0) document.getElementById('cant4').value = Redondea0(empt);
		else empt = parseInt(document.getElementById('cant4').value); 
		//document.getElementById('p3').value = (Redondea0(empt) * parseInt(document.getElementById('precio3').value));
		document.getElementById('total').value = (Redondea0(empt) * parseInt(document.getElementById('precio4').value));
		//alert("precio4: "+document.getElementById('precio4').value+" empt: "+empt+" emp1: "+emp1+" emp2: "+emp2+" emp3: "+emp3);
	}
}
function efectivo(cual)
{
	switch(cual)
	{
		case '1':
			document.getElementById('numero1').value='0000000000';
			document.getElementById('fecha1').value=document.getElementById('fecha').value;
			document.getElementById('numero1').disabled=true;
			document.getElementById('fecha1').disabled=true;
			document.getElementById('monto1').focus();			
			break;
		case '2':
			document.getElementById('numero2').value='0000000000';
			document.getElementById('fecha2').value=document.getElementById('fecha').value;
			document.getElementById('numero2').disabled=true;
			document.getElementById('fecha2').disabled=true;
			document.getElementById('monto2').focus();
			break;
		case '3':
			document.getElementById('numero3').value='0000000000';
			document.getElementById('fecha3').value=document.getElementById('fecha').value;
			document.getElementById('numero3').disabled=true;
			document.getElementById('fecha3').disabled=true;
			document.getElementById('monto3').focus();
			break;
		case '4':
			document.getElementById('numero1').value='';
			document.getElementById('fecha1').value='';
			document.getElementById('numero1').disabled=false;
			document.getElementById('fecha1').disabled=false;
			document.getElementById('numero1').focus();			
			break;
		case '5':
			document.getElementById('numero2').value='';
			document.getElementById('fecha2').value='';
			document.getElementById('numero2').disabled=false;
			document.getElementById('fecha2').disabled=false;
			document.getElementById('numero2').focus();
			break;
		case '6':
			document.getElementById('numero3').value='';
			document.getElementById('fecha3').value='';
			document.getElementById('numero3').disabled=false;
			document.getElementById('fecha3').disabled=false;
			document.getElementById('numero3').focus();
			break;
	}
}

 ////*** Este Codigo permite Validar que sea un campo Numerico  **////
function Solo_Numerico(variable)
{
	Numer=parseInt(variable);
	  if (isNaN(Numer)) { return ""; }
	return Numer;
}
function ValNumero(Control)
{
	Control.value=Solo_Numerico(Control.value);
}
function popupCentrado(Url,NombreVentana,width,height,extras,scrollbars) {
	var largo = width;
	var altura = height;
	var adicionales= extras;
	var NO = 0;
	var top = (screen.height-altura)/2;
	var izquierda = (screen.width-largo)/2; nuevaVentana=window.open(''+ Url + '',''+ NombreVentana + '','width=' + largo + ',height=' + altura + ',top=' + top + ',left=' + izquierda + ',scrollbars=' + scrollbars + ',Resizable='+ NO + ',Location=' + NO);
	nuevaVentana.focus();
}
function listado() {
	var bus1,bus2,bus3,url_id='imprimirlistadopro.php';
	bus1=document.getElementById('cedula').value;
	bus2=document.getElementById('estado1').value;
	bus3=document.getElementById('municipio1').value;
	//alert("Recibi el resultado. ced="+bus1+" est="+bus2+" mun="+bus3);
	url_id = "imprimirlistadopro.php?ced="+bus1+"&est="+bus2+"&mun="+bus3;
	popupCentrado(url_id,'PRODUCTORES','800','600','0')
}

function refrescaDiv(div,segs,url)
{
	// define our vars
	var div,segs,url,fetch_unix_timestamp;
	 
	// Chequeamos que las variables no esten vacias..
	if(div == ""){ alert('Error: escribe el id del div que quieres refrescar'); return;}
	else 
		if(!document.getElementById(div)){ alert('Error: el Div ID selectionado no esta definido: '+div); return;}
		else 
			if(segs == ""){ alert('Error: indica la cantidad de segundos que quieres que el div se refresque'); return;}
			else 
				if(url == ""){ alert('Error: la URL del documento que quieres cargar en el div no puede estar vacia.'); return;}
	 
	// The XMLHttpRequest object
	var xmlHttp;
	try {
		xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
	}
	catch (e) {
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e) {
			try {
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("Tu explorador no soporta AJAX.");
				return false;
			}
		}
	}
	 
	// Timestamp para evitar que se cachee el array GET
	fetch_unix_timestamp = function()
	{
		return parseInt(new Date().getTime().toString().substring(0, 10))
	}
	 
	var timestamp = fetch_unix_timestamp();
	var nocacheurl = url+"?t="+timestamp;
	 
	// the ajax call
	xmlHttp.onreadystatechange=function() {
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			//alert("responseText: "+xmlHttp.responseText);
			if(xmlHttp.responseText == "Salir") {
				alert('Sesi\u00f3n expirada!');				
				window.location='index.php';				
			} else {
				document.getElementById(div).innerHTML=xmlHttp.responseText;
			}			
			setTimeout(function(){refrescaDiv(div,segs,url);},segs*1000);
		}
	}
	xmlHttp.open("GET",nocacheurl,true);
	xmlHttp.send(null);
}
