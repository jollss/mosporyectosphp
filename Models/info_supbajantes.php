<?php
/**
* 
*/
class Info_Supbajantes 
{
//atributos
	var $idinfosup;
	var $info;
	var $id_orden;
	var $ddqueja;
	var $mmqueja;
	var $yearqueja;
	var $horaqueja;
	var $supervisor_calidad;

//metodos
	public function execute($query){ 
	      $con = Conectarse();  
	      return mysqli_query($con,$query);
	}
	public function obtenerInfoBD($idu,$con){
		$sql1="SELECT * FROM info_supbajantes WHERE idinfosup='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idinfosup=$row['idinfosup'];
         	$this->info=$row['info'];
         	$this->id_orden=$row['id_orden'];
         	$this->ddqueja=$row['ddqueja'];
         	$this->mmqueja=$row['mmqueja'];
         	$this->yearqueja=$row['yearqueja'];
			$this->horaqueja=$row['horaqueja'];
			$this->supervisor_calidad=$row['supervisor_calidad'];
        }
	}
	public function obtenerDataosOsBD($idu,$con){
		$sql1="SELECT * FROM info_supbajantes WHERE supervisor_calidad='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idinfosup=$row['idinfosup'];
         	$this->info=$row['info'];
         	$this->id_orden=$row['id_orden'];
         	$this->ddqueja=$row['ddqueja'];
         	$this->mmqueja=$row['mmqueja'];
         	$this->yearqueja=$row['yearqueja'];
			$this->horaqueja=$row['horaqueja'];
			$this->supervisor_calidad=$row['supervisor_calidad'];
        }
	}
	public function ingresaInfo($idinfosup,$info,$id_orden,$supervisor_calidad){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$horas=$hora.":".$min;

		$this->idinfosup=$idinfosup;
		$this->info=$info;
		$this->id_orden=$id_orden;
		$this->ddqueja=$dia;
		$this->mmqueja=$mes;
		$this->yearqueja=$aaaa;
		$this->horaqueja=$horas;
		$this->supervisor_calidad=$supervisor_calidad;
	}
	public function TotalInfoBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM info_supbajantes");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos=$row['idinfosup'];
	    }
	    //$tos=$tos+1;
	    return $tos;
	}
	public function registroInfoBD($con){
		  $sql="INSERT INTO info_supbajantes (
          idinfosup,info,id_orden,
          ddqueja,mmqueja,yearqueja,horaqueja,
          supervisor_calidad)
          VALUES
          ('".$this->idinfosup."','".$this->info."','".$this->id_orden."',
          	'".$this->ddqueja."','".$this->mmqueja."','".$this->yearqueja."','".$this->horaqueja."',
          	'".$this->supervisor_calidad."')"; 
          $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function verDataos(){
		echo $this->idinfosup."<br>";
		echo $this->info."<br>";
		echo $this->id_orden."<br>";
		echo $this->ddqueja."<br>";
		echo $this->mmqueja."<br>";
		echo $this->yearqueja."<br>";
		echo $this->horaqueja."<br>";
		echo $this->supervisor_calidad."<br>";
	}
	public function regresaIdinfosup(){return $this->idinfosup;}
	public function regresaInfo(){return $this->info;}
	public function regresaIdOrden(){return $this->id_orden;}
	public function regresaddqueja(){return $this->ddqueja;}
	public function regresammqueja(){return $this->mmqueja;}
	public function regresayearqueja(){return $this->yearqueja;}
	public function regresahoraqueja(){return $this->horaqueja;}
	public function regresaSupervisorCalidad(){return $this->supervisor_calidad;}
}
?>