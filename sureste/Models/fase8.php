<?php
/**
* 
*/
class Fase8
{
	
	var $idfase8;
	var $tecnico;
	var $observaciones;
	var $fecha;
	var $venta;
	function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
	public function obtenerFase8BD($id,$con){
		$sql1="SELECT * FROM fase8 WHERE venta='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idfase8=$row['idfase8'];
         	$this->tecnico=$row['tecnico'];
         	$this->observaciones=$row['observaciones'];
         	$this->fecha=$row['fecha'];
         	$this->venta=$row['venta'];
        }
	}
	public function ingresaDataos($idfase8,$tecnico,$observaciones,
		$venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha=$dia."/".$mes."/".$aaaa." ".$hora;
		$this->idfase8=$idfase8;
		$this->tecnico=$tecnico;
		$this->observaciones=$observaciones;
		$this->fecha=$fecha;
		$this->venta=$venta;
	}
	public function TotalDataosBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM fase8");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function registroDataosBD($con){
		  $sql="INSERT INTO fase8 (
          idfase8,tecnico,observaciones,
          fecha,venta)
          VALUES
          ('".$this->idfase8."','".$this->tecnico."','".$this->observaciones."',
          	'".$this->fecha."','".$this->venta."'
            )"; 
          $this->execute($sql) or die (mysqli_error($con)); 
	}
}
?>