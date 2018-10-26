<?php
include("../Config/library.php");
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$id=$_POST['idventa'];

$folio_ventas=$_POST['folio_ventas'];
$nombre=strtoupper($_POST['nombre']);
$apaterno=strtoupper($_POST['apaterno']);
$amaterno=strtoupper($_POST['amaterno']);
$dir=strtoupper($_POST['dir']);
$datos=strtoupper($_POST['datos']);
$terminal=strtoupper($_POST['terminal']);
$documentacion=strtoupper($_POST['documentacion']);
$area=strtoupper($_POST['area']);
$distrito=strtoupper($_POST['distrito']);
$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$tel3=$_POST['tel3'];
$con = Conectarse();  
$venta=new Ventas();
$venta->modificarVenta($id,$folio_ventas,$nombre,$apaterno,$amaterno,$dir,$datos,$terminal,$tel1,$tel2,$tel3,$documentacion,$con);
$venta->cambiarArea($id,$area,$con);
$venta->cambiarDistrito($id,$distrito,$con);
 echo "
      <script>
          alert('REGISTRADO!');
          document.location=(' inde.php');
      </script>"; 
?>