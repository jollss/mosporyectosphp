<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');

$con = Conectarse(); 
$idU=$_POST['user'];
$idventa=$_POST['idventa'];
//echo $idU."-----------------".$idventa;
$asignar=new AsignacionBajante();
$id_asignacion=$asignar->obtenerId($con);
$asignar->ingresaAsignacion($id_asignacion,$idU,$idventa);
$asignar->verAsignacion();
$asignar->registroAsignacionBD($con);
  echo "
    <script>
        alert('MODIFICACION EXITOSA!');
        document.location=(' inde.php');
    </script>"; 
?>