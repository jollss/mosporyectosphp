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
$cnx = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnx->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnx->use_result();
while ($line = $result->fetch_assoc()){
    $idus=$line['idu'];
    $name=$line['nombre'];
    $ap=$line['apaterno'];
    $am=$line['amaterno'];
}
$tos=0;
$con2->real_query("SELECT * FROM os WHERE tecnico='$idus' AND activos=1 ORDER BY idmos");
    $resultado = $con2->use_result();
    while ($row = $resultado->fetch_assoc()){
        $tos++;
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
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Ordenes de Servicio Pendientes de <b><?php echo $name." ".$ap." ".$am; ?><h3><?php echo $tos; ?></b></h3></div>
            <div class="panel-body">
            <div align="center">
            </div>
                <?php
                  $con->real_query("SELECT * FROM os 
                    WHERE tecnico='$idus' AND activos=1");
                  $resultado = $con->use_result();
                ?>
                <form action=" dataos.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                              <th>ID Mos</th>
                              <th>Folio os</th>
                              <th>Fecha Contrata</th>
                              <th>Tipo</th>
                              <th>Cliente</th>
                              <th>Distrito</th>
                              <th>Terminal</th>
                              <th>Puerto</th>
                            </tr>
                            <?php 
                            while ($row = $resultado->fetch_assoc()){?>  
                                <tr>
                                    <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idmos'];?>"></th>
                                    <th><?php echo $row['folio'];?></th>
                                    <th><?php echo $row['f_contrata'];?></th>
                                    <th><?php echo $row['tipo'];?></th>
                                    <th><?php echo $row['nombre'];?></th>
                                    <th><?php echo $row['distrito'];?></th>
                                    <th><?php //echo $row['terminal'];?></th>
                                    <th><?php //echo $row['puerto'];?></th>
                                </tr>
                                <?php
                                }
                                ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>