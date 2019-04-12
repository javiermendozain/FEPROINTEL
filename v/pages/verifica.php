<?php
include("../conexion.php");
if(isset($_POST["id_evaluador"]) && isset($_POST["password"])){

$id_evaluador=$_POST["id_evaluador"];
$password=$_POST["password"];

$sql="SELECT  (nombre_eva) as fullname   FROM evaluadores  WHERE id_evaluador='".$id_evaluador."'  AND password='".MD5($password)."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$nombre= $row[0];
}

if(!empty($nombre)) {
session_start();
$_SESSION['nombre']=$nombre;
$_SESSION['id_evaluador'] = $id_evaluador;
header("Location: index.php");
}else {

header("Location: login.php ");
}




} // END IF
?>