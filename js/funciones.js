function nuevoAjax()
{ 
	var xmlhttp=false; 
	try 
	{ 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

function prueba(){
	alert('alert desde funciones.js')
}

function controlarSesion(){
	//alert('controlar sesion')
	$.ajax({
		url: 'login.php',
		type: 'GET',
		async: true,
		data: {},

		success: function(response){
			//alert(response);
			document.getElementById('div_chico').innerHTML=response;
			location.href='#chicoModal';
		},
		
		error: function(error){
			alert('No se puede mostrar el login');
		}
	});
	location.href='#';
	//$('.modal').fadeOut();
}

function validarUsuario(tipo){

	$.ajax({
		url: 'validuser.php',
		type: 'POST',
		async: true,
		data: $('#formLogin').serialize(),

		success: function(response){
			//alert(response)
			var arrayRespuesta= response.split("|");
			if(arrayRespuesta[0]!=0){
				document.getElementById('div_mensaje_login').innerHTML="<h4>Ingreso incorrecto</h4>";
				document.getElementById('usuario').value="";
				document.getElementById('contrasena').value="";
				document.getElementById('usuario').focus();

			}
			else{
				location.href='#';
				//var usuario_id=$("#usuario_id").val();
				document.getElementById('link_sesion').style.display="none";
				document.getElementById('link_usuario').innerHTML=arrayRespuesta[1];
				document.getElementById('menu_principal').style.display = 'inline';
				Transformadores();
			}
		},
		
		error: function(error){
			alert('Error al guardar el análisis');
		}
	});
	//location.href='#';
	//$('.modal').fadeOut();
}

function Transformadores(){

	var ajax=nuevoAjax();
	ajax.open("POST", "transformadoresFiltro.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
	ajax.send();
	
	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta);
			document.getElementById('div_principal').innerHTML=respuesta;
		} 
	}

}

function Filtrar(ordenarPor){
	//alert(ordenarPor)
	var ordenamiento=ordenarPor.split(' ');
	sentido='Asc'
	if(ordenamiento[1]=="↓") {sentido='Desc'}

	var localidad=document.getElementById('selectLocalidad').value
	var marca=document.getElementById('selectMarca').value
	var serie=document.getElementById('serie').value
	var ajax=nuevoAjax();
	ajax.open("POST", "transformadoresLista.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//en este caso el documento php recibe el/los parametros con $_POST
	ajax.send("localidad="+localidad+"&marca="+marca+"&serie="+serie+"&ordenarPor="+ordenamiento[0]+"&sentido="+sentido);

	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta)
			//cargo lo devuelto por el documento al que llamo en el div
			document.getElementById('divTransformadores').innerHTML=respuesta;
		} 
	}
	
}

/*function VerAnalisis(idTransformador) { 

window.open('analisisListaAnalisis.php?idTransformador=' + idTransformador + '','','width=1200,height=600');
}*/

function MM_openBrWindow(idTransformador) { 

window.open('listaResultadoAnalisis.php?idTransformador=' + idTransformador + '','','width=700,height=600');
}

function AbrirMetodoDornenberg(idTransformador, idAnalisis){
		window.open('metodoDornenberg.php?idTransformador=' + idTransformador + '&idAnalisis='+ idAnalisis + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}

function AbrirMetodoDornenbergModal(idTransformador, idAnalisis){

	$.ajax({
		url: 'metodoDornenbergModal.php',
		type: 'GET',
		async: true,
		data: {idTransformador:idTransformador,idAnalisis:idAnalisis},

		success: function(response){
			//alert(response);
			document.getElementById('div_grafico').innerHTML=response;
			location.href='#graficoModal';
		},
		
		error: function(error){
			alert('No se puede mostrar el gráfico');
		}
	});
	location.href='#';
	//$('.modal').fadeOut();
}

function AbrirMetodoDuvalTriangle(idTransformador, idAnalisis){
		window.open('metodoDuvalTriangle.php?idTransformador=' + idTransformador + '&idAnalisis='+ idAnalisis + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}

function AbrirMetodoDornenbergTop5(idTransformador){
		window.open('metodoDornenbergTop5.php?idTransformador=' + idTransformador + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}

function AbrirMetodoDornenbergFiltro(){
	var localidad=document.getElementById('selectLocalidad').value
	var marca=document.getElementById('selectMarca').value
	var serie=document.getElementById('serie').value
	window.open('metodoDornenbergFiltro.php?localidad=' + localidad + "&marca=" + marca + "&serie="+ serie + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}

function AbrirMetodoDuvalTriangleFiltro(){
	var localidad=document.getElementById('selectLocalidad').value
	var marca=document.getElementById('selectMarca').value
	var serie=document.getElementById('serie').value
	window.open('metodoDuvalTriangleFiltro.php?localidad=' + localidad + "&marca=" + marca + "&serie="+ serie + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}

function AbrirMetodoDuvalTriangleTop5(idTransformador, idAnalisis){
		window.open('metodoDuvalTriangleTop5.php?idTransformador=' + idTransformador + '&idAnalisis='+ idAnalisis + '','','width=900,height=450,status=no,toolbar=no,menubar=no,location=no');

}


function NuevoTransformadorModal(){

	document.getElementById('modal-contenido').style.width = '300px';
	var ajax=nuevoAjax();
	ajax.open("POST", "transformadorNuevoForm.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("accion=Nuevo");

	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta)
			//document.getElementById('modal-contenido').style.height = '100px';
			
			document.getElementById('div_modal').innerHTML=respuesta;
		} 
	}

	//levanto el div modal
	location.href='#miModal';

}

function AnalisisNuevoModal(idTransformador){
	
	document.getElementById('modal-contenido').style.width = '1200px';
	var ajax=nuevoAjax();
	ajax.open("POST", "analisisNuevo.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idTransformador=" + idTransformador)

	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta)
			document.getElementById('div_modal').innerHTML=respuesta;
		} 
	}

	//levanto el div modal
	location.href='#miModal';

}

function ModificarTransformadorModal(idTransformador){
	
	//grabo el id de transformador en una variable de sesion desde un script php
	//window.open('script.php?idTrafo=' + idTransformador + "&accion=Modificar");
	
	//actulizo el div con los datos del transformador
	document.getElementById('modal-contenido').style.width = '300px';
	var ajax=nuevoAjax();
	ajax.open("POST", "transformadorNuevoForm.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idTransformador=" + idTransformador + "&accion=Modificar");

	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta)
			
			document.getElementById('div_modal').innerHTML=respuesta;
		} 
	}

	//levanto el div modal
	location.href='#miModal';
}

function guardarTransformador(){
	var accion = document.getElementById("accion").value;
	var idTransformador = document.getElementById("idTransformador").value;
	var Detalle = document.getElementById("Detalle").value;
	var Tipo = document.getElementById("Tipo").value;
	var Serie = document.getElementById("Serie").value;
	var Potencia = document.getElementById("Potencia").value;
	var KV = document.getElementById("KV").value;
	var Gconexion = document.getElementById("Gconexion").value;
	var Campo = document.getElementById("Campo").value;
	var AnoTR = document.getElementById("AnoTR").value;
	var Estado = document.getElementById("Estado").value;
	var TipoCBC = document.getElementById("TipoCBC").value;
	var NroCBC = document.getElementById("NroCBC").value;
	var idMarca = document.getElementById("idMarca").value;
	var ajax=nuevoAjax();
	ajax.open("POST", "transformadorAgregar.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("Detalle="+Detalle+"&Tipo="+Tipo+"&Serie="+Serie+"&Potencia="+Potencia+"&KV="+KV+"&Gconexion="+Gconexion+"&Campo="+Campo+"&AnoTR="+AnoTR+"&Estado="+Estado+"&TipoCBC="+TipoCBC+"&NroCBC="+NroCBC+"&idMarca="+idMarca+"&accion="+accion+"&idTransformador="+idTransformador);

	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta)
			//document.getElementById('miModal').style.display = 'none'; //oculto el div
			location.href='#'; //oculto el div modal usando la transicion del css
		} 
	}
	Filtrar('Serie')

}

/*function AnalisisNuevo(idTransformador){

	var ajax=nuevoAjax();
	ajax.open("POST", "analisisNuevo.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
	ajax.send("idTransformador="+idTransformador);
	
	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta);
			document.getElementById('div_principal').innerHTML=respuesta;
		} 
	}

}*/

function guardarAnalisis(tipo){

	$.ajax({
		url: 'analisisAgregar.php',
		type: 'POST',
		async: true,
		data: $('#formulario').serialize() + "&tipoAnalisis=" + tipo,

		success: function(response){
			//alert(response);

		},
		
		error: function(error){
			alert('Error al guardar el análisis');
		}
	});
	location.href='#';
	//$('.modal').fadeOut();
}

/*function VerAnalisis(idTransformador){

	var ajax=nuevoAjax();
	ajax.open("POST", "analisisListaAnalisis.php" , true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");	
	ajax.send("idTransformador="+idTransformador);
	
	ajax.onreadystatechange=function() 
	{ 
		if (ajax.readyState==4)
		{
			var respuesta= ajax.responseText;
			//alert(respuesta);
			document.getElementById('div_principal').innerHTML=respuesta;
		} 
	}

}*/

function VerAnalisisModal(idTransformador, Serie){

	document.getElementById('modal-contenido').style.width = '1200px';
	document.getElementById('modal-contenido').style.height = '600px';
	document.getElementById('modal-contenido').style.overflow = 'scroll';
	$.ajax({
		url: 'analisisListaAnalisis.php',
		type: 'POST',
		async: true,
		data: {idTransformador:idTransformador, Serie:Serie},

		success: function(response){
			//alert(response);
			
			document.getElementById('div_modal').innerHTML=response;
			//$('.modal').fadeIn();
			location.href='#miModal';
		},
		
		error: function(error){
			alert('Error al mostrar los análisis');
		}
	});
	
	

}

function ControlColor(id){
	var elem1 = document.getElementById(id)
	var valor = document.getElementById(id).value
    if(id=="Metano"){
		if(valor<120){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=120 && valor<240){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=240){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}
	if(id=="Etileno"){
		if(valor<50){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=50 && valor<100){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=100){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}
	if(id=="Etano"){
		if(valor<65){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=65 && valor<100){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=100){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}	
	if(id=="Acetileno"){
		if(valor<2){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=2 && valor<5){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=5){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}
	if(id=="Hidrogeno"){
		if(valor<100){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=100 && valor<700){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=700){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}	
	if(id=="MdeCarbono"){
		if(valor<350){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=350 && valor<570){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=570){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}	
	if(id=="AnhDeCarbono"){
		if(valor=11000){elem1.style.backgroundColor = "rgb(159,255,159)";}
		//if(valor>=50 && valor<100){elem1.style.backgroundColor = "rgb(255,255,159)";}
		//if(valor>=100){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}
	if(id=="Oxigeno"){
		if(valor=1000){elem1.style.backgroundColor = "rgb(159,255,159)";}
		//if(valor>=350 && valor<570){elem1.style.backgroundColor = "rgb(255,255,159)";}
		//if(valor>=570){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}	
	if(id=="Nitrogeno"){
		if(valor=1000){elem1.style.backgroundColor = "rgb(159,255,159)";}
		//if(valor>=350 && valor<570){elem1.style.backgroundColor = "rgb(255,255,159)";}
		//if(valor>=570){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}
	if(id=="TGasesComb"){
		if(valor<700){elem1.style.backgroundColor = "rgb(159,255,159)";}
		if(valor>=700 && valor<1900){elem1.style.backgroundColor = "rgb(255,255,159)";}
		if(valor>=1900){elem1.style.backgroundColor = "rgb(255,170,170)";}
	}						
}

function ControlFAL(){
	var FAL=parseFloat(document.getElementById('FAL').value.replace(",","."));
	
	if(FAL>0.1){
		document.getElementById('Estado').value="Envejecimiento"
	}
	else{
		document.getElementById('Estado').value="Normal"
	}
}

function solonumerosdecimales(evt)
{
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	if(keyPressed!=47){
		return !(((keyPressed < 46 || keyPressed > 57)) && ((keyPressed < 7 || keyPressed > 9)));
	}else{
		return false;
	}
}


function validar(tipoAnalisis){
	document.getElementById("tipoAnalisis").value=tipoAnalisis;

	var idTransformador = document.getElementById("idTransformador");
	if (idTransformador==0){
		alert("Debe especificar el Transformador")
		return
	}
	else{
		document.formulario.submit();
		location.href='javascript:window.close()'
	}
}

