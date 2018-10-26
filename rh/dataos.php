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
$idos=$_POST['ident'];
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnx->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnx->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/slider.css" rel="stylesheet">
<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<?php
  $con->real_query("SELECT * FROM os 
    INNER JOIN osdata 
    INNER JOIN other_os
    INNER JOIN cliente
    WHERE os.idos='$idos' AND os.idos=osdata.os_idos AND other_os.id_osdata=osdata.iddata AND cliente.idcli=os.cliente_idcli
                    ");
  $resultado = $con->use_result();

while ($row = $resultado->fetch_assoc()){?> 
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Datos Cliente</div>
            <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                   <th>CLIENTE</th>
                </tr> 
                <tr>
                    <th>Nombre</th>
                        <td><?php echo $row['nombrecli']." ".$row['apcli']." ".$row['amcli'];?></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><?php echo $row['telcli'];?></td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td><?php echo $row['area'];?></td>
                </tr>
                <tr>
                    <th>Distrito</th>
                    <td><?php echo $row['distrito'];?></td>
                </tr>
            </table>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">DATOS</div>
            <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>PRINCIPAL</th>
                        <td><?php echo $row['principal'];?></td>
                </tr>
                <tr>
                    <th>SECUNDARIO</th>
                    <td><?php echo $row['secundario'];?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
    <!--<div align="center"><h3><?php echo $user;?></h3></div>-->
        <div class="panel panel-info">
            <div class="panel-heading">Ordenes de Servicio</div>
            <div class="panel-body">
               <!-- <form action="" method="POST">-->
                <div > 
                            <table class="table table-bordered">
                                <tr>
                                    <th>No. de Servicio</th>
                                    <th><?php echo $idos;?></th>
                                    <th>FECHA </th>
                                    <th><?php echo $row['dd']."/".$row['mm']."/".$row['aaaa'];?></th>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td><?php if($row['status']==0){ echo "ABIERTO";}if($row['status']==1){ echo "FINALIZADO";}?></td>
                                    <th>Semana</th>
                                    <td><b><?php echo $row['semana'];?></b></td>
                                </tr>
                            </table>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <th>ESTATUS PAGO COBRE</th>
                                    <th><?php echo $row['st_pagocob'];?></th>
                                    <th>ESTATUS PAGO FO </th>
                                    <th><?php echo $row['st_pagofo'];?></th>
                                </tr>
                            </table>
                             <table class="table table-bordered">
                                <tr>
                                    <th>Datos</th>
                                </tr>
                                <tr>
                                    <th>PISAPLEX: <?php echo $row['pisaplex'];?></th>
                                    <th>DILACION: <?php echo $row['dilacion'];?></th>
                                </tr>
                                <tr>
                                    <th>COPE: <?php echo $row['cope'];?></th>
                                    <th>EMPRESA: <?php echo $row['empresa'];?></th>
                                </tr>
                                <tr>
                                    <th>TIPO: <?php echo $row['tipo'];?></th>
                                    <th>TERMINAL OPTICA: <?php echo $row['termi_optica'];?></th>
                                </tr>
                                <tr>
                                    <th>PUERTO: <?php echo $row['puerto'];?></th>
                                    <th>SERIE: <?php echo $row['serie'];?></th>
                                </tr>
                                <tr>
                                    <th>FOLIO TEK: <?php echo $row['folio_tek'];?></th>
                                    <th>SUBTERRANEO: <?php echo $row['subterraneo'];?></th>
                                </tr>
                                <tr>
                                    <th>CLARO VIDEO: <?php echo $row['claro_video'];?></th>
                                    <th>TIPO DE INSTALACIÓN: <?php echo $row['tipo_instalacion'];?></th>
                                </tr>
                            </table>
                </div>
                <!--</form>-->
            </div>
        </div>
       
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Error</th>
                    <th><?php echo $row['erroros'];?></th>
                    <th>Tipificación de error</th>
                    <th><?php echo $row['dd'];?></th>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td><?php if($row['status']==0){ echo "ABIERTO";}if($row['status']==1){ echo "FINALIZADO";}?></td>
                    <th>Semana</th>
                    <td><b><?php echo $row['semana'];?></b></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Observaciones</th>
                    <td><?php echo $row['observa_os'];?></td>
                </tr>
            </table>
        </div>
    </div>
<?php
}
?>
</div>
 <?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>