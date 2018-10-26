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

<?php
    
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>  
</head>
<body>
<br><br><br><br>
<div class="col-md-3"></div>
<div class="col-md-6" align="center">
	<table border="0">
		<tr>
		<form action="pagos.php" method="GET">
			<th>
				<label>MES</label>
				<input class="form-control" type="number" min=0 max=12 name="mes" value="<?php echo $mes;?>">
			</th>
			<th>
				<label>AÑO</label>
				<input class="form-control" type="number" min=2000 max=3000 name="anio" value="<?php echo $aaaa;?>">
			</th>
			<th>
				<label>ORDENAR</label>
				<select name="option_search" class="form-control">
					<option value="1">FOLIO PISA</option>
					<option value="2">SUPERVISOR</option>
					<option value="3">TIPO DE ORDEN</option>
					<option value="4">TECNICO</option>
				</select>
			</th>
			<th>
				<button type="submit" class="btn btn-primary">
					BUSCAR
				</button>
			</th>
		</form>
		</tr>
	</table>
</div>
<div class="col-md-3"></div>
<div class="col-md-12">
<?php
$mes=date('n');
$aaaa=date('Y');
//$sql="SELECT * FROM os inner join dataos where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";
 	if(!isset($_GET['mes']) and !isset($_GET['anio'])){
    	$mes=date('n');
    	$aaaa=date('Y');
    	$sql="SELECT * FROM os inner join dataos where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 ORDER BY folio_pisa ASC,mmos DESC, yearos DESC, ddos DESC";
    }if(isset($_GET['mes']) and isset($_GET['anio']) and isset($_GET['option_search'])){
    	$mes=$_GET['mes'];
    	$aaaa=$_GET['anio'];
    	$opcion=$_GET['option_search'];
    	if($opcion==1){//folio pisa
    		$sql="SELECT * FROM os inner join dataos 
	    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
	    	ORDER BY folio_pisa ASC,mmos DESC, yearos DESC, ddos DESC";
    	}if($opcion==2){//sUPERVISOR
    		$sql="SELECT * FROM os inner join dataos 
	    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
	    	ORDER BY supervisor_idu ASC,mmos DESC, yearos DESC, ddos DESC";
    	}if($opcion==3){//TIPO DE ORDEN
    		$sql="SELECT * FROM os inner join dataos 
	    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
	    	ORDER BY tipo_os ASC,mmos DESC, yearos DESC, ddos DESC";
    	}
    	if($opcion==4){//TECNICO
    		$sql="SELECT * FROM os inner join dataos 
	    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
	    	ORDER BY asignado ASC,mmos DESC, yearos DESC, ddos DESC";
    	}
    }if(isset($_GET['mes']) and isset($_GET['anio']) and isset($_GET['option_search']) and isset($_GET['validar'])){
    	$mes=$_GET['mes'];
    	$aaaa=$_GET['anio'];
    	$opcion=$_GET['option_search'];
    	$folio_pisav=$_GET['validar'];
        $dia=date('j');
        $mes1=date('n');
        $aaaa=date('Y');
        $hora=date('G');
        $min=date('i');
        $time=$hora.":".$min;
        $fecha_super=$dia."/".$mes1."/".$aaaa." ".$time;
        $con2 = Conectarse();
        $sql2="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisav'";
        $resultado2=$con2->query($sql2);
        while($row2 = $resultado2->fetch_assoc())
        {
        	$a1=$row2['fecha_sup'];
        	$a2=$row2['fecha_calidad'];
        	$a3=$row2['fecha_coordinador'];
        }
        if(isset($a1)){
        	//echo "SI ESTA: ".$folio_pisav."<br>";
        	$sql="UPDATE validar_os SET fecha_cobranza='$fecha_super', a_cobro=1 WHERE id_folio_pisa='".$folio_pisav."'";
	        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	        if($opcion==1){//folio pisa
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY folio_pisa ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==2){//sUPERVISOR
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY supervisor_idu ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==3){//TIPO DE ORDEN
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY tipo_os ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==4){//TECNICO
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY asignado ASC,mmos DESC, yearos DESC, ddos DESC";
	    	} 
	    	echo "<script> document.location=('pagos.php?mes=".$mes."&anio=".$aaaa."&option_search=1'); </script>"; 
        }if(!isset($a1)){
        	//echo "NO ESTA: ".$folio_pisav."<br>";
        	//$fecha_super=$dia."/".$mes."/".$aaaa." ".$time;
        	//echo $fecha_super;
        	$sql="INSERT INTO validar_os (id_folio_pisa,fecha_cobranza,a_cobro)
		    VALUES('".$folio_pisav."','".$fecha_super."','1')";
		    //echo $sql;
			if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
			if($opcion==1){//folio pisa
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY folio_pisa ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==2){//sUPERVISOR
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY supervisor_idu ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==3){//TIPO DE ORDEN
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY tipo_os ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}if($opcion==4){//TECNICO
	    		$sql="SELECT * FROM os inner join dataos 
		    	where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 
		    	ORDER BY asignado ASC,mmos DESC, yearos DESC, ddos DESC";
	    	}
	    	echo "<script> document.location=('pagos.php?mes=".$mes."&anio=".$aaaa."&option_search=1'); </script>"; 
        }

    }
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
        	Ordenes a validar <h4>POR PAGAR</h4>
        	<br>
        	<h3>Para realizar una busqueda presiona CTRL + F y coloca el folio pisa que requieres.</h3>
        </div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                    	<td></td>
                    	<td></td>
                        <td>FOLIO PISA</td>
                        <td>FECHA DE CIERRE</td>
                        <td>SUPERVISOR</td>
                        <td>TECNICO</td>
                        <td>TIPO DE ORDEN</td>
                        <td>PAGAR</td>
                    </tr>
                    <?php
                    	$contar=0;
				        $con1 = Conectarse();
//				        $sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";
				        //$sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 and mmos=10 and ddos=19 ORDER BY mmos DESC, yearos DESC, ddos DESC";
				        $resultado=$con1->query($sql);
				        while($row = $resultado->fetch_assoc())
				        {
				        	$idmos=$row['idmos'];
				        	$folio_pisa=$row['folio_pisa'];
				        	$tipo_os=$row['tipo_os'];
				        	$ddos=$row['ddos'];
				        	$mmos=$row['mmos'];
				        	$yearos=$row['yearos'];
				        	$horaos=$row['horaos'];
				        	$supervisor_idu=$row['supervisor_idu'];
				        	$tecnico_asignado_idu=$row['tecnico_asignado_idu'];
				        	?>

				        	<?php
				        	$con2 = Conectarse();
					        $sql2="SELECT * FROM usuario WHERE idu='$supervisor_idu'";
					        $resultado2=$con2->query($sql2);
					        while($row2 = $resultado2->fetch_assoc())
					        {
					        	$noms=$row2['nombre'];
					        	$apats=$row2['apaterno'];
					        	$amats=$row2['amaterno'];
					        }
					        $con3 = Conectarse();
					        $sql3="SELECT * FROM usuario WHERE idu='$tecnico_asignado_idu'";
					        $resultado3=$con3->query($sql3);
					        while($row3 = $resultado3->fetch_assoc())
					        {
					        	$nomt=$row3['nombre'];
					        	$apatt=$row3['apaterno'];
					        	$amatt=$row3['amaterno'];
					        }
					        if($folio_pisa=='' or $folio_pisa=='0'){
					        }else{
					        	//echo $folio_pisa."- ";
					        	?>
					        	<tr>
					        		
				        			<?php
				        			$con4 = Conectarse();
							        $sql4="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisa'";
							        $resultado4=$con4->query($sql4);
							        while($row4 = $resultado4->fetch_assoc())
							        {
							        	$fecha_sup=$row4['fecha_sup'];
							        	$fecha_calidad=$row4['fecha_calidad'];
							        	$fecha_coordinador=$row4['fecha_coordinador'];
							        	$fecha_cobranza=$row4['fecha_cobranza'];
							        	$a_cobro=$row4['a_cobro'];
							        }
							        if(!isset($fecha_cobranza) or $fecha_cobranza==''){
							        $contar=$contar+1; 
							        	?>	
							        		<td><?php echo $contar;?></td>
							        		<td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $idmos;?>" value="<?php echo $folio_pisa;?>">VER</button></td>
							        		<!--<td><button type="button" class="btn btn-success openBtn" data-id="<?php echo $idmos;?>" id="idmos">Open Modal</button></td>-->
							        		<td><?php echo $folio_pisa;?></td>
							        		<td><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></td>
							        		<td><?php echo $noms." ".$apats." ".$amats;?></td>
							        		<td><?php echo $nomt." ".$apatt." ".$amatt;?></td>
							        		<td><?php echo $tipo_os;?></td>
							        		<td>
							        		<form action="pagos.php" method="GET">
							        			<input type="hidden" value="<?php echo $mes;?>" name="mes">	
							        			<input type="hidden" value="<?php echo $aaaa;?>" name="anio">	
							        			<input type="hidden" value="<?php echo $opcion;?>" name="option_search">	
							        			<input type="hidden" value="<?php echo $folio_pisa;?>" name="validar">	
							        			<button class="glyphicon glyphicon-thumbs-down btn btn-danger" type="submit">
							        			</button>
						        			</form>
							        			<!--<span class="glyphicon glyphicon-thumbs-down btn btn-danger" aria-hidden="true" title="Sin definir"></span>-->
							        		</td><?php
							        }
							        /*
							        if(isset($fecha_cobranza) and $fecha_cobranza<>''){ 
							        	?><td><span class="glyphicon glyphicon-thumbs-up btn btn-success" aria-hidden="true" title="<?php echo $fecha_cobranza;?>"></span></td><?php 
							        }*/
							        unset($fecha_sup);
							        unset($fecha_calidad);
							        unset($fecha_coordinador);
							        unset($fecha_cobranza);
				        			?>
					        	</tr>	
					        	<?php
					        	
				        	}
				        }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-md-12" align="center">
          	<!--<label>TOTAL: <?php echo $contar;?></label>-->
        </div>
    </div>
</div>				  

</body>
</html>