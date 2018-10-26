<?php
/**
* 
*/
class finVenta
{
	
	var $idfinventa;
	var $observaciones;
	var $personal_telmex;
	var $fecha;
	var $idventa;

	public function obtenerIdFin($con){
		/*$row_cnt=0;
		if($ultimo =mysqli_query($con,"")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;*/
		$tos=0;
		$con->real_query("SELECT * FROM finventa ORDER BY idfinventa");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function obtenerFin($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT * FROM finventa ORDER BY idfinventa")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt+1;
	}
	public function ingresarFinVenta($idfinventa,$observaciones,$personal_telmex,$idventa){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->idfinventa=$idfinventa;
		$this->observaciones=$observaciones;
		$this->personal_telmex=$personal_telmex;
		$this->fecha=$fecha;
		$this->idventa=$idventa;
	}
	public function obtenerFinVentaBD($id,$con){
		$sql1="SELECT * FROM finVenta WHERE idventa='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idfinventa=$row['idfinventa'];
			$this->observaciones=$row['observaciones'];
			$this->personal_telmex=$row['personal_telmex'];
			$this->fecha=$row['fecha'];
			$this->idventa=$row['idventa'];
        }
	}
	public function registrarBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO finVenta (
	    idfinventa,observaciones,personal_telmex,fecha,
	    idventa)
	    VALUES
	    ('".$this->idfinventa."','".$this->observaciones."','".$this->personal_telmex."','".$this->fecha."',
	     '".$this->idventa."'
	     )";
	    execute($sql) or die (mysqli_error($con)); 
	}
	public function ver(){
    	echo $this->idfinventa."<br>";
		echo $this->observaciones."<br>";
		echo $this->personal_telmex."<br>";
		echo $this->fecha."<br>";
		echo $this->idventa."<br>";
	}
	public function regresaIdFinVenta(){return $this->idfinventa;}
	public function regresaObservaciones(){return $this->observaciones;}
	public function regresaPersonalTelmex(){return $this->personal_telmex;}
	public function regresaFecha(){return $this->fecha;}
	public function regresaIdventa(){return $this->idventa;}
}
?>