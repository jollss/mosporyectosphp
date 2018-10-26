<?php
/**
* 
*/
class Foliosiac
{
	var $id_siac;
	var $folio_siac;
	var $id_filder;
	var $fecha_siac;
	public function ingresarFolioSiac($id_siac,$folio_siac,$id_filder){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->id_siac=$id_siac;
		$this->folio_siac=$folio_siac;
		$this->id_filder=$id_filder;
		$this->fecha_siac=$fecha;
	}
	public function obtenerIdSiac($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT id_siac FROM folio_siac ORDER BY id_siac")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	}
	public function verSiac(){
		echo $this->id_siac."<br>";
		echo $this->folio_siac."<br>";
		echo $this->id_filder."<br>";
		echo $this->fecha_siac."<br>";
	}
	public function obtenerSiacBD($id,$con){
		$sql1="SELECT * FROM folio_siac WHERE id_filder='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_siac=$row['id_siac'];
			$this->folio_siac=$row['folio_siac'];
			$this->id_filder=$row['id_filder'];
			$this->fecha_siac=$row['fecha_siac'];
        }
	}
	public function obtenerSiacVBD($id,$con){
		$sql1="SELECT * FROM folio_siac WHERE idventas='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_siac=$row['id_siac'];
			$this->folio_siac=$row['folio_siac'];
			$this->id_filder=$row['id_filder'];
			$this->fecha_siac=$row['fecha_siac'];
        }
	}
	public function registrarFolioSiacBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO folio_siac (
	    id_siac,folio_siac,id_filder,
	    fecha_siac)
	    VALUES
	    ('".$this->id_siac."','".$this->folio_siac."','".$this->id_filder."',
	     '".$this->fecha_siac."'
	     )";
	    execute($sql) or die (mysqli_error($con)); 
	}
	public function regresaIdSiac(){return $this->id_siac;}
	public function regresaFolioSiac(){return $this->folio_siac;}
	public function regresaIdFilder(){return $this->id_filder;}
	public function regresaFechaSiac(){return $this->fecha_siac;}
}
?>