<?php
/**
* 
*/
class AsignacionBajante
{
	
	var $id_asignacion;
	var $id_supervisor;
	var $fecha_asignacion;
	var $id_venta;
	public function verAsignacion(){
		echo $this->id_asignacion."<br>";
		echo $this->id_supervisor."<br>";
		echo $this->fecha_asignacion."<br>";
		echo $this->id_venta."<br>";
	}
	public function obtenerId($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT id_asignacion FROM asignacion_cobajante ORDER BY id_asignacion")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	}
	public function ingresaAsignacion($id_asignacion,$id_supervisor,$id_venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha_asignacion=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
		$this->id_asignacion=$id_asignacion;
		$this->id_supervisor=$id_supervisor;
		$this->fecha_asignacion=$fecha_asignacion;
		$this->id_venta=$id_venta;
	}
	public function registroAsignacionBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		  $sql="INSERT INTO asignacion_cobajante (
          id_asignacion,id_supervisor,fecha_asignacion,id_venta)
          VALUES
          ('".$this->id_asignacion."','".$this->id_supervisor."','".$this->fecha_asignacion."','".$this->id_venta."'
            )"; 
          execute($sql) or die (mysqli_error($con)); 
	}
	public function obtenerAsignacionBD($id,$con){
		$sql1="SELECT * FROM asignacion_cobajante WHERE id_venta='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_asignacion=$row['id_asignacion'];
         	$this->id_supervisor=$row['id_supervisor'];
         	$this->fecha_asignacion=$row['fecha_asignacion'];
         	$this->id_venta=$row['id_venta'];
        }
	}
	public function regresaIdAsignacion(){return $this->id_asignacion;}
	public function regresaIdSupervisor(){return $this->id_supervisor;}
	public function regresaFechaAsignacion(){return $this->fecha_asignacion;}
	public function regresaIdVenta(){return $this->id_venta;}
}
?>