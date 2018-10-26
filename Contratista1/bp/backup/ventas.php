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
$Yo=new Usuario();
$Yo-> obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
/*
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}*/
$cantidad_resultados_por_pagina = 8;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: ventas.php");
                 die();
             } else { 
                 $pagina = $_GET["pagina"];
            };
         } else {
             header("Location: ventas.php");
            die();
         };
    };

} else { $pagina = 1;};
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
if ($result = $con->query("SELECT * FROM ventas ")) {// WHERE reclutamiento='REGISTRO' or reclutamiento='ENTREVISTA'")) {
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
<?php
    ventas($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    
    <br>
    
    <div class="col-md-12">
    <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info">
            <div class="panel-heading">Datos de Venta</div>
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
            </nav>-->
                <div id="resultadoBusqueda">

                <?php
                $venta=new Ventas();
                $total=$venta->obtenerUltimo($con);
                /*
                   $sql1="SELECT * FROM ventas WHERE idvendedor='$iduser'
                     ORDER BY fecha
                     LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
                   $resultado=$con2->query($sql1);
                   */
                ?>
                <div class="table-responsive" >
                    <table class="table table-bordered" style="background-color:white;">
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Folio</th>
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Datos</th>
                          <th>Teléfono 1</th>
                          <th>Teléfono 2</th>
                          <th>Teléfono 3</th>
                        </tr>
                      <?php
                      $aux=0;
                      $aux2=0;
                      //while($row = $resultado->fetch_assoc())
                      for ($i=0; $i < $total; $i++) 
                      {
                        $v=new Ventas();
                        $v->obtenerVentaBD($i,$con);
                        $vendedor=$v->regresaVendedor();
                        if ($vendedor==$iduser) {
                        $id=$v->regresaIdVenta();
                        $folio=$v->regresaFolioVenta();
                        $name=$v->regresaNombre();
                        $phone1=$v->regresaTel1();
                        $phone2=$v->regresaTel2();
                        $phone3=$v->regresaTel3();
                        $dir=$v->regresaDireccion();
                        $datos=$v->regresaDatos();
                        $diav=$v->regresaDia();
                        $mesv=$v->regresaMes();
                        $yearv=$v->regresaYear();
                        $horav=$v->regresaHora();
                        $fecha=$diav."/".$mesv."/".$yearv." ".$horav;
                        //$fecha=$v->regresaFecha();
                        $estatus=$v->regresaEstatus();
                      ?> 
                          <tr>
                              <!--<th>
                                  <form action="infoos.php" method="POST">
                                      <input type="text" value="<?php echo $row['idreclutamiento'];?>" name="ident" style="display:none;">
                                      <input class="btn btn-info"  type="submit" value="Asignar">
                                  </form>
                              </th>-->
                              <th><?php echo $id;?></th> 
                              <th><?php echo $fecha;?></th> 
                              <th><?php echo $folio;?></th> 
                              <th style="font-size:10px;"><?php echo $name;?></th> 
                              <th style="font-size:10px;"><?php echo $dir;?></th> 
                              <th style="font-size:8px;"><?php echo $datos;?></th> 
                              <th><?php echo $phone1;?></th> 
                              <th><?php echo $phone2;?></th> 
                              <th><?php echo $phone3;?></th> 
                              <!--<th><a href="http://maps.google.com/maps?q=loc: <?php echo $latitud;?>,<?php echo $longitud;?>" target="_blank"><img src="../syspic/ubication.png" width="40" height="40"></a></th>-->
                          </tr>
                      <?php   
                        }                                           
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