<!DOCTYPE html>
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php ventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mis Ventas</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
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
            </nav>-->
                <div id="resultadoBusqueda">

                <?php
                $venta=new Ventas();
                $total=$venta->obtenerUltimo($con);
                ?>
                <div class="table-responsive" style="height: 500px;overflow: scroll;">
                    <table class="table table-bordered" style="background-color:white; font-sizE:12px;">
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
                          <th>Etapa</th>
                          <th>Documentacion</th>
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
                        
                        $dia=$v->regresaDia();
                        $mes=$v->regresaMes();
                        $year=$v->regresaYear();
                        $hora=$v->regresaHora();
                        $docu=$v->regresaDocumentacion();

                        $fecha=$dia."/".$mes."/".$year." ".$hora;
                        $estatus=$v->regresaEstatus();
                        $etapa=new TiendaComercial();
                        $etapa->obtenerTiendaBD($id,$con);
                        $etapaPs=$etapa->regresaEtapa();
                      ?> 
                          <tr>
                              <th>
                                  <form action="dataVenta.php" method="POST">
                                      <input class="btn btn-info" type="submit" value="<?php echo $id;?>" name="ident" >
                                  </form>
                              </th>
                              <!--<th><?php echo $id;?></th> -->
                              <th><?php echo $fecha;?></th> 
                              <th><?php echo $folio;?></th> 
                              <th style="font-size:10px;"><?php echo $name;?></th> 
                              <th style="font-size:10px;"><?php echo $dir;?></th> 
                              <th style="font-size:10px;"><?php echo $datos;?></th> 
                              <th><a href="tel:<?php echo $phone1;?>"><?php echo $phone1;?></a></th> 
                              <th><a href="tel:<?php echo $phone2;?>"><?php echo $phone2;?></a></th> 
                              <th><a href="tel:<?php echo $phone3;?>"><?php echo $phone3;?></a></th> 
                              <!--<th><?php echo $phone2;?></th> 
                              <th><?php echo $phone3;?></th> -->
                              <th><?php echo $etapaPs;?></th>
                              <th><?php echo $docu;?></th>
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
<!--============================================================================================-->      
    </div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
