<script type="text/javascript" src="../Config/alerty-lib/lib/alertify.js"></script>
<link rel="stylesheet" href="../Config/alerty-lib/themes/alertify.core.css" />
<link rel="stylesheet" href="../Config/alerty-lib/themes/alertify.default.css" />

<?php
include("../Config/library.php");
//include("../Models/areas_fielder.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$venta=0;
?>
<li role="presentation">
	<i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i><br>
	VENTAS <?php echo $dia."/".$mes."/".$aaaa;?>: 
</li>
<?php
$cnxe->real_query("SELECT * FROM venta WHERE dia = '$dia' and mes='$mes' and year='$aaaa' order by idventa");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    //$iduser=$line['idu'];
    $venta=$venta+1;
}
?>
<li>
<table class="" border="" align="center">
<?php
$total=0;
$sql="SELECT * FROM areas_fielder order by nom_area DESC";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
	$idarea=$row['idarea'];
	$nom_area=$row['nom_area'];
	$con2 = Conectarse(); 
	$venta=0;
	
	$sql2="SELECT * FROM equipos_fielder WHERE id_area='$idarea'";
	$resultado2=$con2->query($sql2);
	while($row2 = $resultado2->fetch_assoc())
	{
		$id_fielder=$row2['id_fielder'];
		$cnxe->real_query("SELECT * FROM venta
			WHERE dia = '$dia' and mes='$mes' and year='$aaaa' and idvendedor='$id_fielder'
			order by idventa");
		$result = $cnxe->use_result();
		while ($line = $result->fetch_assoc()){
		    //$iduser=$line['idu'];
		    $venta=$venta+1;
		}
	}
	if($nom_area<>''){
	     echo "<tr>
					<td style='font-size:10px;' width='100%'>".$nom_area."</td>
					<th style='font-size:12px' width='20%'>".$venta."</th>
					</tr>"; 
	}
    $total=$total+$venta;
}

?>
<tr>
	<th>TOTAL:<?php echo $total;?></th>
	<td></td>
</tr>
</table>
</li>

<!--
<script>
	function notificacion(){
	        //una notificación normal
	      alertify.log("Nueva Venta"); 
	      return false;
	}
</script>
-->