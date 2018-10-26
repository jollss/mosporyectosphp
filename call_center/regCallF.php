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
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
if($ultimo =mysqli_query($con,"SELECT idU FROM usuario ORDER BY idu")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$id=$row_cnt+1;
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
    call_center($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2"></div>
    <form class="form-horizontal" action="regcall.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">REGISTRO</div>
            <div class="panel-body">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">COPE</span>
                      <input type="text" class="form-control" placeholder="COPE"  name="cope" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">EXPEDIENTE:</span>
                      <input type="text" class="form-control" placeholder="EXPEDIENTE"  name="expediente" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">DISTRITO:</span>
                      <input type="text" class="form-control" placeholder="DISTRITO" name="distrito" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">TELÉFONO:</span>
                      <input type="number" class="form-control" placeholder="TELÉFONO"  name="telefono" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">NOMBRE DE CLIENTE:</span>
                      <input type="text" class="form-control" placeholder="NOMBRE COMPLETO"  name="nombre_cli" aria-describedby="sizing-addon2" required>
                    </div>
                    
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">OBSERVACIONES (DETALLE DEL ESTATUS):</span>
                    </div>
                      <textarea name="observaciones" class="form-control" placeholder="OBSERVACIONES (DETALLE DEL ESTATUS)"></textarea>
                    
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">CALLE: </span>
                  <input type="text" class="form-control" placeholder="CALLE" name="calle" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">NÚMERO: </span>
                  <input type="number" class="form-control" placeholder="NÚMERO" name="numero" aria-describedby="sizing-addon2" required>
                </div>            
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">NÚMERO INTERIOR: </span>
                  <input type="number" class="form-control" placeholder="NÚMERO INTERIOR" name="num_interior" aria-describedby="sizing-addon2" >
                  <span class="input-group-addon" id="sizing-addon2">SUB-NÚMERO: </span>
                  <input type="text" class="form-control" placeholder="SUB-NÚMERO" name="sub_numero" aria-describedby="sizing-addon2" >
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">COLONIA: </span>
                  <input type="text" class="form-control" placeholder="COLONIA" name="colonia" aria-describedby="sizing-addon2">
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">SUPERVISOR: </span>
                  <input type="text" class="form-control" placeholder="NOMBRE COMPLETO" name="supervisor" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">TECNICO: </span>
                  <input type="text" class="form-control" placeholder="TECNICO" name="tecnico" aria-describedby="sizing-addon2" >
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">ESTATUS: </span>
                  <input type="text" class="form-control" placeholder="ESTATUS" name="estatus" aria-describedby="sizing-addon2" >
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <input type="submit" class="form-control" value="REGISTRAR">
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="col-md-12"> <?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>