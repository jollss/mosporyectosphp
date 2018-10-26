<?php
include("../Config/library.php");
$con = Conectarse();
$idu=$_GET['iduser'];
$sql="SELECT * FROM venta WHERE idvendedor='$idu' ORDER BY year DESC, mes DESC, dia DESC, hora DESC";
$resultado=$con->query($sql);
?>
<div style="overflow-x:scroll;height:400px;">
	<table class="table">
		<tr>
			<th>FOLIO</th>
			<th>CLIENTE</th>
			<th>DIRECCIÓN</th>
			<th>FECHA REGISTRO</th>
			<th>AREA</th>
			<th>PAQUETE</th>
			<th>FOLIO SIAC</th>
			<th>ETAPA</th>
			<th>Add</th>
		</tr>
<?php		
while($row = $resultado->fetch_assoc())
{
?>
		<tr>
			<td><?php echo $row['folio_ventas'];?></td>
			<td><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></td>
			<td><?php echo $row['direccion'];?></td>
			<td><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></td>
			<td><?php echo $row['area'];?></td>
			<td><?php echo $row['paquete_venta'];?></td>
			<td><?php echo $row['folio_siac'];?></td>
			<td><?php echo $row['etapa'];?></td>
			<?php
			//echo $row['paquete_venta'];
			
			if($row['paquete_venta']==='RESIDENCIAL $389'){
				echo "<td>$200.00</td>";
			}if($row['paquete_venta']==='RESIDENCIAL $999'){
				echo "<td>$538.00</td>";
			}else{
				echo "<td></td>";
			}
			?>
		</tr>
	<?php
}
?>
	</table>
</div>