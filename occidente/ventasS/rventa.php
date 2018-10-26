<?php
include("../Config/library.php");
$con = Conectarse();  
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$estatus=0;
$name=strtoupper($_POST['name']);
$ap =strtoupper($_POST['ap']);
$am =strtoupper($_POST['am']);
$terminal =strtoupper($_POST['terminal']);
//$documentacion =strtoupper($_POST['documentacion']);
//$name=$name." ".$ap." ".$am;
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$tel3 =$_POST['tel3'];
$mail =$_POST['mail'];

$latitud =$_POST['latitud'];
$longitud =$_POST['longitud'];
$documentacion ="SI";
$tipo_cliente =strtoupper($_POST['tipo_cliente']);
$folio =strtoupper($_POST['folio']);
$paquete_venta=$_POST['paquete_venta'];
$dir=strtoupper($_POST['dir']);
$rfc=strtoupper($_POST['rfc']);
$datos=strtoupper($_POST['detalles']);
$area=strtoupper($_POST['area']);
$distrito=strtoupper($_POST['distrito']);
if(isset($name) && isset($ap)&& isset($am)&& isset($tel1)&& isset($dir)
  && isset($tel2)&& isset($folio)&& isset($tel3))
{

  date_default_timezone_set('America/Mexico_City');
  $dia=date('j');
  $mes=date('n');
  $aaaa=date('Y');
  $hora=date('G');
  $min=date('i');
  $time=$hora.":".$min;
  $id=0;
  $sql1="SELECT * FROM venta order by idventa";
  $resultado=$con->query($sql1);
  while($row = $resultado->fetch_assoc())
  {
    $id=$row['idventa'];
  }
  $id=$id+1;

$sql="INSERT INTO venta
(idventa, folio_ventas, idvendedor, 
  nombrev, apaternov, amaternov, 
  direccion, datos, terminal, 

  telefono_1, telefono_2, telefono_3,
  dia, mes, year, hora, 
  estatus, vendedor, documentacion, 

  area, distrito, rfc_cliente, 
  correo_cliente, tipo_cliente, paquete_venta, 
  longitud, latitud, contesto, 

  id_user, fecha_fielder, cliente,
   atiende, servicio, paquete, 
   direccion_v, colonia, municipio, 

   cp, gastos_instalacion, tiempo_instalacion, 
   observaciones, folio_siac, fecha_siac, 
   tienda_comercial, tel_asignado, folio_os,

   etapa, listo_ps, fecha_comercial) 
VALUES 
  ('".$id."','".$folio."','".$iduser."',
    '".$name."','".$ap."','".$am."',
    '".$dir."','".$datos."','".$terminal."',

    '".$tel1."','".$tel2."','".$tel3."',
    '".$dia."','".$mes."','".$aaaa."','".$time."',
    '".$estatus."','','".$documentacion."',

    '".$area."','".$distrito."','".$rfc."',
    '".$mail."','".$tipo_cliente."','".$paquete_venta."',
    '".$longitud."','".$latitud."','',

    '','','',
    '','','',
    '','','',

    '','','',
    '','','',
    '','','',

    '','','')
";
  if ($con->query($sql) === TRUE) { echo "Nueva venta registrada correctamente<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

echo "
<script>
    alert('REGISTRO EXITOSO!');
    document.location=('inde.php'); 
</script>"; 

echo "EXITOSO";

}else{
  
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php'); 
  </script>"; 
  
  echo "NO EXITOSO";
}
?>