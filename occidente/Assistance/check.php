<?php
/**
* 
*/
class Check
{
	
	public function obtenerUnRegistro($bd,$id){
		$sql="SELECT * FROM registros WHERE idreg='$id'";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    //$resultado = count($idu);
	    //$resultado= $resultado+1;
	    return $array;
	}
	public function obtenerTotaldeRegsitros($bd){
		$sql="SELECT * FROM registros";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $ttl = $query->fetchAll();
	    $resultado = count($ttl);
	    $resultado= $resultado+1;
	    return $resultado;
	}
	public function obtenerRegistros($bd){
		$sql="SELECT * FROM registros";
	    $query = $bd->prepare($sql);
	    $query->execute();
	    $array = $query->fetchAll();
	    //$resultado = count($idu);
	    //$resultado= $resultado+1;
	    return $array;
	}
	public function registrarRegistros($bd,$data){
		//var_dump($data);
		$sql = "INSERT INTO registros (idreg,usuario, fecha,fecha_reg,imagen,tipo,location)
		VALUES ('".$data['id']."','".$data['usuario']."', '".$data['fecha']."', '".$data['fecha_reg']."', '".$data['imagen']."', '".$data['tipo']."', '".$data['location']."')";
	    $query = $bd->prepare($sql);
	    $query->execute();
	}
}
?>