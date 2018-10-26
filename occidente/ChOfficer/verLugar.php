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
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
if($ultimo =mysqli_query($con,"SELECT idU FROM usuario ORDER BY idu")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$id=$row_cnt+1;
?>
<?php
              // comprobar si tenemos los parametros w1 y w2 en la URL
              if (isset($_GET["w1"]) && isset($_GET["w2"])) {
                  // asignar w1 y w2 a dos variables
                  $phpVar1 = $_GET["w1"];
                  $phpVar2 = $_GET["w2"];
               
                  // mostrar $phpVar1 y $phpVar2
                  echo "<p>Parameters: " . $phpVar1 . " " . $phpVar1 . "</p>";
              } else {
                  echo "<p>No parameters</p>";
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
        <link href="../css/slider.css" rel="stylesheet">
<?php
    ventas($user);
?>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Mapa</div>
            <div class="panel-body">
                <div class="well well-sm">
                  <div id='ubicacion'></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-body">
              <!-- Se escribe un mapa con la localizacion anterior-->
<div id="demo"></div>
<div id="mapholder"></div>
<!--===============================================================-->

<button onclick="cargarmap()">Cargar mapa</button>
<script type="text/javascript">
  var x=document.getElementById("demo");
  function cargarmap(){
  navigator.geolocation.getCurrentPosition(showPosition,showError);
  function showPosition(position)
    {
    lat=position.coords.latitude;
    lon=position.coords.longitude;
    latlon=new google.maps.LatLng(lat, lon)
    mapholder=document.getElementById('mapholder')
    mapholder.style.height='250px';
    mapholder.style.width='500px';
    var myOptions={
    center:latlon,zoom:10,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    };
    var map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
    var marker=new google.maps.Marker({position:latlon,map:map,title:"Nueva Venta"});
    }
  function showError(error)
    {
    switch(error.code) 
      {
      case error.PERMISSION_DENIED:
        x.innerHTML="Denegada la peticion de Geolocalización en el navegador."
        break;
      case error.POSITION_UNAVAILABLE:
        x.innerHTML="La información de la localización no esta disponible."
        break;
      case error.TIMEOUT:
        x.innerHTML="El tiempo de petición ha expirado."
        break;
      case error.UNKNOWN_ERROR:
        x.innerHTML="Ha ocurrido un error desconocido."
        break;
      }
    }}
</script>

            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
    </div>
</div>
<div class="col-md-12"> <?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
        div.innerHTML = "Timestamp: " + times + "<br>Latitud: " + latitud + "<br>Longitud: " + longitud + "<br>Altura en metros: " + altitud + "<br>Exactitud: " + exactitud;}  
      function refrescarUbicacion() { 
        navigator.geolocation.watchPosition(mostrarUbicacion);} 
  </script> 
</body>
</html>