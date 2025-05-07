<?php
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    include("func.php");

	$idTransformador=$_GET['idTransformador'];

    $cn=Conectar();
	$rs=mysqli_query($cn,"SELECT idAnalisis,DATE_FORMAT(Fecha, '%d/%m/%Y') as Fecha, Humedad, Acidez, TensionInter, Tang, Rigidez, Inhibidor, ComPolares, Lodos, HMF, FAL, ACF, MEF, DP, Estado, Metano,Etileno,Etano,Acetileno,Hidrogeno,MdeCarbono,AnhCarbono,Oxigeno,Nitrogeno,tGasesComb,GasesTotales,PresionSatGases,TemperaturaMuestra, Comentario FROM analisis WHERE idTransformador=$idTransformador");

$rsfq=mysqli_query($cn,"SELECT DATE_FORMAT(Fecha, '%d/%m/%Y') as Fecha,ContenidoDeAgua,HumedadEnSolidos,Acidez,ContenidoInhibidor,RigidezDielectrica,ContenidoDeLodos,Tension,TemperaturaTangente,TangenteDelta,PuntoInflamacion FROM analisisfq WHERE idTransformador=$idTransformador");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Análisis de Transformadores</title>
<link rel="stylesheet" href="Estilos/Estilo_gral.css" type="text/css">
</head>
<body onload="iniciarFecha()">

<header>

</header>

<form action="analisisAgregar.php" method="POST">
<table align="center" WIDTH="90%" class="Borde_tabla_index" cellspacing="2" cellpadding="2">
		<tr>
        <td colspan="8" align="center"><h2 class="Titulos_recargas">Resultados</h2></td>
        </tr>
		<tr>
		<td class="Input_titulo">Fecha</td>
		<td class="Input_titulo">Ch4/h2</td>
        <td class="Input_titulo">C2H2/CH4</td>
        <td class="Input_titulo">C2H4/C2H6</td>
        <td class="Input_titulo">C2H2/C2H4</td>
        <td class="Input_titulo">CO2/CO</td>
        <td class="Input_titulo">O2/N2</td>
        <td class="Input_titulo">Comentario</td>
	</tr>

	<?php 			
	$colorfondo=0;
	while(	$row = mysqli_fetch_assoc($rs))
	{
		if ($colorfondo==0){
			$color= "#F2F2F2";
			$colorfondo=1;
		}else{
			$color= "#FFFFFF";
			$colorfondo=0;
		}

		?>
		<tr bgcolor="<?php echo $color; ?>">
			<td align="right" class="Form_listados"><?php echo $row['Fecha'] ?></td>
            <td align="right" class="Form_listados"><?php echo round($row['Metano'] / $row['Hidrogeno'],2) ?></td>
            <td align="right" class="Form_listados"><?php echo round($row['Acetileno'] / $row['Metano'],2)?></td>
            <td align="right" class="Form_listados"><?php echo round($row['Etileno'] / $row['Etano'],2) ?></td>
            <td align="right" class="Form_listados"><?php echo round($row['Acetileno'] / $row['Etileno'],2) ?></td>
            <td align="right" class="Form_listados"><?php echo round($row['AnhCarbono'] / $row['MdeCarbono'],2) ?></td>
            <td align="right" class="Form_listados"><?php echo round($row['Oxigeno'] / $row['Nitrogeno'],2) ?></td>
            <td align="right" class="Form_listados"><?php echo $row['Comentario'] ?></td>
    		</tr>
        
	<?php } ?>

</table>
<BR><BR>
<!--<table align="center" WIDTH="90%" class="Borde_tabla_index" cellspacing="2" cellpadding="2">
		<tr>
        <td colspan="15" align="center"><h2 class="Titulos_recargas">Análisis Físico Químico</h2></td>
        </tr>
		<tr>
		<td class="Input_titulo">Fecha</td>
		<td class="Input_titulo">Contenido de Agua</td>
		<td class="Input_titulo">Humedad en Sólidos</td>
		<td class="Input_titulo">Acidez</td>
		<td class="Input_titulo">Contenido Inhibidor</td>
		<td class="Input_titulo">Rigidez Dieléctrica</td>
		<td class="Input_titulo">Contenido de Lodos</td>
		<td class="Input_titulo">Tensión</td>
		<td class="Input_titulo">Temperatura Tangente</td>
		<td class="Input_titulo">Temperatura Tangente Delta</td>
		<td class="Input_titulo">Punto Inflamación</td>
        <td class="Input_titulo">Comentario</td>
		
	</tr>

	<?php 			
	$colorfondo=0;
	while(	$row = mysqli_fetch_assoc($rsfq))
	{
		if ($colorfondo==0){
			$color= "#F2F2F2";
			$colorfondo=1;
		}else{
			$color= "#FFFFFF";
			$colorfondo=0;
		}

		?>
		<tr bgcolor="<?php echo $color; ?>">
			<td align="right" class="Form_listados"><?php echo $row['Fecha'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['ContenidoDeAgua'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['HumedadEnSolidos'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['Acidez'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['ContenidoInhibidor'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['RigidezDielectrica'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['ContenidoDeLodos'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['Tension'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['TemperaturaTangente'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['TangenteDelta'] ?></td>
			<td align="right" class="Form_listados"><?php echo $row['PuntoInflamacion'] ?></td>
			<td align="right" class="Form_listados">Ver</td>


			
		</tr>
	<?php } ?>

</table>-->
</form>




