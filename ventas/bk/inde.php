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
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$nombreyo=$Yo->regresaNombre();
$apyo=$Yo->regresaApaterno();
$amyo=$Yo->regresaAmaterno();
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
    <?php 
    ventasS($user);
    if (!isset($_GET['latitud']) && !isset($_GET['longitud'])) {
            echo "
                <script type='text/javascript'>
                    if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(obtenerUbicacion);
                    } else {alert('¡Error! Este navegador no soporta la Geolocalización.');}
                    function obtenerUbicacion(position) {
                      var times = position.timestamp;
                      var latitud = position.coords.latitude;
                      var longitud = position.coords.longitude;
                      var altitud = position.coords.altitude; 
                      var exactitud = position.coords.accuracy; 
                      location.href='inde.php?latitud='+ latitud + '&longitud='+longitud;
                    }
                </script>
            ";
        }else{
          $id=0;
              $idventa='0';
              $lon=$_GET['longitud'];
              $lat=$_GET['latitud'];
        }
?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
    ?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Vender</h3>
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
                echo "<br><b>FASE 1</b>";
              ?>
            </div>

            <div class="panel-body">
            
        <form class="form-horizontal" action="rventa.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*No. de Solicitud:</span>
                      <input type="text" class="form-control" pattern=".{7,}"  maxlength="7" placeholder="No. de Solicitud"  name="folio" title="Folio de 7 digitos" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Nombre(s):</span>
                      <input type="text" class="form-control" placeholder="Nombre (s)"  name="name" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Apellido Paterno:</span>
                      <input type="text" class="form-control" placeholder="Apellido Paterno"  name="ap" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Apellido Materno:</span>
                      <input type="text" class="form-control" placeholder="Apellido Materno"  name="am" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*Teléfono 1:</span>
                      <input type="tel" class="form-control" placeholder="Teléfono"  pattern=".{10}" name="tel1" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono 2:</span>
                      <input type="tel" class="form-control" placeholder="Teléfono"  min="0" name="tel2" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono 3:</span>
                      <input type="tel" class="form-control" placeholder="Teléfono"  min="0" name="tel3" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group">
                      <input type="text" value="<?php echo $lat;?>" name="latitud" aria-describedby="sizing-addon2" style="border:none;background:none;display:none;" readonly>
                      <input type="text" value="<?php echo $lon;?>" name="longitud" aria-describedby="sizing-addon2" style="border:none;background:none;display:none;" readonly>
                    </div>
                <div class="well well-sm">
                  
                  <div class="input-group" style="display:;">
                      <span class="input-group-addon" id="sizing-addon2">Área:</span>
                      <input type="text" class="form-control" placeholder="AREA" name="area" aria-describedby="sizing-addon2" >
                  </div>
                  <div class="input-group" style="display:">
                      <span class="input-group-addon" id="sizing-addon2">Distrito:</span>
                      <input type="text" class="form-control" placeholder="DISTRITO" name="distrito" aria-describedby="sizing-addon2" >
                  </div>
                  
                  <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Terminal:</span>
                      <input type="text" class="form-control" placeholder="TERMINAL" name="terminal" aria-describedby="sizing-addon2" required>
                  </div>
                  <div class="form-group">
                  <label for="sel1">Documentación completa:</label>
                  <select class="form-control" name="documentacion">
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Nombre de vendedor:</span>
                  <input type="text" class="form-control" name="vende" placeholder="Solo si es necesario"  aria-describedby="sizing-addon2">
                </div>
                <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">*Dirección: </span>
                    <textarea class="form-control" minlength="15" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" required></textarea>
                </div>
            <div class="well well-sm"></div>
              <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">Detalles: </span>
                    <textarea class="form-control" rows="3" name="detalles" maxlength="500" placeholder="Detalles" style="resize:none;"></textarea>
                </div>
            <div class="">
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</form>
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
