<?php
    mb_internal_encoding('UTF-8');
    mb_http_output('UTF-8');
    include("func.php");
	$tipoAnalisis=$_POST['tipoAnalisis'];
	$idUsuario=$_POST['idUsuario'];
	$idTransformador=$_POST['idTransformador'];
	$Fecha=$_POST['Fecha'];
	$Humedad=$_POST['Humedad'];
	$Acidez=$_POST['Acidez'];
	$TensionInter=$_POST['TensionInter'];
	$Tang=$_POST['Tang'];
	$Rigidez=$_POST['Rigidez'];
	$Inhibidor=$_POST['Inhibidor'];
	$ComPolares=$_POST['ComPolares'];
	$Lodos=$_POST['Lodos'];
	$HMF=$_POST['HMF'];
	$FAL=$_POST['FAL'];
	$ACF=$_POST['ACF'];
	$MEF=$_POST['MEF'];
	$DP=$_POST['DP'];
	$Estado=$_POST['Estado'];
	$Metano=$_POST['Metano'];
	$Etileno=$_POST['Etileno'];
	$Etano=$_POST['Etano'];
	$Acetileno=$_POST['Acetileno'];
	$Hidrogeno=$_POST['Hidrogeno'];
	$MdeCarbono=$_POST['MdeCarbono'];
	$AnhDeCarbono=$_POST['AnhDeCarbono'];
	$Oxigeno=$_POST['Oxigeno'];
	$Nitrogeno=$_POST['Nitrogeno'];
	$TGasesComb=$_POST['TGasesComb'];
	$GasesTotales=$_POST['GasesTotales'];
	$PresionSatGases=$_POST['PresionSatGases'];
	$Temperatura=$_POST['Temperatura'];
	$Comentario=$_POST['Comentario'];
	
	
	$cn=Conectar();
	if ($tipoAnalisis=='gases'){

		$query = mysqli_query($cn,"INSERT INTO analisis (
		Fecha,
		Metano,
		Etileno,
		Etano,
		Acetileno,
		Hidrogeno,
		MdeCarbono,
		AnhCarbono,
		Oxigeno,
		Nitrogeno,
		tGasesComb,
		GasesTotales,
		PresionSatGases,
		TemperaturaMuestra,
		idUsuario,
		idTransformador,
		Comentario)
		VALUES (
		'$Fecha',
		'$Metano',
		'$Etileno',
		'$Etano',
		'$Acetileno',
		'$Hidrogeno',
		'$MdeCarbono',
		'$AnhDeCarbono',
		'$Oxigeno',
		'$Nitrogeno',
		'$TGasesComb',
		'$GasesTotales',
		'$PresionSatGases',
		'$Temperatura',
		'$idUsuario',
		'$idTransformador',
		'$Comentario')");
	}
	
	if ($tipoAnalisis=='papel'){
		
		$query = mysqli_query($cn,"INSERT INTO analisisdp (
		Fecha,
		HMF,
		FAL,
		ACF,
		MEF,
		DP,
		Estado,	
		idUsuario,
		idTransformador,
		Comentario)
		VALUES (
		'$Fecha',
		'$HMF',
		'$FAL',
		'$ACF',
		'$MEF',
		'$DP',
		'$Estado',		
		'$idUsuario',
		'$idTransformador',
		'$Comentario')");
	}	

	if ($tipoAnalisis=='fq'){

		$query = mysqli_query($cn,"INSERT INTO analisisfq (
		Fecha,
		Humedad,
		Acidez,
		TensionInter,
		Tang,
		Rigidez,
		Inhibidor,
		ComPolares,
		Lodos,
		idUsuario,
		idTransformador,
		Comentario)
		VALUES (
		'$Fecha',
		'$Humedad',
		'$Acidez',
		'$TensionInter',
		'$Tang',
		'$Rigidez',
		'$Inhibidor',
		'$ComPolares',
		'$Lodos',
		'$idUsuario',
		'$idTransformador',
		'$Comentario')");
	}	
	
	if($query){
		echo 'ok';
	}else{
		echo 'error';
	}

	mysqli_close($cn);
	exit;
	 //header("Location:Principal.php");


?>


