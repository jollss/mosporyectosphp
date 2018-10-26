<?php
include("../Config/library.php"); 
$con = Conectarse();  
$q=$_POST['q'];
$mail = $_SESSION['mail']; 
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$miid=$Yo->regresaIdu();

$Os = new Os();
$total=$Os->totalOs($miid,$con);

//$Os->obtenerOsFolioBD($q,$con);
$Os->obtenerOsFolioPBD($q,$con);
$idmos=$Os-> regresaIdmos();
$cope=$Os-> regresaCope();
$expediente=$Os-> regresaExpediente();
$asignado=$Os->regresaAsignado();
$ddos=$Os-> regresaDDOS();
$mmos=$Os-> regresaMMOS();
$yearos=$Os-> regresaYEAROS();
$folio_pisaplex=$Os-> regresaFolioPisaplex();
$folio_pisa=$Os-> regresaFolioPisa();
$telefono=$Os-> regresaTelefono();
$cliente=$Os-> regresaCliente();
$tipo_tarea=$Os-> regresaTipoTarea();
$tecnologia=$Os-> regresaTecnologia();
$distrito=$Os-> regresaDistrito();
$zona=$Os-> regresaZona();
$dilacion_etapa=$Os-> regresaDilacionEtapa();
$dilacion=$Os-> regresaDilacion();
?>
<div class="panel panel-info">
	<div class="panel-heading"><b>DATOS ENCONTRADOS</b></div>
    <div class="panel-body" style="background-color:white;">
	    <div class="table-responsive">
	    	<table class="table">
			  <thead class="thead-inverse">
			    <tr>
			      <th>ID MOS</th>
			      <th>Folio Pisa</th>
			      <th>Folio Pisaplex</th>
			      <th>Cope</th>
			      <th>Expediente</th>
			      <th>Distrito</th>
			      <th>Zona</th>
			      <th>Dilacion Etapa</th>
			      <th>Dilacion</th>
			      <th>Fecha de Carga</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row"><?php echo $idmos;?></th>
			      <td><?php echo $folio_pisa;?></td>
			      <td><?php echo $folio_pisaplex;?></td>
			      <td><?php echo $cope;?></td>
			      <td><?php echo $expediente;?></td>
			      <td><?php echo $distrito;?></td>
			      <td><?php echo $zona;?></td>
			      <td><?php echo $dilacion_etapa;?></td>
			      <td><?php echo $dilacion;?></td>
			      <td><?php echo $ddos."/".$mmos."/".$yearos;?></td>
			    </tr>
			  </tbody>
			</table>
		</div>
    </div>
</div>
<?php
$DataOs=new Dataos();
$DataOs->obtenerDataosOsBD($idmos,$con);
$existencia=$DataOs->ExisteDataos($idmos,$con);
if ($existencia==0) {
	?>
	<div class="panel panel-info" align="center">
		<label>OS no asignada</label>
	</div>
	<?php
}if ($existencia==1) {
	$tecnicoAsig=$DataOs-> regresaTecnicoAsignacionIdu();
	$estadoa=$DataOs-> regresaEstatus();
	if($estadoa==0){$estatus='ABIERTA';}
	if($estadoa==1){$estatus='OBJETADA';}
	if($estadoa==2){$estatus='LIQUIDADA';}
	$observaciones=$DataOs-> regresaObservaciones();
	$ddcambio=$DataOs-> regresaDDOS();
	$mmcambio=$DataOs-> regresaMMOS();
	$yearcambio=$DataOs-> regresaYEAROS();
	$horacambio=$DataOs-> regresaHORAOS();
	$ddasig=$DataOs-> regresaDDASIG();
	$mmasig=$DataOs-> regresaMMASIG();
	$yearasig=$DataOs-> regresaYEARASIG();
	$principal=$DataOs-> regresaPrincipal();
	$secundario=$DataOs-> regresaSecundario();
	$claro_video=$DataOs-> regresaClaroVideo();
	$tipo_os=$DataOs-> regresaTipoOs();
	$alfa=$DataOs->regresaAlfanumerico();
	$serie=$DataOs->regresaSerie();
	$archivoOs=$DataOs->regresaFileOs();
	?>
	<div align="center">
		<form action="datosTec.php" method="POST">
			<input type="text" value="<?php echo $idmos;?>" style="display:none;" name="idmos" required>
			<input type="text" value="<?php echo $asignado;?>" style="display:none;" name="tecnico" required>
			<input type="submit" value="VER" class="btn btn-success" onclick="return confirm('Datos de quejas')">
		</form>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><b>DATOS REGISTRADOS POR OS</b></div>
	    <div class="panel-body" style="background-color:white;">
		    <div class="table-responsive">
		    	<table class="table">
				    <tr>
				      <th>Tecnico</th>
				      <th>Estatus</th>
				      <th>Observaciones</th>
				      <th>Fecha de termino</th>
				      <th>Fecha de Asignacion</th>
				      <th>Principal</th>
				      <th>Secundario</th>
				      <th>Claro Video</th>
				      <th>Tipo de Os</th>
				      <th></th>
				    </tr>
				    <tr>
				      <th scope="row"><?php 
				      	$tecnic=new Usuario();
				      	$tecnic->obtenerUsuarioBD($tecnicoAsig,$con);
				      	$idsuper=$tecnic->regresaAsignado();
				      	$super=new Usuario();
				      	$super->obtenerUsuarioBD($idsuper,$con);
				      	$nsu=$super->regresaNombre();
				      	$apsu=$super->regresaApaterno();
				      	$amsu=$super->regresaAmaterno();
				      	$supervisor=$nsu." ".$apsu." ".$amsu;
				      	$ntec=$tecnic->regresaNombre();
				      	$aptec=$tecnic->regresaApaterno();
				      	$amtec=$tecnic->regresaAmaterno();
				      	echo $tecnicoAsig."-".$ntec." ".$aptec." ".$amtec;
				      	?>
				      </th>
				      <td><?php echo $estatus;?></td>		      
				      <td><?php echo $observaciones;?></td>
				      <td><?php echo $ddcambio."/".$mmcambio."/".$yearcambio." ".$horacambio;?></td>
				      <td><?php echo $ddasig."/".$mmasig."/".$yearasig;?></td>
				      <td><?php echo $principal;?></td>
				      <td><?php echo $secundario;?></td>
				      <td><?php echo $claro_video;?></td>
				      <td><?php echo $tipo_os;?></td>
				      <td><?php
				      $adjunto=new Adjunto_os();
		 			  $totalAd=$adjunto->TotalAdjuntosBD($con);
					  for ($i=0; $i <= $totalAd; $i++) { 
					  	$adjuntor=new Adjunto_os();
					  	$adjuntor->obtenerAdjuntoOsBD($i,$con);
					  	$adjuntoOs=$adjuntor->regresaOsIdos();
					  	$nameIm=$adjuntor->regresaNombreImg();				  	
						  	if($adjuntoOs==$idmos){
						  	?>
						  		<a href="../os/<?php echo $nameIm; ?>" target="_blank"><img src="../os/<?php echo $nameIm; ?>" width=20 height=20></a>
						  	<?php
						  	}
					 	}
						?>
					  </td>
				    </tr>
				</table>
			<!--</div>
			<div class="table-responsive">-->
				<table class="table">
					<tr>
						<th>Alfanumerico: <?php echo $alfa;?></th>
					</tr>
					<tr>
						<th>Serie: <?php echo $serie;?></th>
					</tr>
					<tr>
					<?php
					if($archivoOs==''){
					?>
						<td style="color:red;"><label>SIN ARCHIVO DE OS</label></td>
					<?php
					}else{
					?>
						<td>Orden:<a href="../os/<?php echo $archivoOs;?>" target="_blank"><img src="../syspic/see.png" width="30" height="30"></td>
					<?php
					}
					?>
					</tr>
				</table>
				<h4><?php echo "Supervisor: ".$supervisor;?></h4>
			</div>
	    </div>
	</div>
<?php
}
?>