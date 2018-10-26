<!DOCTYPE html>
<?php
error_reporting(0);
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
$idcontrase=($_GET['id']);
?>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


  <style type="text/css">
  .boton_personalizado{
    text-decoration: none;
    padding: 7px;
    font-weight: 500;
    font-size: 15px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }
</style>
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
    <script src="../code/highcharts.js"></script>
    <script src="../code/modules/exporting.js"></script>
    <script src="../code/modules/export-data.js"></script>
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
              <?php

              $query2 = "SELECT areas.idarea,areas.nom_area FROM equipos_fielder AS equi
              INNER JOIN areas_fielder AS areas ON areas.idarea=equi.id_area WHERE  id_fielder='$idcontrase' ";


              $result1 = $con->query($query2);
              // $total_num_rows = $result1->num_rows;
               //while($row = $result1->fetch_array())
            //  {
            //      print_r($row);
            //  }
              while($filas1 = $result1->fetch_assoc()) {
                $idarea=$filas1['idarea'];
                $nombrezona=$filas1['nom_area'];
                  $nom_area=$filas1['nom_area'];

              }

              $query = "select nombre from usuario where idu='$idcontrase'";
              $result = $con->query($query);

              while($filas = $result->fetch_assoc()) {
                $nombre=$filas['nombre'];
}

if($nombrezona=="" and $idarea==""){
  echo  "<h1 class='page-header'> $nombre No esta en alguna Zona y No Cuenta Con alguna asignacion de equipo ,
";
$resultes = mysqli_query($con,
"
SELECT COUNT(*) AS total FROM
     venta
       WHERE idvendedor='$idcontrase'
");
$row = mysqli_fetch_array($resultes);
$meses = $row['total'];
if($meses==0){
  echo "Ademas no tiene ventas, cuando tenga venta se reflejara y si esta en un equipo de igual manera
  <button type='button' class='btn btn-primary' id='btn-cancelar'>Regresar</button>
  <script type='text/javascript'>
     document.getElementById('btn-cancelar').onclick = function () {
     location.href = 'indexRe.php';
     };
  </script>
  ";
}
else{

echo"  pero no significa que no tenga ventas por el mismo</h1>";
  echo"<button class='btn btn-primary' onclick='verTotalindividualmentesinequipo()'>Ver Total por Año(Individual) </button>

<button type='button' class='btn btn-primary' id='btn-cancelar'>Mas Especifico</button>
<script type='text/javascript'>
   document.getElementById('btn-cancelar').onclick = function () {
   location.href = 'Reporteequipo.php?id=$idcontrase&nombre=$nombre';
   };
</script>
  ";
  echo "
  <div class='col-md-12'>
  	<div class='panel panel-default'>
  	  <div class='panel-heading'>
  	  </div>

  <div id='container' style='min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto'></div>

<script type='text/javascript'>
Highcharts.chart('container', {
chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
},
title: {
    text: 'Ventas de $nombre del 2018'
},
tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
},
plotOptions: {
    pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
            style: {
                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
            }
        }
    }
},
series: [{
    name: 'Mos Proyetos',
    colorByPoint: true,
    data: [";?>
    <?php
    for ($i = 1; $i < 13; $i++) {


      $result = mysqli_query($con,
      "
      SELECT COUNT(*) AS total FROM
           venta
             WHERE idvendedor='$idcontrase'  AND mes='$i'
      ");
      $row = mysqli_fetch_array($result);
      $meses = $row['total'];


if($i==1){
  echo"

   {
        name: 'Enero',
        y: $meses,

    },
";
}

elseif($i==2)
{
echo"

{
name: 'Febrero',
y: $meses,

},
";
}
elseif($i==3)
{
echo"

{
name: 'Marzo',
y: $meses,

},
";
}
elseif($i==4)
{
echo"

{
name: 'Abril',
y: $meses,

},
";
}
elseif($i==5)
{
echo"

{
name: 'Mayo',
y: $meses,

},
";
}
elseif($i==6)
{
echo"

{
name: 'Junio',
y: $meses,

},
";
}
elseif($i==7)
{
echo"

{
name: 'Julio',
y: $meses,

},
";
}
elseif($i==8)
{
echo"

{
name: 'Agosto',
y: $meses,

},
";
}
elseif($i==9)
{
echo"

{
name: 'Septiembre',
y: $meses,

},
";
}
elseif($i==10)
{
echo"

{
name: 'Octubre',
y: $meses,

},
";
}
elseif($i==11)
{
echo"

{
name: 'Noviembre',
y: $meses,

},
";
}
elseif($i==12)
{
echo"

{
name: 'Diciembre',
y: $meses,

},
";
}
else{
echo"no esta el mes";
}

}

echo"          ]

}]
});
</script>
</div></div></div>";
}
}
elseif($nombrezona!="" and $idarea!=""){



              echo  "<h1 class='page-header'> Rendimiento del Lider  $nombre

               del Area $nombrezona";
echo "</h1>
            </div>
        </div>
        <button class='btn btn-primary' onclick='verTotalaño()'>Ver Total por Año(Area) </button>
        <button class='btn btn-primary' onclick='vertotalindividual()'>Ver Total Individualmente en todo el año(Cada Integrante del equipo)</button>
        <button type='button' class='btn btn-primary' id='btn-cancelar1'>Mas Especifico(Area)</button>


        <script type='text/javascript'>
           document.getElementById('btn-cancelar1').onclick = function () {
           location.href = 'Reporteequipoarea.php?idarea=$idarea&nombre=$nom_area';
           };
        </script>
        <button type='button' class='btn btn-primary' id='btn-cancelar'>Regresar</button>
        <script type='text/javascript'>
           document.getElementById('btn-cancelar').onclick = function () {
           location.href = 'indexRe.php';
           };
        </script>


        <br>  <br>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->";


echo "<div id='verTotalaño'>
<div class='col-md-12'>
	<div class='panel panel-default'>
	  <div class='panel-heading'>
	  </div>

            <div id='container' style='min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto'></div>

      		<script type='text/javascript'>
      Highcharts.chart('container', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Ventas de $nombre del 2018'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  }
              }
          },
          series: [{
              name: 'Mos Proyetos',
              colorByPoint: true,
              data: [";?>
              <?php
              for ($i = 1; $i < 13; $i++) {


                $result = mysqli_query($con,
                "SELECT COUNT(*) as total FROM
                equipos_fielder AS eq
                INNER JOIN usuario AS us
                ON eq.id_fielder=us.idu
                INNER JOIN areas_fielder AS areas
                ON areas.idarea=eq.id_area
                INNER JOIN tipo AS ti
                ON ti.idtipo=us.tipo_idtipo
                INNER JOIN venta AS v
                ON v.idvendedor=eq.id_fielder

                 WHERE id_area='$idarea'  AND v.mes='$i'

                ");
                $row = mysqli_fetch_array($result);
                $meses = $row['total'];


if($i==1){
            echo"

             {
                  name: 'Enero',
                  y: $meses,

              },
";
}

elseif($i==2)
{
  echo"

   {
        name: 'Febrero',
        y: $meses,

    },
";
}
elseif($i==3)
{
  echo"

   {
        name: 'Marzo',
        y: $meses,

    },
";
}
elseif($i==4)
{
  echo"

   {
        name: 'Abril',
        y: $meses,

    },
";
}
elseif($i==5)
{
  echo"

   {
        name: 'Mayo',
        y: $meses,

    },
";
}
elseif($i==6)
{
  echo"

   {
        name: 'Junio',
        y: $meses,

    },
";
}
elseif($i==7)
{
  echo"

   {
        name: 'Julio',
        y: $meses,

    },
";
}
elseif($i==8)
{
  echo"

   {
        name: 'Agosto',
        y: $meses,

    },
";
}
elseif($i==9)
{
  echo"

   {
        name: 'Septiembre',
        y: $meses,

    },
";
}
elseif($i==10)
{
  echo"

   {
        name: 'Octubre',
        y: $meses,

    },
";
}
elseif($i==11)
{
  echo"

   {
        name: 'Noviembre',
        y: $meses,

    },
";
}
elseif($i==12)
{
  echo"

   {
        name: 'Diciembre',
        y: $meses,

    },
";
}
else{
  echo"no esta el mes";
}

}

  echo"          ]

          }]
      });
      		</script>
	</div>
</div>
</div>
<!--============================================================================================-->";
?>
<?php
echo"<div style='display:none;' id='vertotalindividual'>
<center><TABLE BORDER>
 <TR>
   <TH>Nombre</TH>
   <TH>Rol</TH>
   <TH>Area</TH>
   <TH>Ver</TH>
 </TR>
";
$sql345="
SELECT us.activo,us.idu,ti.tipo,areas.nom_area,us.nombre,eq.id_fielder,id_area FROM equipos_fielder AS eq
INNER JOIN usuario AS us
ON eq.id_fielder=us.idu
INNER JOIN areas_fielder AS areas
ON areas.idarea=eq.id_area
INNER JOIN tipo AS ti
ON ti.idtipo=us.tipo_idtipo
 WHERE id_area='$idarea' ORDER BY ti.tipo ASC  ";
 $result55 = $con->query($sql345);
 while($fila1 = $result55->fetch_array()){
   $nom_area = $fila1['nom_area'] ;
    $tipo = $fila1['tipo'] ;
     $nombre= $fila1['nombre'] ;
      $idfielder= $fila1['id_fielder'] ;
$activo= $fila1['activo'] ;
if( $activo==0){
}
else{
 echo"

	<TR>
		<TD>$nombre</TD>
	    	<TD>$tipo</TD>
	    	<TD>$nom_area</TD>
        	<TD>
        <a href='detalle2.php?id=$idfielder'>VER</a></TD>
	</TR>";

}

}
echo"</TABLE></center>
</div>";
}

?>
<!--============================================================================================-->
    </div>
</div>

<!-- jQuery -->
<script src="../js/funciones2.js"></script>
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
