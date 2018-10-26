<?php
/**
* 
*/
class AreaFielder
{

	public function obtenerAreaF($idu,$con){
		$sql1="SELECT * FROM areas_fielder WHERE idarea='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
         	$data = array($row['idarea'], $row['nom_area']);		
        }
        return $data;
	}
	public function obtenerAreaF($idu,$con){
		$sql1="SELECT * FROM areas_fielder WHERE idarea='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
         	$data = array($row['idarea'], $row['nom_area']);		
        }
        return $data;
	}
}
?>