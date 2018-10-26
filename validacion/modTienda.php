<?php
include("../Config/library.php");
$con = Conectarse();  
$tienda_comercial=$_POST['tienda'];
$idT=$_POST['id'];
$tel_asignado=$_POST['tel'];
$folio_os=$_POST['folio_o'];
$etapa=$_POST['estapa'];
$ps=$_POST['ps'];
//echo "tienda comercial ".$tienda_comercial." idtienda".$idT." tel asignado".$tel_asignado." folio os".$folio_os." etapa".$etapa." PS:".$ps;
//$tienda=new TiendaComercial();
//$id_tienda=$tienda->obtenerIdTienda($con);
//$tienda->modComercio($tienda_comercial,$tel_asignado,$folio_os,$etapa,$ps,
//		$idT,$con);
//$tienda->verTienda();

/*$tienda->registrarTiendaBD($con);
*/
if(isset($_POST['siac'])){
	$siac=$_POST['siac'];
	$id=$_POST['id'];
	date_default_timezone_set('America/Mexico_City');
	$dia=date('j');
	$mes=date('n');
	$aaaa=date('Y');
	$hora = date("g");
	$min = date("i");
	$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
	$sql="UPDATE venta SET 
  	folio_siac='$siac',fecha_siac='$fecha'
   	WHERE idventa='".$id."'";
	if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }


	date_default_timezone_set('America/Mexico_City');
	$dia=date('j');
	$mes=date('n');
	$aaaa=date('Y');
	$hora = date("g");
	$min = date("i");
	$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
	/*$sql="UPDATE tienda_comercial SET 
	    fecha_comercial='$fecha'
	    WHERE id_tienda='".$idT."'";
	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	*/
	$sql="UPDATE venta SET 
	  	tienda_comercial='$tienda_comercial',tel_asignado='$tel_asignado',folio_os='$folio_os',
	  	etapa='$etapa',
	  	listo_ps='$ps',fecha_comercial='$fecha'
	   	WHERE idventa='".$idT."'";
	if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

	echo "
	<script>
	  alert('REGISTRADO!');
	  document.location=('listadoVentas.php');
	</script>";
}if(!isset($_POST['siac'])){
	echo "
	<script>
	  alert('REQUIERES SIAC!');
	  document.location=('listadoVentas.php');
	</script>";
	echo "<form name=form action=step3.php method=post>";
      echo "<input type=text name=ident value=".$idos.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
}


?>