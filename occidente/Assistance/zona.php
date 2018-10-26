<?php
/**
* 
*/
class Zona
{
	
	public function obtenerZona($bd,$name){
		$sql="SELECT * FROM zona_check WHERE nombre_zona='$name'";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    //$resultado = count($idu);
	    //$resultado= $resultado+1;
	    return $array;
	}
	public function obtenerZonaxID($bd,$id){
		$sql="SELECT * FROM zona_check WHERE idzona='$id'";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    //$resultado = count($idu);
	    //$resultado= $resultado+1;
	    return $array;
	}
	public function obtenerTotaldeZona($bd){
		$sql="SELECT * FROM zona_check";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $ttl = $query->fetchAll();
	    $resultado = count($ttl);
	    $resultado= $resultado+1;
	    return $resultado;
	}
	public function obtenerZonaFull($bd){
		$sql="SELECT * FROM zona_check";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    //$resultado = count($idu);
	    //$resultado= $resultado+1;
	    return $array;
	}
	public function registrarZona($bd,$data){
		//var_dump($data);
		$sql = "INSERT INTO zona_check (idzona,nombre_zona)
		VALUES ('".$data['idzona']."','".$data['nombre_zona']."')";
	    $query = $bd->prepare($sql);
	    $query->execute();
	}
}
?>