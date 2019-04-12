<?php



$conn=pg_connect("host=localhost port=5432 dbname=repository user=postgres password=");

function formatearFecha($fecha){
	return date('g:i a', strtotime($fecha));
}

?>