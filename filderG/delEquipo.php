<?php
include("../Config/library.php");
$con = Conectarse();
$cons = Conectarse();
//$idu=$_GET['iduser'];
$sql="SELECT * FROM areas_fielder";
$resultado=$con->query($sql);
?>
<div style="overflow-x:scroll;height:400px;">
	<table class="table">
		<tr>
			<th>NOMBRE DE AREA</th>
			<th>ELIMINAR</th>
			<th>EN AREA</th>
		</tr>
<?php		
while($row = $resultado->fetch_assoc())
{
	$conta=0;
	$sqls="SELECT * FROM equipos_fielder inner join usuario where id_fielder=idu and activo=1 and id_area='".$row['idarea']."'";
	$resultados=$cons->query($sqls);
	while($rows = $resultados->fetch_assoc())
	{
		$conta++;
	}
	if($row['nom_area']<>''){
?>
		<tr>
			<td><?php echo $row['nom_area'];?></td>
			<td> 
			<?php
			if($conta>0){
				echo "NO PUEDE SER BORRADO";
			}if($conta<=0){
			?>
				<form action="delEquipos.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $row['idarea'];?>">
					<button class="btn btn-danger" type="submit">
						QUITAR
					</button>
				</form>
			<?php
			}
			?>
			</td>
			<td>
				<?php
				echo $conta;
				?>
			</td>
		</tr>
	<?php
	}
}
?>
	</table>
</div>