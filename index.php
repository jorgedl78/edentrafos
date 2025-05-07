<!doctype html>
<html>
	<head>
		<title>Transformadores EDEN</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
		<script type="text/javascript" src="js/funciones.js"></script>
		<script src="js/jquery-3.5.1.min.js"></script>
		<link rel="icon" type="image/png" href="imagenes/favicon.png">	
</script>


	</head>
	<body onload="controlarSesion()">
		<section id="contenedor">
			<section>
				<?php require 'require-include/cabecera.php' ?>
			</section>
			<section id="contenido_principal">
				<div id="div_principal"></div>				
			</section>
			<!-- <a href="#miModal">Abrir Modal</a> -->
			<div id="miModal" class="modal">
			  <div class="modal-contenido" id="modal-contenido">
			    <!-- <a href="#">X</a> -->
			    <p>
			    	<div id="div_modal"></div>
			    </p>
			  </div>  
			</div>
			<div id="graficoModal" class="graficoModal">
			  <div class="grafico-contenido">
			    <!-- <a href="#">X</a> -->
			    <p>
			    	<div id="div_grafico"></div>
			    </p>
			  </div>  
			</div>	
			<div id="chicoModal" class="chicoModal">
			  <div class="chico-contenido">
			    <!-- <a href="#">X</a> -->
			    <p>
			    	<div id="div_chico"></div>
			    </p>
			  </div>  
			</div>							
			<footer>
				<h5>Diseñado por Jorge de León - Para EDEN S.A </h5>
			</footer>
		</section>
	</body>
</html>
