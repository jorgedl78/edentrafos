<?php
    include("func.php");
    $cn=Conectar();
	$rs=mysqli_query($cn,"select transformadores.*, marcas.Marca from transformadores inner join marcas on transformadores.idmarca=marcas.idmarca");
	$rsLocalidades=mysqli_query($cn,"SELECT Distinct Detalle FROM transformadores order by Detalle");
	$rsMarcas=mysqli_query($cn,"SELECT Distinct idMarca, Marca FROM marcas order by Marca");
?>
<div class="div_borde">
<table align="center" WIDTH="95%">
		<tr>
		<td><h2 >Buscar Transformadores</h2></td>
		<td align="right">Localidad</td>
		<td>
        <select name="selectLocalidad" id="selectLocalidad" onChange="Filtrar('Detalle');">
              <option value='0'>--- Todas ---</option>
              <?php 			
			
			while(	$row = mysqli_fetch_assoc($rsLocalidades))
			{
				echo "<option value='".utf8_encode($row['Detalle'])."'>".utf8_encode($row['Detalle'])."</option>";
			}		
			?>
          </select>
        </td>
		<td align="right">Marca</td>
		<td><select name="selectMarca" id="selectMarca" onChange="Filtrar('Detalle');">
              <option value='0'>--- Todas ---</option>
              <?php 			
			
			while(	$row = mysqli_fetch_assoc($rsMarcas))
			{
				echo "<option value='".utf8_encode($row['idMarca'])."'>".utf8_encode($row['Marca'])."</option>";
			}		
			?>
            </select></td>
            <td align="right">Serie:<Input type="Text" size="10" name="serie" id="serie"></td>
            <td align="left"><input type="button" value="Buscar" class="boton" onClick="Filtrar('Detalle')"></td>
            <td><input type="button" value="Nuevo Transformador" class="boton" onClick="NuevoTransformadorModal()"></td> 
            <!-- <td><a href="#miModal" class="href_tipo_boton">Nuevo Transformador</a></td> -->
	</tr>


</table>
</div>
<div id="divTransformadores" class="div_borde"><h4 align="center">No se encuentran transformadores en esta búsqueda<h4></div>
<br>

