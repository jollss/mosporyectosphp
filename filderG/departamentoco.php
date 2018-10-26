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
    <style>
    .padre {
  display: flex;
  justify-content: center;
}
    body {
  background-color: #333;
}

.organigrama * {
  margin: 0px;
  padding: 0px;
}

.organigrama ul {
	padding-top: 20px;
  position: relative;
}

.organigrama li {
	float: left;
  text-align: center;
	list-style-type: none;
	padding: 20px 5px 0px 5px;
  position: relative;
}

.organigrama li::before, .organigrama li::after {
	content: '';
	position: absolute;
  top: 0px;
  right: 50%;
	border-top: 1px solid #f80;
	width: 50%;
  height: 20px;
}

.organigrama li::after{
	right: auto;
  left: 50%;
	border-left: 1px solid #f80;
}

.organigrama li:only-child::before, .organigrama li:only-child::after {
	display: none;
}

.organigrama li:only-child {
  padding-top: 0;
}

.organigrama li:first-child::before, .organigrama li:last-child::after{
	border: 0 none;
}

.organigrama li:last-child::before{
	border-right: 1px solid #f80;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
	border-radius: 0 5px 0 0;
}

.organigrama li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

.organigrama ul ul::before {
	content: '';
	position: absolute;
  top: 0;
  left: 50%;
	border-left: 1px solid #f80;
	width: 0;
  height: 20px;
}

.organigrama li a {
	border: 1px solid #f80;
	padding: 1em 0.75em;
	text-decoration: none;
	color: #333;
  background-color: rgba(255,255,255,0.5);
	font-family: arial, verdana, tahoma;
	font-size: 0.85em;
	display: inline-block;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
  -webkit-transition: all 500ms;
  -moz-transition: all 500ms;
  transition: all 500ms;
}

.organigrama li a:hover {
	border: 1px solid #fff;
	color: #ddd;
  background-color: rgba(255,128,0,0.7);
	display: inline-block;
}

.organigrama > ul > li > a {
  font-size: 1em;
  font-weight: bold;
}

.organigrama > ul > li > ul > li > a {
  width: 8em;
}
</style>
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
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">

          <?php
          if($iduser==347){

            ?>
            <div class="col-lg-12">
                <h1 class="page-header">Bienvenido <?php echo $nomu ?></h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->

	  <div class="panel-heading">
	    <h3 class="panel-title">Se te Presenta tu avanze a nivel lider,supervisor y lider
<?php
if($iduser==347){
      echo"  (si eres carlos ya no llames a sistemas jajajaj xD)
";
}  ?></h3>
	  </div>

<div class="padre">
  <?php
  	require ('../conexion.php');

  	$query = "SELECT u.nombre,u.idu,t.tipo FROM usuario AS u
INNER JOIN tipo AS t
ON t.idtipo=u.tipo_idtipo



 WHERE u.correo='carlos.pereyra@mosproyectos.com.mx' AND u.idu=$iduser";
  	$resultado=$mysqli->query($query);
  ?>
  <script language="javascript" src="../js/jquery-3.1.1.min.js"></script>

  <script language="javascript">
    $(document).ready(function(){
      $("#coordinador").change(function () {
      // $('#promotor').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

        $("#coordinador option:selected").each(function () {
          idu = $(this).val();

        //  console.log(id_zona);
          $.post("../includes/getdirectorlider.php", { idu: idu }, function(data){
            $("#lider").html(data);
          });
        });

      })
    });

    $(document).ready(function(){
      $("#lider").change(function () {
        $("#lider option:selected").each(function () {
          idu = $(this).val();

          $.post("../includes/getcoordinadorsupervisor.php", { idu: idu }, function(data){
            $("#supervisor").html(data);
          });

        });
      })
      $("#supervisor").change(function () {
        $("#supervisor option:selected").each(function () {
          idu = $(this).val();

          $.post("../includes/getliderpromotor.php", { idu: idu }, function(data){

            $("#promotor").html(data);
          });

        });
      })


    });

  </script>
  <form id="combo" name="combo" action="rendimientoco.php" method="get">
    <div>Selecciona a tu usuario : <select name="coordinador" id="coordinador">
      <option value="0">Selecciona...</option>
      <?php while($row = $resultado->fetch_assoc()) { ?>
        <option value="<?php echo $row['idu']; ?>"><?php echo $row['nombre']; ?>/<?php echo $row['tipo']; ?> </option>
      <?php } ?>
    </select></div>

    <br />


    <div>Ahora si Selecciona a tu lider : <select name="lider" id="lider"></select></div>
    <br />
    <div>Selecciona  a tu supervisor de Ventas : <select name="supervisor" id="supervisor"></select></div>

    <br />

    <div>Selecciona a tu Promotor : <select name="promotor" id="promotor"></select></div>

    <br />

    <input type="submit" id="enviar" name="enviar" value="Ver" />
  </form>
</div>
<?php
}
else{

  echo"todavia no se te asigna a tus ususarios";
}

  ?>
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
