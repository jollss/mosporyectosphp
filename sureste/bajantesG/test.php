<?php
include("../Config/library.php"); 
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
$con = Conectarse();  
//$mail = $_SESSION['mail'];
//$user = $_SESSION['username'];
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();
$tipo=2;
$di=2;
$mi=12;
$yi=2017;

$df=7;
$mf=12;
$yf=2017;

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
        //unlink($nombre_archivo);
        //$archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
        $mensaje = "ORDENES DEL MES\nID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,FECHA DE RETRABAJO,OBSERVACIONES";
        //fwrite($archivo,$mensaje. "\n");
    }else{
        //$archivo = fopen($nombre_archivo, "a");
        $mensaje = "ORDENES DEL MES\nID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,FECHA DE RETRABAJO,OBSERVACIONES";
        //$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
        //fwrite($archivo,$mensaje. "\n");
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
                    //$mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    $mensaje = $idmos.",".$cope.",".",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    echo $mensaje."<br>";
                    $archivo = fopen($nombre_archivo, "a");
                    //fwrite($archivo,$mensaje. "\n");
                    //fclose($archivo);
                    unset($fecha_obj);
                    unset($obser);
                    unset($pisa);
                    unset($dist);
                }if(isset($fecha_obj)){
                    //$pisa=$folio_pis."-".$dist;
                    $pisa=$folio_pis."-RT";
                    $date=$daux."/".$maux."/".$yaux;
                    //$mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$pisa.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    $mensaje = $idmos.",".$cope.",".",".$nomsuper.",".$tecnicoa.",".$tipo_os.",".$fecha_obj.",".$obser;;
                    echo $mensaje."<br>";
                    $archivo = fopen($nombre_archivo, "a");
                    //fwrite($archivo,$mensaje. "\n");
                    //fclose($archivo);
                    unset($fecha_obj);
                    unset($obser);
                    unset($pisa);
                    unset($dist);
                }
            }
        }else{
        }
        
    }   
?>