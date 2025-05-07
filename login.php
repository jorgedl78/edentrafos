<form action="validuser.php.php" name="formLogin" id="formLogin" onsubmit="event.preventDefault();">
	<h3>Ingrese sus datos</h3>
	<br><br>
	<label>Usuario</label>
	<br>
	<input class="inputLogin" type="text" name="usuario" id="usuario"  onkeypress="document.getElementById('div_mensaje_login').innerHTML='';">
	<br><br>
	<label>Clave</label>
	<br>
	<input class="inputLogin" type="password" name="contrasena" id="contrasena" onkeypress="document.getElementById('div_mensaje_login').innerHTML='';">
	<br>	
	<div align="center" id="div_mensaje_login"></div><br><br><br><br>	
	<input type="button" value="ingresar" class="botonLogin" onclick="validarUsuario()">
	<br><br>	
								
</form>