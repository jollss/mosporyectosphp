<?php
include("../Config/library.php");
$cnx = Conectarse();
$con = Conectarse();
$con2 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
$name=$Yo->regresaNombre();
$ap=$Yo->regresaApaterno();
$am=$Yo->regresaAmaterno();
$tos=0;
$con->real_query("SELECT * FROM os inner join dataos where idmos=id_orden and estatus=0 and asignado='$idus'");
$resultado = $con->use_result();
while ($row = $resultado->fetch_assoc()){
    $tos=$tos+1;
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<?php
    nivel1($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="panel panel-info">

            <div class="panel-heading">Ordenes de Servicio Pendientes de <b>
              <?php echo $name." ".$ap." ".$am; ?><h3><?php echo $tos; ?></b></h3>
              tu menta mensual deberia de ser 48 ordenes de servicio
              de las cuales llevas <br>
              <progress max="48" value="1" ></progress>48
            </div>
<br>
            <div class="panel-body">
            <div align="center">
            </div>
            <h3>Fotos de Tu orden</h3>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th colspan="2">Accion</th>
                  <th>ID MOS</th>
                  <th>Cope</th>
                  <th>Teléfono</th>
                  <th>Fecha de Asignacion</th>
                  <th>Folio Pisaplex</th>
                  <th>Folio Pisa</th>
                  <th>Distrito</th>
                  <th>Zona</th>
                  <th>Tipo de Tarea</th>

                </tr>
<?php
$mes=date("d");
$sql11= "SELECT o.ddcarga,o.mmcarga,o.yearcarga,dat.foto,o.idmos,cope,expediente,folio_pisaplex,folio_pisa,telefono,distrito,zona,tipo_tarea
FROM os  AS o INNER JOIN dataos AS dat ON o.idmos=dat.id_orden
WHERE  O.ddcarga='$mes'   AND o.asignado='$idus' AND dat.estatus='0'";
    $result111 = $con->query($sql11);
while($fila1 = $result111->fetch_array())
{
    $fotoq = $fila1['foto'] ;
  $idmos=$fila1['idmos'];
    $cope=$fila1['cope'];
      $expediente=$fila1['expediente'];
        $folio_pisaplex=$fila1['folio_pisaplex'];
          $folio_pisa=$fila1['folio_pisa'];
            $telefono=$fila1['telefono'];
              $distrito=$fila1['distrito'];
                $ddcarga=$fila1['ddcarga'];
                $mmcarga=$fila1['mmcarga'];
                $yearcarga=$fila1['yearcarga'];
                $tipo_tarea=$fila1['tipo_tarea'];
                $zona=$fila1['zona'];
  if($fotoq=='SI'){
    echo "  <tr>
      <th colspan='2'><center>YA Tienen Fotos</center></th>
<th>$idmos</th>
<th>$cope</th>
<th>$telefono</th>
<th>$ddcarga/$mmcarga/$yearcarga</th>
<th>$folio_pisaplex</th>
<th>$folio_pisa</th>
<th>$distrito</th>
<th>$zona</th>
<th>$tipo_tarea</th>

       </tr> ";}

    else{


      $foto = $fila1['foto'] ;

      $idmos=$fila1['idmos'];
        $cope=$fila1['cope'];
          $expediente=$fila1['expediente'];
            $folio_pisaplex=$fila1['folio_pisaplex'];
              $folio_pisa=$fila1['folio_pisa'];
                $telefono=$fila1['telefono'];
                  $distrito=$fila1['distrito'];
                    $ddcarga=$fila1['ddcarga'];
                    $mmcarga=$fila1['mmcarga'];
                    $yearcarga=$fila1['yearcarga'];
                    $tipo_tarea=$fila1['tipo_tarea'];
  $zona=$fila1['zona'];



  echo"
          <tr>
          <th><center>

<a href='editarfotososliquidar.php?id=$idmos&tipo=liquidar'><i class='fas fa-check-circle fa-2x'></i></a></center><br></th>
            <th><center>  <a href='editarfotosos.php?id=$idmos&tipo=objetar'><i class='fas fa-minus-circle fa-2x'></i></a></center></th>
    <th>$idmos</th>
    <th>$cope</th>
    <th>$telefono</th>
    <th>$ddcarga/$mmcarga/$yearcarga</th>
    <th>$folio_pisaplex</th>
    <th>$folio_pisa</th>
    <th>$distrito</th>
    <th>$zona</th>
    <th>$tipo_tarea</th>

           </tr>    ";
           }
         }



?>
            </table>
          </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-12"></div>
<?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
