<?php
/**
* 
*/
class Material
{
	var $idmate;
	var $idos;
	var $modem;
	var $rosetas;
	var $metraje;
	var $tipo_instalacion;

	private function execute($query){
	      $con = Conectarse();  
	      return mysqli_query($con,$query);
	}
	public function obtenerMaterialBD($id,$con){
		$con->real_query("SELECT * FROM material WHERE idos='$id'");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $this->idmate=$l['idmate'];
	        $this->idos=$l['idos'];
	        $this->modem=$l['modem'];
	        $this->rosetas=$l['rosetas'];
	        $this->metraje=$l['metraje'];
	        $this->tipo_instalacion=$l['tipo_instalacion'];
	    }
	}
	public function ingresarMaterial($idmate,$idos,$modem,$rosetas,$metraje,$tipo_instalacion){
		$this->idmate=$idmate;
		$this->idos=$idos;
		$this->modem=$modem; 
		$this->rosetas=$rosetas;
		$this->metraje=$metraje;
		$this->tipo_instalacion=$tipo_instalacion;
	}
	public function verMaterial(){
		echo $this->idmate;echo "<br>";
		echo $this->idos;echo "<br>";
		echo $this->modem;echo "<br>";
		echo $this->rosetas;echo "<br>";
		echo $this->metraje;echo "<br>";
		echo $this->tipo_instalacion;echo "<br>";
	}
	public function registrarMaterialBD($con){
		$sql="INSERT INTO material (
	    idmate,
	    idos,modem,rosetas,metraje,tipo_instalacion)
	    VALUES
	    ('".$this->idmate."',
	     '".$this->idos."','".$this->modem."','".$this->rosetas."','".$this->metraje."','".$this->tipo_instalacion."'
	     )";
	    $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function totalesMaterial($con){
		$ls=0;
		$con->real_query("SELECT * FROM material");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function regresaIdmate(){return $this->idmate;}
	public function regresaIdos(){return $this->idos;}
	public function regresaModem(){return $this->modem;}
	public function regresaRosetas(){return $this->rosetas;}
	public function regresaMetraje(){return $this->metraje;}
	public function regresaTipoInstalacion(){return $this->tipo_instalacion;}
}
?>