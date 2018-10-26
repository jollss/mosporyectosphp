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
$tos=0;
$idus=$_POST['ident'];
$con2->real_query("SELECT * FROM usuario WHERE idu='$idus'");
    $resultado = $con2->use_result();
    while ($row = $resultado->fetch_assoc()){
        $tos++;
        $idsuper=$row['idu'];
        $nus=$row['nombre'];
        $apus=$row['apaterno'];
        $amus=$row['amaterno'];
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
<script type="text/javascript" src="../js/browser5.js"></script>
        
<?php
    cbajantes($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
    <!--<div align="center"><h3><?php echo $user;?></h3></div>-->
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
             <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?><h4><!--Semana:<?php echo $semana;?>--></h4></div>
            <div class="panel-body">
            <div class="col-md-6">
                <?php
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                
                $semana = date("W");
                echo "<b><br> Asignar Tecnicos a: ".$nus." ".$apus." ".$amus."</b>";
                ?>
            </div>
            <form action="asignar.php" method="POST">
            <div class="col-md-4">
            <input type="text" value="<?php echo $idsuper;?>" name="idsuper" style="display:none;">
                <div class="form-group">
                <label for="sel1">Tecnicos sin supervisor:</label>
                    <select class="form-control" id="sel1" name="iduser">
                <?php
                   $sql1="SELECT * FROM usuario 
                     WHERE activo=1 AND tipo_idtipo=1 AND asignado =0  ORDER BY nombre";
                   $resultado=$con2->query($sql1);
                   while($row = $resultado->fetch_assoc())
                    {
                        if(is_null(asignado) ){}else{
                        echo "<option value='".$row['idu']."'>".$row['nombre']." ".$row['apaterno']." ".$row['amaterno']."</option>";
                        }
                    }
                ?>
                  </select>
                </div>
            </div>
            <div align="center">
                    <input type="submit" class="btn btn-info" value="ASIGNAR">
                </div>
            </form>
            <div align="center" class="col-md-12">
                <div id="resultadoBusqueda">

                <?php
                   $sql1="SELECT * FROM usuario 
                     WHERE activo=1 AND tipo_idtipo=1 AND asignado='$idsuper' ORDER BY nombre";
                   $resultado=$con2->query($sql1);
                ?>
                <div class="table-responsive" >
                    <table class="table table-bordered" style="background-color:white;">
                        <tr>
                          <th>Nombre</th>
                          <th>ID</th>
                          <th>Teléfono</th>
                          <th>Correo</th>
                          <th>QUITAR</th>
                        </tr>
                <?php
                    while($row = $resultado->fetch_assoc())
                    {
                        $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                        $phone=$row['cel'];
                        $mail=$row['correo'];
                        ?> 
                        <tr>
                            <th><?php echo $name;?></th>
                            <th><?php echo $row['idu'];?></th> 
                            <th><?php echo $phone;?></th> 
                            <th><?php echo $mail;?></th> 
                            <th>
                                <form action="modAsignado.php" method="POST">
                                    <input type="text" value="<?php echo $row['idu'];?>" name="idu" style='display:none;'>
                                    <input type="submit" value="-" class="btn btn-danger">
                                </form>
                            </th>
                        </tr>
                        <?php                                              
                        }
                        ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>