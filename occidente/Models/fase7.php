<?php
/**
* 
*/
class Fase7
{
	
	var $idfase7;
	var $estatus;
	var $observaciones;
	var $fecha_fase7;
	var $id_venta;

	function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
	public function ingresarfase7($idfase7,$estatus,$observaciones,$id_venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha_fase7=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->idfase7=$idfase7;
		$this->estatus=$estatus;
		$this->observaciones=$observaciones;
		$this->fecha_fase7=$fecha_fase7;
		$this->id_venta=$id_venta;
	}
	public function obtenerfase7BD($id,$con){
		$sql1="SELECT * FROM fase7 WHERE id_venta='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idfase7=$row['idfase7'];
			$this->estatus=$row['estatus'];
			$this->observaciones=$row['observaciones'];
			$this->fecha_fase7=$row['fecha_fase7'];
			$this->id_venta=$row['id_venta'];
        }
	}
	public function modEstatus($dato,$id,$con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
		$sql="UPDATE fase7 SET 
	        estatus='$dato'
	        WHERE id_venta='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function verfase7(){
		echo $this->idfase7."<br>";
		echo $this->estatus."<br>";
		echo $this->observaciones."<br>";
		echo $this->fecha_fase7."<br>";
		echo $this->id_venta."<br>";
	}
	public function ultimaFase7($con){
		$tos=0;
		$con->real_query("SELECT * FROM fase7");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function registrarfase7BD($con){		
		$sql="INSERT INTO fase7 (
	    idfase7,estatus,observaciones,
	    fecha_fase7,id_venta)
	    VALUES
	    ('".$this->idfase7."','".$this->estatus."','".$this->observaciones."',
	     '".$this->fecha_fase7."','".$this->id_venta."'
	     )";
	    $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function regresaIdFse7(){return $this->idfase7;}
	public function regresaEstatus(){return $this->estatus;}
	public function regresaObservaciones(){return $this->observaciones;}
	public function regresaFechafase7(){return $this->fecha_fase7;}
	public function regresaIdVenta(){return $this->id_venta;}
}
?>