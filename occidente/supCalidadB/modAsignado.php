<?php
ob_start();
include("../Config/library.php");
$idu=$_POST['idu'];
$con = Conectarse();  
$cambio=new Usuario();
$cambio->cambiarAsignado($idu,$con);
echo  "
<script>
    alert('Cambio Exitoso.');
    document.location=('asigna.php');
</script>";
ob_end_flush();
?>