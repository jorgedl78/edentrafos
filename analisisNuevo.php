<?php

	session_start();
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
	$usuario_nombre=$_SESSION['nombre'];
	$usuario_id=$_SESSION['usuario_id'];
    $usuario_id=1;
    include("func.php");
	$idTransformador=$_POST['idTransformador'];
    $cn=Conectar();
	$rs=mysqli_query($cn,"SELECT Detalle, idTransformador FROM transformadores Order by Detalle");
	$rsTransformador=mysqli_query($cn,"SELECT Detalle, Serie FROM transformadores WHERE idTransformador=$idTransformador");
	$rowTransformador = mysqli_fetch_assoc($rsTransformador);
	$fecha=getdate();

?>

<form action="analisisAgregar.php" method="POST" name="formulario" id="formulario" onsubmit="event.preventDefault();">
<input type="hidden" id="idTransformador" name="idTransformador" value="<?php echo $idTransformador;?>">
<input type="hidden" name="idUsuario" value="<?php echo $usuario_id?>">
<input   type="hidden" size="10" name="tipoAnalisis" id="tipoAnalisis">
<div class="div_header_formulario">
    <table>
        <tr>
            <td><label>Ubicación: </label></td>
            <td>
            <input name="ubicacion" type="text" disabled id="ubicacion" value="<?php echo $rowTransformador['Detalle'];?>"></td>
            <td><label>Serie: </label></td>
            <td><input name="serie" type="text" disabled id="serie" value="<?php echo $rowTransformador['Serie'];?>"></td>
            <td><label>Fecha: </label></td>
            <td><input type="date" id="Fecha" name="Fecha" value="<?php echo date("Y-m-d");?>"></td>
        </tr>
    </table>
</div>
<div class="div_flotante">
    <h4>Análisis de Gases</h4>
    <table class="tabla_formulario">
        <tr>
            <td>Metano CH4</td>
            <td><input type='Text' size="10" name="Metano" id="Metano" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Etileno C2H4</td>
            <td><input  type="Text" size="10" name="Etileno" id="Etileno" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Etano C2H6</td>
            <td><input  type="Text" size="10" name="Etano" id="Etano" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Acetileno C2H2</td>
            <td><input   type="Text" size="10" name="Acetileno" id="Acetileno" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Hidrógeno H2</td>
            <td><input   type="Text" size="10" name="Hidrogeno" id="Hidrogeno" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>M. de Carbono CO</td>
            <td><input   type="Text" size="10" name="MdeCarbono" id="MdeCarbono" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Anh. de Carbono CO2</td>
            <td><input   type="Text" size="10" name="AnhDeCarbono" id="AnhDeCarbono" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Oxígeno O2</td>
            <td><input   type="Text" size="10" name="Oxigeno" id="Oxigeno" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Nitrógeno N2</td>
            <td><input   type="Text" size="10" name="Nitrogeno" id="Nitrogeno" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>T. Gases Comb. TGC</td>
            <td><input   type="Text" size="10" name="TGasesComb" id="TGasesComb" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Gases Totales GT</td>
            <td><input   type="Text" size="10" name="GasesTotales" id="GasesTotales" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Presión Sat. Gases PSG</td>
            <td><input   type="Text" size="10" name="PresionSatGases" id="PresionSatGases" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
        <tr>
            <td>Temperatura de Muestra Cº</td>
            <td><input   type="Text" size="10" name="Temperatura" id="Temperatura" onkeypress="return solonumerosdecimales(event)" onBlur="ControlColor(this.id)"></td>
        </tr>
    </table>
    <br>  
    <input type="submit" class="boton" value="Confirmar" onclick="guardarAnalisis('gases')">  
</div>
<div class="div_flotante">
    <h3>Productos de Degradación de Papel</h3>
    <table class="tabla_formulario">
        <tr>
            <td>HMF</td>
            <td><input   type="Text" size="10" name="HMF" onkeypress="return solonumerosdecimales(event)" ></td>
        </tr>
        <tr>
            <td>FAL</td>
            <td><input    type="Text" size="10" name="FAL" id="FAL" onkeypress="return solonumerosdecimales(event)" onBlur="ControlFAL()"></td>
        </tr>
        <tr>
            <td>ACF</td>
            <td><input   type="Text" size="10" name="ACF" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>MEF</td>
            <td><input    type="Text" size="10" name="MEF" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>DP</td>
            <td><input    type="Text" size="10" name="DP" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>Estado</td>
            <td><input type="Text" size="15" name="Estado" id="Estado" readonly onkeypress="return solonumerosdecimales(event)" ></td>
        </tr>
    </table>
    <br>
    <input type="button" class="boton" value="Confirmar" onclick="guardarAnalisis('papel')">
</div>

<div class="div_flotante">
    <h3>Anáilsis Físico Químico</h3>
    <table class="tabla_formulario">
        <tr align="center">
		    <td>Humedad</td>
            <td><input  type="Text" size="10" name="Humedad" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
		    <td>Acidez</td>
            <td><input  type="Text" size="10" name="Acidez" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>Tens. Inter</td>
            <td><input  type="Text" size="10" name="TensionInter" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>Tang</td>
            <td><input  type="Text" size="10" name="Tang" onkeypress="return solonumerosdecimales(event)" ></td>
        </tr>
        <tr>
            <td>Rigidez</td>
            <td><input  type="Text" size="10" name="Rigidez" onkeypress="return solonumerosdecimales(event)" ></td>
        </tr>
        <tr>
            <td>Inhibidor</td>
            <td><input  type="Text" size="10" name="Inhibidor" onkeypress="return solonumerosdecimales(event)"></td>
        </tr>
        <tr>
            <td>ComPolares</td>
            <td><input  type="Text" size="10" name="ComPolares" onkeypress="return solonumerosdecimales(event)" ></td>
        </tr>
        <tr>
            <td>Lodos</td>
            <td><input  type="Text" size="10" name="Lodos" onkeypress="return solonumerosdecimales(event)" ></td>
	    </tr>
    </table>
    <br>
    <input type="button" class="boton" value="Confirmar" onclick="guardarAnalisis('fq')">
</div>

<div class="div_flotante">
    <table class="tabla_formulario">
         <tr>	
            <td>Comentario: <textarea name="Comentario" cols="20" rows="10"></textarea></td>	
     	</tr>
    </table>
</div>
</form>
<div class="div_pie_formulario">
    <input type="button" class="boton" value="Salir" onclick="location.href='#'">
</div>
</form>

 
