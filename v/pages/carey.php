<?php 
include("../conexion.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vamos</title>

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

    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function(){
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                    
                }
            }

            req.open('GET', 'chat.php', true);
            req.send();

        }

        //linea que hace que se refreseque la pagina cada segundo
        setInterval(function(){ajax();}, 1000);


        function redirecionar(){

              window.location.href = "#chatt";
            //  $("#chat").animate({ scrollTop: $('#chat')[0].scrollHeight}, 1000);
       
        }



    </script>




</head>

<body onload="ajax();" >

    <div id="wrapper">

      <?php
      
include("menu.php");
      ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Vamos!</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                              <i class="fa fa-calendar fa-5x" ></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php 

$sql="SELECT 
  count(plan_viaje.id_plan_viaje)
FROM 
  public.plan_viaje
WHERE  plan_viaje.id_cliente='".$_SESSION['telefono']."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$numero= $row[0];
}

echo $numero;
                                      ?> </div>
                                    <div>Viajes Programados!</div>
                                </div>
                            </div>
                        </div>
                        <a href="plan_viaje.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
 <?php 

$sql="SELECT 
  count(historial_viaje.id_plan_viaje)
FROM 
  public.historial_viaje
WHERE  historial_viaje.id_cliente='".$_SESSION['telefono']."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$historia= $row[0];
}

echo $historia;
 ?> 
                                  </div>
                                    <div>Historial!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-star   fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
 <?php 

$sql="SELECT count(id_cliente)
  FROM calificaciones
  WHERE id_cliente='".$_SESSION['telefono']."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$calif= $row[0];
}

echo $calif;
 ?> 


                                    </div>
                                    <div>Calificaciones!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group   fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
 <?php 

$sql="SELECT count(id_cliente)
  FROM grupo_cliente
WHERE id_cliente ='".$_SESSION['telefono']."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$grupo_cliente= $row[0];
}

echo $grupo_cliente;
 ?> 

                                    </div>
                                    <div>Comunidad!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
              
    

                <!--Star col-lg-4 -->
               <div class="col-lg-4" id="chatt" >
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Chat
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php

                           $me='<li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet.
                                        </p>
                                    </div>
                                </li>';


                            $other=' <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet.
                                        </p>
                                    </div>
                                </li>';
                            ?>


                        <!-- star .panel-heading chat -->
                        <div class="panel-body">
                            <ul class="chat" id="chat">
                               
                               <?php
/*
                                    $sql="";

                                    $rs=pg_query($conn,$sql);

                                    while($row=pg_fetch_row($rs)) { 
                                   
                                    }*/

                               ?>
                   

      


                            </ul>
                        </div>
                        <!--  panel-body chat -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <form method="POST" action="index.php">
                                    <input id="btn-input" type="text" name="mensaje" class="form-control input-sm" placeholder="Escribe tu mensaje aquí..." />
                                    <span class="input-group-btn">
                                        <button  type="submit" name="enviar"  class="btn btn-warning btn-sm" id="btn-chat">
                                            Enviar
                                        </button>
                                    </span>
                                </form>


                                <?php
                              //     include("../conexion.php");

                                if (isset($_POST['enviar'])) {
                                    
                                    $mensaje = $_POST['mensaje'];
                                    $sql = "INSERT INTO chat (mensaje,id_cliente,id_other_cliente,
fecha) VALUES ( '".$mensaje."','".$_SESSION['telefono']."','".$_SESSION['telefono']."','2011-05-21');";



                                  //$ejecutar = $conexion->query($consulta);
                                    $rs=pg_query($conn,$sql);
                                //    echo $sql.' <br> ';  

//echo pg_last_error($conn);

                                    if ($rs) {
                                        echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";

                                        echo '<script type="text/javascript"> redirecionar(); </script>';

                                    }
                                            }

                                        ?>


                            </div>
                        </div>
                        <!-- panel-footer -->
                    </div>
                    <!-- end panel .chat-panel -->
                </div>
                <!--end chat col-lg-l4-->




                <!--Panel noficaciones-->
             <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notificaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                            
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="lista.php" allowfullscreen></iframe>
</div>
                
                                <?php
                                /*
                                   //Armando Notificaciones
                                   $cadsql="SELECT   cliente.nombre || ' ' || cliente.apellido nombres,   fecha,
                                              plan_viaje.hora_salida, plan_viaje.modo_viaje, so.nombre_sitio, sd.nombre_sitio , cliente.id_cliente 
                                            FROM plan_viaje, cliente, sitios so, sitios sd
                                            WHERE  plan_viaje.id_cliente = cliente.id_cliente AND
                                                   so.id_sitio = plan_viaje.id_sitio AND
                                                   sd.id_sitio = plan_viaje.id_sitio_destino";
                                  $rsv=pg_query($conn,$cadsql);
                                  echo '<form><table class="table table-striped table-bordered table-hover">';
                                  while($row  = pg_fetch_row($rsv)){
                                      if($row[3]==1){ //Pasajero
                                        echo '<tr><td>
                                                                
                                                 <input type="radio" name="cliente" value='.$row[6].'>   <i class="fa  fa-male"></i> '.$row[0].' &nbsp;</td><td width=15% >'.$row[4].' &nbsp;</td><td width=15% >'.$row[5].' &nbsp;</td><td>'.$row[2].' &nbsp;
                                              </td></tr>';                                      
                                      
                                      }
                                      else{//Conductor
                                        echo '<tr><td>                                                      
                                             <input type="radio" name="cliente" value='.$row[6].'>     <i class="fa  fa-car"></i> '.$row[0].' &nbsp;</td><td width=15% >'.$row[4].' &nbsp;</td><td width=15% >'.$row[5].' &nbsp;</td><td>'.$row[2].' &nbsp;
                                              </td></tr>';                                      
                                      }
                                  }
                                  echo '</table></form>';     */
                                ?>
                            </div>
                            <!-- /.list-group -->
                            <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a>    -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!--  notificaciones.col-lg-4 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
