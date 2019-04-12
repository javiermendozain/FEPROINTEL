<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title>Cargar</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link href="style.css" rel="stylesheet">
</head>
<body>
<h1>Cargar</h1>

<div class="row">
    ::before
    <div class="col-lg-3 col-md-6"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <i class="fa fa-file-o"></i> Cargar un archivo de clientes:
                </div>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-primary">Elegir</button>
            </div>
        </div>
    </div>
    ::after
</div>


<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
$conn =  pg_connect("host=localhost port=5432 dbname=crycomco_vamos user=crycomco_vamos2017 password=Vamos_a_ganar2017");   

if($conn){

  $archivo = "datos.xlsx";
  $inputFileType = PHPExcel_IOFactory::identify($archivo);
  $objReader = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel = $objReader->load($archivo);
  $sheet = $objPHPExcel->getSheet(0); 
  $highestRow = $sheet->getHighestRow(); 
  $highestColumn = $sheet->getHighestColumn();
  $nas=0;
  
  //Cargar funciones temporales
  for ($row = 2; $row <= $highestRow; $row++){ 
      $id=$sheet->getCell("A".$row)->getValue();
      $nombre=$sheet->getCell("B".$row)->getValue();
      $apellido=$sheet->getCell("C".$row)->getValue();
      $telefono=$sheet->getCell("D".$row)->getValue();
      $pass=$sheet->getCell("E".$row)->getValue();
      $email=$sheet->getCell("F".$row)->getValue();
      $cadsql ="INSERT INTO cliente VALUES('".$id."','".$nombre."','".$apellido."','".$telefono."','".MD5($pass)."','".$email."')";
      echo "$id","$nombre","$apellido","$telefono","$pass","$email";
      $add = pg_query($conn, $cadsql);
  }  
  
  
  

}
else {
  echo 'ERROR conexión';
}
?>
</body>
</html>