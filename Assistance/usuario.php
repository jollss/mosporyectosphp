<?php
/**
* Clase modelo para usuarios
*/
class Usuario
{
	public function obtenerUnRegistro($bd,$id){
		$sql="SELECT * FROM usuario WHERE idu='$id'";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    return $array;
	}
}
?>