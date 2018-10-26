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
if($ultimo =mysqli_query($con,"SELECT idu FROM usuario ORDER BY idu")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$id=$row_cnt+1;
$cnx->real_query("SELECT * FROM usuario WHERE correo='$mail'");
$resultado = $cnx->use_result();
while ($list = $resultado->fetch_assoc()){
    $nsup=$list['nombre'];
    $apsu=$list['apaterno'];
    $amsu=$list['amaterno'];
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
        <script type="text/javascript" src="../js/browserCall.js"></script>
<?php
    call_center($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>	
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <div class="col-md-3"></div>
        <div class="panel panel-default col-md-6">
            <div class="panel-heading">Busqueda</div>
            <div class="panel-body" style="background-color:gray;">
                <div align="center">
                    <div class="panel panel-danger">
                        La busqueda se hace por ID, NOMBRE DE CLIENTE, DISTRITO, COPE o EXPEDIENTE.    
                    </div>
                    <form accept-charset="utf-8" method="POST">
                        <div class="form-group">
                            <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="DATO A BUSCAR" id="bus">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-12">
            <div id="resultadoBusqueda"></div>
        </div>
    </div>
    <div class="col-md-1" ></div>
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>