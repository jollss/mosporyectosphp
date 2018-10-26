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
$idmos=($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">

        	<link href="css/style.css" rel='stylesheet' type='text/css' />
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

            <div class="panel-heading">


              <h3>Hola   <?php echo $name." ".$ap." ".$am; ?> Estas Apunto de Objetar la Orden</h3>
            </div>
<br>
            <div class="panel-body">
            <div align="center">
            </div>
            <div class="table-responsive">
<!-- --------------------------------------------------------primer div de detalle del servicio------------------------------------------------------------- -->
<?php
$sql12= "SELECT o.cliente,o.folio_pisaplex,folio_pisa,o.telefono,
o.distrito,o.zona,o.idmos,o.expediente,o.cope,
o.tipo_tarea,o.dilacion,o.dilacion_etapa,d.tipo_os,
o.ddcarga,o.mmcarga,o.yearcarga
FROM os AS o INNER JOIN dataos AS d
ON d.id_orden=o.idmos
WHERE id_orden='$idmos'";
$result123 = $con->query($sql12);
while($fila1 = $result123->fetch_array())
{
$ddcarga = $fila1['ddcarga'];
$mmcarga = $fila1['mmcarga'];
$yearcarga = $fila1['yearcarga'];
$cliente = $fila1['cliente'];
$foliopisaplex = $fila1['folio_pisaplex'];
$foliopisa = $fila1['folio_pisa'];
$telefono = $fila1['telefono'];
$distrito = $fila1['distrito'];
$zona = $fila1['zona'];
$idmos = $fila1['idmos'];
$expediente = $fila1['expediente'];
$cope = $fila1['cope'];
$tipotarea = $fila1['tipo_tarea'];
$dilacion = $fila1['dilacion'];
$dilacionetapa = $fila1['dilacion_etapa'];
$tipoos = $fila1['tipo_os'];
echo"
              <div class='price-grid'>
               <div class='price-block agile'>
                 <div class='price-gd-top pric-clr1'>
                   <i class='fab fa-accusoft'></i>
                   <h4>Datos del Cliente</h4>
                   <p>Nombre:$cliente</p>
              <p>Folio Pisaplex:$foliopisaplex</p>
              <p>Folio Pisa:$foliopisa</p>
              <p>Teléfono:$telefono</p>
              <p>Distrito:$distrito</p>
              <p>Zona:$zona</p>
              <p>Fecha Asignada:$ddcarga/$mmcarga/$yearcarga</p>
                 </div>
                 <div class='price-gd-bottom'>
                 </div>
               </div>
             </div>
 <!-- --------------------------------------------------------segundo div de datos del Cliente------------------------------------------------------------- -->
 <div class='price-grid'>
  <div class='price-block agile'>
    <div class='price-gd-top pric-clr1'>
      <i class='fab fa-accusoft'></i>
      <h4> Orden Servicio</h4>
      <p>Folio MOS:$idmos</p>
      <p>Expediente:$expediente</p>
      <p>Tipo de Tarea:$tipotarea</p>
      <p>Tipo de Orden:$tipoos</p>
      <p>Dilacion:$dilacion</p>
      <p>D. ETAPA:$dilacionetapa</p>
      <p>Cope:$cope</p>
    </div>
    <div class='price-gd-bottom'>
    </div>
  </div>
 </div>
 <!-- --------------------------------------------------------tercer div imagenes ------------------------------------------------------------- -->
";
}
?>
           <div class="price-grid">
            <div class="price-block agile">
              <div class="price-gd-top pric-clr1">
                <i class="fab fa-accusoft"></i>
                 <h4>Subir Imagenes</h4>
                <form action="guardarimagen.php" method="post" enctype="multipart/form-data">

<?php

$result = mysqli_query($con, "SELECT COUNT(*) as total FROM adjunto_os WHERE os_idos='$idmos'");
$row = mysqli_fetch_array($result);
$count = $row['total'];
if($count=='0'){
  echo"
  <p> <input type='file' name='archivo[]' multiple='multiple' accept='image/*' id='capture' capture='camera' ><br></p>

  <p> <input type='file' name='archivo[]' multiple='multiple' accept='image/*' id='capture' capture='camera' ><br></p>
                          <input type='hidden' name='id' value=' $idmos '>


                                                  <label>SELECCIONA ALGUNA RAZON:</label>
                                                      <select name='detalles'  class='form-control' required>
                                                          <!--<option value='OTRA RAZON (VERIFICAR CON TECNICO)'>OTRA</option>-->
                                                          <option value='NO HAY RED DE FIBRA'>NO HAY RED DE FIBRA</option>
                                                          <option value='TERMINAL SATURADA'>TERMINAL SATURADA</option>
                                                          <option value='TERMINAL SIN POTENCIA'>TERMINAL SIN POTENCIA</option>
                                                          <option value='TERMINAL NO DADA DE ALTA'>TERMINAL NO DADA DE ALTA</option>
                                                          <option value='TERMINAL CON DAÑO FISICO'>TERMINAL CON DAÑO FISICO</option>
                                                          <option value='TERMINAL MAL ROTULADA'>TERMINAL MAL ROTULADA</option>
                                                          <option value='TERMINAL CRUZADA'>TERMINAL CRUZADA</option>
                                                          <option value='TUBERIA SATURADA INTERNA O INEXISTENTE (DENTRO DOMICILIO)'>TUBERIA SATURADA INTERNA O INEXISTENTE (DENTRO DOMICILIO)</option>
                                                          <option value='TUBERIA SATURADA INTERNA (VERTICALES)'>TUBERIA SATURADA INTERNA (VERTICALES)</option>
                                                          <option value='TUBERIA SATURADA EXTERNA (RADIAL)'>TUBERIA SATURADA EXTERNA (RADIAL)</option>
                                                          <option value='POZO INUNDADO'>POZO INUNDADO</option>
                                                          <option value='POZO SELLADO'>POZO SELLADO</option>
                                                          <option value='CLIENTE CON ADEUDO MAYOR A 3 MESES'>CLIENTE CON ADEUDO MAYOR A 3 MESES</option>
                                                          <option value='PERMISO PATRIMONIAL'>PERMISO PATRIMONIAL</option>
                                                          <option value='RE-AGENDA'>RE-AGENDA</option>
                                                          <option value='CAMBIO DE DOMICILIO'>CAMBIO DE DOMICILIO</option>
                                                          <option value='CLIENTE NO DIO ACCESO'>CLIENTE NO DIO ACCESO</option>
                                                          <option value='CLIENTE REQUIERE A SU PERSONAL DE SISTEMAS'>CLIENTE REQUIERE A SU PERSONAL DE SISTEMAS</option>
                                                          <option value='CLIENTE NO SE LOCALIZA'>CLIENTE NO SE LOCALIZA</option>
                                                          <option value='SOLO PERSONAL TELMEX'>SOLO PERSONAL TELMEX</option>
                                                          <option value='PERMISO REQUERDIO'>PERMISO REQUERDIO</option>
                                                          <option value='NO LE INTERESA'>NO LE INTERESA</option>
                                                          <option value='YA CUENTA CON EL SERVICIO'>YA CUENTA CON EL SERVICIO</option>
                                                          <option value='NO UTILIZA EL INTERNET/DESCONOCE SU CONTRATACION'>NO UTILIZA EL INTERNET/DESCONOCE SU CONTRATACION</option>
                                                          <option value='NO ACEPTA INSTALACION POR MALA EXPERIENCIA ANTERIOR/ DESCONFIANZA'>NO ACEPTA INSTALACION POR MALA EXPERIENCIA ANTERIOR/ DESCONFIANZA</option>
                                                          <option value='LINEA SIN INTERNET'>LINEA SIN INTERNET</option>
                                                          <option value='LINEA DADA DE BAJA'>LINEA DADA DE BAJA</option>
                                                      </select>

                          ";
}
elseif($count=='1')
{
  $mes=date("m");
  $año=date("y");
  $sql55= "SELECT * FROM adjunto_os WHERE os_idos='$idmos'";
  $result55 = $con->query($sql55);
  while($fila1 = $result55->fetch_array()){
    $foto = $fila1['nombreimg'] ;

//echo $foto;
  echo"
  <a target='_blank' href='../os/$idus$mes$año/$foto'>
  <img src='../os/$idus$mes$año/$foto' border='1'  width='50' height='50'><br>
</a>
ya se subio esta foto solo sube una foto  mas
  <p> <input type='file' name='archivo[]' multiple='multiple' accept='image/*' id='capture' capture='camera' required><br></p>
                          <input type='hidden' name='id' value=' $idmos '>";}
}else{
echo"ya tienes fotos registradas pide ayuda al Area de Sistemas para checar este error";
                      }
                        ?>
  <!-- --------------------------------------------------------Select  ------------------------------------------------------------- -->


                            <br>
                    <input type="submit" value="Enviar"  class="trig">
                </form>
              </div>
              <div class="price-gd-bottom">
              </div>
            </div>
          </div>
  <!-- --------------------------------------------------------Fin de los divs------------------------------------------------------------- -->

             <div class="clear"></div>
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
