<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora=date('G');
$min=date('i');
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$venta=$_POST['ident'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$nombreyo=$Yo->regresaNombre();
$apyo=$Yo->regresaApaterno();
$amyo=$Yo->regresaAmaterno();
$VentaData=new Ventas();
$VentaData->obtenerVentaBD($venta,$con);
$folioventa=$VentaData->regresaFolioVenta();
//$vendedor=$Ventas->regresaVendedor();
$nombre=$VentaData->regresaNombre();
$apaterno=$VentaData->regresaApaterno();
$amaterno=$VentaData->regresaAmaterno();
$dire=$VentaData->regresaDireccion();
$detalles=$VentaData->regresaDatos();
$vende=$VentaData->regresaVendedorN();
$terminal=$VentaData->regresaTerminal();
$tel1=$VentaData->regresaTel1();
$tel2=$VentaData->regresaTel2();
$tel3=$VentaData->regresaTel3();
$dia=$VentaData->regresaDia();
$mes=$VentaData->regresaMes();
$year=$VentaData->regresaYear();
$hora==$VentaData->regresaHora();
//$VentaData->regresaEstatus();
//$VentaData->regresaVendedorN();
//$VentaData->regresaDocumentacion();
$area=$VentaData->regresaArea();
$distrito=$VentaData->regresaDistrito();
?>
<!DOCTYPE html>
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
    <?php nivel4($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Documentacion</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
              <?php 
                echo $nombreyo." ".$apyo." ".$amyo;
                echo "<br>Fecha ".$dia."/".$mes."/".$aaaa;
              ?>
            </div>

            <div class="panel-body">
            <div class="input-group col-md-12" align="center" style="background-color:;">
              <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="<?php echo $venta;?>" style="display:none;" name="venta" readonly>
                <span class="input-group-addon" id="sizing-addon2">
                <label>Imagen de Documentacion:</label>
                <input type="file" name="userfile[]">
                <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
                </span>
              </form>
            </div>
        <!--<form class="form-horizontal" action="rventa.php" method="POST" enctype="multipart/form-data">-->
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*No. de Solicitud:</span>
                      <input type="text" class="form-control" value="<?php echo $folioventa;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Nombre(s):</span>
                      <input type="text" class="form-control" value="<?php echo $nombre;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Apellido Paterno:</span>
                      <input type="text" class="form-control" value="<?php echo $apaterno;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Apellido Materno:</span>
                      <input type="text" class="form-control" value="<?php echo $amaterno;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Teléfono 1:</span>
                      <input type="tel" class="form-control" value="<?php echo $tel1;?>" name="tel1" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono 2:</span>
                      <input type="tel" class="form-control" value="<?php echo $tel2;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono 3:</span>
                      <input type="tel" class="form-control" value="<?php echo $tel3;?>" aria-describedby="sizing-addon2" readonly="readonly">
                    </div>
                <div class="well well-sm">
                  
                  <div class="input-group" style="display:;">
                      <span class="input-group-addon" id="sizing-addon2">Área:</span>
                      <input type="text" class="form-control" value="<?php echo $area;?>"aria-describedby="sizing-addon2" readonly="readonly">
                  </div>
                  <div class="input-group" style="display:">
                      <span class="input-group-addon" id="sizing-addon2">Distrito:</span>
                      <input type="text" class="form-control" value="<?php echo $distrito;?>" aria-describedby="sizing-addon2" readonly="readonly">
                  </div>
                  
                  <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Terminal:</span>
                      <input type="text" class="form-control" value="<?php echo $terminal;?>" aria-describedby="sizing-addon2" readonly="readonly">
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">Vendedor: </span>
                    <input class="form-control" type="text" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" readonly="readonly" value="<?php echo $vende;?>">
                </div>
                <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">*Dirección: </span>
                    <textarea class="form-control" minlength="15" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" readonly="readonly"><?php echo $dire;?></textarea>
                </div>
            <div class="well well-sm"></div>
              <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">Detalles: </span>
                    <textarea class="form-control" rows="3" name="detalles" maxlength="500" placeholder="Detalles" style="resize:none;" readonly="readonly"><?php echo $detalles;?></textarea>
                </div>
            <div class="">
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <a href="inde.php"><input type="button" class="btn btn-danger" value="NO SUBIR ARCHIVOS O SALIR"></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="well well-sm">
              <?php
              $sql1="SELECT * FROM Adjunto_venta WHERE folio_venta='$venta'";
              $resultado=$con->query($sql1);
              while($row = $resultado->fetch_assoc())
              {
                $folioventa=$row['folio_venta'];
                $imagen_n=$row['imagen_n'];
                ?>
                <a href="../adjVentas/<?php echo $imagen_n;?>" target="_blank"><img src="../adjVentas/<?php echo $imagen_n;?>" width="40" height="40"></a>
                <?php
              }
              ?>
            </div>
        </div>
    </div>
    </div>
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
