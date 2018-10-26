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
$cantidad_resultados_por_pagina = 20;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: addOs.php");
                 die();
             } else { 
                 $pagina = $_GET["pagina"];
            };
         } else {
             header("Location: addOs.php");
            die();
         };
    };

} else { $pagina = 1;};
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
if ($result = $con->query("SELECT * FROM os WHERE usuario_idu='$iduser' AND tecnico='' AND activos=0")) {
    /* determinar el número de filas del resultado */
    $total_registros = $result->num_rows;
    printf("Result set has %d rows.\n", $total_registros);
    /* cerrar el resultset */
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
<script type="text/javascript" src="../js/browser2.js"></script>
        
<?php
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">

        <div class="panel panel-info">

            <div class="panel-heading">Ordenes de servicio restantes</div>
            <div class="panel-body" style="background-color:gray;">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div align="center">
            <nav aria-label="Page navigation" style="font-size:10px;">
              <ul class="pagination">
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php }; ?>
                </li>
              </ul>
            </nav>
                 <div id="">
                 <?php
                     $sql1="SELECT * FROM os WHERE usuario_idu='$iduser' AND tecnico='' AND activos=0 ORDER BY folio
                     LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
                    $resultado=$con->query($sql1);
                    if(mysqli_num_rows($resultado)==0){
                    echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
                    }
                    else{
                        ?>                        
                            <div class="table-responsive" >
                                <table class="table table-bordered" style="background-color:white;font-size:11px">
                                    <tr style="font-size:12px;">
                                      <th><a href="addOs.php">Asignar</a></th>
                                      <th><a href="addOsFolio.php">Folio</a></th>
                                      <th><a href="addOsTipo.php">Tipo</a></th> 
                                      <th>Teléfono</th>
                                      <th><a href="addOsCliente.php">Cliente</th>
                                      <th>Coordinador Division</th>
                                    </tr>
                                    <form action="addOsF.php" method="POST">
                                    <?php
                                    $id=0;
                                    while($row = $resultado->fetch_assoc())
                                    {
                                        $id=$row['idmos'];
                                        $idCoo=$row['c_division'];
                                    ?>
                                    <tr>                                        
                                        <th><input class="btn btn-info"  name="ident" type="submit" value="<?php echo $id;?>"></th>
                                        <th><?php echo $row['folio'];?></th>            
                                        <th><?php echo $row['tipo'];?></th>
                                        <th><?php echo $row['telefono'];?></th>
                                        <th><?php echo $row['nombre'];?></th>
                                        <?php 
                                        $con4->real_query("SELECT * FROM usuario WHERE idu='$idCoo'");
                                        $re = $con4->use_result();
                                        while ($ln = $re->fetch_assoc()){
                                            $name=$ln['nombre'];
                                            $apaterno=$ln['apaterno'];
                                        }
                                        ?>
                                        <th><?php echo $name." ".$apaterno;?></th>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </form>
                                </table>
                            </div>
                        <?php
                    }
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
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
</body>
</html>