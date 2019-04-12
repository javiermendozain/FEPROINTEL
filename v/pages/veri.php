<?php
include("../conexion.php");
/*
echo ''.$_POST["personal"].', '.$_POST["id_evaluador"].', '.$_POST["id_proyecto"].',  '.$_POST["tiempo"].', '.$_POST["coherencia_meto"].', '.$_POST["claridad"].', '.$_POST["diapositivas"].', '.$_POST["video"].', '.$_POST["conclusions"].'';
*/

$sql='INSERT INTO evaluacion(presentacion, id_evaluador, id_proyecto,  tiempo, 
            coherencia_met, claridad, diapositiva, video, conclusiones)
    VALUES ('.$_POST["personal"].', '.$_POST["id_evaluador"].', '.$_POST["id_proyecto"].',  '.$_POST["tiempo"].', '.$_POST["coherencia_meto"].', '.$_POST["claridad"].', '.$_POST["diapositivas"].', '.$_POST["video"].', '.$_POST["conclusions"].');';

$sql.="UPDATE asignar_proyecto_docente
   SET  estado=1
 WHERE  id_evaluador='".$_POST["id_evaluador"]."' and id_proyecto=".$_POST["id_proyecto"].";";

$rs=pg_query($conn,$sql);

if ($rs) {
	header("Location: index.php");

}else{
	echo 'Algo mal';
}





?>