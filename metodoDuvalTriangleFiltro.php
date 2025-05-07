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
    while(  $rowTrafos = mysqli_fetch_assoc($rsTrafos)){
      //traigo el último análisis del transformador
      $rsUltimoAnalisis=mysqli_query($cn,"SELECT   Metano,Etileno,Acetileno, DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr, Comentario, idAnalisis   FROM analisis WHERE idTransformador=".$rowTrafos['idTransformador']." order by Fecha desc limit 1");



      //envio datos para calcular y armar el div para este trafo
      if($rsUltimoAnalisis->num_rows>0){
        $rowAnalisis = mysqli_fetch_assoc($rsUltimoAnalisis);
        $Acetileno=round((100 * $rowAnalisis['Acetileno']) / ($rowAnalisis['Acetileno'] + $rowAnalisis['Etileno'] + $rowAnalisis['Metano']),2);
        $Etileno=round((100 * $rowAnalisis['Etileno']) / ($rowAnalisis['Acetileno'] + $rowAnalisis['Etileno'] + $rowAnalisis['Metano']),2);
        $Metano=round((100 * $rowAnalisis['Metano']) / ($rowAnalisis['Acetileno'] + $rowAnalisis['Etileno'] + $rowAnalisis['Metano']),2);        
        CalcularCordenadas($rowAnalisis['FechaStr'], $rowAnalisis['Comentario'], $rowTrafos['Serie'], $Metano,$Etileno,$Acetileno);
      }

    }
  }

function CalcularCordenadas($fecha, $comentario, $serie, $Metano,$Etileno, $Acetileno){
  
  global $divsTriangulos;

  /*$Acetileno=round((100 * $Acetileno) / ($Acetileno + $Etileno + $Metano),2);
  $Etileno=round((100 * $Etileno) / ($Acetileno + $Etileno + $Metano),2);
  $Metano=round((100 * $Metano) / ($Acetileno + $Etileno + $Metano),2);*/

  $ejeX=(100-$Acetileno)-($Metano/(tan(60*pi()/180)));
  $ejeY=$Metano;
  
  $top=(370*(100-$ejeY))/100;
  $left=(450*$ejeX)/100;

 /* echo "Acetileno: ".$Acetileno;
  echo "<br>";
  echo "Etileno: ".$Etileno;
  echo "<br>";
  echo "Metano: ".$Metano;
  echo "<br>";
echo "serie: ".$serie;
echo "<br>";
  echo "top: ".$top;
echo "<br>";
echo "left: ".$left;
echo "<br>";*/

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

<body background="imagenes/duvalTriangle.png" style="background-repeat: no-repeat;">
<?php echo $divsTriangulos ?>  
<div id="divReferencias">
	<div align="center"><input type="button" value="Cerrar" class="boton" onclick="window.close()"></div>
</div>
</html>