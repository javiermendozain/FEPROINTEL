  
<?php 

session_start();
if (isset($_SESSION['nombre']) && isset($_SESSION['id_evaluador'])) {
 
  ?>
     <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
              
                <a class="navbar-brand" href="index.php"> <?php 
                //session_start();
                echo  "Hola, ".$_SESSION["nombre"]."  "; 
                ?>
                    
                </a>
                          
                          <div align="right">
                              <ul  class="nav navbar-top-links navbar-right">
                       
                            <!-- /.dropdown -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                                </a>
                            <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="cerrar.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                        </ul>
                          </div> 
            </div>
            <!-- /.navbar-header -->
         
            
            <!-- /.navbar-top-links -->

            <!-- /.navbar-static-side -->
        </nav>

<?php
}else{

header("Location: login.php");
}

?>





