<?php	

include("../conexion.php");
//include("conexion.php");
//define('SHOW_VARIABLES', 1);
 //define('DEBUG_LEVEL', 1);


// Desactivar toda notificación de error
error_reporting(0);
session_start();

$frecuen=$_POST["frecuen"];
$date_fecha=$_POST["date_fecha"];
$select_dia=$_POST["select_fecha"];
$hora=$_POST["hora"];
$selec_origen=$_POST["selec_origen"];
$selec_destin=$_POST["selec_destin"];
$modalid_viaje=$_POST["modalid_viaje"];
$costo=$_POST["costo"];
$cupos=$_POST["cupos"];
$id_cliente=$_SESSION['telefono'];



//echo $frecuen.'- '.$date_fecha.'- '.$select_dia.'- '.$hora.'- *'.$selec_origen.'- *'.$selec_destin.'- '.$modalid_viaje.'- '.$costo.'- '.$cupos.'- '.$id_cliente;

/*  estado 
0: Esperando La Hora
1: Cumplido
2: No Cumplido

*/



if(isset($_POST["hora"]) && isset($_POST["selec_origen"])&&isset($_POST["selec_destin"])   && isset($_POST["modalid_viaje"]) && isset($_SESSION['nombre']) && isset($_SESSION['telefono']) ){


if ($frecuen==0) { // Frecuentemente 
$sql="INSERT INTO plan_viaje(  hora_salida, id_sitio, id_cliente, modo_viaje,  estado, cupos, id_sitio_destino,tipo_plan , dia_semana,costo)  VALUES (  '".$hora."', ".$selec_origen.", ".$id_cliente.", ".$modalid_viaje.",   0, ".$cupos.", ".$selec_destin.", ".$frecuen.", ".$select_dia.",".((empty($costo)) ? 0 : $costo) .");";


}else {  // Una sola Vez

$sql="INSERT INTO plan_viaje(  fecha,hora_salida, id_sitio, id_cliente, modo_viaje,  estado, cupos, id_sitio_destino,tipo_plan ,costo)
    VALUES (  '".$date_fecha."','".$hora."', ".$selec_origen.", ".$id_cliente.", ".$modalid_viaje.",   0, ".$cupos.", ".$selec_destin.", ".$frecuen.",".((empty($costo)) ? 0 : $costo) .");";


}



// Agendar un Viaje

$rs=pg_query($conn,$sql);

	if ($rs) {
        header("Location: plan_viaje.php");
	}else{

	echo "<script type=\"text/javascript\">
           history.go(-1);
       </script>";
     //   exit;

	//	echo '<a href="javascript:history.go(-1);">Atras</a>';
	}



}
	


	echo " <br> Entro 5 <br>" ;



?>