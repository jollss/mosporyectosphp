<?php
/**
* 
*/
class Filder
{
	
	var $id_filder;
	var $contesto;
	var $id_user;
	var $fecha_filder;
	var $cliente;
	var $atiende;
	var $servicio;
	var $paquete;
	var $direccion;
	var $colonia;
	var $municipio;
	var $cp;
	var $gastos_instalacion;
	var $tiempo_instalacion;
	var $observaciones;
	var $idventas;
	public function ingresaFilder($id_filder,$contesto,$id_user,$cliente,$atiende,$servicio,$paquete,
		$direccion,$colonia,$municipio,$cp,$gastos_instalacion,$tiempo_instalacion,$observaciones,$idventas){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->id_filder=$id_filder;
		$this->contesto=$contesto;
		$this->id_user=$id_user;
		$this->fecha_filder=$fecha;
		$this->cliente=$cliente;
		$this->atiende=$atiende;
		$this->servicio=$servicio;
		$this->paquete=$paquete;
		$this->direccion=$direccion;
		$this->colonia=$colonia;
		$this->municipio=$municipio;
		$this->cp=$cp;
		$this->gastos_instalacion=$gastos_instalacion;
		$this->tiempo_instalacion=$tiempo_instalacion;
		$this->observaciones=$observaciones;
		$this->idventas=$idventas;
	}
	public function cambiarEstatus($iduser,$os,$con){
		$sql="UPDATE os SET 
          	asignado='".$iduser."'
         	WHERE idmos='".$os."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function obtenerFilderBD($id,$con){
		$sql1="SELECT * FROM filder WHERE id_user='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_filder=$row['id_filder'];
			$this->contesto=$row['contesto'];
			$this->id_user=$row['id_user'];
			$this->fecha_filder=$row['fecha_filder'];
			$this->cliente=$row['cliente'];
			$this->atiende=$row['atiende'];
			$this->servicio=$row['servicio'];
			$this->paquete=$row['paquete'];
			$this->direccion=$row['direccion'];
			$this->colonia=$row['colonia'];
			$this->municipio=$row['municipio'];
			$this->cp=$row['cp'];
			$this->gastos_instalacion=$row['gastos_instalacion'];
			$this->tiempo_instalacion=$row['tiempo_instalacion'];
			$this->observaciones=$row['observaciones'];
			$this->idventas=$row['idventas'];
        }
	}
	public function obtenerFilderVBD($id,$con){
		$sql1="SELECT * FROM filder WHERE idventas='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_filder=$row['id_filder'];
			$this->contesto=$row['contesto'];
			$this->id_user=$row['id_user'];
			$this->fecha_filder=$row['fecha_filder'];
			$this->cliente=$row['cliente'];
			$this->atiende=$row['atiende'];
			$this->servicio=$row['servicio'];
			$this->paquete=$row['paquete'];
			$this->direccion=$row['direccion'];
			$this->colonia=$row['colonia'];
			$this->municipio=$row['municipio'];
			$this->cp=$row['cp'];
			$this->gastos_instalacion=$row['gastos_instalacion'];
			$this->tiempo_instalacion=$row['tiempo_instalacion'];
			$this->observaciones=$row['observaciones'];
			$this->idventas=$row['idventas'];
        }
	}
	public function obtenerId($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT id_filder FROM filder ORDER BY id_filder")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	}
	public function registrarFilderBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO filder (
	    id_filder,contesto,id_user,
	    fecha_filder,cliente,atiende,servicio,
	    paquete,direccion,colonia,
	    municipio,cp,gastos_instalacion,tiempo_instalacion,
	    observaciones,idventas)
	    VALUES
	    ('".$this->id_filder."','".$this->contesto."','".$this->id_user."',
	     '".$this->fecha_filder."','".$this->cliente."','".$this->atiende."','".$this->servicio."',
	     '".$this->paquete."','".$this->direccion."','".$this->colonia."',
	     '".$this->municipio."','".$this->cp."','".$this->gastos_instalacion."','".$this->tiempo_instalacion."',
	     '".$this->observaciones."','".$this->idventas."'
	     )";
	    execute($sql) or die (mysqli_error($con)); 
	}
	public function cambiarAtiende($id,$data,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE filder SET atiende='".$data."' WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarServicio($id,$data,$con){
		$sql="UPDATE filder SET 
          	servicio='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarPaquete($id,$data,$con){
		$sql="UPDATE filder SET 
          	paquete='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarDireccion($id,$data,$con){
		$sql="UPDATE filder SET 
          	direccion='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarColonia($id,$data,$con){
		$sql="UPDATE filder SET 
          	colonia='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarMunicipio($id,$data,$con){
		$sql="UPDATE filder SET 
          	municipio='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarCp($id,$data,$con){
		$sql="UPDATE filder SET 
          	cp='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarGastosIns($id,$data,$con){
		$sql="UPDATE filder SET 
          	gastos_instalacion='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarTiempoIns($id,$data,$con){
		$sql="UPDATE filder SET 
          	tiempo_instalacion='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function cambiarObs($id,$data,$con){
		$sql="UPDATE filder SET 
          	observaciones='$data'
         	WHERE id_filder='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function regresaIdFilder(){return $this->id_filder;}
	public function regresaContesto(){return $this->contesto;}
	public function regresaIdUser(){return $this->id_user;}
	public function regresaFechaFilder(){return $this->fecha_filder;}
	public function regresaCliente(){return $this->cliente;}
	public function regresaAtiende(){return $this->atiende;}
	public function regresaServicio(){return $this->servicio;}
	public function regresaPaquete(){return $this->paquete;}
	public function regresaDireccion(){return $this->direccion;}
	public function regresaColonia(){return $this->colonia;}
	public function regresaMunicipio(){return $this->municipio;}
	public function regresaCP(){return $this->cp;}
	public function regresaGastosInstalacion(){return $this->gastos_instalacion;}
	public function regresaTiempoInstalacion(){return $this->tiempo_instalacion;}
	public function regresaObservaciones(){return $this->observaciones;}
	public function regresaIdVenta(){return $this->idventas;}
	
}
?>