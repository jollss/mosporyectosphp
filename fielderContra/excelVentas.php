<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
	$dia=date('j');
	$mes=date('n');
	$aaaa=date('Y');
	$hoy = $dia." ".$mes." ".$aaaa;
	$nombre_archivo="../filtro/".$hoy.".csv";
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

$Total=new Ventas();
$totalU=$Total->totalVentasFull($con);
$aux=0;
if(file_exists($nombre_archivo)){
	unlink($nombre_archivo);
	$archivo = fopen($nombre_archivo, "a");
	$mensaje = "ID MOS VENTA, FOLIO VENTA, BP, CLIENTE, DIRECCION";
	fwrite($archivo,$mensaje. "\n");
}else{
	$archivo = fopen($nombre_archivo, "a");
	$mensaje = "ID MOS VENTA, FOLIO VENTA, BP, CLIENTE, DIRECCION";
	fwrite($archivo,$mensaje. "\n");
}
for ($i=0; $i <= $totalU; $i++) { 
	/*=========================*/
    $venta=new Ventas();
    $venta->obtenerVentaBD($i,$con);
    $id=$venta->regresaIdVenta();
    $fventa=$venta->regresaFolioVenta();
    $idvendedor=$venta->regresaVendedor();
    $nom=$venta->regresaNombre();
    $apa=$venta->regresaApaterno();
    $ama=$venta->regresaAmaterno();
    $dire=$venta->regresaDireccion();
    $datos=$venta->regresaDatos();
    $tel1=$venta->regresaTel1();
    $tel2=$venta->regresaTel2();
    $tel3=$venta->regresaTel3();
    $dd=$venta->regresaDia();
    $mm=$venta->regresaMes();
    $y=$venta->regresaYear();
    $hr=$venta->regresaHora();
    $status=$venta->regresaEstatus();
    $vendedor=$venta->regresaVendedorN();
    /*=========================*/
    $us=new Usuario();
    $us->obtenerUsuarioBD($idvendedor,$con);
    $tipo=$us->regresaTipoIdTipo();
    $nomb=$us->regresaNombre();
    $apep=$us->regresaApaterno();
    $amem=$us->regresaAmaterno();
    $fil=$nomb." ".$apep." ".$amem;
    echo $id.",".$fventa.",".$fil.",".$dire.",".$datos."<br>";
    date_default_timezone_set('America/Mexico_City');
	$dia=date('j');
	$mes=date('n');
	$aaaa=date('Y');
	$hoy = $dia." ".$mes." ".$aaaa;

	$nombre_archivo="../filtro/".$hoy.".csv";
	$mensaje = $id."	".$fventa."	".$fil."	".$dire;
	$archivo = fopen($nombre_archivo, "a");
	fwrite($archivo,$mensaje. "\n");
    fclose($archivo);
}
/*
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
	if(file_exists($nombre_archivo)){
		unlink($nombre_archivo);
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
		
	    $Datos=new Dataos();
	    $Datos->obtenerDataosBD($i,$con);
	    $dd=$Datos->regresaDdasig();
	    $mm=$Datos->regresaMmasig();
	    $yy=$Datos->regresaYearasig();

	    $ordens=$Datos->regresaIdOrden();
	    $Os=new Os();
	    $Os->obtenerOsBD($i,$con);
	    
	    $folio_pisaplex=$Os->regresaFolioPisaplex();
	    $folio_pis=$Os->regresaFolioPisa();
	    $tel=$Os->regresaTelefono();
	    $cliente=$Os->regresaCliente();                            
	    
	    $daux=$Os->regresaDdcarga();
	    $maux=$Os->regresaMmcarga();
	    $yaux=$Os->regresaYearcarga();

	    if($yi<=$yaux && $yaux>=$yf && $mi<=$maux && $mf>=$maux && $di<=$daux || $df>=$daux){ 
	        $idmos=$Os->regresaImos();
	        $date=$daux."/".$maux."/".$yaux;
			$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date."";
			$archivo = fopen($nombre_archivo, "a");
			fwrite($archivo,$mensaje. "\n");
		    fclose($archivo);
	    	//header("Location: ../filtro/".$nombre_archivo);
	    }else{
	    }
	}
	//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";

*/

	/*
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
	*/
?>