<?php
include("../Config/library.php");
$con = Conectarse();
$id=$_GET['iduser'];
echo $id;
$sql="SELECT * FROM os inner join dataos where idmos=id_orden and idmos='$id'";
echo $sql;
$resultado=$con->query($sql);
?>
<div style="overflow-x:scroll;height:400px;">
	<table class="table">
		<tr>
			<th>IDMOS</th>
			<th>CLIENTE</th>
			<th>COPE</th>
			<th>FOLIO PISA</th>
			<th>TELEFONO</th>
			<th>TIPO TAREA</th>
			<th>DISTRITO</th>
			<th>ZONA</th>
			<th>Add</th>
		</tr>
		<?php		
		while($row = $resultado->fetch_assoc())
		{
		?>
		<tr>
			<td><?php echo $row['idmos'];?></td>
			<td><?php echo $row['cliente'];?></td>
			<td><?php echo $row['cope'];?></td>
		</tr>
		<?php
		}
		?>
	</table>
</div>