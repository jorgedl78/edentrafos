<?php
	session_start(); 
    include("func.php");
    $user=$_POST['usuario'];
	$psw=$_POST['contrasena'];


/*	include_once('securimage/securimage.php');
	$securimage = new Securimage();
	$error=0;

	if ($securimage->check($codigo) == false) {
		$error=1;
		echo "2";
		exit;
	}*/
	$hoy=date('d-m-Y H:i:s', time() -3600);
	sleep(2);
    $cn=Conectar();
	$rs=mysqli_query($cn,"SELECT Nombre, Usuario, Contrasena, idUsuario FROM usuarios WHERE USUARIO = '$user'");
	$usuario = mysqli_fetch_assoc($rs);

	if ((!$usuario) && ($error==0)) { 
		
			echo "1";
			$error=1;
            exit;
		}

	if($usuario['Contrasena']!=$psw){
			echo "1";
			$error=1;	
            exit;
		
	}
	
if($error==0){

	$_SESSION['nombre'] = $usuario['Nombre'];
	$_SESSION['usuario_id'] = $usuario['idUsuario'];
	echo "0|".$usuario['Nombre'];
}
	mysqli_free_result($rs);
	Desconectar($cn);	
?>