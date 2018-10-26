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
$tipo=$_POST['tipo'];
$di=$_POST['di'];
$mi=$_POST['mi'];
$yi=$_POST['yi'];

$df=$_POST['df'];
$mf=$_POST['mf'];
$yf=$_POST['yf'];
//echo "DATOS DE ENTRADA=============================<BR>";
//echo "Tipo:".$tipo." DI".$di." MI".$mi." YI".$yi."  -df".$df." mf".$mf." yf".$yf."<br>";
if($tipo==1){
	$Dataos=new Dataos();
	$TotalOs=new Os();
	//$Totales=$TotalOs->totalOs($idYo,$con);
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
		unlink($nombre_archivo);
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA";
		fwrite($archivo,$mensaje. "\n");
	}
	for ($i=1; $i <= $Totales; $i++) { 
	    $Os=new Os();
	    $Os->obtenerOsBD($i,$con);
	    
	    $folio_pisaplex=$Os->regresaFolioPisaplex();
	    $folio_pis=$Os->regresaFolioPisa();
	    $tel=$Os->regresaTelefono();
	    $cliente=$Os->regresaCliente();                            
	    $quienAsigna=$Os->regresaUsuarioIdu();
	    $daux=$Os->regresaDDOS();
	    $maux=$Os->regresaMMOS();
	    $yaux=$Os->regresaYEAROS();
	    $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
	    //if($yi<=$yaux && $yaux>=$yf && $mi<=$maux && $mf>=$maux && $di<=$daux || $df>=$daux){ 
	    	if($quienAsigna==$idYo){
		        $idmos=$Os->regresaIdmos();
		        $date=$daux."/".$maux."/".$yaux;
				$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date."";
				$archivo = fopen($nombre_archivo, "a");
				fwrite($archivo,$mensaje. "\n");
			    fclose($archivo);
		    	//header("Location: ../filtro/".$nombre_archivo);
			}
	    }else{
	    }
	}
	//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
/*****************************************************************************************/
if($tipo==2){
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
		$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}
    for ($i=0; $i <= $Totales; $i++) { 
        
        $Os=new Os();
        $Os->obtenerOsBD($i,$con);
        
        $folio_pisaplex=$Os->regresaFolioPisaplex();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $cliente=$Os->regresaCliente(); 
        $asignado=$Os->regresaAsignado();                           
        $idmos=$Os->regresaIdmos();
        /*===============================*/
        $daux=$Os->regresaDDOS();
        $maux=$Os->regresaMMOS();
        $yaux=$Os->regresaYEAROS();
        $quienAsigna=$Os->regresaUsuarioIdu();
        /*===============================*/
        $tecnico=new Usuario();
        $tecnico->obtenerUsuarioBD($asignado,$con);
        $nmt=$tecnico->regresaNombre();
        $apmt=$tecnico->regresaApaterno();
        $ammt=$tecnico->regresaAmaterno();
        $tecnicoa=$nmt." ".$apmt." ".$ammt;
        
        if($asignado==0){
        }else{
        $Datos=new Dataos();
        $Datos->obtenerDataosOsBD($idmos,$con);
        $dd=$Datos->regresaDdasig();
        $mm=$Datos->regresaMmasig();
        $yy=$Datos->regresaYearasig();
        $ordens=$Datos->regresaIdOrden();
        echo $ordens."=".$idmos."<br>";
	        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd){
        $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
	            if($quienAsigna==$idYo){
		            //$idmos=$Os->regresaIdmos();
			        $date=$daux."/".$maux."/".$yaux;
					$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date.",".$tecnicoa;
					$archivo = fopen($nombre_archivo, "a");
					fwrite($archivo,$mensaje. "\n");
				    fclose($archivo);
			    	//header("Location: ../filtro/".$nombre_archivo);
		        }
		    }
	    }
    }
    //echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
if($tipo==3){
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
		$mensaje = "ORDENES OBJETADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA CARGA, FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ORDENES OBJETADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA CARGA,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}
    for ($i=0; $i <= $total; $i++) { 
        $Datos=new Dataos();
        $Datos->obtenerDataosBD($i,$con);
        $dd=$Datos->regresaDDASIG();
        $mm=$Datos->regresaMMASIG();
        $yy=$Datos->regresaYEARASIG();
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
        $fecha_cambio=$ddos."/".$mmos."/".$yearos." ".$horaos;

 		$Os=new Os();
        $Os->obtenerOsBD($ordens,$con);
        $idmOSs=$Os->regresaIdmos();
        $folio_pisaplex=$Os->regresaFolioPisaplex();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $quienAsigna=$Os->regresaUsuarioIdu();
        $cliente=$Os->regresaCliente(); 
        $asignado=$Os->regresaAsignado(); 
        $Material= new Material();
        $Material->obtenerMaterialBD($idmOSs,$con);
        $modem=$Material->regresaModem();
        $rosetas=$Material->regresaRosetas();
        $metraje=$Material->regresaMetraje();
        $tipo_instalacion=$Material->regresaTipoInstalacion();
        //echo "<br>".$modem."-".$rosetas."-".$metraje."<br>";

                                  
        /*===============================*/
        $daux=$Os->regresaDDOS();
        $maux=$Os->regresaMMOS();
        $yaux=$Os->regresaYEAROS();
        /*===============================*/
        $tecnico=new Usuario();
        $tecnico->obtenerUsuarioBD($asignado,$con);
        $nmt=$tecnico->regresaNombre();
        $apmt=$tecnico->regresaApaterno();
        $ammt=$tecnico->regresaAmaterno();
        $tecnicoa=$nmt." ".$apmt." ".$ammt;
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==1){ 
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $estatus==1){
        $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
        $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
        $fecha_a_evaluar = $yearos."-".$mmos."-".$ddos;//'2010-06-15';
        if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
        	if($quienAsigna==$idYo  && $estatus==1){
            $idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
			$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tipo_instalacion.",".$tecnicoa;
			$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa."<bR>";
			//echo $mensajeAux;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
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
		$mensaje = "ORDENES LIQUIDADA\nID MOS,FOLIO PISAPLEX,FOLIO PISA,TIPO TAREA,TELEFONO,CLIENTE,FECHA CARGA,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ORDENES LIQUIDADA\nID MOS,FOLIO PISAPLEX,FOLIO PISA,TIPO TAREA,TELEFONO,CLIENTE,FECHA CARGA,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}
    for ($i=0; $i <= $total; $i++) { 
        $Datos=new Dataos();
        $Datos->obtenerDataosBD($i,$con);
        $dd=$Datos->regresaDDASIG();
        $mm=$Datos->regresaMMASIG();
        $yy=$Datos->regresaYEARASIG();
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
        $fecha_cambio=$ddos."/".$mmos."/".$yearos." ".$horaos;

        $Os=new Os();
        $Os->obtenerOsBD($ordens,$con);
        $folio_pisaplex=$Os->regresaFolioPisaplex();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $cliente=$Os->regresaCliente();  
        $idmOSs=$Os->regresaIdmos();
        $asignado=$Os->regresaAsignado(); 
        $quienAsigna=$Os->regresaUsuarioIdu();
        $tipo_tarea=$Os->regresaTipoTarea();
        $Material= new Material();
        $Material->obtenerMaterialBD($idmOSs,$con);
        $modem=$Material->regresaModem();
        $rosetas=$Material->regresaRosetas();
        $metraje=$Material->regresaMetraje();
        $tipo_instalacion=$Material->regresaTipoInstalacion(); 
        echo "<br>".$modem."-".$rosetas."-".$metraje."<br>";

        /*===============================*/
        $daux=$Os->regresaDDOS();
        $maux=$Os->regresaMMOS();
        $yaux=$Os->regresaYEAROS();
        /*===============================*/
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
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $estatus==2){ 
        	if($quienAsigna==$idYo && $estatus==2){
            $idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
			$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tipo_tarea.",".$tel.",".$cliente.",".$date.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tipo_instalacion.",".$tecnicoa;
			$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tipo_tarea.",".$tel.",".$cliente.",".$date.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tipo_instalacion.",".$tecnicoa;
			//echo $mensajeAux;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
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