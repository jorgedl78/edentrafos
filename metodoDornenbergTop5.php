<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php
    include("func.php");
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    
	$idTransformador=$_GET['idTransformador'];
	$idAnalisis=$_GET['idAnalisis'];

	$fecha=array();
	$top=array();
	$left=array();
	$mostrar=array();
	$comentario=array();
	for ($i = 0; $i <5; $i++) { 
		$mostrar[$i]="none";
	}

    $cn=Conectar();
	$rs=mysqli_query($cn,"SELECT Metano,Acetileno,Hidrogeno, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario FROM analisis WHERE idTransformador=$idTransformador order by Fecha desc limit 5");
	$c=0;
	while($row = mysqli_fetch_assoc($rs)){
		$fecha[$c]=$row['FechaStr'];
		$comentario[$c]=$row['Comentario'];
		$Ch4_H2=round($row['Metano'] / $row['Hidrogeno'],4); //eje Y
		$C2H2_CH4=round($row['Acetileno'] / $row['Metano'],4); //eje X
		CalcularCordenadas($c,$Ch4_H2,$C2H2_CH4);
		$mostrar[$c]="si";
		$c++;
	}

$w="50px";



function CalcularCordenadas($indice, $Ch4_H2,$C2H2_CH4){
	global $top;
	global $left;
	
	if($Ch4_H2 < 0.025){$top[$indice]=277;}
	if($Ch4_H2 >= 0.025 and $Ch4_H2 < 0.05){$top[$indice]=268;}	
	if($Ch4_H2 >= 0.05  and $Ch4_H2 < 0.075){$top[$indice]=257;}	
	if($Ch4_H2 >= 0.075  and $Ch4_H2 < 0.1){$top[$indice]=246;}		
	if($Ch4_H2 >= 0.1  and $Ch4_H2 < 0.25){$top[$indice]=235;}			
	if($Ch4_H2 >= 0.25  and $Ch4_H2 < 0.50){$top[$indice]=220;}				
	if($Ch4_H2 >= 0.50  and $Ch4_H2 < 0.75){$top[$indice]=205;}					
	if($Ch4_H2 >= 0.75  and $Ch4_H2 < 1){$top[$indice]=190;}						
	if($Ch4_H2 >= 1  and $Ch4_H2 < 2.5){$top[$indice]=175;}			
	if($Ch4_H2 >= 2.5  and $Ch4_H2 < 5){$top[$indice]=158;}				
	if($Ch4_H2 >= 5  and $Ch4_H2 < 7.5){$top[$indice]=142;}					
	if($Ch4_H2 >= 7.5  and $Ch4_H2 < 10){$top[$indice]=126;}	
	
	//valores para el eje x
	if($C2H2_CH4 < 0.001){$left[$indice]=80;}
	if($C2H2_CH4 >= 0.001 and $C2H2_CH4 < 0.0025){$left[$indice]=100;}	
	if($C2H2_CH4 >= 0.0025  and $C2H2_CH4 < 0.005){$left[$indice]=125;}	
	if($C2H2_CH4 >= 0.005  and $C2H2_CH4 < 0.0075){$left[$indice]=150;}			
	if($C2H2_CH4 >= 0.0075  and $C2H2_CH4 < 0.01){$left[$indice]=175;}
	if($C2H2_CH4 >= 0.01  and $C2H2_CH4 < 0.025){$left[$indice]=200;}	
	if($C2H2_CH4 >= 0.025 and $C2H2_CH4 < 0.05){$left[$indice]=127;}	
	if($C2H2_CH4 >= 0.05  and $C2H2_CH4 < 0.075){$left[$indice]=154;}	
	if($C2H2_CH4 >= 0.075  and $C2H2_CH4 < 0.1){$left[$indice]=181;}		
	if($C2H2_CH4 >= 0.1  and $C2H2_CH4 < 0.25){$left[$indice]=310;}			
	if($C2H2_CH4 >= 0.25  and $C2H2_CH4 < 0.50){$left[$indice]=340;}				
	if($C2H2_CH4 >= 0.50  and $C2H2_CH4 < 0.75){$left[$indice]=370;}					
	if($C2H2_CH4 >= 0.75  and $C2H2_CH4 < 1){$left[$indice]=400;}						
	if($C2H2_CH4 >= 1  and $C2H2_CH4 < 2.5){$left[$indice]=430;}			
	if($C2H2_CH4 >= 2.5  and $C2H2_CH4 < 5){$left[$indice]=458;}				
	if($C2H2_CH4 >= 5  and $C2H2_CH4 < 7.5){$left[$indice]=486;}					
	if($C2H2_CH4 >= 7.5  and $C2H2_CH4 < 10){$left[$indice]=514;}	
	if($C2H2_CH4 >= 10  and $C2H2_CH4 < 25){$left[$indice]=540;}			
	if($C2H2_CH4 >= 25  and $C2H2_CH4 < 50){$left[$indice]=570;}				
	if($C2H2_CH4 >= 50  and $C2H2_CH4 < 75){$left[$indice]=600;}					
	if($C2H2_CH4 >= 75  and $C2H2_CH4 < 100){$left[$indice]=630;}		
	if($C2H2_CH4 >= 100 ){$left[$indice]=660;}
	
	/*echo 'top: '.$top[$indice];
	echo '<br>';
	echo 'left: '.$left[$indice];
	echo '<br>';*/
	
}

 ?>


<style type="text/css">
#divTriangulo1 {
  position: absolute;
  top: <?php echo $top[0];?>px;
  left: <?php echo $left[0];?>px;
  width: <?php echo $w;?>px;	
  display : <?php echo $mostrar[0];?>; 
   z-index: 5;
   
}


#divTriangulo2 {
  position: absolute;
  top: <?php echo $top[1];?>px;
  left: <?php echo $left[1];?>px;
  width: <?php echo $w;?>px;	
  display : <?php echo $mostrar[1];?>; 
 z-index: 4;  
}

#divTriangulo3 {
  position: absolute;
  top: <?php echo $top[2];?>px;
  left: <?php echo $left[2];?>px;
  width: <?php echo $w;?>px;
  display : <?php echo $mostrar[2];?>;  
 z-index: 3;  
}

#divTriangulo4 {
  position: absolute;
  top: <?php echo $top[3];?>px;
  left: <?php echo $left[3];?>px;
  width: <?php echo $w;?>px;
  display : <?php echo $mostrar[3];?>; 
 z-index: 2;  
}

#divTriangulo5 {
  position: absolute;
  top: <?php echo $top[4];?>px;
  left: <?php echo $left[4];?>px;
  width: <?php echo $w;?>px;
  display : <?php echo $mostrar[4];?>; 
  z-index: 1;   
}

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

h5{
	font-size: 11px;
	font-family: "Calibri", "Verdana", Tahoma;
	margin-left: 1em;
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

<body background="imagenes/metodoDornenberg.png" style="background-repeat: no-repeat;">

<div id="divTriangulo1"><img src="imagenes/Triangulo1.gif" width="55" height="49" title="<?php echo $fecha[0].' - '.$comentario[0];?>"/></div>
<div id="divTriangulo2"><img src="imagenes/Triangulo2.gif" width="55" height="49" title="<?php echo $fecha[1].' - '.$comentario[1];?>"/></div>
<div id="divTriangulo3"><img src="imagenes/Triangulo3.gif" width="55" height="49" title="<?php echo $fecha[2].' - '.$comentario[2];?>"/></div>
<div id="divTriangulo4"><img src="imagenes/Triangulo4.gif" width="55" height="49" title="<?php echo $fecha[3].' - '.$comentario[3];?>" /></div>
<div id="divTriangulo5"><img src="imagenes/Triangulo5.gif" width="55" height="49" title="<?php echo $fecha[4].' - '.$comentario[4];?>" /></div>
<div id="divReferencias">
	<h5 onclick="ponerAlFrente(1);">1: <?php echo $fecha[0];?></h5>
	<h5 onclick="ponerAlFrente(2);">2: <?php echo $fecha[1];?></h5>
	<h5 onclick="ponerAlFrente(3);">3: <?php echo $fecha[2];?></h5>
	<h5 onclick="ponerAlFrente(4);">4: <?php echo $fecha[3];?></h5>
	<h5 onclick="ponerAlFrente(5);">5: <?php echo $fecha[4];?></h5>
	<div align="center"><input type="button" value="Cerrar" class="boton" onclick="window.close()"></div>				
</div>

</html>

<script type="text/javascript">

function ponerAlFrente(indice){
	document.getElementById('divTriangulo1').style.zIndex= '-1';	
	document.getElementById('divTriangulo2').style.zIndex= '-1';	
	document.getElementById('divTriangulo3').style.zIndex= '-1';	
	document.getElementById('divTriangulo4').style.zIndex= '-1';	
	document.getElementById('divTriangulo5').style.zIndex= '-1';	
	document.getElementById('divTriangulo'+indice).style.zIndex= '1';	

}

</script>
