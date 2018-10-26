<?php
include("Config/conexion.php"); 
include("Config/conexion2.php"); 
$con = Conectarse();
function ejecutar($sql,$conex){
	if ($conex->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($conex, $sql)) { printf("Errormessage: %s\n", mysqli_error($conex)); echo "<br>"; } }
}
/*=======================================================================================================================================*/
$folio_pisa=$_GET['folio_p'];
/*=======================================================================================================================================*/
if(!isset($folio_pisa)){
	echo "INGRESAR FOLIO PISA PARA QUITAR ASIGNACION...";
	?>
	<form action="quitar_asignacion.php" method="GET">
    	<input type="submit" value="FOLIO PISA">
    	<input type="text" value='0' name="si" style="display:none;">
    	<input type="text" value='0' name="folio_p" style="">
    </form>
    <?php
}else{
	$si=$_GET['si'];
    echo "==================ORDEN=================================<BR>";
	    $sql="SELECT * FROM os WHERE folio_pisa='$folio_pisa'";
	    $resultado=$con->query($sql);
	    while($row = $resultado->fetch_assoc())
	    {
	    	$idmos=$row['idmos'];
			$folio_pisaplex=$row['folio_pisaplex'];
			$folio_pisa=$row['folio_pisa'];
			$usuario_idu=$row['usuario_idu'];
			$asignado=$row['asignado'];
			$estado_os=$row['estado_os'];
	    }
	    echo "
	    idmos: <b>".$idmos."</b><br> 
	    folio_pisa: <b>".$folio_pisa."</b><br>
	    folio pisaplex: ".$folio_pisaplex."<br>
	    usuario idu: ".$usuario_idu."<br>
	    asignado: ".$asignado."<br>
	    estado de la orden(0 abierta 1 cerrada) : ".$estado_os."<br>
	    ";
    echo "==================CANTIDADES=================================<BR>";
	    $sql1="SELECT * FROM cantidades WHERE usuario_idu='$asignado'";
	    $resultado=$con->query($sql1);
	    while($row = $resultado->fetch_assoc())
	    {
	    	$cobre=$row['cobre'];
			$fibra=$row['fibra'];
			$hibrida=$row['hibrida'];
			$tecnica=$row['tecnica'];
			$voz=$row['voz'];
			$psr=$row['psr'];
	    }
	    echo "
	    COBRE: ".$cobre."<br> 
	    FIBRA: ".$fibra."<br>
	    HIBRIDA: ".$hibrida."<br>
	    TECNIA: ".$tecnica."<br>
	    VOZ: ".$voz."<br>
	    PSR: ".$psr."<br>
	    ";
   	echo "==================CANTIDADES=================================<BR>";
	   	$sql1="SELECT * FROM dataos WHERE id_orden='$idmos'";
	    $resultado=$con->query($sql1);
	    while($row = $resultado->fetch_assoc())
	    {
	    	$iddataos=$row['iddataos'];
			$supervisor_idu=$row['supervisor_idu'];
			$tecnico_asignado_idu=$row['tecnico_asignado_idu'];
			$estatus=$row['estatus'];
			$tipo_os=$row['tipo_os'];
			$id_orden=$row['id_orden'];
	    }
	    echo "
	    Id de dataos: ".$iddataos."<br> 
	    Supervisor: ".$supervisor_idu."<br>
	    tecnico: ".$tecnico_asignado_idu."<br>
	    estatus: ".$estatus."<br>
	    id mos: ".$id_orden."<br>
	    TIPO DE ORDEN: <b>".$tipo_os."</b><br>
	    ";
    echo "======================================================CONFIRMACION=================================<BR>";
    echo " Ordenes iguales?<b>".$idmos."  ==  ".$id_orden."</b><br>";
    echo " Supervisores iguales?<b>".$usuario_idu."  ==  ".$supervisor_idu."</b><br>";
    echo " Tecnicos iguales?<b>".$asignado."  ==  ".$tecnico_asignado_idu."</b><br>";
    ?>
    <form action="quitar_asignacion.php" method="GET">
    	<input type="submit" value="QUITAR ASIGNACION">
    	<input type="text" value='1' name="si" style="display:none;">
    	<input type="text" value='<?php echo $folio_pisa;?>' name="folio_p" style="display:;">
    </form>
    <form action="quitar_asignacion.php" method="GET">
    	<input type="submit" value="CANCELAR">
    	<input type="text" value='0' name="si" style="display:none;">
    	<input type="text" value='0' name="folio_p" style="display:none;">
    </form>
    <?php
    if(!isset($si)){
		echo "SIN CONFIRMAR";
	}if(isset($si) or $si==1){
		//echo $si;
		$con = Conectarse();
		if($tipo_os=='COBRE'){
	      $sql="UPDATE cantidades SET 
	        cobre=cobre-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    if($tipo_os=='FIBRA'){
	      $sql="UPDATE cantidades SET 
	        fibra=fibra-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    if($tipo_os=='HIBRIDA'){
	      $sql="UPDATE cantidades SET 
	        hibrida=hibrida-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    if($tipo_os=='VOZ'){
	      $sql="UPDATE cantidades SET 
	        voz=voz-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    if($tipo_os=='PSR'){
	      $sql="UPDATE cantidades SET 
	        psr=psr-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    if($tipo_os=='TECNICA'){
	      $sql="UPDATE cantidades SET 
	        tecnica=tecnica-1
	        WHERE usuario_idu='".$asignado."'";
	        ejecutar($sql,$con);
	    }
	    $sql="UPDATE os SET 
	        asignado=0
	        WHERE idmos='".$idmos."'";
	    ejecutar($sql,$con);
	    $n=0;
	    
	    echo "----------------------------------------------------------------------------------------------------------------------------------<br>";
		    echo "==================ORDEN=================================<BR>";
			    $sql="SELECT * FROM os WHERE folio_pisa='$folio_pisa'";
			    $resultado=$con->query($sql);
			    while($row = $resultado->fetch_assoc())
			    {
			    	$idmos=$row['idmos'];
					$folio_pisaplex=$row['folio_pisaplex'];
					$folio_pisa=$row['folio_pisa'];
					$usuario_idu=$row['usuario_idu'];
					$asignado=$row['asignado'];
					$estado_os=$row['estado_os'];
			    }
			    echo "
			    idmos: <b>".$idmos."</b><br> 
			    folio_pisa: <b>".$folio_pisa."</b><br>
			    folio pisaplex: ".$folio_pisaplex."<br>
			    usuario idu: ".$usuario_idu."<br>
			    asignado: ".$asignado."<br>
			    estado de la orden(0 abierta 1 cerrada) : ".$estado_os."<br>
			    ";
		    echo "==================CANTIDADES=================================<BR>";
			    $sql1="SELECT * FROM cantidades WHERE usuario_idu='$tecnico_asignado_idu'";
			    $resultado=$con->query($sql1);
			    while($row = $resultado->fetch_assoc())
			    {
			    	$cobre=$row['cobre'];
					$fibra=$row['fibra'];
					$hibrida=$row['hibrida'];
					$tecnica=$row['tecnica'];
					$voz=$row['voz'];
					$psr=$row['psr'];
			    }
			    echo "
			    COBRE: ".$cobre."<br> 
			    FIBRA: ".$fibra."<br>
			    HIBRIDA: ".$hibrida."<br>
			    TECNIA: ".$tecnica."<br>
			    VOZ: ".$voz."<br>
			    PSR: ".$psr."<br>
			    ";
		   	echo "==================CANTIDADES=================================<BR>";
			   	$sql1="SELECT * FROM dataos WHERE id_orden='$idmos'";
			    $resultado=$con->query($sql1);
			    while($row = $resultado->fetch_assoc())
			    {
			    	$iddataos=$row['iddataos'];
					$supervisor_idu=$row['supervisor_idu'];
					$tecnico_asignado_idu=$row['tecnico_asignado_idu'];
					$estatus=$row['estatus'];
					$tipo_os=$row['tipo_os'];
					$id_orden=$row['id_orden'];
			    }
			    echo "
			    Id de dataos: ".$iddataos."<br> 
			    Supervisor: ".$supervisor_idu."<br>
			    tecnico: ".$tecnico_asignado_idu."<br>
			    estatus: ".$estatus."<br>
			    id mos: ".$id_orden."<br>
			    TIPO DE ORDEN: <b>".$tipo_os."</b><br>
			    ";
		    echo "======================================================CONFIRMACION=================================<BR>";
		    $sql="UPDATE dataos SET 
	        tecnico_asignado_idu=0
	        WHERE id_orden='".$idmos."'";
	    	ejecutar($sql,$con);
		    echo " Ordenes iguales?<b>".$idmos."  ==  ".$id_orden."</b><br>";
		    echo " Supervisores iguales?<b>".$usuario_idu."  ==  ".$supervisor_idu."</b><br>";
		    echo " Tecnico removido?<b>".$asignado."  ==  ".$tecnico_asignado_idu."</b><br>";
	}
}
?>