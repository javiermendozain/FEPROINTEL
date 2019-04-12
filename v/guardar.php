<?php	

include("conexion.php");
//include("conexion.php");
//define('SHOW_VARIABLES', 1);
 //define('DEBUG_LEVEL', 1);


// Desactivar toda notificación de error
error_reporting(0);


$nombres=$_POST["nombres"];
$apellidos=$_POST["apellidoss"];
$email=$_POST["email"];
$num_tel=$_POST["num_tel"];
$fecha_nacimiento=$_POST["fecha_nacimiento"];
$codigo_comunida=$_POST["codigo_comunida"];
$pass=$_POST["pass"];
$politicas=$_POST["politicas"];

//echo $nombres." - ".$apellidos." - ".$email." - ".$num_tel." - ".$fecha_nacimiento." - ".$codigo_comunida." - ".$pass." - ".$politicas;

if(isset($_POST["nombres"]) && isset($_POST["apellidoss"])&&isset($_POST["num_tel"])   && isset($_POST["pass"])){


$sql="INSERT INTO cliente(id_cliente, nombre, apellido, tel_movil, password , e_mail)
VALUES ('".$num_tel."', '".$nombres."', '".$apellidos."', '".$num_tel."',MD5('".$pass."'), '".$email."');";

// 
// Registra Personal

$rs=pg_query($conn,$sql);

	if ($rs) {
        header("Location: pages/login.php");
	}else{

	echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
     //   exit;

	//	echo '<a href="javascript:history.go(-1);">Atras</a>';
	}



}
	






?>