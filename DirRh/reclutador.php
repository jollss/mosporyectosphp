<?php
include("../Config/library.php"); 
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>       
<?php
    Grh($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">    
    <div class="col-md-6">
        <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info" style="height:500px;overflow-y:scroll;">
            <div class="panel-heading">Datos de Reclutamiento</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
                <?php
                   $sql1="SELECT * FROM reclutamiento WHERE id_reclutar='$iduser'
                     ORDER BY rfecha DESC";
                   $resultado=$con2->query($sql1);
                ?>
                <div class="table-responsive" >
                    <table class="table table-bordered" style="background-color:white;">
                        <tr>
                          <!--<th></th>-->
                          <th>Nombre</th>
                          <th>Teléfono</th>
                          <th>Edad</th>
                          <th>Dirección</th>
                          <th>Sexo</th>
                          <th>Fase</th>
                          <th>Fecha</th>
                        </tr>
                      <?php
                      $aux=0;
                      $aux2=0;
                      while($row = $resultado->fetch_assoc())
                      {
                      $name=$row['nombre']." ".$row['apepaterno']." ".$row['apematerno'];
                      $phone=$row['rtelefono'];
                      $edad=$row['redad'];
                      $dir=$row['rdir'];
                      $sexo=$row['rsexo'];
                      $fase=$row['rfase'];
                      $rfecha=$row['rfecha'];
                      ?> 
                          <tr>
                              <th><?php echo $name;?></th> 
                              <th><?php echo $phone;?></th> 
                              <th><?php echo $edad;?></th> 
                              <th><?php echo $dir;?></th> 
                              <th><?php echo $sexo;?></th> 
                              <th><?php echo $fase;?></th> 
                              <th><?php echo $rfecha;?></th> 
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
    <div class="col-md-6">
        <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info" style="height:500px;overflow-y:scroll;">
            <div class="panel-heading">RECLUTADORES</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
                <?php
                   /*$sql1=
                   "SELECT reclutamiento.nombre,usuario.nombre,apepaterno,apaterno,apematerno,amaterno,
                   rtelefono,redad,rdir,rsexo,rfase,rfecha 
                   FROM reclutamiento INNER JOIN usuario 
                   WHERE id_reclutar=idu
                   ORDER BY rfecha";*/
                   $sql1=
                   "SELECT * 
                   FROM reclutamiento 
                   ORDER BY rfecha DESC";
                   $resultado=$con2->query($sql1);
                ?>
                <div class="table-responsive" >
                    <table class="table table-bordered" style="background-color:white;">
                        <tr>
                          <th>RECLUTA</th>
                          <th>Nombre</th>
                          <th>Teléfono</th>
                          <th>Edad</th>
                          <th>Dirección</th>
                          <th>Sexo</th>
                          <th>Fase</th>
                          <th>Fecha</th>
                        </tr>
                      <?php
                      $aux=0;
                      $aux2=0;
                      while($row = $resultado->fetch_assoc())
                      {
                        $name=$row['nombre']." ".$row['apepaterno']." ".$row['apematerno'];
                        $phone=$row['rtelefono'];
                        $edad=$row['redad'];
                        $dir=$row['rdir'];
                        $sexo=$row['rsexo'];
                        $fase=$row['rfase'];
                        $rfecha=$row['rfecha'];
                        $asig=$row['id_reclutar'];
                        $s="SELECT * FROM usuario WHERE idu='$asig'";
                        $re=$con3->query($s);
                        while($r = $re->fetch_assoc())
                        {
                          $n2=$r['nombre'];
                          $ap2=$r['apaterno'];
                          $am2=$r['amaterno'];
                        }
                        $name2=$n2." ".$ap2." ".$am2;
                        ?> 
                            <tr>
                                <th><?php echo $name2;?></th> 
                                <th><?php echo $name;?></th> 
                                <th><?php echo $phone;?></th> 
                                <th><?php echo $edad;?></th> 
                                <th><?php echo $dir;?></th> 
                                <th><?php echo $sexo;?></th> 
                                <th><?php echo $fase;?></th> 
                                <th><?php echo $rfecha;?></th> 
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
    <?php footer();?>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>