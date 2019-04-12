<?php 

session_start();
//session_destroy();
include("../conexion.php");
$nombre_user=$_SESSION['telefono'];

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Plan de Viajes</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

       <?php
include("menu.php");

?>
    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                <h2> </h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<?php 

$sql="SELECT 
  count(plan_viaje.id_plan_viaje)
FROM 
  public.plan_viaje
WHERE  plan_viaje.id_cliente='".$nombre_user."'";

$rs=pg_query($conn,$sql);

while($row=pg_fetch_row($rs)) { 
$numero= $row[0];
}

?>

<!-- Inicio-->
  <div class="row">
                <div class="col-lg-12">
                        
                            <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Agendar</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                          <!-- Contenido-->
                                                <form role="form"   method="post" action="agendar.php" >
                                                    <div class="form-group">
                                                        <label>  
                                                             <label class="radio-inline" >
                                                                <input type="radio" name="frecuen" id="optionsRadios1" value="0"    onclick="ocultar_fecha()" checked > <i class="fa fa-retweet  "></i> Periodicamente
                                                            </label>
                                                            <label class="radio-inline" >
                                                                <input type="radio" name="frecuen" id="optionsRadios2" value="1"  onclick=" mostrar_fecha()"  > <i class="fa fa-check   "></i>  Solo una vez
                                                            </label>
                                                        </label>

                                                    </div>
                                                    <div class="form-group">
                                                        <label> <i class="fa  fa-calendar"> </i> Fecha Salida</label>
                                                        <input type="date" class="form-control"  name="date_fecha" id="date_fecha" style="display:none;"  >
                                                        <select  class="form-control" name="select_fecha" id="select_fecha"   >
                                                            <option value="1">Domingo</option>
                                                            <option value="2">Lunes</option>
                                                            <option value="3">Martes</option>
                                                            <option value="4">Mi&eacute;rcoles</option>
                                                            <option value="5">Jueves</option>
                                                            <option value="6">Viernes</option>
                                                            <option value="7">S&aacute;bado</option>
                                                          </select>  
                                                    </div>
                                                    <div class="form-group">
                                                        <label> <i class="fa fa-clock-o"> </i> Hora salida</label>
                                                        <input type="time" class="form-control" name="hora" placeholder="Enter text">

                                                    </div>
                                                   
              
                                                   <div class="form-group">
                                                        <label><i class="fa  fa-bullseye"></i> Origen</label>
                                                        <select class="form-control  " name="selec_origen">
                                                          <option >Seleccione...</option>
                                                                <?php   
                                                            $sql="SELECT 
                                                                  sitios.id_sitio, 
                                                                  (grupo_viaje.nombre_grupo|| ', ' ||sitios.nombre_sitio)
                                                                  
                                                                FROM 
                                                                  public.cliente, 
                                                                  public.grupo_cliente, 
                                                                  public.grupo_viaje, 
                                                                  public.sitios
                                                                WHERE 
                                                                  cliente.id_cliente = grupo_cliente.id_cliente AND
                                                                  grupo_cliente.id_grupo = grupo_viaje.id_grupo AND
                                                                  grupo_viaje.id_grupo = sitios.id_grupo AND
                                                                  cliente.id_cliente = '".$nombre_user."'; ";

                                                             $rs=pg_query($conn,$sql);
                                                           
                                                            while(($row=pg_fetch_row($rs))) { 
                                                         
                                                            echo ' <option value="'.$row[0].'">'.$row[1].'</option>';

                                                            }

                                                             ?>   

                                                         </select>
                                                    </div>

                                                      <div class="form-group ">
                                                        <label><i class="fa fa-map-marker"></i> Destino</label>
                                                        <select class="form-control" name="selec_destin">
                                                                     <option >Seleccione...</option>
                                                                <?php   
                                                            $sql="SELECT 
                                                                  sitios.id_sitio, 
                                                                  (grupo_viaje.nombre_grupo|| ', ' ||sitios.nombre_sitio)
                                                                  
                                                                FROM 
                                                                  public.cliente, 
                                                                  public.grupo_cliente, 
                                                                  public.grupo_viaje, 
                                                                  public.sitios
                                                                WHERE 
                                                                  cliente.id_cliente = grupo_cliente.id_cliente AND
                                                                  grupo_cliente.id_grupo = grupo_viaje.id_grupo AND
                                                                  grupo_viaje.id_grupo = sitios.id_grupo AND
                                                                  cliente.id_cliente = '".$nombre_user."'; ";

                                                             $rs=pg_query($conn,$sql);
                                                           
                                                            while(($row=pg_fetch_row($rs))) { 
                                                         
                                                            echo ' <option value="'.$row[0].'">'.$row[1].'</option>';

                                                            }

                                                             ?>   
                                                        </select>
                                                    </div>

                                                     <div class="form-group">
                                                        <label>Modalidad de Viaje: <br></label>
                                                      
                                                            <label class="radio-inline" >
                                                                <input type="radio" name="modalid_viaje" id="optionsRadios1" value="0"    onclick="mostrar()" > <i class="fa fa-automobile "></i> Conductor
                                                            </label>
                                                           <label class="radio-inline">
                                                                <input type="radio" name="modalid_viaje" id="optionsRadios2" value="1"  onclick="ocultar()"  checked> <i class="fa fa-child   "></i>  Pasajero
                                                            </label>
                                                    </div>
                                                    <div class="form-group" id="idcosto"  style="display:none;"  >
                                                        
                                                        <label >Costo x Persona </label>
                                                                <div class="form-group input-group" >
                                                                     <span class="input-group-addon">$</span>
                                                                    <input type="number" id="txtcosto"  class="form-control" placeholder="2.000" name="costo">
                                                                    <span class="input-group-addon">.00</span>
                                                                 </div>
                                                     </div>
                                                  
                                                    <div class="form-group">
                                                        <label>Cupos: <br></label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="cupos" id="optionsRadiosInline1" value="1" checked>1
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="cupos" id="optionsRadiosInline2" value="2">2
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="cupos" id="optionsRadiosInline3" value="3">3
                                                        </label>
                                                           <label class="radio-inline">
                                                            <input type="radio" name="cupos" id="optionsRadiosInline4" value="4">4
                                                        </label>
                                                    </div>
                                                  
                                                   
                                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save  "></i> Listo</button>

                                                    <!--  
                                                  <button type="reset" class="btn btn-default">Reset Button</button>
                                                    -->
                                               
                                                </form>
                                        <!--End contenido-->
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Programados</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                           <!-- Contenido-->
  <!-- /.row -->
<?php   
  $sql="SELECT 
 ( CASE WHEN plan_viaje.tipo_plan=0 THEN (  ( 
            CASE WHEN plan_viaje.dia_semana=1 THEN 'Domingo'
                 WHEN plan_viaje.dia_semana=2 THEN 'Lunes'
                 WHEN plan_viaje.dia_semana=3 THEN 'Martes'
                 WHEN plan_viaje.dia_semana=4 THEN 'Miercoles'
                 WHEN plan_viaje.dia_semana=5 THEN 'Jueves'
                 WHEN plan_viaje.dia_semana=6 THEN 'Viernes'
                 WHEN plan_viaje.dia_semana=7 THEN 'Sabado'
       END )    || '' || '')
            WHEN plan_viaje.tipo_plan=1 THEN (plan_viaje.fecha || '' || '')
       END ) as fecha , 
  plan_viaje.hora_salida, 
  ( CASE WHEN plan_viaje.modo_viaje=0 THEN 'Conductor'
            WHEN plan_viaje.modo_viaje=1 THEN 'Pasajero'
           
       END )as modo_viaje, 
  sitios.nombre_sitio as destino, 
   
 ( CASE WHEN plan_viaje.tipo_plan=0 THEN 'Periodicamente'
            WHEN plan_viaje.tipo_plan=1 THEN 'Solo una Vez'
           
       END )as frecuencia_viaje
 , (Select  sitios.nombre_sitio From  sitios where sitios.id_sitio= plan_viaje.id_sitio ) as origen,
 plan_viaje.id_plan_viaje

FROM 
  public.plan_viaje, 
  public.cliente, 
  public.sitios
WHERE 
  cliente.id_cliente = plan_viaje.id_cliente AND
  sitios.id_sitio = plan_viaje.id_sitio_destino AND plan_viaje.id_cliente='".$nombre_user."'";

  $rs=pg_query($conn,$sql);
  
  $i=1; // controla para agregar 3 columnas por fila
$stilo=0; // define el estilo de cada cuadro <div class="col-lg-4">
  echo '<div class="row">';
    while(($row=pg_fetch_row($rs))) { 
     echo  ($i>3) ? '<div class="row">' : '' ;
       

$datos='


        <div class="panel-heading">
         <i class="fa fa-bullseye " ></i> Origen: '.$row[5].'
        </div>
        <div class="panel-body">
                <div class="col-lg-8">
                      <p><i class="fa fa-calendar" ></i> '.$row[0].'<br><i class="fa fa-clock-o  " ></i> '.$row[1].'<br>
                      <i class="fa fa-child" ></i> '.$row[2].'<br><i class="fa fa-retweet" ></i> '.$row[4].'</p>
                </div>
                <div class="col-lg-4">
                   <br><button type="button" class="btn btn-outline btn-primary">Confirmar</button> 
                   <input type="hidden" id="id_plan_viaje" name="id_plan_viaje"  value="'.$row[6].'" />
                </div>
        </div>
        <div class="panel-footer">
           <i class="fa   fa-map-marker" ></i> Destino: '.$row[3].'

          </div>


';

switch ($stilo) {

    case 0:
    echo ' <div class="col-lg-4">
                     <div class="panel panel-default">
                     '. $datos.'
                    </div>
                </div> <br>';
    break;
    case 1:
     echo ' <div class="col-lg-4">
                    <div class="panel panel-primary">
                   '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 2:
     echo ' <div class="col-lg-4">
                  <div class="panel panel-success">
                '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 3:
     echo ' <div class="col-lg-4">
                    <div class="panel panel-info">
                   '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 4:
     echo ' <div class="col-lg-4">
                    <div class="panel panel-warning">
                    '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 5:
     echo ' <div class="col-lg-4">
                     <div class="panel panel-danger">
                  '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 6:
     echo ' <div class="col-lg-4">
                     <div class="panel panel-green">
                   '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 7:
     echo ' <div class="col-lg-4">
                     <div class="panel panel-yellow">
                     
                     '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
    case 8:
     echo ' <div class="col-lg-4">
                    <div class="panel panel-red">
                     '. $datos.'
                    </div>
                </div> <br>';
    # code...
    break;
  

}

 echo  ($i==3) ? '</div>' : '' ;
         if ($i>3) {
            $i=1;
          }
       $i++;
       $stilo++;
       if ($stilo==8) {  // Reinicio la variable de estila, para el switch
        $stilo=0;
       }

  }


  ?> 


   


                                           <!--end contenido-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end .panel-heading -->
  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row FIn -->
          
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>



<script type="text/javascript">
    
function mostrar_fecha(){
document.getElementById('date_fecha').style.display = 'block';
document.getElementById('select_fecha').style.display = 'none';
}

function ocultar_fecha(){
document.getElementById('date_fecha').style.display = 'none';
document.getElementById('select_fecha').style.display = 'block';
}



function mostrar(){
document.getElementById('idcosto').style.display = 'block';
}

function ocultar(){
document.getElementById('idcosto').style.display = 'none';
document.getElementById('txtcosto').value = '';
}

</script>