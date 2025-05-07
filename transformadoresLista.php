<?php
    include("func.php");
    
	$localidad=$_POST['localidad'];
	$marca=$_POST['marca'];
	$serie=$_POST['serie'];
	$ordenarPor=$_POST['ordenarPor'];
	$sentido=$_POST['sentido'];
	
	if(empty($ordenarPor)){
		$ordenarPor='Detalle';
	}
	
	//$ordenarPor='Detalle';
	if ($localidad=='0'){$desdeLocalidad='%'; $hastaLocalidad='9';}
	else{$desdeLocalidad=$localidad; $hastaLocalidad=$localidad;}
	if ($marca=='0'){$desdeMarca=0; $hastaMarca=99999;}
	else{$desdeMarca=$marca; $hastaMarca=$marca;}

	$o_Detalle=''; $o_Tipo=''; $o_Serie=''; $o_Potencia=''; $o_KV='';$o_Gconexion='';$o_Campo='';$AnoTR='';$o_Estado=''; $o_TipoCBC='';$o_NroCBC='';
	$o='↓';
	if($sentido=='Desc'){$o='↑';}

	switch ($ordenarPor) {
	    case 'Detalle':
	        $o_Detalle=$o;
	        break;
	    case 'Tipo':
	    	$o_Tipo=$o;
	        break;
	    case 'Serie':
	    	$o_Serie=$o;
	        break;
   	    case 'Potencia':
	    	$o_Potencia=$o;
	        break;
	    case 'KV':
	    	$o_KV=$o;
	        break;
	    case 'Gconexion':
	    	$o_Gconexion=$o;
	        break;	
	    case 'Campo':
	    	$o_Campo=$o;
	        break;	
	    case 'AnoTR':
	    	$o_AnoTR=$o;
	        break;
	    case 'Estado':
	    	$o_Estado=$o;
	        break;
	    case 'TipoCBC':
	    	$o_TipoCBC=$o;
	        break;
	    case 'NroCBC':
	    	$o_NroCBC=$o;
	        break;
	}

//echo "select transformadores.*, marcas.Marca from transformadores inner join marcas on transformadores.idmarca=marcas.idmarca WHERE transformadores.Detalle like '$desdeLocalidad' and transformadores.idMarca BETWEEN '$desdeMarca' and '$hastaMarca' and Serie like '%$serie' order by ".$ordenarPor." ".$sentido;


    $cn=Conectar();
	$rs=mysqli_query($cn,"select transformadores.*, marcas.Marca from transformadores inner join marcas on transformadores.idmarca=marcas.idmarca WHERE transformadores.Detalle like '$desdeLocalidad' and transformadores.idMarca BETWEEN '$desdeMarca' and '$hastaMarca' and Serie like '%$serie' order by ".$ordenarPor." ".$sentido);
	$row_count = $rs->num_rows;

if($row_count >0 ){ ?>

<table>
		<tr align="center">
		<th onClick="Filtrar('Detalle <?php echo $o_Detalle ?>')">Lugar <?php echo $o_Detalle ?></th>
		<th onClick="Filtrar('Tipo <?php echo $o_Tipo ?>')">Tipo <?php echo $o_Tipo ?></th>
		<th onClick="Filtrar('Serie <?php echo $o_Serie ?>')">Serie  <?php echo $o_Serie ?></th>
		<th onClick="Filtrar('Potencia <?php echo $o_Potencia ?>')">Potencia  <?php echo $o_Potencia ?></th>
		<th onClick="Filtrar('KV <?php echo $o_KV ?>')">KV  <?php echo $o_KV ?></th>
		<th onClick="Filtrar('Gconexion <?php echo $o_Gconexion ?>')">G Conexion  <?php echo $o_Gconexion ?></th>
		<th onClick="Filtrar('Campo <?php echo $o_Campo ?>')">Campo  <?php echo $o_Campo ?></th>
		<th onClick="Filtrar('AnoTR <?php echo $o_AnoTR ?>')">Año  <?php echo $o_AnoTR ?></th>
		<th onClick="Filtrar('Estado <?php echo $o_Estado ?>')">Estado  <?php echo $o_Estado ?></th>
		<th onClick="Filtrar('TipoCBC <?php echo $o_TipoCBC ?>')">Tipo CBC  <?php echo $o_TipoCBC ?></th>
		<th onClick="Filtrar('NroCBC <?php echo $o_NroCBC ?>')">Nro CBC  <?php echo $o_NroCBC ?></th>
		<th>Marca</th> 
        <th>Cambiar</th>
        <th>Ana.</th>
        <th>Ver Ana.</th>
        <!-- <th>An.G</th>   -->
        <th colspan="2">Dornenberg</th> 
        <th colspan="2" >Duval</th> 
	</tr>

	<?php 			
	$colorfondo=0;
	while(	$row = mysqli_fetch_assoc($rs))
	{
		?>
		<tr class="tr_datos">
			<td align="left"><?php echo $row['Detalle'] ?></td>
			<td align="left"><?php echo $row['Tipo'] ?></td>
			<td align="center"><?php echo $row['Serie'] ?></td>
			<td align="center"><?php echo $row['Potencia'] ?></td>
			<td align="center"><?php echo $row['KV'] ?></td>
			<td align="center"><?php echo $row['Gconexion'] ?></td>
			<td align="center"><?php echo $row['Campo'] ?></td>
			<td align="center"><?php echo $row['AnoTR'] ?></td>
			<td align="center"><?php echo $row['Estado'] ?></td>
			<td align="center"><?php echo $row['TipoCBC'] ?></td>
			<td align="center"><?php echo $row['NroCBC'] ?></td>
			<td align="center"><?php echo $row['Marca'] ?></td>
            <td align="center"><img src="imagenes/Modifica.png" onClick="ModificarTransformadorModal('<?php echo $row['idTransformador'] ?>')"/></td>
            <td align="center"><img src="imagenes/agregar.png" onClick="AnalisisNuevoModal('<?php echo $row['idTransformador'] ?>')"/></td>
            <td align="center"><img src="imagenes/lupa.png" onClick="VerAnalisisModal(<?php echo $row['idTransformador']?> , <?php echo $row['Serie'] ?>)"/></td>
            <!-- <td align="center"><img src="Imagenes/lupa.png" onClick="MM_openBrWindow('<?php echo $row['idTransformador'] ?>')"/></td>  --> 

            <td><img src="imagenes/iconoDornenberg.png" onClick="AbrirMetodoDornenberg('<?php echo $row['idTransformador'] ?>')"/></td>
            <td><img src="imagenes/top5.png" onClick="AbrirMetodoDornenbergTop5('<?php echo $row['idTransformador'] ?>')"/></td> 
            <td><img src="imagenes/iconoDornenberg.png" onClick="AbrirMetodoDuvalTriangle('<?php echo $row['idTransformador'] ?>')"/></td>
             <td><img src="imagenes/top5.png" onClick="AbrirMetodoDuvalTriangleTop5('<?php echo $row['idTransformador'] ?>')"/></td>           
		</tr>
        
	<?php } ?>
<tr>
		<td colspan="13" align="center"></td></tr>
</table>
<div class="div_borde" style="float: right;">
	<table>
		<tr>
			<td><h4>Gráficos Comparativos</h4></td>	
			<td><input type="button" value="Metodo Dornenberg" class="boton" onClick="AbrirMetodoDornenbergFiltro()"></td>
			<td><input type="button" value="Metodo DuvalTriangle" class="boton" onClick="AbrirMetodoDuvalTriangleFiltro()"></td>
		</tr>
	</table>
</div>
<?php }
else{
	echo '<h4 align="center">No se encuentran transformadores en esta búsqueda<h4>';
} ?>


