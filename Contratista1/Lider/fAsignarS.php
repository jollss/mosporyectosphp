<?php
require_once '../Config/main.php';
require_once '../Config/foot.php';
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Asignaciones</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <div class="container col-md-12" name="toTop" id="topPos">
            <div class="col-md-1">
            <br><br><br>
            </div>
            <div class="col-md-10">
            <div align="center"><h3><?php //echo $user;?></h3></div>
                <div class="panel panel-info">
                    <div class="panel-heading">Asignar BP a Supervisor</div>
                    <div class="panel-body" style="background-color:gray;">
                    <?php if(!isset($_GET['tipoGet']) or $_GET['tipoGet']==''){ $tipoGet=''; }else{ $tipoGet=$_GET['tipoGet'];} ?>
                    <form action="fAsignarS.php" method="GET">
                        <select name="tipoGet" class="form-control">
                            <option value="35">DIRECCION DE AREA</option>
                            <!--<option value="29">DIRECCION DE RH</option>
                            <option value="20">RECLUTADORES</option>-->
                            <option value="30">SUB DIRECCION</option>
                            <option value="31">COORDINADOR</option>
                            <option value="32">LIDERES</option>
                            <option value="33">GERENTE</option>
                            <option value="34">CHIEF OFFICER</option>
                            <option value="24">SUPERVISOR</option>
                        </select>
                        <input type="submit" class="btn btn-primary" value="VER">
                    </form>
                    <div align="center" style="font-size:12px !important;">
                        <div id="resultadoBusqueda">

                        <?php
                           $sql1="SELECT * FROM usuario 
                             WHERE activo=1 AND tipo_idtipo<>0 AND tipo_idtipo='$tipoGet' ORDER BY nombre";
                           $resultado=$con2->query($sql1);
                        ?>
                                    <div class="table-responsive" >
                                        <table class="table table-bordered" style="background-color:white;">
                                            <tr>
                                              <th></th>
                                              <th>Nombre</th>
                                              <th>Teléfono</th>
                                              <th>Correo</th>
                                            </tr>
                                <?php
                                $aux=0;
                                $aux2=0;
                            while($row = $resultado->fetch_assoc())
                            {
                                $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                                $phone=$row['cel'];
                                $mail=$row['correo'];
                                ?> 
                                    <tr>
                                        <th>
                                            <form action="fAsignar.php" method="POST">
                                                <input type="text" value="<?php echo $row['idu'];?>" name="ident" style="display:none;">
                                                <input class="btn btn-info"  type="submit" value="Asignar">
                                            </form>
                                        </th>
                                        <th><?php echo $name;?></th> 
                                        <th><?php echo $phone;?></th> 
                                        <th><?php echo $mail;?></th> 
                                    </tr>
                                <?php                                              
                                }
                                ?>
                                </table>
                                    </div>                        
                                <?php
                            ?>
                         </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
<!--============================================================================================-->      
    </div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>