<?php
include("../Config/library.php");
$con = Conectarse();  
$tienda_comercial=$_POST['tienda'];
$idT=$_POST['id'];
$tel_asignado=$_POST['tel'];
$folio_os=$_POST['folio_o'];
$etapa=$_POST['estapa'];
$ps=$_POST['ps'];

$tienda=new TiendaComercial();
$id_tienda=$tienda->obtenerIdTienda($con);
$tienda->modComercio($tienda_comercial,$tel_asignado,$folio_os,$etapa,$ps,
		$idT,$con);
//$tienda->verTienda();

/*$tienda->registrarTiendaBD($con);
*/

echo "
<script>
  alert('REGISTRADO!');
  document.location=('listadoVentas.php');
</script>";

?>