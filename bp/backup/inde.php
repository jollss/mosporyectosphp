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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/slider.css" rel="stylesheet">
<?php
    ventas($user);
?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarUbicacion);
      } else {alert("¡Error! Este navegador no soporta la Geolocalización.");}
    function mostrarUbicacion(position) {
      var times = position.timestamp;
      var latitud = position.coords.latitude;
      var longitud = position.coords.longitude;
      var altitud = position.coords.altitude; 
      var exactitud = position.coords.accuracy; 
      var div = document.getElementById("ubicacion");
      div.innerHTML = "<br>Latitud: <input type='text' name='latitud' value='" + latitud + "' style='background:none;border:none;' readonly><br>Longitud: <input type='text' name='longitud' value='" + longitud + "' style='background:none; border:none;' readonly><br>Exactitud: " + exactitud;
    }
    function refrescarUbicacion() { navigator.geolocation.watchPosition(mostrarUbicacion); } 
  </script> 
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2"></div>
    <div class="col-md-4">
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
        <!--
            <div class="col-md-12" align="center" style="background-color:orange;">
            Se tomara la ubicación actual como referencia para registrar un cliente.
            <img src="../syspic/ubication.png" width="40" height="40">
             <div id='ubicacion'></div>
             <!--<a href="http://maps.google.com/maps?q=loc: 19.2845104,-99.6610857" target="_blank">-->
            <!--</div>-->
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">*FOLIO:</span>
                      <input type="text" class="form-control" pattern=".{7,}"  maxlength="8" placeholder="FOLIO"  name="folio" title="Folio de 7 digitos" aria-describedby="sizing-addon2" required>
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
                    <!--
                    <div class="well well-sm">
                        <div class="input-group">
                            <input type="radio" name="sexo" value="Masculino" checked>Masculino<br>
                            <input type="radio" name="sexo" value="Femenino">Femenino<br>
                        </div>
                    </div>-->
                <div class="well well-sm"></div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">*Dirección: </span>
                    <textarea class="form-control" minlength="15" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" required></textarea>
                </div>
            <div class="well well-sm"></div>
              <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">Detalles: </span>
                    <textarea class="form-control" rows="3" name="detalles" maxlength="1000" placeholder="Detalles" style="resize:none;"></textarea>
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
    <div class="col-md-3">
    </div>
    </div>
</form>
</div>
<div class="col-md-12"> <?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>