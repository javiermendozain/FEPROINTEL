<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<link rel="stylesheet" type="text/css" href="estilos.css">
    <link href="style.css" rel="stylesheet">   

 </head>
<body  >
  
 
                  
<div class="col-lg-8">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">       
        <?php
          
          include("../conexion.php");
          session_start();
          
          if (isset($_POST['cliente'])) {
            $_SESSION['cliente']=$_POST['cliente'];
       //     $_SESSION['nom_client']=$_POST['nom_cliente'];
            
          }
          
          if (isset($_POST['fecha'])) 
              $fecha=$_POST['fecha'];
          else
              $fecha=date("Y/m/d");
         
           //Armando Notificaciones
 
           $cadsql="SELECT   cliente.nombre || ' ' || cliente.apellido nombres,   fecha,
                      plan_viaje.hora_salida, plan_viaje.modo_viaje, so.nombre_sitio, sd.nombre_sitio , cliente.id_cliente, id_plan_viaje 
                    FROM plan_viaje, cliente, sitios so, sitios sd
                    WHERE  plan_viaje.id_cliente = cliente.id_cliente AND
                           so.id_sitio = plan_viaje.id_sitio AND
                           sd.id_sitio = plan_viaje.id_sitio_destino AND
                           fecha = '$fecha'
                           AND  cliente.id_cliente <> '".$_SESSION['telefono']."' ";
                           

          $rsv=pg_query($conn,$cadsql);
          
          echo '<form  method="POST" action="lista.php" ><table class="table table-striped table-bordered table-hover">';
            /*<div class="well">
                <div class="col-xs-3">
                <label> <i class="fa  fa-calendar"> </i> Fecha &nbsp;&nbsp;</label>
                     <input  type="text" class="form-control"  name="fecha" value="'.$fecha.'" onchange="window.location.href=this.value"></input>
                     
                    <span class="add-on">
                        <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                        </i>
                    </span>
                    
                </div>
             </div>';      */
          while($row  = pg_fetch_row($rsv)){
              
            
              if($row[3]==1){ //Pasajero
                echo '<tr    style=" margin: 5px;padding: 5px; " ><td>
                      <input type="radio" name="cliente" value="'.$row[6].'"  >   <i class="fa  fa-male"></i> '.$row[0].' &nbsp;</td><td width=15% >'.$row[4].' &nbsp;</td><td width=15% >'.$row[5].' &nbsp;</td><td>'.$row[2].' &nbsp;
                      </td></tr>';                                      
              
              }
              else{//Conductor
                echo '<tr style=" margin: 5px;padding: 5px; " ><td>  
    
                     <input type="radio" name="cliente" value="'.$row[6].'"  >     <i class="fa  fa-car"></i> '.$row[0].' &nbsp;</td><td width=15% >'.$row[4].' &nbsp;</td><td width=15% >'.$row[5].' &nbsp;</td><td>'.$row[2].' &nbsp;
                      </td></tr>';                                      
              }
          }
          echo '</table></form>';
        ?>
                            </div>
                            <!-- /.list-group -->
                            <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a>    -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>        
      </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
  </body>

</html>

<script type="text/javascript">
  
 $(document).ready(function() { 
   $('input[name=cliente]').change(function(){
        $('form').submit();
   });
  });


  
</script>

