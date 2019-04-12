<?php
include ("../conexion.php");
	///consultamos a la base
session_start();
$consulta = "SELECT 
  chat.mensaje, 
  chat.fecha, 
   (SELECT nombre  FROM cliente WHERE cliente.id_cliente=chat.enviadox) as nombre,
  chat.enviadox
FROM 
  public.chat, 
  public.cliente

WHERE 
  cliente.id_cliente = chat.id_other_cliente AND
  ('".$_SESSION['telefono']."' IN (chat.id_other_cliente,chat.id_cliente)) AND
   ('".$_SESSION['cliente']."' IN (chat.id_other_cliente,chat.id_cliente)) 

ORDER BY chat.id asc
  ; ";
	//$ejecutar = $conexion->query($consulta); 

$rs=pg_query($conn,$consulta);


//while($fila = $rs->fetch_array());

while($row=pg_fetch_row($rs)) { 
//while ($row=pg_fetch_row($rs)) {
//echo 'bien';

//echo $consulta;


if ($row[3]==$_SESSION['telefono']) {  // El mensaje es del que esta en la web
echo '
<li class="right clearfix ">
          <span class="chat-img pull-right">
              <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
          </span>
          <div class="chat-body clearfix">
              <div class="header">
                  <small class=" text-muted">
                      <i class="fa fa-clock-o fa-fw"></i> '.formatearFecha($row[1]).'</small>
                  <strong class="pull-right primary-font"> Yo </strong>
              </div>
              <p>
                 '.$row[0].' 
              </p>
          </div>
      </li>';
}else{                              // mesanje del otro compañero
echo ' <li class="left clearfix   ">
      <span class="chat-img pull-left">
          <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
      </span>
      <div class="chat-body clearfix">
          <div class="header">
              <strong class="primary-font">'.$row[2].'</strong>
              <small class="pull-right text-muted">
                  <i class="fa fa-clock-o fa-fw"></i>'.formatearFecha($row[1]).'</small>
          </div>
          <p>
                 &nbsp; '.$row[0].' 
          </p>
      </div>
  </li> ';

}










// id="datos-chat"
}

?>

	

