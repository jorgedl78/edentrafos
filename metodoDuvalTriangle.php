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

	$mostrar="none";

    $cn=Conectar();
	if(!$idTransformador){//fue llamado desde la lista de analiis
		$rs=mysqli_query($cn,"SELECT  Metano,Etileno,Acetileno, Serie, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario FROM analisis  Inner Join transformadores on analisis.idTransformador = transformadores.idTransformador WHERE analisis.idAnalisis=$idAnalisis");
	}
	else{//fue llamado desde 
		$rs=mysqli_query($cn,"SELECT   Metano,Etileno,Acetileno, idAnalisis, Serie, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario  FROM analisis  Inner Join transformadores on analisis.idTransformador = transformadores.idTransformador WHERE analisis.idTransformador=$idTransformador order by Fecha desc limit 1");
	}
	if($rs->num_rows>0){

		$mostrar='si';	
		$row = mysqli_fetch_assoc($rs);
		$serie=$row['Serie'];
		$fecha=$row['FechaStr'];
		$comentario=$row['Comentario'];
		$Acetileno=round((100 * $row['Acetileno']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		$Etileno=round((100 * $row['Etileno']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		$Metano=round((100 * $row['Metano']) / ($row['Acetileno'] + $row['Etileno'] + $row['Metano']),2);
		
		$ejeX=(100-$Acetileno)-($Metano/(tan(60*pi()/180)));
		$ejeY=$Metano;
		
		$top=(370*(100-$ejeY))/100;
		$left=(450*$ejeX)/100;


		$w="50px";
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

#divTriangulo {
  position: absolute;
  top: <?php echo $top;?>px;
  left: <?php echo $left;?>px;
  width: 50px;	
  display: <?php echo $mostrar?>;  
}

h5{
	font-size: 16px;
	font-family: "Calibri", "Verdana", Tahoma;
	margin-left: 0.5em;
	color: #39b5d6; 
}

</style>
</head>

<body background="imagenes/duvalTriangle.png" style="background-repeat: no-repeat;">
<div id="divTriangulo"><img src="imagenes/Triangulo.gif" width="55" height="49" title="<?php echo $fecha.' - '.$comentario;?>" />
</div>
<div id="divReferencias">
	<h5><?php echo 'Trafo: '.$serie ?></h5>
	<h5><?php echo $fecha ?></h5>
	<div align="center"><input type="button" value="Cerrar" class="boton" onclick="window.close()"></div>				
</div>
</html>