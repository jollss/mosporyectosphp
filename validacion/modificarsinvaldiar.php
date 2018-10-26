<?php
include("../config/conexion2.php");
$con = Conectarse();
$idventa=($_POST['idventa']);
$area=($_POST['area']);
$nombrev=($_POST['nombre']);
$apaternov=($_POST['apaternov']);
$amaternov=($_POST['amaternov']);
$direccion=($_POST['direccion']);
$terminal=($_POST['terminal']);
$distrito=($_POST['distrito']);
$datos=($_POST['datos']);
$telefono_1=($_POST['telefono_1']);
$telefono_2=($_POST['telefono_2']);
$telefono_3=($_POST['telefono_3']);
$documentacion=($_POST['documentacion']);
$dato_completo=($_POST['dato_completo']);
$venta_area=($_POST['venta_area']);
$cliente_contesto=($_POST['cliente_contesto']);
$distrito_asignado=($_POST['asigna']);
$coments_1=($_POST['coments_1']);
$promotor_informo=($_POST['promotor_informo']);
$coments_2=($_POST['coments_2']);
$folio_siac=($_POST['folio_siac']);
$valido_horas=($_POST['valido_horas']);
$detalles=($_POST['idventa']);
$tienda=($_POST['tienda']);
$tel_asignado=($_POST['tel_asignado']);
$folio_os=($_POST['folio_os']);
$etapa=($_POST['etapa']);
$listo_ps=($_POST['listo_ps']);
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora = date("g");
$min = date("i");
$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
$sql = "UPDATE venta SET nombrev='$nombrev' ,apaternov='$apaternov',amaternov='$amaternov', direccion='$direccion',datos='$datos',terminal='$terminal', AREA='$area',distrito='$distrito',documentacion='$documentacion', telefono_1='$telefono_1 ',telefono_2='$telefono_2 ',telefono_3='$telefono_3', dato_completo='$dato_completo',venta_area='$venta_area',distrito_asignado='$distrito_asignado',  coments_1='$coments_1',contesto='$cliente_contesto',promotor_informo='$promotor_informo',coments_2='$coments_2',valido_horas='$valido_horas',observaciones=' ', folio_siac='$folio_siac',fecha_siac='$fecha',tienda_comercial='$tienda', tel_asignado='$tel_asignado',folio_os='$folio_os',etapa='$etapa',listo_ps='$listo_ps' WHERE idventa='$idventa'";
$result = $con->query($sql);

echo "
 <script>
   alert('Modificacion correcta !');
    document.location=('buscarVentaporarea.php');
 </script>";
?>
