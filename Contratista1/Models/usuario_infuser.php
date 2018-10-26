<?php
/**
* 
*/
class Usuario_infuser 
{
	var $nombre;
	var $correo;
	var $tipo;
	var $idu;
	var $estado;
	var $tipo_personal;

	public function listUsuarioRh($con){
		$con->real_query("SELECT * FROM usuario INNER JOIN tipo 
        WHERE activo=1 AND usuario.tipo_idtipo=tipo.idtipo AND idtipo<>5 ORDER BY nombre");
     	$resultado = $con->use_result();
     	while ($row = $resultado->fetch_assoc()){
     		$this->nombre=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
     		$this->correo=$row['correo'];
     		$this->tipo=$row['tipo'];
     		$this->idu=$row['idu'];
     		$this->estado=$row['activo'];
     		$this->tipo_personal=$row['tipo_personal'];
     	}
	}
	public function TotalUsuarioRh($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT * FROM usuario INNER JOIN tipo 
        WHERE activo=1 AND usuario.tipo_idtipo=tipo.idtipo AND idtipo<>5 ORDER BY nombre"))
        {
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $idu=$row_cnt;
	}
	public function verConsulta(){
		echo $this->nombre;
		echo $this->correo;
		echo $this->tipo;
		echo $this->idu;
		echo $this->estado;
		echo $this->tipo_personal;
	}
	public function regresaNombre(){return $this->nombre;}
	public function regresaCorreo(){return $this->correo;}
	public function regresaTipo(){return $this->tipo;}
	public function regresaIdu(){return $this->idu;}
	public function regresaEstado(){return $this->estado;}
	public function regresaTipoPersonal(){return $this->tipo_personal;}
}
?>