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
$correo=$_POST['correo'];
$paquete_venta=$_POST['paquete_venta'];
$con = Conectarse();  
/*
$venta=new Ventas();
$venta->modificarVenta($id,$folio_ventas,$nombre,$apaterno,$amaterno,$dir,$datos,$terminal,$tel1,$tel2,$tel3,$documentacion,$con);
$venta->modificarPaquete($paquete_venta,$con,$id);
$venta->cambiarArea($id,$area,$con);
$venta->cambiarDistrito($id,$distrito,$con);
*/
$sql="UPDATE venta SET 
  	paquete_venta='$paquete_venta',nombrev='$nombre',apaternov='$apaterno',amaternov='$amaterno',
  	direccion='$dir',datos='$datos',terminal='$terminal',documentacion='$documentacion',area='$area',
  	distrito='$distrito',telefono_1='$tel1',telefono_2='$tel2',telefono_3='$tel3',paquete_venta='$paquete_venta',
  	correo_cliente='$correo'
   	WHERE idventa='".$id."'";
if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

 echo "
      <script>
          alert('REGISTRADO!');
          document.location=(' inde.php');
      </script>"; 

?>