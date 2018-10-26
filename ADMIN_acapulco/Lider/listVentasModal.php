<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con4 = Conectarse();  
$dato=$_GET['id'];
$porciones = explode("-", $dato);
$mes=$porciones[0];
$dato=$porciones[1];
?>

<section class="row" style="height:500px;overflow-x:scroll;">
	<table class="table">
		<tr>
			<th>Folio Venta</th>
			<th>Tipo de Cliente</th>
			<th>Cliente</th>
			<th>Dirección</th>
			<th>Tel1</th>
			<th>Tel2</th>
			<th>Tel3</th>
			<th>Fecha de venta</th>
			<th>Correo</th>
			<th>RFC</th>
		</tr>
		<?php
		//var_dump($porciones);
		//$sql4="SELECT * FROM ventas where '$dato'=idvendedor AND mes='$mes' ORDER BY mes DESC,year DESC, dia DESC";
        $sql4="SELECT * FROM venta 
        WHERE   idvendedor='$dato' AND mes='$mes' 
        ORDER BY mes DESC,year DESC, dia DESC";
        $resultado4=$con4->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {
        	$ventaid=$row4['idventa'];
            ?>
            <tr>
            	<td><?php echo $row4['folio_ventas'];?></td>
            	<td><?php echo $row4['tipo_cliente'];?></td>
            	<td><?php echo $row4['nombrev']." ".$row4['apaternov']." ".$row4['amaternov'];?></td>
            	<td><?php echo $row4['direccion'];?></td>
            	<td><?php echo $row4['telefono_1'];?></td>
            	<td><?php echo $row4['telefono_2'];?></td>
            	<td><?php echo $row4['telefono_3'];?></td>
            	<td><?php echo $row4['dia']."/".$row4['mes']."/".$row4['year']." ".$row4['hora'];?></td>
            	<td><?php echo $row4['correo_cliente'];?></td>
            	<td><?php echo $row4['rfc_cliente'];?></td>
            </tr>
            <?php
        }
		?>
	</table>
</section>
