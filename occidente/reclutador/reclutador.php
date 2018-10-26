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
    recluta($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
    <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info">
            <div class="panel-heading">Datos de Reclutamiento</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
            <!--
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php }; ?>
                </li>
              </ul>
            </nav>
            -->
                <div id="resultadoBusqueda">

                <?php
                   $sql1="SELECT * FROM reclutamiento WHERE id_reclutar='$iduser'
                     ORDER BY rfecha";
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
                          <th>Recomendado por</th>
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
                      $referencia=$row['referencia'];
                      ?> 
                          <tr>
                              <th><?php echo $name;?></th> 
                              <th><?php echo $phone;?></th> 
                              <th><?php echo $edad;?></th> 
                              <th><?php echo $dir;?></th> 
                              <th><?php echo $sexo;?></th> 
                              <th><?php echo $fase;?></th> 
                              <?php
                              $sql="SELECT * FROM usuario WHERE idu='$referencia'";
                                   $re=$con3->query($sql);
                                    while($row2 = $re->fetch_assoc())
                                    {
                                      ?>
                                      <th><?php echo $row2['nombre']." ".$row2['apaterno']." ".$row2['amaterno'];?></th> 
                                      <?php
                                    }
                              ?>
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
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>