<?php
include("../Config/library.php");
//include("../Models/areas_fielder.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse();
$con = Conectarse();
$con2 = Conectarse();
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
$id=($_GET['id']);
$foli_venta=($_GET['foli_venta']);

/*========================================*/
/*========================================*/
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    nivel4($user);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
  <br><br>
  <br><br>
  <!-- Page Content -->
  <div id="page-wrapper">
    <style>
input[type=submit] {
    width: 50%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=submit]:hover {
    background-color: #45a049;
}
</style>
<center><h3>Detalle sobre la Informacion de la Venta Sin validar</h3></center>
<div class="col-md-12">
        <div class="panel panel-info">
      <?php
$sql = "SELECT  nombrev,apaternov,amaternov,direccion,datos,terminal,telefono_1,telefono_2,telefono_3,dia,mes,YEAR,hora,documentacion,AREA,distrito  FROM venta WHERE idventa='$id'";

      $result1 = $con->query($sql);
      //$total_num_rows = $result1->num_rows;
       while($fila = $result1->fetch_array())
     {
      $nombrev=$fila['nombrev'];
      $amaternov=$fila['amaternov'];
      $apaternov=$fila['apaternov'];
      $direccion=$fila['direccion'];
      $datos=$fila['datos'];
      $terminal=$fila['terminal'];
      $dia=$fila['dia'];
      $mes=$fila['mes'];
      $telefono_2=$fila['telefono_2'];
      $year=$fila['YEAR'];
      $hora=$fila['hora'];
      $documentacion=$fila['documentacion'];
      $area=$fila['AREA'];
      $distrito=$fila['distrito'];
$telefono_1=$fila['telefono_1'];
$telefono_3=$fila['telefono_3'];

  echo"<form action='modificarsinvaldiar.php' method='POST'>
  <table>
    <tbody>
      <tr>
        <th><span class='input-group-addon' id='sizing-addon3'>Fecha de la Venta:</span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Fecha Ultima Actualizacion:</span></th>

              <th><span class='input-group-addon' id='sizing-addon3'>No. de Solicitud:: </span></th>
              <th><span class='input-group-addon' id='sizing-addon3'>Area </span></th>
              <th></th>
              <th></th>
              <th></th>
        <th></th>
      </tr>
      <tr>
        <td>
        <input type='hidden' class='form-control' aria-describedby='sizing-addon4'  name='idventa'  value='$id'   >
              <input class='form-control' aria-describedby='sizing-addon4'  name='fechas'  placeholder='$dia-$mes-$year  $hora' disabled >
          </td>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='fecha_actualizacion'  value='Sin Fecha' disabled></td>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='folio_o'  value='$foli_venta' disabled></td>
<td><input class='form-control' aria-describedby='sizing-addon4'  name='area'  value='$area' ></td>
      </tr>
    </tbody>
</table><br>
<table>
    <tbody>
      <tr>
        <th><span class='input-group-addon' id='sizing-addon3'>Nombre: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Apellido Paterno: </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Apellido Materno </span></th>

      </tr>
      <tr>
        <td>
              <input class='form-control' aria-describedby='sizing-addon4'  name='nombre'  value='$nombrev' >
          </td>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='apaternov'  value='$apaternov' ></td>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='amaternov'  value='$amaternov' ></td>

      </tr>
    </tbody>
</table><br>
<table>
      <tbody>
    <tr>
      <th><span class='input-group-addon' id='sizing-addon3'>Direccion: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Terminal: </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Distrito: </span></th>
<th><span class='input-group-addon' id='sizing-addon3'>Detalles: </span></th>
            <th></th>
            <th></th>
            <th></th>
      <th></th>
    </tr>
    <tr>
      <td>
            <input class='form-control' aria-describedby='sizing-addon4'  name='direccion'  value='$direccion' >
        </td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='terminal'  value='$terminal' ></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='distrito'  value='$distrito' ></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='datos'  value='$datos' ></td>
    </tr>
  </tbody>
  </table><br>
  <table>
    <tbody>
      <tr>
      <th><span class='input-group-addon' id='sizing-addon3'>Telefono 1: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Telefono 2: </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Telefono 3: </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Tiene la  Documentacion : $documentacion</span></th>
      </tr>
      <tr>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='telefono_1'  value='$telefono_1' ></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='telefono_2'  value='$telefono_2' ></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='telefono_3'  value='$telefono_3' ></td>



<td><select class='form-control' id='sel1' name='documentacion'>
          <option value='NO'>NO</option>
          <option value='SI' selected='selected'>SI</option>
          </select></td>


      </tr>
    </tbody>
    </table><br>
    <table>
    <tbody>
      <tr>
      <th><span class='input-group-addon' id='sizing-addon3'>tiene los Datos Completos: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Es una Venta de Área: </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>El Cliente contesto la Encuesta: </span></th>
      </tr>
      <tr>
      <td><select class='form-control' id='sel1' name='dato_completo'>
          <option value='0' selected='selected'>NO</option>
          <option value='1'>SI</option>
      </select></td>
      <td><select class='form-control' id='sel1' name='venta_area'>
          <option value='0' selected='selected'>NO</option>
          <option value='1'>SI</option>
      </select></td>
      <td><select class='form-control' id='sel1' name='cliente_contesto'>
          <option value='0' selected='selected'>NO</option>
          <option value='1'>SI</option>
      </select></td>
      </tr>
    </tbody>
    </table><br>
<table>
    <tbody>
      <tr>
      <th><span class='input-group-addon' id='sizing-addon3'>Venta DISTRITO Asignado: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Comentarios </span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Promotor informo detalles:</span></th>
          <th><span class='input-group-addon' id='sizing-addon3'>Comentarios:</span></th>
      </tr>
      <tr>
        <td>
        <select class='form-control'  name='asigna'>
            <option value='0' selected='selected'>NO</option>
            <option value='1'>SI</option>
        </select>
        </td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='coments_1'></td>
      <td><select class='form-control' id='sel1' name='promotor_informo'>
          <option value='0' selected='selected'>NO</option>
          <option value='1'>SI</option>
      </select></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='coments_2'   ></td>
      </tr>
    </tbody>
    </table><br>
<table>
    <tbody>
      <tr>
          <th><span class='input-group-addon' id='sizing-addon3'>Folio Siac: </span></th>
      <th><span class='input-group-addon' id='sizing-addon3'>Valido dentro de las 24 hrs : </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Comentarios </span></th>
  <th><span class='input-group-addon' id='sizing-addon3'>Tienda Comercial:</span></th>

      </tr>
      <tr>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='folio_siac'></td>
        <td><select class='form-control' id='sel1' name='valido_horas'>
            <option value='0' selected='selected'>NO</option>
            <option value='1'>SI</option>
        </select></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='detalles'  ></td>
    <td><input class='form-control' aria-describedby='sizing-addon4'  name='tienda'  ></td>

      </tr>
    </tbody>
</table><br>
<table>
    <tbody>
      <tr>
          <th><span class='input-group-addon' id='sizing-addon3'>Teléfono: </span></th>
      <th><span class='input-group-addon' id='sizing-addon3'>Folio Orden de Servicio: </span></th>
        <th><span class='input-group-addon' id='sizing-addon3'>Etapa en la que se encuntra: </span></th>
  <th><span class='input-group-addon' id='sizing-addon3'>Listo para Instalar (PS):</span></th>

      </tr>
      <tr>
        <td><input class='form-control' aria-describedby='sizing-addon4'  name='tel_asignado' ></td>
          <td><input class='form-control' aria-describedby='sizing-addon4'  name='folio_os' ></td>
        <td><select class='form-control' id='sel1' name='etapa'>
        <option value=''>-Seleccionar etapa-</option>
          <option value='ABIERTA'>I ... ABIERTA</option>
          <option value='P'>P ... POSTEADO</option>
          <option value='CANCELADA'>X... CANCELADO</option>
          <option value='COMERCIAL'>C... COMERCIAL </option>
          <option value='ADEUDO'>CC... ADEUDO </option>
          <option value='DEMANDA/INFRAESTRUCTURA'>ID... DEMANDA/INFRAESTRUCTURA</option>
          <option value='SOLICITUD DUPLICADA'>SOLICITUD DUPLICADA </option>
          <option value='0'>NINGUNO</option>
            <option value='3'>NO ENCONTRADA</option>
            <option value='4'>SIN ESTRATEGIA</option>
        </select></td>
      <td><input class='form-control' aria-describedby='sizing-addon4'  name='listo_ps'></td>

      </tr>
    </tbody>
  </table>
<center>
  <input type='submit' class='btn btn-primary' value='Enviar'></center>
</form>";
}
?>
<center><h3>Galeria</h3></center>

<?php
$query2 = "SELECT imagen_n FROM adjunto_venta WHERE folio_venta='$foli_venta'";

$result1 = $con->query($query2);
// $total_num_rows = $result1->num_rows;
 while($row = $result1->fetch_array())
 {
       $imagen_n=$row['imagen_n'];
      //print_r($row);
      //echo $imagen_n;

echo"<a target='_blank' href='../www.mosproyectos.com.mx/adjVentas/$imagen_n'>
    <img src='../www.mosproyectos.com.mx/adjVentas/$imagen_n'  width='149' height='300'>
  </a>";
}
?>

</div></div>

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
