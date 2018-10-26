<?php
function pagoFielder($dato){
	$co2 = Conectarse(); 
	$sql22="SELECT * FROM validar_venta WHERE folio_solicitud='$dato'";
	//echo $sql22;
	$valida=0;
	$res2=$co2->query($sql22);
	while($row22 = $res2->fetch_assoc())
	{
		if($row22['xsol']==0){
			$valida=$valida+1;
			?>
			<td><input type="checkbox" name="xsoli[]" value="<?php echo $dato;?>"></td>
			<?php
		}if($row22['xsol']==1){
			$valida=$valida+1;
			?>
			<td>X</td>
			<?php
		}if($row22['xpos']==0){
			$valida=$valida+1;
			?>
			<td><input type="checkbox" name="xpos[]" value="<?php echo $dato;?>"></td>
			<?php
		}if($row22['xpos']==1){
			$valida=$valida+1;
			?>
			<td>X</td>
			<?php
		}if($row22['xflotante']==0){
			$valida=$valida+1;
			?>
			<td><input type="checkbox" name="flotante[]" value="<?php echo $dato;?>"></td>
			<?php
		}if($row22['xflotante']==1){
			$valida=$valida+1;
			?>
			<td>X</td>
			<?php
		}
		$valida+1;
	}
	//echo $valida;
	if($valida==0){
		?>
		<td><input type="checkbox" name="xsoli[]" value="<?php echo $dato;?>"></td>
		<td><input type="checkbox" name="xpos[]" value="<?php echo $dato;?>"></td>
		<td><input type="checkbox" name="flotante[]" value="<?php echo $dato;?>"></td>
		<?php
	}
	
}
$con13 = Conectarse(); 
$sql13="SELECT * FROM areas_fielder where nom_area<>''";
$resultado13=$con->query($sql13);
?>
<form action="../contabilidad/pagoFielder.php" method="GET">
	<input type="hidden" name="option" value="2">
	<input type="hidden" name="main" value="<?php echo $main;?>">
	<div class="col-md-3">
		<select name="area" class="form-control">
		<?php
		while($row13 = $resultado13->fetch_assoc())
		{
			?>
				<option value="<?php echo $row13['idarea'];?>"><?php echo $row13['nom_area'];?></option>
			<?php
		}
		?>
		</select>
	</div>
	<div class="col-md-2">
		<button type="submit" class="btn btn-primary">VER</button>
	</div>
	<div class="col-md-6">
		<label></label>
	</div>
</form>

<?php
$con3 = Conectarse(); 
if(!isset($_GET['area'])){
	$sql2="SELECT * FROM venta";
	$area='';
	echo "<h2>SELECCIONA UN ÁREA</h2>";
}if(isset($_GET['area'])){
	$area=$_GET['area'];
	$sql2="SELECT * FROM venta inner join usuario inner join equipos_fielder inner join areas_fielder WHERE 
	equipos_fielder.id_area='".$area."' and 
	venta.idvendedor=usuario.idu and equipos_fielder.id_fielder=usuario.idu 
	and id_area=idarea";// and venta.etapa='P'";
	$resultado2=$con->query($sql2);
	?>
	<form action="../contabilidad/pagoFielder.php" method="GET">
		<div class="panel-body col-md-12" style="height:500px;overflow-x:scroll;">
			<table class="table">
				<tr>
					<th></th>
					<th>Solicitud</th>
					<th>SIAC</th>
					<th>ETAPA</th>
					<th>POR SOLICITUD</th>
					<th>POR POSTEO</th>
					<th>FLOTANTE</th>
					<th>Fielder</th>
				</tr>
					<input type="hidden" name="option" value="2">
					<input type="hidden" name="area" value="<?php echo $area;?>">
					<?php
					$index=0;
					while($row2 = $resultado2->fetch_assoc())
					{
						$folio_solicitud=$row2['folio_ventas'];
						$folio_siac=$row2['folio_siac'];
						$idventa=$row2['idventa'];
						if(isset($row2['nombre'])){
							$fielder=$row2['nombre']." ".$row2['apaterno']." ".$row2['amaterno'];
						}if(!isset($row2['nombre'])){
							$fielder='';
						}
						$sql3="SELECT * FROM validar_venta where 
						folio_solicitud='".$idventa."' and xsol=1 and xpos=1 and xflotante=1";
						$resultado3=$con3->query($sql3);
						$cnt=0;
						while($row3 = $resultado3->fetch_assoc())
						{
							$cnt=$cnt+1;
						}
						//echo $sql3;
						if($cnt<>0){}
						if($cnt==0){
							$index=$index+1;
							?>
							<tr>
								<td><?php echo $index;?></td>
								<td><?php echo $folio_solicitud;?></td>
								<td><?php echo $folio_siac;?></td>
								<td><?php echo $row2['etapa'];?></td>
								<?php
								pagoFielder($idventa);
								?>
								<td><?php echo $fielder;?></td>
							</tr>
							<?php
						}
					}
					?>
			</table>
		</div>
		<div align="center" class="col-md-12">
			<button class="btn btn-primary" type="submit">PAGAR</button>
		</div>
	</form>
	<?php
	if(isset($_GET['xsoli']) or isset($_GET['xpos']) or isset($_GET['flotante'])){
		include("regPago.php");
	}	
}
?>