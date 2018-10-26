<?php
include("../Config/library.php"); 
include("library2.php");
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
$con = Conectarse();  
$mail = 'mariana.gonzalez@mosproyectos.com.mx';
$user = 'Mariana';
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();
$di='26';
$mi='9';
$yi='2017';

$df='26';
$mf='9';
$yf='2017';

    $Dataos=new Dataos();
    $TotalOs=new Os();
    $Totales=$TotalOs->totalOs($idYo,$con);
    $total=$Dataos->TotalDataosBD($con);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    $nombre_archivo="../filtro/".$hoy.".csv";
    //chmod($nombre_archivo, 0777);  // octal; valor de modo correcto
    if(file_exists($nombre_archivo)){
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje = "ORDENES LIQUIDADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE TAREA,COPE, FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
        $mensaje = "ORDENES LIQUIDADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES,FECHA RETRABAJO,OBSERVACIONES RETRABAJO,AUXILIAR TELMEX";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje = "ORDENES LIQUIDADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE INSTALACION,COPE,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
        $mensaje = "ORDENES LIQUIDADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES,FECHA RETRABAJO,OBSERVACIONES RETRABAJO,AUXILIAR TELMEX";
        fwrite($archivo,$mensaje. "\n");
    }
    for ($i=0; $i <= $total; $i++) { 
        $Datos=new Dataos();
        $Datos->obtenerDataosBD($i,$con);
        $dd=$Datos->regresaDDASIG();
        $mm=$Datos->regresaMMASIG();
        $yy=$Datos->regresaYEARASIG();
        $tipo_os=$Datos->regresaTipoOs();
        $estatus=$Datos->regresaEstatus();
        $observa=$Datos->regresaObservaciones();
        $ddos=$Datos->regresaDDOS();
        $mmos=$Datos->regresaMMOS();
        $yearos=$Datos->regresaYEAROS();
        $horaos=$Datos->regresaHORAOS();
        $principal=$Datos->regresaPrincipal();
        $secundario=$Datos->regresaSecundario();
        $claro_video=$Datos->regresaClaroVideo();
        $ordens=$Datos->regresaIdOrden();
        $alfa=$Datos->regresaAlfanumerico();
        $serie=$Datos->regresaSerie();
        $fecha_cambio=$ddos."/".$mmos."/".$yearos." ".$horaos;

        $Os=new Os();
        $Os->obtenerOsBD($ordens,$con);
        $idmOSs=$Os->regresaIdmos();
        $tarea=$Os->regresaTipoTarea();
        $cope=$Os->regresaCope();
        $folio_pisaplex=$Os->regresaFolioPisaplex();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $cliente=$Os->regresaCliente(); 
        $asignado=$Os->regresaAsignado();
        $distrito=$Os->regresaDistrito(); 
        $expediente=$Os->regresaExpediente();
        $tipo_tarea=$Os->regresaTipoTarea();
        $usuarioidu=$Os->regresaUsuarioIdu();
        $zona=$Os->regresaZona();
        $dilacion_etapa=$Os->regresaDilacionEtapa();
        $dilacion=$Os->regresaDilacion(); 
        $Material= new Material();
        $Material->obtenerMaterialBD($idmOSs,$con);
        $modem=$Material->regresaModem();
        $rosetas=$Material->regresaRosetas();
        $metraje=$Material->regresaMetraje();
        $tipoins=$Material->regresaTipoInstalacion();
        //echo "<br>".$modem."-".$rosetas."-".$metraje."<br>";

        /*===============================*/
        $daux=$Os->regresaDDOS();
        $maux=$Os->regresaMMOS();
        $yaux=$Os->regresaYEAROS();
        /*===============================*/
        $Super=new Usuario();
        $Super->obtenerUsuarioBD($usuarioidu,$con);
        $nmte=$Super->regresaNombre();
        $apmte=$Super->regresaApaterno();
        $ammte=$Super->regresaAmaterno();
        $nomsuper=$nmte." ".$apmte." ".$ammte;
        $tecnico=new Usuario();
        $tecnico->obtenerUsuarioBD($asignado,$con);
        $nmt=$tecnico->regresaNombre();
        $apmt=$tecnico->regresaApaterno();
        $ammt=$tecnico->regresaAmaterno();
        $tecnicoa=$nmt." ".$apmt." ".$ammt;
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==2){ 
        $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $yearos."-".$mmos."-".$ddos;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
            if($estatus==2 && $asignado<>0){
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $estatus==2 && $asignado<>0){
                $idmos=$Os->regresaIdmos();
                $date=$daux."/".$maux."/".$yaux;
                $con1 = Conectarse();
                $aux=0;
                $sql="SELECT * FROM objecion_os WHERE id_orden='$folio_pis'";
                $resultado=$con1->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    $fecha=$row['fecha'];
                    $observaciones=$row['observaciones'];
                    $auxiliar=$row['personal_telmex'];
                    $distintivo=$row['distintivo'];
                    $aux=1;
                }
                echo $sql;
                if($aux==1){
                    //$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;;
                    $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                    .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa
                    .",".$fecha.",".$observaciones.",".$auxiliar.",".$distintivo;
                    //$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
                    //echo $mensajeAux;
                    //echo $aux."--".$mensaje;
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                }if($aux==0){
                    //$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;;
                    $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                    .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa
                    .",".$fecha.",".$observaciones.",".$auxiliar.",".$distintivo;
                    //$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
                    //echo $mensajeAux;
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                }
                //fclose($archivo);
            }
        }else{
        }
        //header("Location: ../filtro/".$nombre_archivo);
    }
header("Location: ../filtro/".$nombre_archivo);
//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
/*
require('Config/pclzip.lib.php');
$zip = new PclZip('test.zip');
$zip->create('a.txt,b.txt');
*/
?>