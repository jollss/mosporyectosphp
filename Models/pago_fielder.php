<?php
/**
* 
*/
class pago_fielder
{
	var $gP1=0;
	
	function datos($inicio,$fin,$user,$con)
	{
		if(isset($inicio) and isset($fin)){
            $dia1 = date("d", strtotime($inicio));
            $mes1 = date("m", strtotime($inicio));
            $year1 = date("Y", strtotime($inicio));

            $dia2 = date("d", strtotime($fin));
            $mes2 = date("m", strtotime($fin));
            $year2 = date("Y", strtotime($fin));

            $tipos=$this->tipo_user($user,$con);
			$fechas=$this->array_fecha($user,$con);
			$j=count($fechas);
			?>
			<section class="col-md-12 lista" style="height:350px;overflow-y:scroll;">
			<table class="table">
                <tr>
                    <th>Solicitud</th>
                    <th>Cliente</th>
                    <th>SIAC</th>
                    <th>ETAPA</th>
                    <th>Fecha de venta</th>
                    <th>PAQUETE</th>
                </tr>
			<?php
			$contador=0;
			$paq1=0;$paq2=0;
			$paq3=0;$paq4=0;
			$paq5=0;$paq6=0;
			$paq7=0;$paq8=0;
			$paq9=0;$paq10=0;
			$paq11=0;$paq12=0;
			$paq13=0;$paq14=0;
			$paq15=0;$paq16=0;
			$paq17=0;$paq18=0;
			$paq19=0;
			for ($i=0; $i < $j; $i++) { 
				//17:49
				$idventa=$fechas[$i][0];
				$day=$fechas[$i][1];
				$month=$fechas[$i][2];
				$year=$fechas[$i][3];
				//echo $day."/".$month."/".$year;
				$start_date=$year1."-".$mes1."-".$dia1;
				$end_date=$year2."-".$mes2."-".$dia2;

				$fecha_a_evaluar=$year."-".$month."-".$day;

				if ($this->check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
					$venta=$this->array_venta($idventa,$con);
					//var_dump($venta);
					if($venta[46]=='P'){
					?>
						<tr>
							<td><?php echo $venta[1];?></td>
							<td><?php echo $venta[3]." ".$venta[4]." ".$venta[5];?></td>
							<td><?php echo $venta[41];?></td>
							<td><?php echo $venta[46];?></td>
							<td><?php echo $venta[12]."/".$venta[13]."/".$venta[14]." ".$venta[15];?></td>
							<td><?php echo $venta[24];?></td>
						</tr>
						<?php
							//$contador=$this->tabla_pagos($venta[24],$contador,$tipos);
							//$this->countPaquete($venta[24]);
							if($venta[24]=='RESIDENCIAL $333'){
								$paq1++;
							}if($venta[24]=='RESIDENCIAL $389'){
								$paq2++;
							}if($venta[24]=='RESIDENCIAL FRONTERA $389'){
								$paq3++;
							}if($venta[24]=='RESIDENCIAL $599'){
								$paq4++;
							}if($venta[24]=='RESIDENCIAL $999'){
								$paq5++;
							}if($venta[24]=='RESIDENCIAL PURO 10MB $349'){
								$paq6++;
							}if($venta[24]=='RESIDENCIAL PURO 20MB $499'){
								$paq7++;
							}if($venta[24]=='RESIDENCIAL PURO 50MB $649'){
								$paq8++;
							}if($venta[24]=='RESIDENCIAL PURO 100MB $899'){
								$paq9++;
							}if($venta[24]=='COMERCIAL $399'){
								$paq10++;
							}if($venta[24]=='COMERCIAL $549'){
								$paq11++;
							}if($venta[24]=='COMERCIAL $799'){
								$paq12++;
							}if($venta[24]=='COMERCIAL $1499'){
								$paq13++;
							}if($venta[24]=='COMERCIAL $1789'){
								$paq14++;
							}if($venta[24]=='COMERCIAL $2289'){
								$paq15++;
							}if($venta[24]=='COMERCIAL $404.84'){
								$paq16++;
							}if($venta[24]=='COMERCIAL RED $706.08'){
								$paq17++;
							}if($venta[24]=='COMERCIAL PREMIUM $1209.42'){
								$paq18++;
							}if($venta[24]=='COMERCIAL (Sin Internet) $899'){
								$paq19++;
							}
					}
					//if($venta[46]<>'P'){
					//}
				}
			}
			?>

            </table>
            </section>
            <section class="col-md-12 lista" style="height:130px;overflow-y:scroll;">
            	<!--<h3>Pago: $<?php echo $contador;?></h3>-->
            	<table class="table" border="2" >
            		<tr style="font-size:11px !important;">
            			<th>RESIDENCIAL $333</th>
            			<th>RESIDENCIAL $389</th>
            			<th>RESIDENCIAL FRONTERA $389</th>
						<th>RESIDENCIAL $599</th>
						<th>RESIDENCIAL $999</th>
						<th>RESIDENCIAL PURO 10MB $349</th>
						<th>RESIDENCIAL PURO 20MB $499</th>
						<th>RESIDENCIAL PURO 50MB $649</th>
						<th>RESIDENCIAL PURO 100MB $899</th>
						<th>COMERCIAL $399</th>
						<th>COMERCIAL $549</th>
						<th>COMERCIAL $799</th>
						<th>COMERCIAL $1499</th>
						<th>COMERCIAL $1789</th>
						<th>COMERCIAL $2289</th>
						<th>COMERCIAL $404.84</th>
						<th>COMERCIAL RED $706.08</th>
						<th>COMERCIAL PREMIUM $1209.42</th>
						<th>COMERCIAL (Sin Internet) $899</th>
            		</tr>
            		<tr style="font-size:15px !important;">
            			<td><?php echo $paq1;?></td>
            			<td><?php echo $paq2;?></td>
            			<td><?php echo $paq3;?></td>
            			<td><?php echo $paq4;?></td>
            			<td><?php echo $paq5;?></td>
            			<td><?php echo $paq6;?></td>
            			<td><?php echo $paq7;?></td>
            			<td><?php echo $paq8;?></td>
            			<td><?php echo $paq9;?></td>
            			<td><?php echo $paq10;?></td>
            			<td><?php echo $paq11;?></td>
            			<td><?php echo $paq12;?></td>
            			<td><?php echo $paq13;?></td>
            			<td><?php echo $paq14;?></td>
            			<td><?php echo $paq15;?></td>
            			<td><?php echo $paq16;?></td>
            			<td><?php echo $paq17;?></td>
            			<td><?php echo $paq18;?></td>
            			<td><?php echo $paq19;?></td>
            		</tr>
            	</table>
            </section>
			<?php
        }if(!isset($inicio) and !isset($fin)){
        	echo "SELECCIONA UN RANGO DE FECHAS";
        }
	}
	function tipo_user($user,$con){
		$sql4="SELECT * FROM usuario where idu='$user'";
        $resultado4=$con->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {
            $tipo=$row4['tipo_idtipo'];
        }
        return $tipo;
	}
	function countPaquete($paquete){
		//echo $paquete;		
		if($paquete=='RESIDENCIAL $333'){
			$contador=$contador+30.62;
		}if($paquete=='RESIDENCIAL $389'){
			$contador=$contador+81.72;
		}
		echo $contador;
//        return $tipo;
	}
	function array_fecha($user,$con){
		$array=array();
		$i=0;
		$sql4="SELECT * FROM venta where idvendedor='$user' order by idventa";
        $resultado4=$con->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {	
        	$idventa=$row4['idventa'];
            $dia=$row4['dia'];
            $mes=$row4['mes'];
            $year=$row4['year'];
            $i=count($array);
            array_push($array,array($idventa,$dia,$mes,$year));
        }
        return $array;
	}
	function tabla_pagos($paquete,$contador,$tipo){
		/*if($tipo==32){
			if($paquete=='RESIDENCIAL $333'){
				$contador=$contador+30.62;
			}if($paquete=='RESIDENCIAL $389'){
				$contador=$contador+81.72;
			}
		}*/
        return $contador;
	}
	function array_venta($idventa,$con){
		$array=array();
		$sql4="SELECT * FROM venta where idventa='$idventa' order by etapa";
        $resultado4=$con->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {	
        	$idventa=$row4['idventa'];
        	$folio_ventas=$row4['folio_ventas'];
        	$idvendedor=$row4['idvendedor'];
        	$nombrev=$row4['nombrev'];
        	$apaternov=$row4['apaternov'];
        	$amaternov=$row4['amaternov'];
        	$direccion=$row4['direccion'];
        	$datos=$row4['datos'];
        	$terminal=$row4['terminal'];
        	$telefono_1=$row4['telefono_1'];
        	$telefono_2=$row4['telefono_2'];
        	$telefono_3=$row4['telefono_3'];
        	$dia=$row4['dia'];
        	$mes=$row4['mes'];
        	$year=$row4['year'];
        	$hora=$row4['hora'];
        	$estatus=$row4['estatus'];
        	$vendedor=$row4['vendedor'];
        	$documentacion=$row4['documentacion'];
        	$area=$row4['area'];
        	$distrito=$row4['distrito'];
        	$rfc_cliente=$row4['rfc_cliente'];
        	$correo_cliente=$row4['correo_cliente'];
        	$tipo_cliente=$row4['tipo_cliente'];
        	$paquete_venta=$row4['paquete_venta'];
        	$longitud=$row4['longitud'];
        	$latitud=$row4['latitud'];
        	$contesto=$row4['contesto'];
        	$id_user=$row4['id_user'];
        	$fecha_fielder=$row4['fecha_fielder'];
        	$cliente=$row4['cliente'];
        	$atiende=$row4['atiende'];
        	$servicio=$row4['servicio'];
        	$paquete=$row4['paquete'];
        	$direccion_v=$row4['direccion_v'];
        	$colonia=$row4['colonia'];
        	$municipio=$row4['municipio'];
        	$cp=$row4['cp'];
        	$gastos_instalacion=$row4['gastos_instalacion'];
        	$tiempo_instalacion=$row4['tiempo_instalacion'];
        	$observaciones=$row4['observaciones'];
        	$folio_siac=$row4['folio_siac'];
        	$fecha_siac=$row4['fecha_siac'];
        	$tienda_comercial=$row4['tienda_comercial'];
        	$tel_asignado=$row4['tel_asignado'];
        	$folio_os=$row4['folio_os'];
        	$etapa=$row4['etapa'];
        	$listo_ps=$row4['listo_ps'];
        	$fecha_comercial=$row4['fecha_comercial'];
        	$venta_pagada=$row4['venta_pagada'];
        	$fecha_pago=$row4['fecha_pago'];
        	$pago_por=$row4['pago_por'];
            array_push($array,
            	$idventa,$folio_ventas,$idvendedor,
	        	$nombrev,$apaternov,$amaternov,
	        	$direccion,$datos,$terminal,
	        	$telefono_1,$telefono_2,$telefono_3,
	        	$dia,$mes,$year,$hora,
	        	$estatus,$vendedor,$documentacion,
	        	$area,$distrito,$rfc_cliente,
	        	$correo_cliente,$tipo_cliente,$paquete_venta,
	        	$longitud,$latitud,$contesto,
	        	$id_user,$fecha_fielder,$cliente,
	        	$atiende,$servicio,$paquete,
	        	$direccion_v,$colonia,$municipio,
	        	$cp,$gastos_instalacion,$tiempo_instalacion,
	        	$observaciones,$folio_siac,$fecha_siac,
	        	$tienda_comercial,$tel_asignado,$folio_os,
	        	$etapa,$listo_ps,$fecha_comercial,
	        	$venta_pagada,$fecha_pago,$pago_por
            );
            /*
            array_push($array,array(
            	$idventa,$folio_ventas,$idvendedor,
	        	$nombrev,$apaternov,$amaternov,
	        	$direccion,$datos,$terminal,
	        	$telefono_1,$telefono_2,$telefono_3,
	        	$dia,$mes,$year,$hora,
	        	$estatus,$vendedor,$documentacion,
	        	$area,$distrito,$rfc_cliente,
	        	$correo_cliente,$tipo_cliente,$paquete_venta,
	        	$longitud,$latitud,$contesto,
	        	$id_user,$fecha_fielder,$cliente,
	        	$atiende,$servicio,$paquete,
	        	$direccion_v,$colonia,$municipio,
	        	$cp,$gastos_instalacion,$tiempo_instalacion,
	        	$observaciones,$folio_siac,$fecha_siac,
	        	$tienda_comercial,$tel_asignado,$folio_os,
	        	$etapa,$listo_ps,$fecha_comercial,
	        	$venta_pagada,$fecha_pago,$pago_por
            ));*/
        }
        return $array;
	}
	function check_in_range($start_date, $end_date, $evaluame) {
	    $start_ts = strtotime($start_date);
	    $end_ts = strtotime($end_date);
	    $user_ts = strtotime($evaluame);
	    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}	
	function gananciaPQT($cantidad,$gPQTK){
		
			$this->$gP1=($cantidad*$gPQT);
		
	}
}
?>