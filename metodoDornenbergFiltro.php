<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php
    include("func.php");
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    
	$localidad=$_GET['localidad'];
	$marca=$_GET['marca'];
	$serie=$_GET['serie'];

	$divsTriangulos='';

	if ($localidad=='0'){$desdeLocalidad='%'; $hastaLocalidad='9';}
	else{$desdeLocalidad=$localidad; $hastaLocalidad=$localidad;}
	if ($marca=='0'){$desdeMarca=0; $hastaMarca=99999;}
	else{$desdeMarca=$marca; $hastaMarca=$marca;}
    $cn=Conectar();
	$rsTrafos=mysqli_query($cn,"select transformadores.*, marcas.Marca from transformadores inner join marcas on transformadores.idmarca=marcas.idmarca WHERE transformadores.Detalle like '$desdeLocalidad' and transformadores.idMarca BETWEEN '$desdeMarca' and '$hastaMarca' and Serie like '%$serie' order by Detalle");
	$row_count = $rsTrafos->num_rows;
	if($row_count >0 ){ 
		//recorro los transformadores filtrados
		$c=0;
		while(	$rowTrafos = mysqli_fetch_assoc($rsTrafos)){
			//traigo el último análisis del transformador
			$rsUltimoAnalisis=mysqli_query($cn,"SELECT Metano,Acetileno,Hidrogeno, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario FROM analisis WHERE idTransformador=".$rowTrafos['idTransformador']." order by Fecha desc limit 1");

			//envio datos para calcular y armar el div para este trafo
			if($rsUltimoAnalisis->num_rows>0){
				$rowAnalisis = mysqli_fetch_assoc($rsUltimoAnalisis);
				CalcularCordenadas($rowAnalisis['FechaStr'], $rowAnalisis['Comentario'], $rowTrafos['Serie'], $rowAnalisis['Metano'],$rowAnalisis['Hidrogeno'],$rowAnalisis['Acetileno']);
			}

		}
	}

function CalcularCordenadas($fecha, $comentario, $serie, $Metano,$Hidrogeno, $Acetileno){
	global $divsTriangulos;

	$Ch4_H2=round($Metano / $Hidrogeno,4); //eje Y
	$C2H2_CH4=round($Acetileno / $Metano,4); //eje X	
	
	if($Ch4_H2 < 0.025){$top=277;}
	if($Ch4_H2 >= 0.025 and $Ch4_H2 < 0.05){$top=268;}	
	if($Ch4_H2 >= 0.05  and $Ch4_H2 < 0.075){$top=257;}	
	if($Ch4_H2 >= 0.075  and $Ch4_H2 < 0.1){$top=246;}		
	if($Ch4_H2 >= 0.1  and $Ch4_H2 < 0.25){$top=235;}			
	if($Ch4_H2 >= 0.25  and $Ch4_H2 < 0.50){$top=220;}				
	if($Ch4_H2 >= 0.50  and $Ch4_H2 < 0.75){$top=205;}					
	if($Ch4_H2 >= 0.75  and $Ch4_H2 < 1){$top=190;}						
	if($Ch4_H2 >= 1  and $Ch4_H2 < 2.5){$top=175;}			
	if($Ch4_H2 >= 2.5  and $Ch4_H2 < 5){$top=158;}				
	if($Ch4_H2 >= 5  and $Ch4_H2 < 7.5){$top=142;}					
	if($Ch4_H2 >= 7.5  and $Ch4_H2 < 10){$top=126;}	
	
	//valores para el eje x
	if($C2H2_CH4 < 0.001){$left=80;}
	if($C2H2_CH4 >= 0.001 and $C2H2_CH4 < 0.0025){$left=100;}	
	if($C2H2_CH4 >= 0.0025  and $C2H2_CH4 < 0.005){$left=125;}	
	if($C2H2_CH4 >= 0.005  and $C2H2_CH4 < 0.0075){$left=150;}			
	if($C2H2_CH4 >= 0.0075  and $C2H2_CH4 < 0.01){$left=175;}
	if($C2H2_CH4 >= 0.01  and $C2H2_CH4 < 0.025){$left=200;}	
	if($C2H2_CH4 >= 0.025 and $C2H2_CH4 < 0.05){$left=127;}	
	if($C2H2_CH4 >= 0.05  and $C2H2_CH4 < 0.075){$left=154;}	
	if($C2H2_CH4 >= 0.075  and $C2H2_CH4 < 0.1){$left=181;}		
	if($C2H2_CH4 >= 0.1  and $C2H2_CH4 < 0.25){$left=310;}			
	if($C2H2_CH4 >= 0.25  and $C2H2_CH4 < 0.50){$left=340;}				
	if($C2H2_CH4 >= 0.50  and $C2H2_CH4 < 0.75){$left=370;}					
	if($C2H2_CH4 >= 0.75  and $C2H2_CH4 < 1){$left=400;}						
	if($C2H2_CH4 >= 1  and $C2H2_CH4 < 2.5){$left=430;}			
	if($C2H2_CH4 >= 2.5  and $C2H2_CH4 < 5){$left=458;}				
	if($C2H2_CH4 >= 5  and $C2H2_CH4 < 7.5){$left=486;}					
	if($C2H2_CH4 >= 7.5  and $C2H2_CH4 < 10){$left=514;}	
	if($C2H2_CH4 >= 10  and $C2H2_CH4 < 25){$left=540;}			
	if($C2H2_CH4 >= 25  and $C2H2_CH4 < 50){$left=570;}				
	if($C2H2_CH4 >= 50  and $C2H2_CH4 < 75){$left=600;}					
	if($C2H2_CH4 >= 75  and $C2H2_CH4 < 100){$left=630;}		
	if($C2H2_CH4 >= 100 ){$left=660;}

	$divsTriangulos.='<div><img src="imagenes/Triangulo.gif" width="55" height="49" title="'.$serie.': '.$fecha.' - '.$comentario.'" style="position: absolute; top: '.$top.'px; left: '.$left.'px; width:50px;"/></div>';

}

 ?>


<style type="text/css">

#divReferencias{
  	width:100px;
	float:right;
	margin: 1em;
	border: 1px solid #39b5d6;
	-moz-border-radius: 9px;
	-webkit-border-radius:9px;
	padding: 4px;
	margin-top: 1em; 
	margin-bottom: 0.5em;
    -moz-box-shadow: 6px 5px 0px #000000;
    -webkit-box-shadow: 6px 5px 0px #000000;
    box-shadow: 6px 5px 0px #000000;
}


.boton{
    font-size:12px;
    font-weight:bold;
    color:white;
    background:#638cb5;
    border:0px;
    -moz-border-radius: 9px;
 	-webkit-border-radius:9px;
    width:auto;
    height:auto;
    padding: 0.5em;
    padding-left: 1em;
    padding-right: 1em;
    clear: both;
}

</style>
</head>

<body background="imagenes/metodoDornenberg.png" style="background-repeat: no-repeat;" >
<?php echo $divsTriangulos ?>
<div id="divReferencias">
	<div align="center"><input type="button" value="Cerrar" class="boton" onclick="window.close()"></div>				
</div>

</html>