<?php
/**
* 
*/
class TiendaComercial
{
	
	var $id_tienda;
	var $tienda_comercial;
	var $tel_asignado;
	var $folio_os;
	var $etapa;
	var $listo_ps;
	var $fecha_comercial;
	var $id_venta;
	public function ingresaTiendaComercial($id_tienda,$tienda_comercial,$tel_asignado,$folio_os,$etapa,$listo_ps,
		$id_venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha_comercial=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
		$this->id_tienda=$id_tienda;
		$this->tienda_comercial=$tienda_comercial;
		$this->tel_asignado=$tel_asignado;
		$this->folio_os=$folio_os;
		$this->etapa=$etapa;
		$this->listo_ps=$listo_ps;
		$this->fecha_comercial=$fecha_comercial;
		$this->id_venta=$id_venta;
	}
	public function obtenerIdTienda($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT * FROM tienda_comercial ORDER BY id_tienda")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	}
	public function verTienda(){
		echo $this->id_tienda."<br>";
		echo $this->tienda_comercial."<br>";
		echo $this->tel_asignado."<br>";
		echo $this->folio_os."<br>";
		echo $this->etapa."<br>";
		echo $this->listo_ps."<br>";
		echo $this->fecha_comercial."<br>";
		echo $this->id_venta."<br>";
	}
	public function registrarTiendaBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO tienda_comercial (
	    id_tienda,tienda_comercial,tel_asignado,
	    folio_os,etapa,listo_ps,
	    fecha_comercial,id_venta)
	    VALUES
	    ('".$this->id_tienda."','".$this->tienda_comercial."','".$this->tel_asignado."',
	     '".$this->folio_os."','".$this->etapa."','".$this->listo_ps."',
	     '".$this->fecha_comercial."','".$this->id_venta."'
	     )";
	    execute($sql) or die (mysqli_error($con)); 
	}
	public function modComercio($tienda_comercial,$tel_asignado,$folio_os,$etapa,$ps,
		$id,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE tienda_comercial SET 
          	tienda_comercial='".$tienda_comercial."',
          	tel_asignado='".$tel_asignado."',
          	folio_os='".$folio_os."',
          	etapa='".$etapa."',
          	listo_ps='".$ps."'
         	WHERE id_tienda='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function obtenerTiendaBD($id,$con){
		$sql1="SELECT * FROM tienda_comercial WHERE id_venta='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_tienda=$row['id_tienda'];
			$this->tienda_comercial=$row['tienda_comercial'];
			$this->tel_asignado=$row['tel_asignado'];
			$this->folio_os=$row['folio_os'];
			$this->etapa=$row['etapa'];
			$this->listo_ps=$row['listo_ps'];
			$this->fecha_comercial=$row['fecha_comercial'];
			$this->id_venta=$row['id_venta'];
        }
	}
	public function regresaIdTienda(){return $this->id_tienda;}
	public function regresaTiendaComercial(){return $this->tienda_comercial;}
	public function regresaTelAsignado(){return $this->tel_asignado;}
	public function regresaFolioOs(){return $this->folio_os;}
	public function regresaEtapa(){return $this->etapa;}
	public function regresaListoPs(){return $this->listo_ps;}
	public function regresaFechaComercial(){return $this->fecha_comercial;}
	public function regresaIdVenta(){return $this->id_venta;}
}
?>