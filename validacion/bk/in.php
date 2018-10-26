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
        <script type="text/javascript" src="../js/browser4.js"></script>
<?php
    nivel1($user);
?>  
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div align="center"><h3><?php echo $user;?></h3></div>
        <div class="panel panel-info">
            <div class="panel-heading">Usuarios</div>
            <div class="panel-body">
                <div align="center">
                <form accept-charset="utf-8" method="POST">
                <div class="form-group">
                    <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="Primeras letras de nombre" id="bus">
                </div>
                </form>
                 <div id="resultadoBusqueda"></div>
                </div>
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