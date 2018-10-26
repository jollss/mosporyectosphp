<!DOCTYPE html>
<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse();
$con = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$nomu=$Yo->regresaNombre();
$apu=$Yo->regresaAPaterno();
$amu=$Yo->regresaIdu();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->

    <?php nivel1($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
              <?php
                    date("n");

              $query2 = "SELECT nombre,apaterno,amaterno FROM usuario WHERE idu='$iduser'";

              $result1 = $con->query($query2);
              // $total_num_rows = $result1->num_rows;
               //while($row = $result1->fetch_array())
            //  {
            //      print_r($row);
            //  }
              while($filas1 = $result1->fetch_assoc()) {
                $nombre=$filas1['nombre'];
                $apaterno=$filas1['apaterno'];
                  $amaterno=$filas1['amaterno'];
              //   print_r($filas1);
              }
            echo "<h3 class='page-header'>Hola $nombre se te Prsentara tu meta mensual,semanal y tu rendimiento durante el mes.</h3>";
                ?>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
<div class="col-md-12">
	<div class="panel panel-default">
	  <div class="panel-heading">
      <button class="btn btn-primary" onclick="metaMensual()">Ver Meta Mensual Actual</button>
      <button class="btn btn-primary" onclick="metaSemanal()">Ver Meta Semanal Actual</button>



	  </div>
	  <div class="panel-body" align="center">
<div id="metaSemanal">
  tu meta semanal deberia ser de 12 ordenes de servicio

  <br>

</div>
<div style="display:none;" id="metaMensual">

</div>
	  </div>
	</div>
</div>
<!--============================================================================================-->
    </div>
</div>

<!-- jQuery -->
<script src="../js/funciones3.js"></script>
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
