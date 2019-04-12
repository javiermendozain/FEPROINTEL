<?php
	include ("../conexion.php");
	///consultamos a la base
	$consulta = "SELECT * FROM chat ORDER BY id DESC";
	//$ejecutar = $conexion->query($consulta); 

$rs=pg_query($conn,$consulta);


//while($fila = $rs->fetch_array());


while ($row=pg_fetch_row($rs)) {
echo '<div id="datos-chat">
		<span style="color: #1C62C4;"> '.$row[0].'</span>
		<span style="color: #848484;">'.$row[1].'</span>
		<span style="float: right;">'.formatearFecha($row[2]).'</span>
	</div>';

}

?>

	
	<?php endwhile; ?>
