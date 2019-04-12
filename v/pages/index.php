<?php 
include("../conexion.php");
session_start();

//echo $_POST['cliente'];
?>


<!DOCTYPE html>
<html lang="es">

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
                    bajar();
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

        function bajar(){
                 //  window.setInterval(function() {
                          var elem = document.getElementById('chat');
                          elem.scrollTop = elem.scrollHeight;
                    // }, 0);
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
                  <br>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
              
    
            <form method="POST" action="evalua.php">

                <div class="col-lg-4"> 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bookmark fa-fw"></i> Proyectos Asignados
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?php

                            $sql="SELECT 
                                  proyectos.id_proyecto, 
                                  proyectos.nombre_proyecto, 
                                  proyectos.id_categoria, 
                                  user_student.user_nombres, 
                                  asignar_proyecto_docente.estado
                                FROM 
                                  public.asignar_proyecto_docente, 
                                  public.user_student, 
                                  public.proyectos
                                WHERE 
                                  proyectos.id_proyecto = asignar_proyecto_docente.id_proyecto AND
                                  proyectos.id_user = user_student.id_user AND
                                  asignar_proyecto_docente.id_evaluador  = '".$_SESSION['id_evaluador']."'; ";

                            $rs=pg_query($conn,$sql);

                            while($row=pg_fetch_row($rs)) { 
                            $cate = ($row[2]==1) ? 'fa-random' : 'fa-globe' ;
                            $esta = ($row[4]==0) ? 'fa-circle-o' : 'fa-circle' ;

                            $print='
                             <form   ><a href="evalua.php?i='.$row[0].'" class="list-group-item">
                                    <i class="fa '.$cate.' fa-fw"></i> '.$row[1].'
                                    <span class="pull-right text-muted small"><em>'.$row[3].'</em>
                                     <i class="fa '.$esta.' fa-fw"></i> 
                                    </span>
                                    </a> </form>';
                            echo $print;
                            }

                                  ?>
                                 
                            
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ver Todos</a>
                        </div>
                        <!-- /.panel-body -->
                   </div>
                </div>



            </form>
         
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
