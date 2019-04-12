
<?php 
include("../conexion.php");
session_start();

$id_proyecto=$_GET['i'];
$id_evaluador=$_SESSION['id_evaluador'];

?>


<!DOCTYPE html>
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

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- php5 Shim and Respond.js IE8 support of php5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">

.formulario input[type="radio"] {
    display: none;
     }

  .formulario input[id="estrategico"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }



  .formulario input[id="estrategico1"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico1"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo1"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo1"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico1"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico1"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo1"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo1"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico1"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico1"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo1"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico1"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo1"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico1"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }

  .formulario input[id="estrategico2"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico2"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo2"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo2"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico2"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico2"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo2"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo2"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico2"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico2"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo2"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico2"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo2"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico2"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }

  .formulario input[id="estrategico3"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico3"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo3"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo3"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico3"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico3"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo3"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo3"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico3"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico3"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo3"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico3"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo3"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico3"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }


  .formulario input[id="estrategico4"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico4"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo4"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo4"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico4"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico4"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo4"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo4"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico4"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico4"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo4"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico4"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo4"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico4"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }


  .formulario input[id="estrategico5"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico5"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo5"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo5"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico5"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico5"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo5"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo5"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico5"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico5"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo5"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico5"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo5"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico5"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }



------
.formulario input[id="estrategico6"] + label {
    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico6"] + label:before {
      content: "";
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }

     

    .formulario input[id="malo6"] + label {

    display: inline-block;
    cursor: pointer;
    color: #d9534f;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="malo6"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #d9534f; }

      .formulario input[id="basico6"] + label {

    display: inline-block;
    cursor: pointer;
    color: #f0ad4e;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="basico6"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #f0ad4e; }

.formulario input[id="autonomo6"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5bc0de;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }

    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="autonomo6"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5bc0de; }
     

.formulario input[id="estrategico6"] + label {

    display: inline-block;
    cursor: pointer;
    color: #5cb85c;
    position: relative;
    padding: 5px 15px 5px 51px;
    font-size: 1em;
    border-radius: 5px;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; }
    .formulario .radio label:hover,
    .formulario .checkbox label:hover {
      background: rgba(164,175,222, 0.1); 
  }
    .formulario input[id="estrategico6"] + label:before {
      content: "";      
      display: none;
      width: 17px;
      height: 17px;
      position: absolute;
      left: 15px;
      border-radius: 50%;
      background: none;
      border: 3px solid #5cb85c; }
    .formulario input[id="malo6"]:checked + label {

      padding: 5px 15px;
      background: #d9534f;
      border-radius: 2px;
      color: #fff; }


       .formulario input[id="basico6"]:checked + label {
      padding: 5px 15px;
      background: #f0ad4e;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="autonomo6"]:checked + label {
      padding: 5px 15px;
      background: #5bc0de;
      border-radius: 2px;
      color: #fff; }
       .formulario input[id="estrategico6"]:checked + label {
      padding: 5px 15px;
      background: #5cb85c;
      border-radius: 2px;
      color: #fff; }



                                   

</style>

</head>

<body>

    <div id="wrapper">

       <?php
include("menu.php");

?>
    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php 
                        $sql="SELECT  nombre_proyecto
                              FROM proyectos 
                              WHERE id_proyecto=".$id_proyecto."";
                              $rs=pg_query($conn,$sql);

                            while($row=pg_fetch_row($rs)) { 
                           echo $row[0];
                            }

                        ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

      <form method="POST" action="veri.php" class="formulario">
            <?php echo '<input type="hidden" name="id_proyecto" id="id_proyecto" value="'.$id_proyecto.'">';
                  echo '<input type="hidden" name="id_evaluador" id="id_evaluador" value="'.$id_evaluador.'">';
             ?>
         
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Presentación personal.  
                        </div>
                                <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home">
                                            <h4>Estratégico</h4>
                                            <p>La presentación personal del grupo es formal de forma homogénea.
La actitud del grupo en general es excelente y hacen su presentación con buen nivel de  energía, entusiasmo y demuestran gran empatía hacia el público, incluso llegando a interactuar con ellos.
Se identifica absoluta coordinación y coherencia del contenido y se expone de forma muy fluida, en donde todos los ponentes se expresan de forma homogonea tanto en tiempo como en contenido.
Los ponentes mantienen una excelente postura, gesticulación y cuentan con un dominio completo del auditorio y público, asi como de escucha activa ante las preguntas o recomendaciones de los docentes, evaluadores y presentes al auditorio.
Los ponentes usan de forma correcta, acertada y a través de toda la presentación lenguaje técnico propio de la temática del proyecto, dejando ver una apropiación del conocimiento.
</p>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <h4>Autónomo</h4>
                                            <p>La presentación personal del grupo es informal en su mayoría.
La actitud del grupo en general es buena, hacen su presentación con buen nivel de  energía, entusiasmo incluso empatía hacia el público.
Se percibe una coordinación y asignación de items o contenido asignado  en cada intervención. 
Los ponentes aunque mantienen una postura correcta, no cuentan con un dominio completo del auditorio y público.
El lenguaje que manejan los ponentes es  básico, emplean algunos conceptos y tratan de usar lenguaje técnico que han ido adquiriendo con la realización del proyecto.
</p>
                                        </div>
                                        <div class="tab-pane fade" id="messages">
                                            <h4>Básico</h4>
                                            <p>La presentación personal del grupo es desaliñada o muy informal
La actitud del grupo en general no responde a niveles minimos de energía, entusiasmo, ni empatía entre ellos y entre el público.
No se percibe coordinación entre el grupo al momento de cada intervención y se repiten aspectos por los miembros lo cual denota que no hubo preparación previa.
Los ponentes no mantienen una postura correcta, ejemplo manos en los bolsillos, curvados, miran al suelo y no manejan el auditorio.
El lenguaje que manejan los ponentes es extremadamente básico incluso con errores, es escasa la presentación de concepto o lenguaje técnico que debería haber adquirido con la realización del proyecto.
</p>
                                        </div>
                                        <div class="tab-pane fade" id="settings">
                                            <h4>Malo</h4>
                                            <p>Nada.</p>
                                        </div>
                                    </div>
                                </div>

                        <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio"  name="personal" value="5" id="estrategico" required>
                                    <label for="estrategico">Estratégico</label>

                                    <input type="radio"  name="personal" value="4" id="autonomo">
                                    <label for="autonomo">Autónomo</label>

                                    <input type="radio" name="personal" value="3" id="basico">
                                    <label for="basico">Básico</label>

                                    <input type="radio" name="personal" value="0" id="malo">
                                    <label for="malo">Malo</label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
               
                <div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                           Diapositivas.
                        </div>
                         <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home1" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile1" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages1" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings1" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home1">
                                            <h4>Estratégico</h4>
                                            <p> El índice debe contener los items (Introduccion,  problema a resolver, objetivos, metodologia, resultados, conclusiones y referencias) y aparecen los aspectos principales del tema investigado, la información presentada es ordenada y coherente, referencia  las imágenes y los textos, además  se encuentra una estrecha relación entre la imagen y el texto y se incorporan otros recursos didacticos. El nivel linguistico es acertivo en la discusion del problema en su totalidad.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile1">
                                            <h4>Autónomo</h4>
                                            <p>    El índice debe contener los items (Introduccion,  problema a resolver, objetivos, metodologia, resultados, conclusiones y referencias) y aparecen los aspectos principales del tema investigado, la información presentada es ordenada y coherente, referencia  las imágenes y los textos, además  se encuentra una estrecha relación entre la imagen y el texto con alta claridad tecnica y se incorporan otros recursos didacticos. El nivel linguistico es apropiado.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages1">
                                            <h4>Básico</h4>
                                            <p> El índice debe contener los items (Introduccion,  problema a resolver, objetivos, metodologia, resultados, conclusiones y referencias), y  aparecen los aspectos principales del tema investigado, la información presentada es ordenada y coherente, referencia  las imágenes y los textos, además  se encuentra una estrecha relación entre la imagen y el texto. El nivel linguistico es apropiado pero falta mayor claridad. 
  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings1">
                                            <h4>Malo</h4>
                                            <p>Nada.</p>
                                        </div>
                                    </div>
                                </div>
                         <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="diapositivas" value="5" id="estrategico1" required>
                                    <label for="estrategico1">Estratégico</label>

                                    <input type="radio" name="diapositivas" value="4" id="autonomo1">
                                    <label for="autonomo1">Autónomo</label>

                                    <input type="radio" name="diapositivas" value="3" id="basico1">
                                    <label for="basico1">Básico</label>

                                    <input type="radio" name="diapositivas" value="0" id="malo1">
                                    <label for="malo1">Malo</label>
                              </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                          Video.
                        </div>
                        <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home2" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile2" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages2" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings2" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home2">
                                            <h4>Estratégico</h4>
                                            <p> El video presenta las tres partes que lo conforman:  I) la introducción al tema, II) problema a resolver y III) resultados obtenidos, se cumple con los tiempos establecidos y se capta la atención del espectador presentando un desarrollo completo del proyecto, con buena edición del video, imágenes, y sonidos.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile2">
                                            <h4>Autónomo</h4>
                                            <p>   El video presenta las tres partes que lo conforman:  I) la introducción al tema, II) problema a resolver y III) resultados obtenidos y se cumple con los tiempos establecidos, pero no se capta la atención del espectador por baja resolución de video, sonido inadecuado, tomas en lugares inapropiados y/o vestimenta no idóneas.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages2">
                                            <h4>Básico</h4>
                                            <p> El video presenta las tres partes que lo conforman:  I) la introducción al tema, II) problema a resolver y III) resultados obtenidos, pero no cumple con el tiempo máximo establecido de 2 minutos.
  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings2">
                                            <h4>Malo</h4>
                                            <p>Nada.</p>
                                        </div>
                                    </div>
                                </div>
                        <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="video" value="5" id="estrategico2" required>
                                    <label for="estrategico2">Estratégico</label>

                                    <input type="radio" name="video" value="4" id="autonomo2">
                                    <label for="autonomo2">Autónomo</label>

                                    <input type="radio" name="video" value="3" id="basico2">
                                    <label for="basico2">Básico</label>

                                    <input type="radio" name="video" value="0" id="malo2">
                                    <label for="malo2">Malo</label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
             
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tiempo de la socialización.
                        </div>
                          <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home3" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile3" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages3" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings3" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home3">
                                            <h4>Estratégico</h4>
                                            <p> La presentación fue realizada en el tiempo establecido.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile3">
                                            <h4>Autónomo</h4>
                                            <p>   N/A </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages3">
                                            <h4>Básico</h4>
                                            <p> N/A  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings3">
                                            <h4>Malo</h4>
                                            <p> La presentación no fue realizada en el tiempo establecido.</p>
                                        </div>
                                    </div>
                                </div>
                        <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="tiempo" value="5" id="estrategico3" required>
                                    <label for="estrategico3">Estratégico</label>

                                    <input type="radio" name="tiempo" value="4" id="autonomo3">
                                    <label for="autonomo3">Autónomo</label>

                                    <input type="radio" name="tiempo" value="3" id="basico3">
                                    <label for="basico3">Básico</label>

                                    <input type="radio" name="tiempo" value="0" id="malo3">
                                    <label for="malo3">Malo</label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                                Claridad y coherencia en los resultados obtenidos con los objetivos propuestos.
                        </div>
                          <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home4" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile4" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages4" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings4" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home4">
                                            <h4>Estratégico</h4>
                                            <p> Los resultados son presentados con claridad, y demuestran el cumplimiento  total del objetivo general y objetivos específicos del proyecto. Se evidencia además la importancia del proyecto en el contexto de desarrollo de los estudiantes.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile4">
                                            <h4>Autónomo</h4>
                                            <p>   Los resultados demuestran en alto grado cumplimiento del objetivo general y de los objetivos específicos del proyecto, y  son presentados con claridad.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages4">
                                            <h4>Básico</h4>
                                            <p> Los resultados demuestran cumplimiento  parcial del objetivo general y los objetivos específicos, y son presentados con claridad.
  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings4">
                                            <h4>Malo</h4>
                                            <p>No se presentan resultados.
.</p>
                                        </div>
                                    </div>
                                </div>
                       <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="claridad" value="5" id="estrategico4" required>
                                    <label for="estrategico4">Estratégico</label>

                                    <input type="radio" name="claridad" value="4" id="autonomo4">
                                    <label for="autonomo4">Autónomo</label>

                                    <input type="radio" name="claridad" value="3" id="basico4">
                                    <label for="basico4">Básico</label>

                                    <input type="radio" name="claridad" value="0" id="malo4">
                                    <label for="malo4">Malo</label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                        Coherencia de la metodología.
                        </div>
                          <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home6" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile6" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages6" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings6" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home6">
                                            <h4>Estratégico</h4>
                                            <p> La metodología  es  coherente con los objetivos y resultados obtenidos. Ademas, es estructurada y presentada claramente.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile6">
                                            <h4>Autónomo</h4>
                                            <p>   La metodología  es medianamente  coherente con los objetivos y resultados obtenidos. Ademas, es estructurada y presentada claramente. 
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages6">
                                            <h4>Básico</h4>
                                            <p> La metodología  es parcialmente  coherente con los objetivos y resultados obtenidos. Ademas, se estructura y se presenta claramente. 
  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings6">
                                            <h4>Malo</h4>
                                            <p>No se presenta metodología.
.</p>
                                        </div>
                                    </div>
                                </div>
                       <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="coherencia_meto" value="5" id="estrategico5" required>
                                    <label for="estrategico5">Estratégico</label>

                                    <input type="radio" name="coherencia_meto" value="4" id="autonomo5">
                                    <label for="autonomo5">Autónomo</label>

                                    <input type="radio" name="coherencia_meto" value="3" id="basico5">
                                    <label for="basico5">Básico</label>

                                    <input type="radio" name="coherencia_meto" value="0" id="malo5">
                                    <label for="malo5">Malo</label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                         Conclusiones.
                        </div>
                         <div class="panel-body">
                                    <!-- Nav tabs -->

                                    <ul class="nav nav-tabs">
                                       
                                         <li class="active"><a href="#home" data-toggle="tab">
                                         <button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button></a>
                                        </li>
                                        <li><a href="#profile" data-toggle="tab">
                                        <button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i>
                                        </button>
                                         </a>
                                        <li><a href="#messages" data-toggle="tab"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        <li><a href="#settings" data-toggle="tab"> <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-check"></i>
                                        </button></a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home">
                                            <h4>Estratégico</h4>
                                            <p> Las conclusiones presentadas estan adecuadamente presentadas, resumen los puntos principales del trabajo y estan relacionadas con los objetivos y los resultados del proyecto. Se evidencia claramente los resultados obtenidos.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <h4>Autónomo</h4>
                                            <p>   Las conclusiones estan adecuadamente presentadas y se encuentran  relacionadas con los objetivos y los resultados del proyecto.
 </p>
                                        </div>
                                        <div class="tab-pane fade" id="messages">
                                            <h4>Básico</h4>
                                            <p> La conclusiones están relacionadas con los resultados y objetivos del proyecto, sin embargo son muy superficiales y presentan deficiencias en redacción.
  </p>
                                        </div>
                                        <div class="tab-pane fade" id="settings">
                                            <h4>Malo</h4>
                                            <p>No se presentan conclusiones.
.</p>
                                        </div>
                                    </div>
                                </div>
                         <div class="panel-footer">
                            Selecione

                                <div class="radio"> 
                                    <input type="radio" name="conclusions" value="5" id="estrategico6" required>
                                    <label for="estrategico6">Estratégico</label>

                                    <input type="radio" name="conclusions" value="4" id="autonomo6">
                                    <label for="autonomo6">Autónomo</label>

                                    <input type="radio" name="conclusions" value="3" id="basico6">
                                    <label for="basico6">Básico</label>

                                    <input type="radio" name="conclusions" value="0" id="malo6">
                                    <label for="malo6">Malo</label>
                              </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
         
            </div>

            <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block">Evaluar</button>
            <br>
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
