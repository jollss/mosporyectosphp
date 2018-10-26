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
    $name=$line['nombre'];
    $ap=$line['apaterno'];
    $am=$line['amaterno'];
    $cel=$line['cel'];
    $tel=$line['tel'];
    $dir=$line['direccion'];
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
    cobranza($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div align="center"><h3><?php echo $user;?></h3></div>
        <div class="panel panel-info">
            <div class="panel-heading">Modificar Datos</div>
            <div class="panel-body">
            <form class="form-horizontal" action=" moduser.php" method="POST">
                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre(s): </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Apellido Paterno: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputApaterno"  name="ap" value="<?php echo $ap;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Apellido Materno: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputMaterno"  name="am" value="<?php echo $am;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Contraseña: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputPssw"  name="pssw" placeholder="Nueva Contraseña" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Celular:</label>
                    <div class="col-xs-9">
                       <input type="text" class="form-control" value="<?php echo $cel;?>" aria-describedby="sizing-addon2" readonly>
                    </div>
                    <label class="control-label col-xs-3">Teléfono:</label>
                     <div class="col-xs-9">
                        <input type="text" class="form-control" value="<?php echo $tel;?>" aria-describedby="sizing-addon2" readonly>
                    </div>
                    <label class="control-label col-xs-3">Dirección:</label>
                     <div class="col-xs-9">
                        <input type="text" class="form-control" value="<?php echo $dir;?>" aria-describedby="sizing-addon2" readonly>
                     </div>
                </div>

                <div class="form-group">
                    <input type="text" name="iduser" value="<?php echo $iduser;?>" style="visibility:hidden">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" class="btn btn-primary" value="Modificar">
                        <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-3">
    <!--
        <div class="panel panel-info" align="center">
        <a href="../manual/tecnico.pdf" target="_blank">
            <img src="../syspic/pdf.png" width="50px" height="50px" ><br>
            Descarga de Manual
        </a>
        </div>-->
    </div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>