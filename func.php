<?php
session_start();

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

set_time_limit(1000);

function Conectar() {

	$cnx = mysqli_connect("localhost","c2250450_trafos","giSIforu01","c2250450_trafos");

	//mssql_select_db("Trafos");

	return $cnx;

}



function Conectar1() {

	$cnx = mssql_connect("localhost","sa","");

	mssql_select_db("cvpba1");

	return $cnx;

}



function Desconectar($cn) {

	mysqli_close($cn);

}



function add_ceros($numero,$ceros) {

   $order_diez = explode(".",$numero); 

   $dif_diez = $ceros - strlen($order_diez[0]); 

   for($m = 0 ; 

      $m < $dif_diez;

      $m++) 

   { 

      @$insertar_ceros .= 0;

   } 

   return $insertar_ceros .= $numero; 

}



function to_roman($num) {

if ($num <0 || $num >9999) {return -1;}

$r_ones = array(1=>"I", 2=>"II", 3=>"III", 4=>"IV", 5=>"V", 6=>"VI", 7=>"VII", 8=>"VIII", 

9=>"IX");

$r_tens = array(1=>"X", 2=>"XX", 3=>"XXX", 4=>"XL", 5=>"L", 6=>"LX", 7=>"LXX", 

8=>"LXXX", 9=>"XC");

$r_hund = array(1=>"C", 2=>"CC", 3=>"CCC", 4=>"CD", 5=>"D", 6=>"DC", 7=>"DCC", 

8=>"DCCC", 9=>"CM");

$r_thou = array(1=>"M", 2=>"MM", 3=>"MMM", 4=>"MMMM", 5=>"MMMMM", 6=>"MMMMMM", 

7=>"MMMMMMM", 8=>"MMMMMMMM", 9=>"MMMMMMMMM");

$ones = $num % 10;

$tens = ($num - $ones) % 100;

$hundreds = ($num - $tens - $ones) % 1000;

$thou = ($num - $hundreds - $tens - $ones) % 10000;

$tens = $tens / 10;

$hundreds = $hundreds / 100;

$thou = $thou / 1000;

if ($thou) {$rnum .= $r_thou[$thou];} 

if ($hundreds) {$rnum .= $r_hund[$hundreds];} 

if ($tens) {$rnum .= $r_tens[$tens];} 

if ($ones) {$rnum .= $r_ones[$ones];} 

return $rnum;

}



function MAX_ID($tabla,$campo){

	

	$rs=mssql_query("SELECT (MAX($campo)+1) as ID FROM $tabla");

	$id = mssql_fetch_array($rs);

	$id_interno=$id['ID'];

	if($id_interno==0){

		$id_interno=1;

	}

	return $id_interno;

}





function fracciona ($cadena) {

 

//$chars = strlen($cadena); // Contamos el total de caracteres de la cadena

//if($chars%2!=0){

	$nuevaCadena .=$cadena[1];

	// A continuaci�n recorremos los caracteres de la cadena

	for ($i=1;$i<=9;$i++) {

	// Como lo necesitabas de a dos, le indicamos que cada dos elementos agregue un espacio

	if($i==9){

		$space = "";

	}else{

		$space = ($i%2!=0) ? "." : "";

	}

	// Ensambla la cadena de salida

	$nuevaCadena .= $cadena[$i-1].$space;

//}

}

// Finalmente devuelve el resultado

return $nuevaCadena;

}  





function tohtml($texto) {

	$especial=array(chr(160),chr(130),chr(161),chr(162),chr(163),chr(164),chr(181),chr(144),chr(214),chr(224),chr(233),chr(165));

	$traducir=array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&Ntilde;');

	return str_replace($especial,$traducir,$texto);

}

/*

function add_ceros($numero,$ceros) {

   $order_diez = explode(".",$numero); 

   $dif_diez = $ceros - strlen($order_diez[0]); 

   for($m = 0 ; 

      $m < $dif_diez;

      $m++) 

   { 

      @$insertar_ceros .= 0;

   } 

   return $insertar_ceros .= $numero; 

}



function contador(){ 



    $archivo = "contador.txt"; 

    $info = array(); 



    //comprobar si existe el archivo 

    if (file_exists($archivo)){ 

       // abrir archivo de texto y introducir los datos en el array $info 

       $fp = fopen($archivo,"r"); 

       $contador = fgets($fp, 26); 

       $info = explode(" ",$contador); 

       fclose($fp); 



       // poner nombre a cada dato 

       $mes_actual = date("m"); 

       $mes_ultimo = $info[0]; 

       $visitas_mes = $info[1]; 

       $visitas_totales = $info[2]; 

    }else{ 

       // inicializar valores 

       $mes_actual = date("m"); 

       $mes_ultimo = "0"; 

       $visitas_mes = 0; 

       $visitas_totales = 0; 

    } 



    // incrementar las visitas del mes seg�n si estamos en el mismo 

    // mes o no que el de la ultima visita, o ponerlas a cero 

    if ($mes_actual==$mes_ultimo){ 

       $visitas_mes++; 

    }else{ 

       $visitas_mes=1; 

    } 

    $visitas_totales++; 



    // reconstruir el array con los nuevos valores 

    $info[0] = $mes_actual; 

    $info[1] = $visitas_mes; 

    $info[2] = $visitas_totales; 



    // grabar los valores en el archivo de nuevo 

    $info_nueva = implode(" ",$info); 

    $fp = fopen($archivo,"w+"); 

    fwrite($fp, $info_nueva, 26); 

    fclose($fp); 



    // devolver el array 

    return $info; 

}

*/

function fecha(){

 $Ajuste_horario = $_SESSION['ajuste_horario'];   

 $Hoy=date('d-n-Y H:i:s', time() + $Ajuste_horario);

 list($dia,$mes,$resto) = explode("-",$Hoy);

 list($ano,$resto) = explode(" ",$resto);

 list($hora,$minuto,$segundos) = explode(":",$resto);

 

 $Hoy2=date('D-n-Y H:i:s', time() + $Ajuste_horario);

 list($semana,$mes,$resto) = explode("-",$Hoy2);

 list($ano,$resto) = explode(" ",$resto);

 list($hora,$minuto,$segundos) = explode(":",$resto);

 

    //$hora = date('H');

    //$minuto = date('i');

	//$mes = date("n");

	$mesArray = array(

		1 => "Enero", 

		2 => "Febrero", 

		3 => "Marzo", 

		4 => "Abril", 

		5 => "Mayo", 

		6 => "Junio", 

		7 => "Julio", 

		8 => "Agosto", 

		9 => "Septiembre", 

		10 => "Octubre", 

		11 => "Noviembre", 

		12 => "Diciembre"

	);



	//$semana = date("D");

	$semanaArray = array(

		"Mon" => "Lunes", 

		"Tue" => "Martes", 

		"Wed" => "Miercoles", 

		"Thu" => "Jueves", 

		"Fri" => "Viernes", 

		"Sat" => "S�bado", 

		"Sun" => "Domingo", 

	);

	

	$mesReturn = $mesArray[$mes];

	$semanaReturn = $semanaArray[$semana];

	//$dia = date("d");

	//$a�o = date ("Y");

	

return $semanaReturn." ".$dia." de ".$mesReturn." de ".$ano. " - ".$hora.":".$minuto;

}

?>