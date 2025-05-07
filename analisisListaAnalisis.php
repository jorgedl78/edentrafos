<?php
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    include("func.php");

	$idTransformador=$_POST['idTransformador'];
	$Serie=$_POST['Serie'];

    $cn=Conectar();
	//$rs=mysqli_query($cn,"SELECT idAnalisis,DATE_FORMAT(Fecha, '%d/%m/%Y') as Fecha, Humedad, Acidez, TensionInter, Tang, Rigidez, Inhibidor, ComPolares, Lodos, HMF, FAL, ACF, MEF, DP, Estado, Metano,Etileno,Etano,Acetileno,Hidrogeno,MdeCarbono,AnhCarbono,Oxigeno,Nitrogeno,tGasesComb,GasesTotales,PresionSatGases,TemperaturaMuestra, Comentario FROM analisis WHERE idTransformador=$idTransformador");
$rs=mysqli_query($cn,"SELECT idAnalisis,DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr , Metano,Etileno,Etano,Acetileno,Hidrogeno,MdeCarbono,AnhCarbono,Oxigeno,Nitrogeno,tGasesComb,GasesTotales,PresionSatGases,TemperaturaMuestra, Comentario FROM analisis WHERE idTransformador=$idTransformador order by Fecha desc");


$rsfq=mysqli_query($cn,"SELECT DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr,Humedad,Acidez,TensionInter,Tang,Rigidez,Inhibidor,ComPolares,Lodos FROM analisisfq WHERE idTransformador=$idTransformador  order by Fecha desc");

$rsdp=mysqli_query($cn,"SELECT DATE_FORMAT(Fecha, '%d/%m/%Y') as FechaStr,HMF,FAL,ACF,MEF,DP,Estado, Comentario FROM `analisisdp` where idTransformador=$idTransformador  order by Fecha desc ");

$row_count = $rs->num_rows;
if($row_count >0 ){ 

?>

<input type="hidden" value="<?php $Serie ?>">
<h3>Análisis de Gases para el Trafo: <?php echo $Serie ?></h3>
<table>
		<tr>
		<th align="center">Fecha</th>      
		<th align="center">Metano</th>
		<th align="center">Etileno</th>
		<th align="center">Etano</th>
		<th align="center">Acetileno</th>
		<th align="center">Hidrogeno</th>
		<th align="center">M.de Carbono</th>
		<th align="center">Anh. Carbono</th>
		<th align="center">Oxigeno</th>
		<th align="center">Nitrogeno</th>
		<th align="center">Total Gases Comb.</th>
		<th align="center">Gases Totales</th>
		<th align="center">Presion Sat. Gases</th>
		<th align="center">Temp. Muestra</th>
        <th align="center">Dor.</th>
        <th align="center">Duv.</th>
        <th align="center">Comentario</th>
	</tr>

	<?php 			
	while(	$row = mysqli_fetch_assoc($rs))
	{
		?>
		<tr class="tr_datos">
			<td align="right"><?php echo $row['FechaStr'] ?></td>
			<td align="right"><?php echo $row['Metano'] ?></td>
			<td align="right"><?php echo $row['Etileno'] ?></td>
			<td align="right"><?php echo $row['Etano'] ?></td>
			<td align="right"><?php echo $row['Acetileno'] ?></td>
			<td align="right"><?php echo $row['Hidrogeno'] ?></td>
			<td align="right"><?php echo $row['MdeCarbono'] ?></td>
			<td align="right"><?php echo $row['AnhCarbono'] ?></td>
			<td align="right"><?php echo $row['Oxigeno'] ?></td>
			<td align="right"><?php echo $row['Nitrogeno'] ?></td>
			<td align="right"><?php echo $row['tGasesComb'] ?></td>
			<td align="right"><?php echo $row['GasesTotales'] ?></td>
			<td align="right"><?php echo $row['PresionSatGases'] ?></td>
			<td align="right"><?php echo $row['TemperaturaMuestra'] ?></td>
  <td class="Input_titulo"><img src="imagenes/iconoDornenberg.png" onClick="AbrirMetodoDornenberg('','<?php echo $row['idAnalisis'] ?>')"/></td>
            <td class="Input_titulo"><img src="imagenes/iconoDornenberg.png" onClick="AbrirMetodoDuvalTriangle('','<?php echo $row['idAnalisis'] ?>')"/></td>
			<?php if($row['Comentario']==''){?>
				<td class="Input_titulo" align='center'></td>
			<?php
			 } ?>
			<?php if($row['Comentario']!=''){?>
				<!--<td class="Input_titulo" align='center'><img src="Imagenes/lupa.png" onClick="alert('<?php echo $row['Comentario'] ?>')"/></td>-->
				<td class="Input_titulo" align="center"><img src="imagenes/lupa.png" onClick="AbrirMetodoDuvalTriangle('<?php echo $row['idAnalisis'] ?>')"/></td>
			<?php
			 } ?>			 
				
            
		</tr>
        
	<?php } ?>

</table>

<h3>Análisis Físico Químico</h3>
<table>
		<tr>
		<th align="center">Fecha</th>      
		<th align="center">Humedad</th>
		<th align="center">Acidez</th>
		<th align="center">Tens. Inter</th>
		<th align="center">Tang</th>
		<th align="center">Rigidez</th>
		<th align="center">Inhibidor</th>
		<th align="center">ComPolares</th>
		<th align="center">Lodos</th>
	</tr>

	<?php 			
	while(	$row = mysqli_fetch_assoc($rsfq))
	{
		?>
		<tr class="tr_datos">
			<td align="right"><?php echo $row['FechaStr'] ?></td>
			<td align="right"><?php echo $row['Humedad'] ?></td>
			<td align="right"><?php echo $row['Acidez'] ?></td>
			<td align="right"><?php echo $row['TensionInter'] ?></td>
			<td align="right"><?php echo $row['Tang'] ?></td>
			<td align="right"><?php echo $row['Rigidez'] ?></td>
			<td align="right"><?php echo $row['Inhibidor'] ?></td>
			<td align="right"><?php echo $row['ComPolares'] ?></td>
			<td align="right"><?php echo $row['Lodos'] ?></td>
		</tr>
        
	<?php } ?>

</table>

<h3>Análisis Degradación de Papel</h3>
<table>
		<tr>
		<th align="center">Fecha</th>      
		<th align="center">HMF</th>
		<th align="center">FAL</th>
		<th align="center">ACF</th>
		<th align="center">MEF</th>
		<th align="center">DP</th>
		<th align="center">Estado</th>
		<th align="center">Comentario</th>
	</tr>

	<?php 			
	while(	$row = mysqli_fetch_assoc($rsdp))
	{
		?>
		<tr class="tr_datos">
			<td align="right"><?php echo $row['FechaStr'] ?></td>
			<td align="right"><?php echo $row['HMF'] ?></td>
			<td align="right"><?php echo $row['FAL'] ?></td>
			<td align="right"><?php echo $row['ACF'] ?></td>
			<td align="right"><?php echo $row['MEF'] ?></td>
			<td align="right"><?php echo $row['DP'] ?></td>
			<td align="right"><?php echo $row['Estado'] ?></td>
			<td align="right"><?php echo $row['Comentario'] ?></td>
		</tr>
        
	<?php } ?>

</table>

<?php }
else{
	echo '<h4 align="center">No se encuentran análisis para este transformador<h4>';
} ?>

<br>
<input type="button" value="Cerrar" class="boton" onclick="location.href='#'">
