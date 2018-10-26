<?php
function tipo_pago($paquete,$tipo_user,$neto,$asignado){

	//$neto=0;
	if($paquete=='RESIDENCIAL $389'){
		if($tipo_user==21){//promotor
			$neto=$neto+200;
		}if($tipo_user==24){//superv
			$neto=$neto+50;
			/*
			Si asignado 
			*/
		}if($tipo_user==32){//lider
			$neto=$neto+50;
		}
	}
	return $neto;
}
function contador_paquete($paquete,$total){
	/*
	$co = Conectarse();
    $sq="SELECT * FROM equipos_fielder inner join usuario inner join tipo inner join areas_fielder inner join venta
    WHERE id_area=idarea and idvendedor='$personal' AND idvendedor=idu
    and idu=id_fielder and idtipo=tipo_idtipo ORDER BY tipo_idtipo DESC";
    $res=$co->query($sq);
    while($r = $res->fetch_assoc())
    {
        $n=$row3['nombre'];
        $ap=$row3['apaterno'];
        $nom_area=$row3['nom_area'];
        $tipo=$row3['tipo_idtipo'];
        $asignado=$row3['asignado'];
    }
    */
	//$neto=0;
	if($paquete=='RESIDENCIAL $389'){
		$total=$total+1;
	}
	return $total;
}
?>