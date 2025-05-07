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
	$rs=mysqli_query($cn,"SELECT   Metano,Etileno,Acetileno, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario   FROM analisis WHERE idTransformador=$idTransformador order by Fecha desc limit 5");
	
	$c=0;
	while($row = mysqli_fetch_assoc($rs)){
		$fecha[$c]=$row['FechaStr'];
		$comentario[$c]=$row['Comentario'];
		$Acetileno=round((100 * $row['Acetileno']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		$Etileno=round((100 * $row['Etileno']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		$Metano=round((100 * $row['Metano']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		CalcularCordenadas($c,$Acetileno,$Metano);
		$mostrar[$c]="si";
		$c++;
	}

	
$w="50px";


function CalcularCordenadas($indice, $Acetileno,$Metano){
	global $top;
	global $left;

	$ejeX=(100-$Acetileno)-($Metano/(tan(60*pi()/180)));
	$ejeY=$Metano;
	
	$top[$indice]=(370*(100-$ejeY))/100;
	$left[$indice]=(450*$ejeX)/100;
}

 ?>



<style type="text/css">
#divTriangulo1 {
  position: absolute;
  top: <?php echo $top[0];?>px;
  left: <?php echo $left[0];?>px;
  width: 50px;	
   display : <?php echo $mostrar[0];?>; 
   z-index: 5;   
}
#divTriangulo2 {
  position: absolute;
  top: <?php echo $top[1];?>px;
  left: <?php echo $left[1];?>px;
  width: 50px;	
   display : <?php echo $mostrar[1];?>; 
   z-index: 4;   
}
#divTriangulo3 {
  position: absolute;
  top: <?php echo $top[2];?>px;
  left: <?php echo $left[2];?>px;
  width: 50px;	
   display : <?php echo $mostrar[2];?>; 
   z-index: 3;   
}
#divTriangulo4 {
  position: absolute;
  top: <?php echo $top[3];?>px;
  left: <?php echo $left[3];?>px;
  width: 50px;	
   display : <?php echo $mostrar[3];?>; 
   z-index: 2;   
}
#divTriangulo5 {
  position: absolute;
  top: <?php echo $top[4];?>px;
  left: <?php echo $left[4];?>px;
  width: 50px;	
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

<body background="imagenes/duvalTriangle.png" style="background-repeat: no-repeat;">
<div id="divTriangulo1"><img src="imagenes/Triangulo1.gif" width="55" height="49" title="<?php echo $fecha[0].' - '.$comentario[0];?>" /></div>
<div id="divTriangulo2"><img src="imagenes/Triangulo2.gif" width="55" height="49" title="<?php echo $fecha[1].' - '.$comentario[1];?>"/></div>
<div id="divTriangulo3"><img src="imagenes/Triangulo3.gif" width="55" height="49" title="<?php echo $fecha[2].' - '.$comentario[2];?>"/></div>
<div id="divTriangulo4"><img src="imagenes/Triangulo4.gif" width="55" height="49" title="<?php echo $fecha[3].' - '.$comentario[3];?>"/></div>
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