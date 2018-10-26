<?php
include("../Config/library.php"); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="../js/browserBajantes.js"></script>
    <?php
	   cbajantes($user);
	?>
</head> 
<body>
<?php

if(!isset($_POST['idmos'])){
	$os=$_GET['idmos'];
	$tipo=$_GET['tipo'];
	$imagen_eliminar=$_GET['eliminar_imagen'];
	$sql="UPDATE adjunto_os SET 
	nombreimg='0',os_idos='0'
	WHERE idadjunto='".$imagen_eliminar."'";
	if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on OS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

}
if(isset($_POST['idmos'])){
	$os=$_POST['idmos'];
	$tipo=$_POST['tipo'];
}
if($tipo==1){
		date_default_timezone_set('America/Mexico_City');
	    $dia=date('j');
	    $mes=date('n');
	    $aaaa=date('Y');
	    $semana = date("W");
	    $con1 = Conectarse();
	    $con2 = Conectarse();
	    $con3 = Conectarse();
		$sql="SELECT * FROM os WHERE idmos='$os'";
	    $resultado=$con1->query($sql);
	    while($row = $resultado->fetch_assoc())
	    {
	        /*OS*/
	        $idmos=$row['idmos'];
	        $cope=$row['cope'];
	        $expediente=$row['expediente'];
	        $ddcarga=$row['ddcarga'];
	        $mmcarga=$row['mmcarga'];
	        $yearcarga=$row['yearcarga'];
	        $folio_pisaplex=$row['folio_pisaplex'];
	        $folio_pisa=$row['folio_pisa'];
	        $telefono=$row['telefono'];
	        $cliente=$row['cliente'];
	        $tipo_tarea=$row['tipo_tarea'];
	        $tecnologia=$row['tecnologia'];
	        $distrito=$row['distrito'];
	        $zona=$row['zona'];
	        $dilacion_etapa=$row['dilacion_etapa'];
	        $dilacion=$row['dilacion'];
	        $usuario_idu=$row['usuario_idu'];
	        $asignado=$row['asignado'];
	        $aux1=1;
	    }
	    $sql1="SELECT * FROM dataos WHERE id_orden='$idmos'";
	    $RES=$con2->query($sql1);
	    while($r = $RES->fetch_assoc())
	    {
	        /*DATAOS*/
	        $estatus=$r['estatus'];
	        $observaciones=$r['observaciones'];
	        $ddos=$r['ddos'];
	        $mmos=$r['mmos'];
	        $yearos=$r['yearos'];
	        $horaos=$r['horaos'];
	        $principal=$r['principal'];
	        $secundario=$r['secundario'];
	        $claro_video=$r['claro_video'];
	        $tipo_os=$r['tipo_os'];
	        $alfanumerico=$r['alfanumerico'];
	        $serie=$r['serie'];
	        $aux=1;
	    }
		?>
		<br><br><br><br>
		<div class="col-md-12">
		<div align="center">
			<table>
			<?php
			$sql3="SELECT * FROM adjunto_os WHERE os_idos='$idmos'";
	        $resultado=$con3->query($sql3);
	        while($row = $resultado->fetch_assoc())
	        {
	            /*OS*/
	            $idadjunto=$row['idadjunto'];
	            $nombreimg=$row['nombreimg'];
	            $os_idos=$row['os_idos'];
	            ?>
	            <a href="<?php echo "../os/".$nombreimg;?>" target="_blank">
	                <img src="../os/<?php echo $nombreimg;?>" width="50" height="50">
	            </a>
	            <form action="modOs.php" method="GET">
	            	<input type="text" name="eliminar_imagen" value="<?php echo $idadjunto;?>" style="display:none;">
	            	<input type="text" name="idmos" value="<?php echo $os;?>" style="display:none;"> 
	            	<input type="text" name="tipo" value="<?php echo $tipo;?>" style="display:none;"> 
	            	<input type="image" src="../syspic/delete.ico" width="20" height="20">
	            </form>
	            <?php
	        }
			?>
			</table>
		</div>
		<form action="option_uno.php" method="POST">
		<input type="text" value="<?php echo $tipo;?>" name="tipo_opcion" readonly="readonly" style="display:none;">
			<div align="center" style="background-color:gray;border:solid;" class="col-md-2">
				<input type="image" class="btn btn-default" src="../syspic/confirmar.png" width="100" title="MODIFICAR">
				<a href="buscar.php"><img class="btn btn-default" src="../syspic/regresar.png" width="100" title="REGRESAR"></a>
			</div>
		    <div class="col-md-10">
		        <div style="background-color:gray;border:solid;" class="table-responsive">
		            <table class="table" style="background-color:white;">
		                <tr>
		                    <th>IDMOS:</th>                    
		                    <th>COPE:</th>
		                    <th>EXPEDIENTE:</th>
		                    <th>FECHA DE CARGA:</th>
		                    <th>FOLIO PISAPLEX</th>
		                    <th>FOLIO PISA</th>
		                    <TH>TELEFONO</TH>
		                    
		                </tr>
		                <tr>
		                    <td style="color:red;"><input type="text" value="<?php echo $idmos;?>" name="idmos" readonly="readonly" style="border:none;"></td>
		                    <td><input type="text" value="<?php echo $cope;?>" name="cope"></td>
		                    <td><input type="text" value="<?php echo $expediente;?>" name="expediente"></td>
		                    <td style="color:red;"><b><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></b></td>
		                    <td style="color:red;"><b><input type="text" value="<?php echo $folio_pisaplex;?>" name="folio_pisaplex"></b></td>
		                    <td style="color:red;"><b><?php echo $folio_pisa;?></b></td>
		                    <td><input type="text" value="<?php echo $telefono;?>" name="telefono"></td>
		                </tr>
		                <tr>
		                    <th>CLIENTE</th>
		                    <th>TIPO DE TAREA</th>
		                    <!--<TH>TECNOLOGIA</TH>-->
		                    <TH>DISTRITO</TH>
		                    <TH>ZONA</TH>
		                    <TH>DILACION ETAPA</TH>
		                    <TH>DILACION</TH>
		                    <th></th>
		                </tr>
		                <tr>
		                    <td><input type="text" value="<?php echo $cliente;?>" name="cliente"></td>
		                    <td><input type="text" value="<?php echo $tipo_tarea;?>" name="tipo_tarea"></td>
		                    <!--<td><?php echo $tecnologia;?></td>-->
		                    <td><input type="text" value="<?php echo $distrito;?>" name="distrito"></td>
		                    <td><input type="text" value="<?php echo $zona;?>" name="zona"></td>
		                    <td><input type="number" value="<?php echo $dilacion_etapa;?>" name="dilacion_etapa"></td>
		                    <td><input type="number" value="<?php echo $dilacion;?>" name="dilacion"></td>
		                    <th></th>
		                </tr>
		            </table>
		        </div>
		        <div style="background-color:gray;border:solid;" class="table-responsive">
		        <div class="col-md-12" align="center" style="background-color:white;"><label style="color:red;">SI NO EXISTE INFORMACION AUN NO SE TRABAJA</label></div>
		            <table class="table" style="background-color:white;">
		                <tr>
		                    <th>ESTATUS</th>                    
		                    <th>OBSERVACIONES</th>
		                    <th>FECHA DE CIERRE</th>
		                    <th>PRINCIPAL</th>
		                    <th>SECUNDARIO</th>
		                </tr>
		                <tr>
		                    <td style="color:red;">
		                    <h3><?php 
		                        if($estatus==0){
		                            echo "ABIERTA";
		                        }if($estatus==1){
		                            echo "OBJETADA";
		                        }if($estatus==2){
		                            echo "LIQUIDADA";
		                        }if($estatus==5){
		                            echo "";
		                        }
		                        ?>
		                    </h3>
		                    </td>
		                    <td><input type="text" value="<?php echo $observaciones;?>" name="observaciones"></td>
		                    <td style="color:red;"><b><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></b></td>
		                    <td><input type="text" value="<?php echo $principal;?>" name="principal"></td>
		                    <td><input type="text" value="<?php echo $secundario;?>" name="secundario"></td>
		                </tr>
		                <tr>
		                    <th>CLARO VIDEO</th>                    
		                    <th>TIPO DE OS</th>
		                    <th>ALFANUMERICO</th>
		                    <th>SERIE</th>
		                    <th></th>
		                </tr>
		                <tr>
		                    <td>
		                    <select name="claro_video">
							  	<?php
							  	if($claro_video==0){
							  		?>
							  		<option value="0" selected>NA</option>
							  		<option value="SI">SI</option>
								  	<option value="NO">NO</option>
							  		<?php
							  	}if($claro_video=='NO'){
							  		?>
							  		<option value="SI">SI</option>
								  	<option value="NO" selected="selected">NO</option>
							  		<?php
							  	}
							  	if($claro_video=='SI'){
							  		?>
							  		<option value="NO">NO</option>
								  	<option value="SI" selected="selected">SI</option>
							  		<?php
							  	}
							  	?>
							</select>
		                    <?php 
		                        //echo $claro_video;
		                        ?>
		                    </td>
		                    <td>
		                    	<select name="tipo_os">
								  	<option value="<?php echo $tipo_os;?>" selected><?php echo $tipo_os;?></option>
								  	<option value="COBRE">COBRE</option>
								  	<option value="FIBRA">FIBRA</option>
								  	<option value="HIBRIDA">HIBRIDA</option>
								  	<option value="TECNICA">TECNICA</option>
								  	<option value="VOZ">VOZ</option>
								  	<option value="PSR">PSR</option>
								</select>
		                    </td>
		                    <!--<td><?php echo $tipo_os;?></td>-->
		                    <td><input type="text" value="<?php echo $alfanumerico;?>" name="alfanumerico"></td>
		                    <td><input type="text" value="<?php echo $serie;?>" name="serie"></td>
		                    <td></td>
		                </tr>
		            </table>
		        </div>
		        <?php
		        //echo "<h3>".$usuario_idu."-----".$asignado."<br></h3>";
		        ?>
		        <div style="background-color:gray;border:solid;" class="table-responsive">
		            <table class="table" style="background-color:white;">
		                <tr>
		                    <th>SUPERVISOR</th>                    
		                    <th>TECNICO</th>
		                </tr>
		                <tr>
		                    <td>
		                    	<select name="supervisor">
		                    	<?php
		                    	$sql2="SELECT * FROM usuario WHERE tipo_idtipo=3 AND activo=1";
								$resu=$con3->query($sql2);
								while($rest = $resu->fetch_assoc())
								{
									$idu=$rest['idu'];
									$nombre=$rest['nombre'];
									$apaterno=$rest['apaterno'];
									$amaterno=$rest['amaterno'];
									if($idu==$usuario_idu){
										?>
										<option value="<?php echo $idu;?>" selected><?php echo $nombre." ".$apaterno." ".$amaterno;?></option>
										<?php
									}else{
										?>
										<option value="<?php echo $idu;?>"><?php echo $nombre." ".$apaterno." ".$amaterno;?></option>
										<?php
									}
								}
		                    	?>
								</select>
		                    </td>
		                    <td>
		                    	<select name="tecnico">
		                    	<?php
		                    	$sql2="SELECT * FROM usuario WHERE tipo_idtipo=1 AND activo=1 ORDER BY nombre";
								$resu=$con3->query($sql2);
								while($rest = $resu->fetch_assoc())
								{
									$idu=$rest['idu'];
									$nombre=$rest['nombre'];
									$apaterno=$rest['apaterno'];
									$amaterno=$rest['amaterno'];
									if($idu==$asignado){
										?>
										<option value="<?php echo $idu;?>" selected><?php echo $nombre." ".$apaterno." ".$amaterno;?></option>
										<?php
									}else{
										?>
										<option value="<?php echo $idu;?>"><?php echo $nombre." ".$apaterno." ".$amaterno;?></option>
										<?php
									}
								}
		                    	?>
								</select>
		                    </td>
		                </tr>
		            </table>
		        </div>
		    </div>
		</form>
		</div>
<?php
}if($tipo==2){
	$con = Conectarse();  
	$con1 = Conectarse();
	$sql="UPDATE os SET asignado='0'
	WHERE idmos='".$os."'";
	$sql2="UPDATE dataos SET tecnico_asignado_idu='0'
	WHERE id_orden='".$os."'";
	if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on OS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }

	echo "
	<script>
  		alert('MODIFICACION CORRECTA!');
	</script>";
	echo "<form name=form action=buscar.php method=GET>";
	echo "<input type=text name=dato value=".$os.">";
	echo "</form>";
	echo "<script language=javascript>document.form.submit();</script>"; 
}if($tipo==3){
	$con = Conectarse();  
	$con1 = Conectarse();
	/*$sql="UPDATE os SET asignado='0'
	WHERE idmos='".$os."'";*/
	$sql2="UPDATE dataos SET estatus='0',observaciones='',ddos='0',mmos='0',yearos='0',
	horaos='',principal='',secundario='',claro_video='',alfanumerico='',serie=''
	WHERE id_orden='".$os."'";
	/*if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on OS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }*/
	if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }

	echo "
	<script>
  		alert('MODIFICACION CORRECTA!');
	</script>";
	echo "<form name=form action=buscar.php method=GET>";
	echo "<input type=text name=dato value=".$os.">";
	echo "</form>";
	echo "<script language=javascript>document.form.submit();</script>"; 
}if($tipo==4){
	$con = Conectarse();  
	$con1 = Conectarse();
	$con2 = Conectarse();
	$sql="UPDATE os SET folio_pisa='0',usuario_idu='0',asignado='0' WHERE idmos='".$os."'";
	$sql2="UPDATE adjunto_os SET nombreimg='' WHERE os_idos='".$os."'";
	$sql3="UPDATE adjunto_os SET os_idos='0' WHERE nombreimg=''";
	if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on OS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }
	if ($con2->query($sql3) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con2, $sql3)) { printf("Errormessage: %s\n", mysqli_error($con2)); echo "<br>";} }
	echo "
	<script>
  		alert('MODIFICACION CORRECTA!');
  		document.location=('buscar.php'); 
	</script>";	
}
?>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>