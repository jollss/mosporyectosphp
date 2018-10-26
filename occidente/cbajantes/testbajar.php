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
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();
?>
<form action="testbajar.php" method="GET">
    <TABLE>
        <tr>
            <td>
                <input type="number" name="di" placelholder="DIA">
                <input type="number" name="mi" placelholder="MES">
                <input type="number" name="yi" placelholder="AÑO">
            </td>
        </tr>
        <tr>
            <td>
                <input type="number" name="df" placelholder="DIA">
                <input type="number" name="mf" placelholder="MES">
                <input type="number" name="yf" placelholder="AÑO">
            </td>
        </tr>
    </TABLE>
    
</form> 
<?php
$tipo=$_GET['tipo'];
$di=$_GET['di'];
$mi=$_GET['mi'];
$yi=$_GET['yi'];

$df=$_GET['df'];
$mf=$_GET['mf'];
$yf=$_GET['yf'];
//echo "DATOS DE ENTRADA=============================<BR>";
//echo "Tipo:".$tipo." DI".$di." MI".$mi." YI".$yi."  -df".$df." mf".$mf." yf".$yf."<br>";
if($tipo==1){
    echo "<h2>Opcion 1</h2>";
    $con2 = Conectarse();  
    $con1 = Conectarse();  
    $Dataos=new Dataos();
    $TotalOs=new Os();
    $Totales=$TotalOs->totalesOs($con);
    $total=$Dataos->TotalDataosBD($con);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    $nombre_archivo="../filtro/".$hoy.".csv";
    if(file_exists($nombre_archivo)){
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,FECHA DE RETRABAJO,OBSERVACIONES";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,FECHA DE RETRABAJO,OBSERVACIONES";
        fwrite($archivo,$mensaje. "\n");
    }
        $con2->real_query("SELECT * FROM os");// AND semana='$semana'");
        $re = $con2->use_result();
        while ($row2 = $re->fetch_assoc()){
            $folio_pisaplex=$row2['folio_pisaplex'];
            $folio_pis=$row2['folio_pisa'];
            $tel=$row2['telefono'];
            $cope=$row2['cope'];
            $cliente=$row2['cliente'];

            $expediente=$row2['expediente'];
            $distrito=$row2['distrito'];
            $zona=$row2['zona'];
            $dilacion=$row2['dilacion'];
            $tipo_tarea=$row2['tipo_tarea'];
            $dilacion_etapa=$row2['dilacion_etapa'];
            $quienAsigna=$row2['usuario_idu'];
            $daux=$row2['ddcarga'];
            $maux=$row2['mmcarga'];
            $yaux=$row2['yearcarga'];
            $idmos=$row2['idmos'];
            $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
            $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
            $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                if($idmos<>'0'){
                    //if($quienAsigna==$idYo){
                    //$fecha_obj='';
                    $obser='';
                        $con1->real_query("SELECT * FROM objecion_os where id_orden='$folio_pis'");// AND semana='$semana'");
                        $re1 = $con1->use_result();
                        while ($row1 = $re1->fetch_assoc()){
                            $fecha_obj=$row1['fecha'];
                            $obser=$row1['observaciones'];
                            $dist=$row1['distintivo'];
                        }
                        $con5= Conectarse();
                        $con5->real_query("SELECT * FROM usuario where idu='$quienAsigna'");// AND semana='$semana'");
                        $re5 = $con5->use_result();
                        while ($row5 = $re5->fetch_assoc()){
                            $nombre=$row5['nombre'];
                            $paterno=$row5['apaterno'];
                            $materno=$row5['amaterno'];
                        }
                        $nomsuper=$nombre." ".$paterno." ".$materno;
                        if(!isset($fecha_obj) or $fecha_obj==''){
                            //$idmos=$Os->regresaIdmos();
                            
                            $date=$daux."/".$maux."/".$yaux;
                            //$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date."";
                            $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper;
                            //echo $mensaje."<br>";
                            $archivo = fopen($nombre_archivo, "a");
                            fwrite($archivo,$mensaje. "\n");
                            fclose($archivo);
                        }if(isset($fecha_obj)){
                            //$idmos=$Os->regresaIdmos();
                            //$idmos=$row2['idmos'];
                            $date=$daux."/".$maux."/".$yaux;
                            //$pisa=$folio_pis."-".$dist;
                            $pisa=$folio_pis."-RT";
                            //$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date.",".$fecha_obj.",".$obser."";
                            $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$pisa.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$fecha_obj.",".$obser;
                            //echo $mensaje."<br>";
                            unset($fecha_obj);
                            unset($obser);
                            unset($pisa);
                            unset($dist);
                            $archivo = fopen($nombre_archivo, "a");
                            fwrite($archivo,$mensaje. "\n");
                            fclose($archivo);
                        }
                }
            }
        }
}
/*****************************************************************************************/
if($tipo==2){
    echo "<h2>Opcion 2</h2>";
    $con2 = Conectarse();  
    $con1 = Conectarse();  
    $Dataos=new Dataos();
    $TotalOs=new Os();
    $Totales=$TotalOs->totalesOs($con);
    $total=$Dataos->TotalDataosBD($con);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    $nombre_archivo="../filtro/".$hoy.".csv";
    if(file_exists($nombre_archivo)){
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
        $mensaje = "ORDENES DEL MES\nID MOS,ESTATUS,COPE,EXPEDIENTE,FECHA DE TRABAJO,FECHA DE ASIGNACION,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,FECHA DE RETRABAJO,OBSERVACIONES";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ORDENES DEL MES\nID MOS,ESTATUS,COPE,EXPEDIENTE,FECHA DE TRABAJO,FECHA DE ASIGNACION,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,FECHA DE RETRABAJO,OBSERVACIONES";
        //$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
        fwrite($archivo,$mensaje. "\n");
    }
    $con2->real_query("SELECT * FROM os inner join dataos where idmos=id_orden");// AND semana='$semana'");
    $re = $con2->use_result();
    while ($row2 = $re->fetch_assoc()){
        $idmos=$row2['idmos'];

        $dd=$row2['ddasig'];
        $mm=$row2['mmasig'];
        $yy=$row2['yearasig'];
        $tipo_os=$row2['tipo_os'];
        $ordens=$row2['id_orden'];
        $estatus=$row2['estatus'];
        $tarea=$row2['tipo_tarea'];
        $folio_pisaplex=$row2['folio_pisaplex'];
        $folio_pis=$row2['folio_pisa'];
        $tel=$row2['telefono'];
        $cliente=$row2['cliente'];
        $asignado=$row2['asignado'];
        //echo $asignado;
        $distrito=$row2['distrito'];
        $usuarioidu=$row2['usuario_idu'];
        $cope=$row2['cope'];
        $expediente=$row2['expediente'];
        $tipo_tarea=$row2['tipo_tarea'];
        $zona=$row2['zona'];
        $dilacion_etapa=$row2['dilacion_etapa'];
        $dilacion=$row2['dilacion'];

        $daux=$row2['ddos'];
        $maux=$row2['mmos'];
        $yaux=$row2['yearos'];
        if($estatus==0){$estado='ABIERTA';}
        if($estatus==1){$estado='OBJETADA';}
        if($estatus==2){$estado='LIQUIDADA';}
        $con5= Conectarse();
        $con5->real_query("SELECT * FROM usuario where idu='$usuarioidu'");// AND semana='$semana'");
        $re5 = $con5->use_result();
        while ($row5 = $re5->fetch_assoc()){
            $nmte=$row5['nombre'];
            $apmte=$row5['apaterno'];
            $ammte=$row5['amaterno'];
        }
        $nomsuper=$nmte." ".$apmte." ".$ammte;
        $con4= Conectarse();
        $con4->real_query("SELECT * FROM usuario where idu='$asignado'");// AND semana='$semana'");
        $re4 = $con4->use_result();
        while ($row4 = $re4->fetch_assoc()){
            $nmt=$row4['nombre'];
            $apmt=$row4['apaterno'];
            $ammt=$row4['amaterno'];
        } 
        $tecnicoa=$nmt." ".$apmt." ".$ammt;
        $obser='';
        $con1->real_query("SELECT * FROM objecion_os where id_orden='$folio_pis'");// AND semana='$semana'");
        $re1 = $con1->use_result();
        while ($row1 = $re1->fetch_assoc()){
            $fecha_obj=$row1['fecha'];
            $obser=$row1['observaciones'];
            $dist=$row1['distintivo'];
        }
        
        $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $dd."-".$mm."-".$yy;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
            if($asignado<>0 and $idmos<>0){
                if(!isset($fecha_obj) or $fecha_obj==''){
                    $date=$daux."/".$maux."/".$yaux;
                    $mensaje = $idmos.",".$estado.",".$cope.",".$expediente.",".$date.",".$fecha_a_evaluar.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    echo $mensaje."<br>";
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                }if(isset($fecha_obj)){
                    //$pisa=$folio_pis."-".$dist;
                    $pisa=$folio_pis."-RT";
                    $date=$daux."/".$maux."/".$yaux;
                    $mensaje = $idmos.",".$estado.",".$cope.",".$expediente.",".$date.",".$fecha_a_evaluar.",".$folio_pisaplex.",".$pisa.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    echo $mensaje."<br>";
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                    unset($fecha_obj);
                    unset($obser);
                    unset($pisa);
                    unset($dist);
                }
            }
        }else{
        }
        
    }
    //echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
if($tipo==3){
    $con1 = Conectarse(); 
    echo "<h2>Opcion 3</h2>";
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
        //$mensaje = "ORDENES OBJETADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE TAREA,COPE,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
        $mensaje = "ORDENES OBJETADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES,FECHA DE RETRABAJO,OBSERVACIONES";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ORDENES OBJETADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES,FECHA DE RETRABAJO,OBSERVACIONES";
        //$mensaje = "ORDENES OBJETADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE TAREA,COPE,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
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
        $usuarioidu=$Os->regresaUsuarioIdu();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $cliente=$Os->regresaCliente(); 
        $asignado=$Os->regresaAsignado();
        $distrito=$Os->regresaDistrito(); 
        $expediente=$Os->regresaExpediente();
        $tipo_tarea=$Os->regresaTipoTarea();
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

        $obser='';
        $con1->real_query("SELECT * FROM objecion_os where id_orden='$folio_pis'");// AND semana='$semana'");
        $re1 = $con1->use_result();
        while ($row1 = $re1->fetch_assoc()){
            $fecha_obj=$row1['fecha'];
            $obser=$row1['observaciones'];
            $dist=$row1['distintivo'];
        }                        
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
        $idmos=$Os->regresaIdmos();
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==1){ 
        $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $yearos."-".$mmos."-".$ddos;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
            if($estatus==1 && $asignado<>0 and $idmos<>0){
                if(!isset($fecha_obj) or $fecha_obj==''){
                    
                    $date=$daux."/".$maux."/".$yaux;
                    $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                    .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa;
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                }if(isset($fecha_obj)){
                    //$idmos=$Os->regresaIdmos();
                    $date=$daux."/".$maux."/".$yaux;
                    //$pisa=$folio_pis."-".$dist;
                    $pisa=$folio_pis."-RT";
                    $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$pisa.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                    .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa.",".$fecha_obj.",".$obser;
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                    unset($fecha_obj);
                    unset($obser);
                    unset($pisa);
                    unset($dist);
                }
            }
        }else{
        }
        
    }
}
if($tipo==4){
    
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
        $cliente=str_replace ( ',' , '' , $cliente ) ;
        $buscar=array(chr(13).chr(10), "\r\n", "\n", "\r",",");
        $reemplazar=array("", "", "", "","");
        $cliente=str_ireplace($buscar,$reemplazar,$cliente); 
        $cliente = preg_replace("[\n|\r|\n\r]", "", $cliente);
        $cliente = trim($cliente);
        $asignado=$Os->regresaAsignado();
        $distrito=$Os->regresaDistrito(); 
        $expediente=$Os->regresaExpediente();
        $tipo_tarea=$Os->regresaTipoTarea();
        $usuarioidu=$Os->regresaUsuarioIdu();
        $usuarioidu=$Datos->regresaSupervisorIdu();
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
        $idmos=$Os->regresaIdmos();
        /*===============================*/
        $daux=$Os->regresaDDOS();
        $maux=$Os->regresaMMOS();
        $yaux=$Os->regresaYEAROS();
        /*===============================*/
        /*
        $Super=new Usuario();
        $Super->obtenerUsuarioBD($usuarioidu,$con);
        $nms=$Super->regresaNombre();
        $aps=$Super->regresaApaterno();
        $ams=$Super->regresaAmaterno();
        $nomsuper=$nms." ".$apms." ".$ams;
        */
        $con3 = Conectarse();
        $sql3="SELECT * FROM usuario WHERE idu='$usuarioidu'";
        $resultado3=$con3->query($sql3);
        while($row3 = $resultado3->fetch_assoc())
        {
            $nms=$row3['nombre'];
            $apms=$row3['apaterno'];
            $ams=$row3['amaterno'];
        }
        $nomsuper=$nms." ".$apms." ".$ams;
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
            if($estatus==2 && $asignado<>0 and $idmos<>0){                    
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
                if(!isset($fecha) or $fecha==''){
                    $fecha='NA';
                    $observaciones='NA';
                    $auxiliar='NA';
                    $distintivo='NA';
                    //$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;;
                        $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                        .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa
                        .",".$fecha.",".$observaciones.",".$auxiliar.",".$distintivo;//.","."https://www.mosproyectos.com.mx/os/".$imagenes[0].","."https://www.mosproyectos.com.mx/os/".$imagenes[1].","."https://www.mosproyectos.com.mx/os/".$imagenes[2].","."https://www.mosproyectos.com.mx/os/".$imagenes[3].","."https://www.mosproyectos.com.mx/os/".$imagenes[4].","."https://www.mosproyectos.com.mx/os/".$imagenes[5];
                        //$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
                        //echo $mensajeAux;
                        $archivo = fopen($nombre_archivo, "a");
                        fwrite($archivo,$mensaje. "\n");
                        fclose($archivo);
                        unset($fecha);
                        unset($observaciones);
                        unset($auxiliar);
                        unset($distintivo);
                }if(isset($fecha)){
                    $pisa=$folio_pis."-RT";
                    $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$pisa.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
                        .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa
                        .",".$fecha.",".$observaciones.",".$auxiliar.",".$distintivo;//.","."https://www.mosproyectos.com.mx/os/".$imagenes[0].","."https://www.mosproyectos.com.mx/os/".$imagenes[1].","."https://www.mosproyectos.com.mx/os/".$imagenes[2].","."https://www.mosproyectos.com.mx/os/".$imagenes[3].","."https://www.mosproyectos.com.mx/os/".$imagenes[4].","."https://www.mosproyectos.com.mx/os/".$imagenes[5];
                        //$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
                        //echo $mensajeAux;
                        $archivo = fopen($nombre_archivo, "a");
                        fwrite($archivo,$mensaje. "\n");
                        fclose($archivo);
                        unset($fecha);
                        unset($observaciones);
                        unset($auxiliar);
                        unset($distintivo);
                }
            }
        }else{
        }
        //header("Location: ../filtro/".$nombre_archivo);
    }
}
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>