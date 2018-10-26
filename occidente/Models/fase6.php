<?php
/**
* 
*/
class Fase6
{
	
	var $idfase6;
	var $filial_asignada;
	var $nombre_auxiliar;
	var $id_tecnico;
	var $file_os;
	var $fecha_fase6;
	var $id_venta;

	public function ingresarFase6($idfase6,$filial_asignada,$nombre_auxiliar,$id_tecnico,$file_os,$id_venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha_fase6=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->idfase6=$idfase6;
		$this->filial_asignada=$filial_asignada;
		$this->nombre_auxiliar=$nombre_auxiliar;
		$this->id_tecnico=$id_tecnico;
		$this->file_os=$file_os;
		$this->fecha_fase6=$fecha_fase6;
		$this->id_venta=$id_venta;
	}
	public function modTecnico($dato,$id,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE fase6 SET 
	        id_tecnico='$dato'
	        WHERE id_venta='".$id."'";
	        execute($sql) or die (mysqli_error($con));
	}
	public function obtenerFase6BD($id,$con){
		$sql1="SELECT * FROM fase6 WHERE id_venta='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idfase6=$row['idfase6'];
			$this->filial_asignada=$row['filial_asignada'];
			$this->nombre_auxiliar=$row['nombre_auxiliar'];
			$this->id_tecnico=$row['id_tecnico'];
			$this->file_os=$row['file_os'];
			$this->fecha_fase6=$row['fecha_fase6'];
			$this->id_venta=$row['id_venta'];
        }
	}
	public function obtenerFase6INBD($id,$con){
		$sql1="SELECT * FROM fase6 WHERE idfase6='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idfase6=$row['idfase6'];
			$this->filial_asignada=$row['filial_asignada'];
			$this->nombre_auxiliar=$row['nombre_auxiliar'];
			$this->id_tecnico=$row['id_tecnico'];
			$this->file_os=$row['file_os'];
			$this->fecha_fase6=$row['fecha_fase6'];
			$this->id_venta=$row['id_venta'];
        }
	}
	public function verFase6(){
		echo $this->idfase6."<br>";
		echo $this->filial_asignada."<br>";
		echo $this->nombre_auxiliar."<br>";
		echo $this->id_tecnico."<br>";
		echo $this->file_os."<br>";
		echo $this->fecha_fase6."<br>";
		echo $this->id_venta."<br>";
	}
	public function ultimaFse6($con){
		$tos=0;
		$con->real_query("SELECT * FROM fase6");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function registrarFase6BD($con){
		function reg($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO fase6 (
	    idfase6,filial_asignada,nombre_auxiliar,
	    id_tecnico,file_os,fecha_fase6,id_venta)
	    VALUES
	    ('".$this->idfase6."','".$this->filial_asignada."','".$this->nombre_auxiliar."',
	     '".$this->id_tecnico."','".$this->file_os."','".$this->fecha_fase6."','".$this->id_venta."'
	     )";
	    reg($sql) or die (mysqli_error($con)); 
	}
	public function regresaIdFse6(){return $this->idfase6;}
	public function regresaFilialAsignada(){return $this->filial_asignada;}
	public function regresaNombreAuxiliar(){return $this->nombre_auxiliar;}
	public function regresaIdTecnico(){return $this->id_tecnico;}
	public function regresaFileOs(){return $this->file_os;}
	public function regresaFechaFase6(){return $this->fecha_fase6;}
	public function regresaIdVenta(){return $this->id_venta;}
}
?>