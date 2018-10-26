<?php
include("../Config/library.php");
$con = Conectarse();  
$tienda_comercial=$_POST['tienda'];
$id_venta=$_POST['id'];
$tel_asignado=$_POST['tel'];
$folio_os=$_POST['folio_o'];
$etapa=$_POST['estapa'];
$ps=$_POST['ps'];

$tienda=new TiendaComercial();
$id_tienda=$tienda->obtenerIdTienda($con);
$tienda->ingresaTiendaComercial($id_tienda,$tienda_comercial,$tel_asignado,$folio_os,$etapa,$ps,$id_venta);
$tienda->registrarTiendaBD($con);

echo "
<script>
  alert('REGISTRADO!');
  document.location=('listadoVentas.php');
</script>";
?>