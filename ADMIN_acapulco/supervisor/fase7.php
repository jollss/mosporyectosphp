<?php
include("../Config/library.php");
$con = Conectarse(); 
$estatus=strtoupper($_POST['estatus']);
$detalles=strtoupper($_POST['detalles']);
$venta=strtoupper($_POST['ident']);

//echo $estatus." ".$detalles." ".$venta;
$fase=new Fase7();
$fase->obtenerfase7BD($venta,$con);
$idVentaF=$fase->regresaIdVenta();

if($idVentaF==$venta){
	$fase->modEstatus($estatus,$venta,$con);
}else{
	$fase7 = new Fase7();
	$idfase7=$fase7->ultimaFase7($con);
	//echo $idfase7;
	$fase7->ingresarfase7($idfase7,$estatus,$detalles,$venta);
	$fase7->verfase7();
	$fase7->registrarfase7BD($con);
	
}


echo "
    <script>
        alert('Registro correcto');
        document.location=('listVentas.php');
    </script>"; 

?>