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
    

$cantidad_resultados_por_pagina = 20;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: fullF.php");
                 die();
             } else { 
                 $pagina = $_GET["pagina"];
            };
         } else { 
             header("Location: fullF.php");
            die();
         };
    };

} else { 
    $pagina = 1;
};
$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
if ($result = $con->query("SELECT * FROM data_callcenter INNER JOIN call_center 
                    WHERE  estado_call=1 AND call_center_id_calc=id_callc ORDER BY id_cc")) {
    $total_registros = $result->num_rows;
    printf("Result set has %d rows.\n", $total_registros);
    $result->close();
}
$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
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
    call_center($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
    <div align="center"><h3></h3></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body" style="background-color:gray;">
            
            <div align="center" style="font-size:12px !important;">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php 
                };?>
              </ul>
            </nav>
                 <div id="resultadoBusqueda">

                 <?php
                   $sql1="SELECT * FROM data_callcenter INNER JOIN call_center 
                    WHERE  estado_call=1 AND call_center_id_calc=id_callc ORDER BY id_cc 
                   LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
                   $resultado=$con2->query($sql1);

                        ?>
                        <form action="dataCall.php" method="POST">
                            <div class="table-responsive" >
                                <table class="table table-bordered" style="background-color:white; font-size:10px !important;">
                                    <tr>
                                      <th><a >ID</a></th>
                                      <th><a >Consecutivo</a></th>
                                      <th><a >COPE</a></th>
                                      <th><a >EXPEDIENTE</a></th>
                                      <th>TELÉFONO</th>
                                      <th><a >CLIENTE</a></th>
                                      <th><a >DISTRITO</a></th>
                                      <th><a >SUPERVISOR</a></th>
                                      <th><a >TECNICO</a></th>
                                      <th><a href="fullFEstado.php">ESTATUS</a></th>
                                      <th>Fecha</th>
                                    </tr>
                                <?php
                                $aux=0;
                                $aux2=0;
                                    while($row = $resultado->fetch_assoc())
                                    {
                                        ?>
                                      <tr>
                                          <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['id_callc'];?>"></th>
                                          <th><?php echo $row['consecutivo'];?></th>
                                          <th><?php echo $row['cope'];?></th>
                                          <th><?php echo $row['expediente'];?></th>
                                          <th><?php echo $row['telefono'];?></th>                                
                                          <th><?php echo $row['nombre_cli'];?></th>
                                          <th><?php echo $row['distrito'];?></th>
                                          <th><?php echo $row['supervisor'];?></th>
                                          <th><?php echo $row['tecnico'];?></th>
                                          <th>
                                            <?php
                                            if($row['servicio']=='SI'){
                                            ?>
                                              <label class="btn btn-success"><?php echo $row['servicio'];?></label>
                                            <?php
                                            }if($row['servicio']=='NO'){
                                            ?>
                                              <label class="btn btn-danger"><?php echo $row['servicio'];?></label>
                                            <?php
                                            }
                                            ?>                                            
                                          </th>
                                          <th><?php echo $row['dd']."/".$row['mm']."/".$row['aaaa']." - ".$row['hora'];?></th>
                                      </tr>
                                        <?php

                                        }
                                        ?>
                                </table>
                            </div>
                        </form>
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
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>

</body>
</html>