<?php
ob_start();
include("../Config/library.php"); 

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
		$mensaje = "ID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		$mensaje = "ID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR";
		fwrite($archivo,$mensaje. "\n");
	}
	for ($i=1; $i <= $Totales; $i++) { 
	    $Os=new Os();
	    $Os->obtenerOsBD($i,$con);
        $cope=$Os->regresaCope();
        $expediente=$Os->regresaExpediente();
        $tipo_tarea=$Os->regresaTipoTarea();
        $zona=$Os->regresaZona();
        $dilacion_etapa=$Os->regresaDilacionEtapa();
        $dilacion=$Os->regresaDilacion();
        $usuarioidu=$Os->regresaUsuarioIdu();
	    $folio_pisaplex=$Os->regresaFolioPisaplex();
	    $folio_pis=$Os->regresaFolioPisa();
	    $tel=$Os->regresaTelefono();
	    $cliente=$Os->regresaCliente();                            
	    $distrito=$Os->regresaDistrito();
	    $daux=$Os->regresaDDOS();
	    $maux=$Os->regresaMMOS();
	    $yaux=$Os->regresaYEAROS();
        $Super=new Usuario();
        $Super->obtenerUsuarioBD($usuarioidu,$con);
        $nmt=$Super->regresaNombre();
        $apmt=$Super->regresaApaterno();
        $ammt=$Super->regresaAmaterno();
        $nomsuper=$nmt." ".$apmt." ".$ammt;
	    if($yi<=$yaux && $yaux>=$yf && $mi<=$maux && $mf>=$maux){ 
	        $idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
			$mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
	    	//header("Location: ../filtro/".$nombre_archivo);
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
		//$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
        $mensaje = "ORDENES DEL MES\nID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
        $mensaje = "ORDENES DEL MES\nID MOS,COPE,EXPEDIENTE,FECHA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO";
		//$mensaje = "ID MOS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,FECHA,TIPO DE OS,TIPO DE TAREA,TECNICO,DISTRITO";
		fwrite($archivo,$mensaje. "\n");
	}
    for ($i=0; $i <= $total; $i++) { 
        $Datos=new Dataos();
        $Datos->obtenerDataosBD($i,$con);
        $dd=$Datos->regresaDdasig();
        $mm=$Datos->regresaMmasig();
        $yy=$Datos->regresaYearasig();
        $tipo_os=$Datos->regresaTipoOs();
        $ordens=$Datos->regresaIdOrden();
        $Os=new Os();
        $Os->obtenerOsBD($ordens,$con);
        $tarea=$Os->regresaTipoTarea();
        $folio_pisaplex=$Os->regresaFolioPisaplex();
        $folio_pis=$Os->regresaFolioPisa();
        $tel=$Os->regresaTelefono();
        $cliente=$Os->regresaCliente(); 
        $asignado=$Os->regresaAsignado();                           
        $distrito=$Os->regresaDistrito();
        $usuarioidu=$Os->regresaUsuarioIdu();
        $cope=$Os->regresaCope();
        $expediente=$Os->regresaExpediente();
        $tipo_tarea=$Os->regresaTipoTarea();
        $zona=$Os->regresaZona();
        $dilacion_etapa=$Os->regresaDilacionEtapa();
        $dilacion=$Os->regresaDilacion();
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
        $asignado=$Os->regresaAsignado();
        $idmos=$Os->regresaIdmos();
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $asignado!=0){ 
        if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $asignado!=0){ 
            //$idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
			$mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
	    	//header("Location: ../filtro/".$nombre_archivo);
        }else{
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
		//$mensaje = "ORDENES OBJETADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE TAREA,COPE,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
        $mensaje = "ORDENES OBJETADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
        $mensaje = "ORDENES OBJETADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES";
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
        //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==1){ 
        if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $estatus==1 && $asignado<>0){ 
            $idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
            //$mensaje = "PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE";
			//$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;
            $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
            .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa;
			//$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa."<bR>";
			//echo $mensajeAux;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
	    	
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
        $mensaje = "ORDENES LIQUIDADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES";
		fwrite($archivo,$mensaje. "\n");
	}else{
		$archivo = fopen($nombre_archivo, "a");
		//$mensaje = "ORDENES LIQUIDADAS\nID MOS,FOLIO PISAPLEX,FOLIO PISA,DISTRITO,TELEFONO,CLIENTE,FECHA CARGA,TIPO DE OS,TIPO DE INSTALACION,TIPO DE INSTALACION,COPE,FECHA CAMBIO DE ESTATUS,OBSERVACIONES,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,TECNICO";
        $mensaje = "ORDENES LIQUIDADAS\nID MOS,COPE,EXPEDIENTE,FECHA DE CARGA,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE TAREA,DISTRITO,ZONA,DILACION ETAPA,DILACION,SUPERVISOR,TECNICO,TIPO DE OS,FECHA CAMBIO DE ESTATUS,TIPO DE INSTALACION,PRINCIPAL,SECUNDARIO,CLARO VIDEO,MODEM,ROSETAS,METRAJE,ALFANUMERICO,SERIE,OBSERVACIONES";
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
        echo "<br>".$modem."-".$rosetas."-".$metraje."<br>";

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
        if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $estatus==2 && $asignado<>0){
            $idmos=$Os->regresaIdmos();
	        $date=$daux."/".$maux."/".$yaux;
			//$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;;
            $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$dilacion_etapa.",".$dilacion.",".$nomsuper.",".$tecnicoa
            .",".$tipo_os.",".$fecha_cambio.",".$tipoins.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$alfa.",".$serie.",".$observa;
			//$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
			//echo $mensajeAux;
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
	    	
        }else{
	    }
	    //header("Location: ../filtro/".$nombre_archivo);
    }
}
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>