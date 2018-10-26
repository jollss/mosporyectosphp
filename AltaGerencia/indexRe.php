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
    <?php ag($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">FIELDER Rendimiento</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
<div class="col-md-12">
	<div class="panel panel-default">

	  <div class="panel-body" align="center">
      <table style='width:100%'>
            <tr>

          <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Accion</th>
            </tr>


    <!--  <form action="#" method="post">
      <select name="Color">
      <option value="metro">Metro</option>
      <option value="occidente">Occidente</option>
      <option value="sureste">Sureste</option>

      </select>
      <input type="submit" name="submit" value="Selecciona la zona" />
    </form>-->
      <?php
      $cantidad_resultados_por_pagina = 8;

  //Comprueba si está seteado el GET de HTTP
  if (isset($_GET["pagina"])) {

  	//Si el GET de HTTP SÍ es una string / cadena, procede
  	if (is_string($_GET["pagina"])) {

  		//Si la string es numérica, define la variable 'pagina'
  		 if (is_numeric($_GET["pagina"])) {

  			 //Si la petición desde la paginación es la página uno
  			 //en lugar de ir a 'index.php?pagina=1' se iría directamente a 'index.php'
  			 if ($_GET["pagina"] == 1) {
  				 header("Location: index.php");
  				 die();
  			 } else { //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
  				 $pagina = $_GET["pagina"];
  			};

  		 } else { //Si la string no es numérica, redirige al index (por ejemplo: index.php?pagina=AAA)
  			 header("Location: index.php");
  			die();
  		 };
  	};

  } else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al index.php o lo que sea)
  	$pagina = 1;
  };

  //Define el número 0 para empezar a paginar multiplicado por la cantidad de resultados por página
  $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
  //Obtiene TODO de la tabla
$obtener_todo_BD = "SELECT us.activo,us.nombre,us.correo,ti.tipo,us.idu
 FROM usuario AS us
 INNER JOIN tipo AS ti ON ti.idtipo=us.tipo_idtipo
  WHERE ti.idtipo='22' OR ti.idtipo='32' OR ti.idtipo='35' ORDER BY us.activo";

//Realiza la consulta
$consulta_todo = mysqli_query($con, $obtener_todo_BD);

//Cuenta el número total de registros
$total_registros = mysqli_num_rows($consulta_todo);

//Obtiene el total de páginas existentes
$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina);

//Realiza la consulta en el orden de ID ascendente (cambiar "id" por, por ejemplo, "nombre" o "edad", alfabéticamente, etc.)
//Limitada por la cantidad de cantidad por página
$consulta_resultados = mysqli_query($con, "
SELECT us.activo,us.nombre,us.correo,ti.tipo,us.idu
 FROM usuario AS us
 INNER JOIN tipo AS ti ON ti.idtipo=us.tipo_idtipo
  WHERE ti.idtipo='22' OR ti.idtipo='32' OR ti.idtipo='35' ORDER BY us.activo ASC
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");

//Crea un bluce 'while' y define a la variable 'datos' ($datos) como clave del array
//que mostrará los resultados por nombre
while($datos = mysqli_fetch_array($consulta_resultados)) {

$id=$datos['idu'];
$nombre=$datos['nombre'];
$correo= $datos['correo'];
$tipo=$datos['tipo'];
$activo=$datos['activo'];
if($activo==0){

}
else{
echo"<tr>
  <td>
  $nombre
  </td>
<td>
$correo
 </td>
<td>
 $tipo </td>
<td>

<a href='detalle.php?id=$id'>VER</a></td>
<tr>";
}

}
?>

<hr><!----------------------------------------------->

| <?php
//Crea un bucle donde $i es igual 1, y hasta que $i sea menor o igual a X, a sumar (1, 2, 3, etc.)
//Nota: X = $total_paginas
for ($i=2; $i<=$total_paginas; $i++) {
	//En el bucle, muestra la paginación
	echo "<a href='?pagina=".$i."'>".$i."</a> | ";
};
 ?>

<hr><!----------------------------------------------->







	  </div>
	</div>
</div>
<!--============================================================================================-->
    </div>
</div>

<!-- jQuery -->
<script src="../js/funciones.js"></script>
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
