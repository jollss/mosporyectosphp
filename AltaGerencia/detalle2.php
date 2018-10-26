<!DOCTYPE html>
<?php
//error_reporting(0);
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
              INNER JOIN areas_fielder AS areas ON areas.idarea=equi.id_area WHERE  id_fielder='$idcontrase'";


              $result1 = $con->query($query2);
              // $total_num_rows = $result1->num_rows;
               //while($row = $result1->fetch_array())
            //  {
            //      print_r($row);
            //  }
              while($filas1 = $result1->fetch_assoc()) {
                $idarea=$filas1['idarea'];
                $nombrezona=$filas1['nom_area'];

              }

              $query = "select nombre from usuario where idu='$idcontrase'";
              $result = $con->query($query);

              while($filas = $result->fetch_assoc()) {
                $nombre=$filas['nombre'];




}
$resultados = mysqli_query($con,"SELECT COUNT(*) as total FROM
equipos_fielder AS eq
INNER JOIN usuario AS us
ON eq.id_fielder=us.idu
INNER JOIN areas_fielder AS areas
ON areas.idarea=eq.id_area
INNER JOIN tipo AS ti
ON ti.idtipo=us.tipo_idtipo
INNER JOIN venta AS v
ON v.idvendedor=eq.id_fielder

 WHERE id_fielder='$idcontrase' and id_area='$idarea'");
 $row = mysqli_fetch_array($resultados);
 $total = $row['total'];

if($total!=0){

              echo  "<h1 class='page-header'> Rendimiento del Lider  $nombre

               del Area $nombrezona";
echo "</h1>
            </div>
        </div>

        <a class='boton_personalizado' a href='javascript:window.history.go(-1);'>Regresar</a>

        <script type='text/javascript'>
           document.getElementById('btn-cancelar').onclick = function () {
           location.href = 'Reporteequipo.php?idarea=$idarea';
           };
        </script>
        <button type='button' class='btn btn-primary' id='btn-cancelar1'>Mas Especifico</button>


        <script type='text/javascript'>
           document.getElementById('btn-cancelar1').onclick = function () {
           location.href = 'Reporteequipo.php?id=$idcontrase&nombre=$nombre';
           };
        </script>
        <br>  <br>
        <h2>su venta total en el año es de $total hasta ahorita al mes actual sin contar los meses que faltan  </h2>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->";


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

                 WHERE id_fielder='$idcontrase'  AND v.mes='$i'

                ");
                $row = mysqli_fetch_array($result);
                $meses = $row['total'];

if($i==1){
if($meses==0){
  echo"

   {
        name: 'No cumplio Meta en Enero ',
        y: $meses,

    },
";
}
else{
            echo"

             {
                  name: 'Enero',
                  y: $meses,

              },
";
}
}

elseif($i==2){
if($meses==0){
  echo"

   {
        name: 'No cumplio Meta en Febrero ',
        y: $meses,

    },
";
}
else{
            echo"

             {
                  name: 'Febrero',
                  y: $meses,

              },
";
}
}
elseif($i==3)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Marzo ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Marzo',
                    y: $meses,

                },
  ";
  }
}
elseif($i==4)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Abril ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Abril',
                    y: $meses,

                },
  ";
  }
}
elseif($i==5)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Mayo ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Mayo',
                    y: $meses,

                },
  ";
  }
}
elseif($i==6)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Junio ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Junio',
                    y: $meses,

                },
  ";
  }
}
elseif($i==7)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Julio ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Julio',
                    y: $meses,

                },
  ";
  }
}
elseif($i==8)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Agosto ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Agosto',
                    y: $meses,

                },
  ";
  }
}
elseif($i==9)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Septiembre ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Septiembre',
                    y: $meses,

                },
  ";
  }
}
elseif($i==10)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Octubre ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Octubre',
                    y: $meses,

                },
  ";
  }
}
elseif($i==11)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Noviembre ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Noviembre',
                    y: $meses,

                },
  ";
  }
}
elseif($i==12)
{
  if($meses==0){
    echo"

     {
          name: 'No cumplio Meta en Diciembre ',
          y: $meses,

      },
  ";
  }
  else{
              echo"

               {
                    name: 'Diciembre',
                    y: $meses,

                },
  ";
  }

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

<!--============================================================================================-->";
}
else{
  echo  "<h1 class='page-header'>Por el momento el lider   $nombre No tiene Ninguna Venta Registrada, al generar una se mostrara en la grafica
<a href='javascript:window.history.go(-1);'>volver</a>
</h1>";
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
