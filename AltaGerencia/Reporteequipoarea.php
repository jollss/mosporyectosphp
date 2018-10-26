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
$idarea=($_GET['idarea']);
$nombre=($_GET['nombre']);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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


    <br><br>
      <a class='boton_personalizado' a href='javascript:window.history.go(-1);'>Regresar</a><br>
      <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      				<h4 class="modal-title" id="myModalLabel">¿Que Es Esta Tabla?</h4>
      			</div>
      			<div class="modal-body">
                  Brevemente se explicara la Busqueda Avanzada:<br>
              <p style='color:#FF0000';>Busqueda:</p>
              Si solo Das buscar te traera los datos de toda esa area,pero puedes hacer mas expecifico dicha consulta,
              filtrar por el folio de la venta,dia y mes."Cada Que quiereas realizar una nueva busqueda da en la opcion de Regresar"
            	</div>
      		</div>
      	</div>
      </div>
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal">
      ¿Que Es Esta Tabla?-Ayuda
      </button>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">


            <h1 class='page-header'> <?php isset($_GET["nombre"]) ? print $_GET["nombre"] : ""; ?> Busca Por  Folio de la Venta,Dia y Mes </h1>

            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
<div class="col-md-12">
	<div class="panel panel-default">

	  <div class="panel-body" align="center">

      <style>
      table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
      }

      td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
      }

      tr:nth-child(even) {
          background-color: #dddddd;
      }
      </style>



        	  <div class="panel-body" align="center">
              <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input id="buscari" name="idarea" type="search" value="<?php echo $idarea?>" hidden >
                <input id="buscari" name="nombre" type="search" value="<?php echo $nombre?>"  hidden>
                  <input id="buscarf" name="folio" type="search" placeholder="Ingresa un Folio..."  >
                  <input id="buscarm" name="mes" type="search" placeholder="Ingresa un Mes..."  >
                  <input id="buscard" name="usuario" type="search" placeholder="Ingresa un nombre..."  >
                  <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
              </form>

        	  </div>
            <table>
              <tr>
                  <th>Folio de la Venta</th>
                <th>Etapa</th>
                  <th>folio OS</th>
  <th>Fecha  </th>
  <th>Cliente </th>
  <th>Vendedor </th>
              </tr>
            <?php
            $texto = '';
            //Variable que contendrá el número de resgistros encontrados
            $registros = '';
            if($_POST){



    $entero = 0;

    if (empty($busqueda)){
  	  $texto = 'Búsqueda sin resultados';
          $idarea=($_POST['idarea']);
           $mes = trim($_POST['mes']);
           $usuario = trim($_POST['usuario']);
              $folio = trim($_POST['folio']);
         }

         $resultados = mysqli_query($con,"  select count(*) as total  FROM
       equipos_fielder AS eq
       INNER JOIN usuario AS us
       ON eq.id_fielder=us.idu
       INNER JOIN areas_fielder AS areas
       ON areas.idarea=eq.id_area
       INNER JOIN tipo AS ti
       ON ti.idtipo=us.tipo_idtipo
       INNER JOIN venta AS v
       ON v.idvendedor=eq.id_fielder

        WHERE  id_area='$idarea' AND v.mes like'%$mes%' AND us.nombre LIKE'%$usuario%' AND v.folio_ventas LIKE '%$folio%'");
          $row = mysqli_fetch_array($resultados);
          $total = $row['total'];
         /////////////////////////
  $sql = "  SELECT us.nombre,v.mes,us.nombre,folio_ventas,etapa,folio_os,CONCAT(dia,'/',mes,'/',YEAR) AS fecha ,
  CONCAT(nombrev,'',apaternov,'',amaternov) AS cliente FROM
equipos_fielder AS eq
INNER JOIN usuario AS us
ON eq.id_fielder=us.idu
INNER JOIN areas_fielder AS areas
ON areas.idarea=eq.id_area
INNER JOIN tipo AS ti
ON ti.idtipo=us.tipo_idtipo
INNER JOIN venta AS v
ON v.idvendedor=eq.id_fielder

 WHERE  id_area='$idarea' AND v.mes like'%$mes%' AND us.nombre LIKE'%$usuario%' AND v.folio_ventas LIKE '%$folio%'";
  $result1 = $con->query($sql);
               //$total_num_rows = $result1->num_rows;
                while($fila = $result1->fetch_array())
              {
                $folio_ventas = $fila['folio_ventas'] ;
                $etapa = $fila['etapa'] ;
                  $folio_os = $fila['folio_os'] ;
                $fecha = $fila['fecha'] ;
                $cliente= $fila['cliente'] ;
    $vendedor= $fila['nombre'] ;


                echo"


                  <tr>
                      <td>$folio_ventas</td>
                    <td>$etapa</td>
  <td>$folio_os</td>
    <td>fecha:$fecha</td>
    <td>$cliente</td>
    <td>$vendedor</td>

                  </tr>



                ";

              //  echo $texto;
                //  print_r($row);
           }
           echo"<a href='excel.php?idarea=$idarea&folio=$folio&usuario=$usuario&mes=$mes'> Haz clic para descargar el reporte</a>";
           if (mysqli_num_rows($result1) > 0){
             // Se recoge el número de resultados
         $registros = mysqli_num_rows($result1);
             // Se almacenan las cadenas de resultado
             while($fila = $result1->fetch_array())
           {

        }

          }else{
               $texto = "NO HAY RESULTADOS EN LA BBDD";
          }
               //while($filas1 = $result1->fetch_assoc()) {
                 //$nombre=$filas1['nombre'];
                 //$apaterno=$filas1['apaterno'];
                  // $amaterno=$filas1['amaterno'];
               //   print_r($filas1);
              // }
                 // $resultado = mysql_query($sql); //Ejecución de la consulta
                     //Si hay resultados...

                  // $registros = '<p>HEMOS ENCONTRADO ' . mysql_num_rows($resultado) . ' registros </p>';
                     // Se almacenan las cadenas de resultado
                  // while($fila = mysql_fetch_assoc($resultado)){
                    //         $texto .= $fila['provincia'] . '<br />';
                     //}
                   }
                     ?>  </table>




<?php echo"el total de los registros es de :$total"; ?>



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
