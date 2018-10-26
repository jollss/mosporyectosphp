<?php
include("../Config/library.php");

$main=$_POST['main'];
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora = date("g");
$min = date("i");
$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
$con = Conectarse();  
/*
function execute($query){
      
      return mysqli_query($con,$query);
}
*/
$sql="UPDATE venta SET 
nombrev='".$_POST['nombre']."' ,apaternov='".$_POST['apaterno']."',amaternov='".$_POST['amaterno']."',
direccion='".$_POST['dir']."',datos='".$_POST['datos']."',terminal='".$_POST['terminal']."',
area='".$_POST['area']."',distrito='".$_POST['distrito']."',documentacion='".$_POST['documentacion']."',
telefono_1='".$_POST['tel1']."',telefono_2='".$_POST['tel2']."',telefono_3='".$_POST['tel3']."',
dato_completo='".$_POST['dato_completo']."',venta_area='".$_POST['venta_area']."',distrito_asignado='".$_POST['distrito_asignado']."',
coments_1='".$_POST['coments_1']."',contesto='".$_POST['cliente_contesto']."',promotor_informo='".$_POST['promotor_informo']."',
coments_2='".$_POST['coments_2']."',valido_horas='".$_POST['valido_horas']."',observaciones='".$_POST['detalles']."',
folio_siac='".$_POST['siac']."',fecha_siac='".$fecha."',tienda_comercial='".$_POST['tienda']."',
tel_asignado='".$_POST['tel']."',folio_os='".$_POST['folio_o']."',etapa='".$_POST['estapa']."',listo_ps='".$_POST['ps']."'
WHERE idventa='".$_POST['idventa']."'";
//".$_POST['']."
var_dump($_POST);
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
//execute($sql) or die (mysqli_error($con));
echo "
<script>
  alert('REGISTRADO!');
  document.location=('../".$main."');
</script>";

?>