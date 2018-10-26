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
$nivel1="TECNICO";
$nivel2="RH";
$nivel3="SUPERVISOR";
$nivel4="VALIDADOR";
$nivel5="GERENCIAL";
$nivel6="SOPORTE";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<?php
    nivel2($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <!--<div align="center"><h3><?php echo $user;?></h3></div>-->
        <div class="panel panel-info">
            <div class="panel-heading">Usuarios</div>
            <div class="panel-body">
            
                <?php
                  $con->real_query("SELECT * FROM usuario INNER JOIN tipo 
                    WHERE activo=1 AND usuario.tipo_idtipo=tipo.idtipo AND idtipo<>5 ORDER BY tipo");
                  $resultado = $con->use_result();
                ?>
                <form action=" data.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                              <th><a href="list.php">Nombre Completo</a></th>
                              <th>Correo</th>
                              <th><a href="listTipo.php">Tipo</th>
                              <th>Celular</th>
                              <th><a href="listID.php">ID</a></th>
                              <th>Estado</th>
                              
                            </tr>
                            <?php 
                            $aux=0;
                            while ($row = $resultado->fetch_assoc()){
                                $mod=$aux%2;
                                    if($mod==0){
                                        ?>  
                                        <tr>
                                            <th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                            <th><?php echo $row['correo'];?></th>
                                             <th><?php echo $row['tipo'];?></th>
                                            <th><?php echo $row['cel'];?></th>
                                            <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idu'];?>"></th>
                                            <th><?php if($row['activo']==1){echo "ACTIVO";}if($row['activo']==0){echo "INACTIVO";}?></th>
                                        </tr>
                                        <?php
                                    }if($mod==1){
                                        ?>
                                        <tr style="background-color:orange;">
                                            <th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                            <th><?php echo $row['correo'];?></th>
                                             <th><?php echo $row['tipo'];?></th>
                                            <th><?php echo $row['cel'];?></th>
                                            <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idu'];?>"></th>
                                            <th><?php if($row['activo']==1){echo "ACTIVO";}if($row['activo']==0){echo "INACTIVO";}?></th>
                                        </tr>
                                        <?php
                                    }
                                    $aux=$aux+1;
                                }
                                ?>
                        </table>
                    </div>
                </form>
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