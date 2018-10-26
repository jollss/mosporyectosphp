<?php
/**
* 
*/
class Vacantes
{

	function TotalVacantes($bd){
		$sql="SELECT * FROM vacantes";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $resultado = $query->fetchAll();
	    return $resultado;
	}
	function ObtenerVacante($bd,$idzona){
		$sql="SELECT * FROM vacantes WHERE idzona='$idzona' and num_vacantes!=0";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $resultado = $query->fetchAll();
	    return $resultado;
	}
	function RegistrarVacante($bd,$data,$id){
		$sql="INSERT INTO vacantes(idzona,zona,puesto,num_vacantes) 
		VALUES ('".$id."','".strtoupper($data['zona'])."','".strtoupper($data['puesto'])."',
		'".strtoupper($data['vacantes'])."')";
	    $query = $bd->prepare($sql);
	    $query->execute();
	}
	function EliminarVacante($bd,$id){
		$sql="UPDATE vacantes SET num_vacantes=0 WHERE idzona='$id'";
	    $query = $bd->prepare($sql);
	    $query->execute();
	}
}
?>