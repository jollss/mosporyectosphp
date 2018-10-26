<?php
var_dump($_GET);
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
date_default_timezone_set('America/Mexico_City');
if(isset($_GET['xsoli'])){
	foreach ($_GET['xsoli'] as $key => $value) {
		$co = Conectarse(); 
		$sql2="SELECT * FROM venta WHERE idventa='$value'";
		$res=$co->query($sql2);
		while($row2 = $res->fetch_assoc())
		{
			$co2 = Conectarse(); 
			$valida=0;
			$sql22="SELECT * FROM validar_venta WHERE folio_solicitud='$value'";
			$res2=$co2->query($sql22);
			while($row22 = $res2->fetch_assoc())
			{
				$valida=$valida+1;
			}
			if($valida==0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="INSERT INTO validar_venta (
		        folio_solicitud,folio_siac,fecha_pago,id_area,xsol,xpos,xflotante)
		        VALUES
		        ('".$value."','".$row2['folio_siac']."','".$day."','".$_GET['area']."','1','0','0')"; 
		        execute($sql) or die (mysqli_error($con)); 
			}
			if($valida>0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="UPDATE validar_venta SET fecha_pago='".$day."' ,xsol='1'
				WHERE folio_solicitud='".$value."'";
				execute($sql) or die (mysqli_error($con));
			}
		}
	}
}

if(isset($_GET['xpos'])){
	foreach ($_GET['xpos'] as $key => $value) {
		$co = Conectarse(); 
		$sql2="SELECT * FROM venta WHERE idventa='$value'";
		$res=$co->query($sql2);
		while($row2 = $res->fetch_assoc())
		{
			$co2 = Conectarse(); 
			$valida=0;
			$sql22="SELECT * FROM validar_venta WHERE folio_solicitud='$value'";
			$res2=$co2->query($sql22);
			while($row22 = $res2->fetch_assoc())
			{
				$valida=$valida+1;
			}
			if($valida==0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="INSERT INTO validar_venta (
		        folio_solicitud,folio_siac,fecha_pago,id_area,xsol,xpos,xflotante)
		        VALUES
		        ('".$value."','".$row2['folio_siac']."','".$day."','".$_GET['area']."','0','1','0')"; 
		        execute($sql) or die (mysqli_error($con)); 
			}
			if($valida>0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="UPDATE validar_venta SET fecha_pago='".$day."' ,xpos='1'
				WHERE folio_solicitud='".$value."'";
				execute($sql) or die (mysqli_error($con));
			}
		}
	}
}

if(isset($_GET['flotante'])){
	foreach ($_GET['flotante'] as $key => $value) {
		$co = Conectarse(); 
		$sql2="SELECT * FROM venta WHERE idventa='$value'";
		$res=$co->query($sql2);
		while($row2 = $res->fetch_assoc())
		{
			$co2 = Conectarse(); 
			$valida=0;
			$sql22="SELECT * FROM validar_venta WHERE folio_solicitud='$value'";
			$res2=$co2->query($sql22);
			while($row22 = $res2->fetch_assoc())
			{
				$valida=$valida+1;
			}
			if($valida==0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="INSERT INTO validar_venta (
		        folio_solicitud,folio_siac,fecha_pago,id_area,xsol,xpos,xflotante)
		        VALUES
		        ('".$value."','".$row2['folio_siac']."','".$day."','".$_GET['area']."','0','0','1')"; 
		        execute($sql) or die (mysqli_error($con)); 
			}
			if($valida>0){
				$dia=date('j');
				$mes=date('n');
				$aaaa=date('Y');
				$day=$dia."/".$mes."/".$aaaa;
				$sql="UPDATE validar_venta SET fecha_pago='".$day."' ,xflotante='1'
				WHERE folio_solicitud='".$value."'";
				execute($sql) or die (mysqli_error($con));
			}
		}
	}
}
echo "
<script>
  alert('REGISTRADO!');
  document.location=('../".$main."?option=1');
</script>";
?>