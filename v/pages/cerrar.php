<?php



session_start();
//session_destroy();
unset($_SESSION['nombre']);
unset($_SESSION['telefono']);
unset($_SESSION['cliente']);
unset($_SESSION['nom_client']);
     
            



header("Location: login.php");


?>