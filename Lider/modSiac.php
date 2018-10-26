<?php
include("../Config/library.php");
$con = Conectarse();  
$siac=$_POST['siac'];
$id=$_POST['id'];
$filder=new Foliosiac();
$id_siac=$filder->obtenerIdSiac($con);
$filder->ingresarFolioSiac($id_siac,$siac,$id);
$filder->registrarFolioSiacBD($con);
//$filder->ingresaFolioSiac($id,$siac,$con);
echo "id registro:".$id_siac." folio siac:".$siac." ID de filder:".$id;
echo "
<script>
  alert('SIAC REGISTRADO!');
  document.location=('listadoVentas.php');
</script>";

?>