<?php
    include("func.php");
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
	$idTransformador=$_POST['idTransformador'];
	$Detalle=$_POST['Detalle'];
	$Tipo=$_POST['Tipo'];
	$Serie=$_POST['Serie'];
	$Potencia=$_POST['Potencia'];	
	$KV=$_POST['KV'];
	$Gconexion=$_POST['Gconexion'];
	$Campo=$_POST['Campo'];
	$AnoTR=$_POST['AnoTR'];
	$Estado=$_POST['Estado'];
	$TipoCBC=$_POST['TipoCBC'];
	$NroCBC=$_POST['NroCBC'];	
	$idMarca=$_POST['idMarca'];
	$accion=$_POST['accion'];

	//echo "accion: ".$accion;

	$cn=Conectar();
	if($accion=="Nuevo"){
		mysqli_query($cn,"INSERT INTO transformadores (
		Detalle,
		Tipo,
		Serie,
		Potencia,
		KV,
		Gconexion,
		Campo,
		AnoTR,
		Estado,
		TipoCBC,
		NroCBC,
		idMarca)
		VALUES (
		'$Detalle',
		'$Tipo',
		'$Serie',
		'$Potencia',
		'$KV',
		'$Gconexion',
		'$Campo',
		'$AnoTR',
		'$Estado',
		'$TipoCBC',
		'$NroCBC',
		'$idMarca'
		)");
	}
	else{

		mysqli_query($cn,"UPDATE transformadores set 
		Detalle='$Detalle',
		Tipo='$Tipo',
		Serie='$Serie',
		Potencia='$Potencia',
		KV='$KV',
		Gconexion='$Gconexion',
		Campo='$Campo',
		AnoTR='$AnoTR',
		Estado='$Estado',
		TipoCBC='$TipoCBC',
		NroCBC='$NroCBC',
		idMarca='$idMarca'
		WHERE idTransformador=$idTransformador");

	}
	
	
	//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
	 //header("Location:index.php");

?>


