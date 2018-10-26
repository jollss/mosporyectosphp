<?php
/**
* 
*/
class svasignaciones
{
function revisa($iduser,$con,$conex)	{
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
              $contador_ventas=$contador_ventas+1;
                $sql="UPDATE contador_fielder 
                SET fecha_referenciauno='$dates',semana='$semana',contador_ventas='$contador_ventas' 
                WHERE id_usuarios='$iduser'";
echo $sql."<br>";
                if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
            }if(!isset($id_usuarios)){
                //ingresa
                date_default_timezone_set('America/Mexico_City');
              $dia=date('j');
              $mes=date('n');
              $aaaa=date('Y');
              $semana=date('W');
                $sql="INSERT INTO contador_fielder (
                id_usuarios,contador_asignado,contador_ventas,fecha_referenciauno,semana,mes)
                VALUES
                ('".$iduser."',0,1,'".$dia."/".$mes."/".$aaaa."',".$semana.",".$mes.")";
                if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
            }
}
}
?>