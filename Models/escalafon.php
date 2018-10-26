<?php
/**
* 
*/
class escalafon
{
	
	function verifica($iduser,$tipo,$conex,$con){
		$tiene="SELECT * FROM contador_fielder WHERE id_usuarios='$iduser'";
            $res=$conex->query($tiene);
            while($data = $res->fetch_assoc())
            {
              $id_usuarios=$data['id_usuarios'];
              $contador_asignado=$data['contador_asignado'];
              $contador_ventas=$data['contador_ventas'];
              $fecha_referenciauno=$data['fecha_referenciauno'];
              $fecha_referenciauno=$data['fecha_referenciauno'];
            }
            if(isset($id_usuarios)){
                //actualiza
              date_default_timezone_set('America/Mexico_City');
              $dia=date('j');
              $mes=date('n');
              $aaaa=date('Y');
              $semana=date('W');
              $dates=$dia."/".$mes."/".$aaaa;
              if($contador_ventas>=30 and $contador_asignado>=3){
              	if($tipo==21){//promotor
              		$sql="UPDATE usuario 
		            SET tipo_idtipo='24'
		            WHERE idu='$iduser'";
		            if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
              	}if($tipo==24){//supervisor
              		$sql="UPDATE usuario 
		            SET tipo_idtipo='34'
		            WHERE idu='$iduser'";
		            if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

              	}
              }
              /*
              $contador_ventas=$contador_ventas+1;
                $sql="UPDATE contador_fielder 
                SET fecha_referenciauno='$dates',semana='$semana',contador_ventas='$contador_ventas' 
                WHERE id_usuarios='$iduser'";
                if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
                */
            }if(!isset($id_usuarios)){
            }
	}
}
?>