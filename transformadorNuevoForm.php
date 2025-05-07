<?php
	session_start();
	//$idTrafo=$_SESSION['idTrafo'];
	//$accion=$_SESSION['accion'];

    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');	
	
	$usuario_nombre=$_SESSION['nombre'];
	$usuario_id=$_SESSION['usuario_id'];
	
	$idTransformador=$_POST['idTransformador'];
	$accion=$_POST['accion'];
	
	//$idTransformador=$idTrafo;	
	//echo "idTrafo:".$idTransformador;
	//echo "accion: ".$accion;


    include("func.php");

    $cn=Conectar();
	$rs=mysqli_query($cn,"SELECT idMarca, Marca FROM marcas Order by Marca");
	$fecha=getdate();
	$boton='Agregar';
	if($idTransformador && $accion!='Nuevo'){
		$boton='Actualizar';
		$rsTrafo=mysqli_query($cn,"select t.*, m.Marca from transformadores t inner join marcas m on t.idMarca=m.idMarca where t.idTransformador=$idTransformador");
		$row = mysqli_fetch_assoc($rsTrafo);
		$Detalle=$row['Detalle'];
		$Tipo=$row['Tipo'];
		$Serie=$row['Serie'];
		$Potencia=$row['Potencia'];
		$KV=$row['KV'];
		$Gconexion=$row['Gconexion'];
		$Campo=$row['Campo'];
		$AnoTR=$row['AnoTR'];
		$Estado=$row['Estado'];
		$TipoCBC=$row['TipoCBC'];
		$NroCBC=$row['NroCBC'];
		$idmarca=$row['idMarca'];
	}
	

?>

<div class="div_borde">
	<!-- <form action="transformadorAgregar.php" method="POST"> -->
	<!--<p align="right">Usuario:<?php echo $usuario_nombre ?></p>-->

	<input type="hidden" size="10" name="idTransformador" id="idTransformador" value="<?php echo $idTransformador?>">
	<input type="hidden" size="10" name="accion" id="accion" value="<?php echo $accion?>">


	
	<table class="tabla_formulario">
		<tr align="center"><td colspan="2"><h2>Datos del Transformador</h2></td></tr>
	    <tr>
			<td align="right">Ubicaci&oacute;n</td>
			<td align="left"><input type="text" size="10" name="Detalle" id="Detalle" value="<?php echo $Detalle ?>"></td>		
		</tr>
		<tr>
			<td align="right">Tipo</td>
			<td align="left"><Input type="Text" size="10" name="Tipo" id="Tipo" value="<?php echo $Tipo ?>"></td>		
		</tr>
		<tr>
			<td align="right">Serie</td>
			<td align="left"><Input type="Text" size="10" name="Serie" id="Serie" value="<?php echo $Serie ?>"></td>		
		</tr>
		<tr>
			<td align="right">Potencia</td>
			<td align="left"><Input type="numer" size="10" name="Potencia" id="Potencia" value="<?php echo $Potencia ?>"></td>		
		</tr>
		<tr>
			<td align="right">KV</td>
			<td align="left"><Input type="Text" size="10" name="KV" id="KV" value="<?php echo $KV ?>"></td>		
		</tr>
		<tr>
			<td align="right">G. conexion</td>
			<td align="left"><Input type="Text" size="10" name="Gconexion" id="Gconexion" value="<?php echo $Gconexion ?>"></td>		
		</tr>
		<tr>
			<td align="right">Campo</td>
			<td align="left"><Input type="Text" size="10" name="Campo" id="Campo" value="<?php echo $Campo ?>"></td>		
		</tr>
		<tr>
			<td align="right">Año</td>
			<td align="left"><Input type="number" size="10" name="AnoTR" id="AnoTR" value="<?php echo $AnoTR ?>"></td>		
		</tr>
		<tr>
			<td align="right">Estado</td>
			<td align="left"><Input type="nmber" size="10" name="Estado" id="Estado" value="<?php echo $Estado ?>"></td>		
		</tr>
		<tr>
			<td align="right">Tipo CBC</td>
			<td align="left"><Input type="Text" size="10" name="TipoCBC" id="TipoCBC" value="<?php echo $TipoCBC ?>"></td>		
		</tr>
		<tr>
			<td align="right">Número CBC</td>
			<td align="left"><Input type="Text" size="10" name="NroCBC" id="NroCBC" value="<?php echo $NroCBC ?>"></td>	
	    </tr>
	    <tr>
			<td align="right">Marca</td>
			<td align="left"><select name="idMarca" id="idMarca" class='Input_combo'>
				<option value='0'>--- Seleccionar ---</option>
				<?php 			
				
				while(	$row = mysqli_fetch_assoc($rs))
				{
					echo "<option value='".$row['idMarca']."' "; if($row['idMarca']==$idmarca){echo "selected";}; echo ">".$row['Marca']."</option>";
				}		
				?>
				</select></td>		
	        	
		</tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<br>
		<tr>
			<td align="center">
					
				
			</td>
		</tr>
	</table>
	<br>
	<div>
		<input type="submit" value="Cancelar" class="boton" onclick="location.href='#'">
		<input type="submit" value="<?php echo $boton ?>" class="boton" onclick="guardarTransformador()">
	</div>
	<br>
	
	
	<!-- </form> -->
</div>
