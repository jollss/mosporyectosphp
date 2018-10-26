<?php
ob_start();
include("../Config/library.php"); 
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$mi=$_GET['mes'];
$yi=$_GET['anio'];
$fecha_pago=""."/".$mi."/".$yi;
var_dump($_GET);
//echo "DATOS DE ENTRADA=============================<BR>";
//echo "Tipo:".$tipo." DI".$di." MI".$mi." YI".$yi."  -df".$df." mf".$mf." yf".$yf."<br>";
//if($tipo==1){
$sql2n="SELECT * FROM os 
        inner join dataos inner join validar_os inner join material
        where idos=idmos and id_folio_pisa=folio_pisa and idmos=id_orden and estatus='2' and paqo='' and mmos='$mi' and yearos='$yi'";//" like '%$fecha_pago%'";/*mmos='$mes' and yearos='$aaaa' and estatus=2 */
    $like="/".$mi."/".$yi;
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    $nombre_archivo="../filtro/SIN PAQO MONTH ".$mi." YEAR ".$yi.".csv";
    if(file_exists($nombre_archivo)){
        //unlink($nombre_archivo);
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "FOLIO PISA,FECHA CARGA DE BOLSA,FECHA ASIGNACION,FECHA LIQUIDACION,TELEFONO,COPE,TIPO DE OS,AEREA/SUBTERRANEA,METRAJE,TIPO INSTALACION";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "FOLIO PISA,FECHA CARGA DE BOLSA,FECHA ASIGNACION,FECHA LIQUIDACION,TELEFONO,COPE,TIPO DE OS,AEREA/SUBTERRANEA,METRAJE,TIPO INSTALACION";
        fwrite($archivo,$mensaje. "\n");
    }
    /*$sql2="SELECT * FROM validar_os INNER JOIN os INNER JOIN dataos
    WHERE id_folio_pisa=folio_pisa AND idmos=id_orden AND id_folio_pisa<>0";*/
    /*$sql2n="SELECT * FROM validar_os WHERE
    id_folio_pisa<>0 AND a_cobro=1 AND fecha_cobranza LIKE '%".$like."%'";*/
    /*$sql2n="SELECT * FROM os inner join dataos inner join validar_os inner join material
            where id_folio_pisa=folio_pisa and idmos=id_orden and idos=idmos
            and estatus='2' and paqo='' and fecha_cobranza like '%$fecha_pago%' 
            ORDER BY folio_pisa";*/ 
    $resultado2n=$con->query($sql2n);
    var_dump($resultado2n);
    while($row = $resultado2n->fetch_assoc())
    {
        $foliopago=$row['id_folio_pisa'];
        $date=$row['fecha_cobranza'];
        /*
        $sql2="SELECT * FROM os INNER JOIN dataos 
        WHERE idmos=id_orden 
        AND folio_pisa='$foliopago'";
        $resultado2=$con->query($sql2);
        while($row = $resultado2->fetch_assoc())
        {
            */
            $cope=$row['cope'];
            $folio_pis=$row['folio_pisa'];
            $tel=$row['telefono'];
            $dos=$row['ddos'];
            $mos=$row['mmos'];
            $yos=$row['yearos'];
            $hos=$row['horaos'];
            $carga=$row['ddcarga']."/".$row['mmcarga']."/".$row['yearcarga'];
            $asignado=$row['ddasig']."/".$row['mmasig']."/".$row['yearasig'];
            $tipo_ins=$row['tipo_instalacion'];
            $metraje=$row['metraje'];
            $fecha_liquida=$dos."/".$mos."/".$yos." ".$hos;
            $tipo_tarea=$row['tipo_tarea'];    
            $instalacion=$row['tipo_os']; 
            //if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
            $idmos=$row['idmos'];
        //}
        $mensaje = $folio_pis.",".$carga.",".$asignado.",".$fecha_liquida.",".$tel.",".$cope.",".$tipo_tarea.",".$tipo_ins.",".$metraje.",".$instalacion;//.",".$tipo_tarea.",".$tipo_tarea.",".$zona.",".$nomtec.",".$nomsuper;
        echo $mensaje."<br>";
        $archivo = fopen($nombre_archivo, "a");
        fwrite($archivo,$mensaje. "\n");
        
    }
    fclose($archivo);
    //echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
//}

header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>