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
$minI=6;
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
    <script type="text/javascript" src="../modVender/ajax.js"></script>
    <?php
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

</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php
    $query = "SELECT * FROM usuario  WHERE  idu='$iduser' and bandera_contrase='no' ";
    $result = $con->query($query);
    while($filas = $result->fetch_assoc()) {
    //print_r($filas);
    $modificarcontrase=$filas['bandera_contrase'];
    $modificarcontrasenombre=$filas['nombre'];
    $modificarcontraseidu=$filas['idu'];
    }
    if($modificarcontrase=='no'){
    echo"<h2><p style='color:#FF0000';>$modificarcontrasenombre</p> tienes que cambiar contraseña por motivos de seguridad  favor de llenar el siguiente formulario</h2> ";
    echo"<form action='../modi.php' method='POST'>
    <input type='hidden'  placeholder='nueva contraseña'  name='idu' value='$modificarcontraseidu'>
    <input type='password'  placeholder='nueva contraseña'  name='pass' aria-describedby='sizing-addon2' maxlength='10' required>
      <input type='submit' class='btn btn-primary' value='Enviar'>


    </form>

    ";
    }else{

    ventas($user);
}


    ?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">INICIO  /

<?php
$queryss= "SELECT id_zona,asignado,pertenece_a,coordinador FROM usuario  WHERE  idu='$iduser' ";
$resuls = $con->query($queryss);
while($filasss = $resuls->fetch_assoc()) {
$asignado=$filasss['asignado'];
$pertenece_a=$filasss['pertenece_a'];
$id_zona=$filasss['id_zona'];
$coordinador=$filasss['coordinador'];
}
  echo"                 <a href='rendimiento.php?idu=$asignado&asignado=$asignado&pertenece_a=$pertenece_a&id_zona=$id_zona&coordinador=$coordinador' >MI RENDIMIENTO </a>";

?>


                 </h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
 <?php
  $main="ventas/inde.php";
  include("../modVender/inde.php");
 ?>
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
