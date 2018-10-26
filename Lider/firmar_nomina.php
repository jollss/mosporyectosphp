<?php
include("../Config/library.php");
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
/*========================================*/
$sql="SELECT * FROM equipos_fielder where id_fielder='$iduser'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['id_area'];
}
if(!isset($areaLider)){
    $areaLider=0;
}
if(!isset($_GET['mesactual'])){
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mesactual=date('n');
    $aaaa=date('Y');
    $semana = date("W");
}if(isset($_GET['mesactual'])){
    $mesactual=$_GET['mesactual'];
}
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
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
<!--===========================================================================-->
<?php
$con13 = Conectarse(); 
$sql13="SELECT * FROM areas_fielder where nom_area<>''";
$resultado13=$con->query($sql13);
?>
<form action="firmar_nomina.php" method="GET">
  <input type="hidden" name="option" value="3">
  <input type="hidden" name="area" value="<?php echo $areaLider;?>">
  <div class="col-md-6">
  <label>Selecciona la fecha de pago</label>
    <table>
      <tr>
        <td>
          <input type="number" name="dia" min=1 max=31 placeholder="DIA" required>
        </td>
        <td>
          <input type="number" name="mes" min=1 max=12 placeholder="MES" required>
        </td>
        <td>
          <input type="number" name="year" min=2000 placeholder="AÑO" required>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary">VER</button>
  </div>
  
</form>
<?php
if(isset($_GET['area'])){
  $area=$_GET['area'];
  $fecha=$_GET['dia']."/".$_GET['mes']."/".$_GET['year'];
  $sql2="SELECT equipos_fielder.id_area,idarea,idu,id_fielder,nom_area,idventa,validar_venta.fecha_pago,xsol,xpos,xflotante,tipo_idtipo FROM usuario inner join equipos_fielder inner join areas_fielder inner join venta inner join validar_venta WHERE equipos_fielder.id_fielder=usuario.idu and equipos_fielder.id_area=idarea and activo=1 and idu=idvendedor and idventa=folio_solicitud and validar_venta.fecha_pago='".$fecha."'
    and equipos_fielder.id_area='".$area."'";
    //echo $sql2;
  $resultado2=$con->query($sql2);
  ?>
  <div class="panel-body col-md-12" style="height:500px;overflow-x:scroll;">
      <table class="table">
        <tr>
          <th></th>
          <th>Area</th>
          <th>Fecha de Pago</th>
          <th>xSolicitud</th>
          <th>xPosteo</th>
          <th>Flotantes</th>
        </tr>
          <input type="hidden" name="option" value="2">
          <input type="hidden" name="area" value="<?php echo $area;?>">
          <?php
          $index=0;
          while($row2 = $resultado2->fetch_assoc())
          {
            ?>
            <tr>
              <td><?php echo $index;?></td>
              <td><?php echo $row2['nom_area'];?></td>
              <td><?php echo $row2['tipo_idtipo'];?></td>
              <td><?php echo $row2['fecha_pago'];?></td>
              <td><?php echo $row2['xsol'];?></td>
              <td><?php echo $row2['xpos'];?></td>
              <td><?php echo $row2['xflotante'];?></td>
            </tr>
            <?php
            $index=$index+1;
          }
          ?>
      </table>
    </div>
    <div class="col-md-8" align="center">
    <label>El siguiente Archivo debe de ser impreso, llenado completamente y cargado en el apartado derecho.</label>
      <form action="../ventaNomina/nominaPDF.php" method="POST" target="_blank">
        <input type="hidden" value="<?php echo $_GET['area'];?>" name="area">
        <input type="hidden" value="<?php echo $fecha;?>" name="fecha">
        <button class="btn btn-primary">VER ARCHIVO</button>
      </form>
    </div>
    <div class="col-md-4">
        <form enctype="multipart/form-data" action="upNomina.php" method="POST">
          <input type="hidden" name="area" value="<?php echo $areaLider;?>">
          <input type="hidden" name="fecha" value="<?php echo $fecha;?>">
          <input name="userfile[]" type="file">
          <!--
          <button type="submit" class="btn btn-primary"><span>
                  <i class="glyphicon glyphicon-open bottom pulsating"></i>
              </span> CARGAR ARCHIVO
          </button>
          -->
          <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
        </form>
    </div>
  <?php
}
?>
<!--===========================================================================-->
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

</body>
</html>