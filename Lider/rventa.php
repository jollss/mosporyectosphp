<?php
include("../Config/library.php");
$con = Conectarse();  
$con2 = Conectarse();  
$con11 = Conectarse();  
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$sql11="SELECT * FROM usuario WHERE correo='$mail'";
$resultado11=$con11->query($sql11);
while($row11 = $resultado11->fetch_assoc())
{
  $iduser=$row11['idu'];
}
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
  $idventa='';
  $sql2="SELECT * FROM venta WHERE folio_ventas='$folio'";
  $resultado2=$con2->query($sql2);
  while($row2 = $resultado2->fetch_assoc())
  {
    $f=$row2['folio_ventas'];
  }
  if($f<>$folio){
      $sql1="SELECT * FROM venta order by idventa";
      $resultado=$con->query($sql1);
      while($row = $resultado->fetch_assoc())
      {
        $id=$row['idventa'];
      }
      $id=$id+1;
/* */
$conm= Conectarse();
 require "../Models/svasignaciones.php";
 $sumaventa= new svasignaciones();
 $sumaventa->revisa($iduser,$conm,$conm);
 /* */
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
          document.location=('vender.php'); 
      </script>"; 
  }if($f==$folio){
    echo "
    <script>
        alert('ERROR EN DATOS SOLICITUD EXISTENTES!');
        document.location=('vender.php'); 
    </script>"; 
  }
echo "EXITOSO";

}else{
  
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('vender.php'); 
  </script>"; 
  
  echo "NO EXITOSO";
}
?>