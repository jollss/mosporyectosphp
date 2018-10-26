<?php
/**
* 
*/
class Reclutamiento
{
	var $idreclutamiento;
	var $nombre;
	var $apepaterno;
	var $apematerno;
	var $rtelefono;
	var $redad;
	var $rdir;
	var $rsexo;
	var $rfase;
	var $rfecha;
	var $correo;
	var $entero_vacante;
	var $fuente;
	var $referencia;
	var $id_reclutar;
	/*
	public function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
	}*/
	public function execute($sql,$con){
		if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function ultimoReclutamiento($con){
		$tos=0;
		$con->real_query("SELECT * FROM reclutamiento");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function ingresaRecluta($idreclutamiento,$nombre,$apepaterno,
		$apematerno,$rtelefono,$redad,$rdir,$rsexo,$rfase,$correo,$referencia,$entero_vacante,
    $fuente,$id_reclutar){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha_asignacion=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;

		$this->idreclutamiento=$idreclutamiento;
		$this->nombre=$nombre;
		$this->apepaterno=$apepaterno;
		$this->apematerno=$apematerno;
		$this->rtelefono=$rtelefono;
		$this->redad=$redad;
		$this->rdir=$rdir;
		$this->rsexo=$rsexo;
		$this->rfase=$rfase;
		$this->rfecha=$fecha_asignacion;
		$this->correo=$correo;
		$this->entero_vacante=$entero_vacante;
		$this->fuente=$fuente;
		$this->referencia=$referencia;
		$this->id_reclutar=$id_reclutar;
	}
	public function verRecluta(){
		echo $this->idreclutamiento."<br>";
		echo $this->nombre."<br>";
		echo $this->apepaterno."<br>";
		echo $this->apematerno."<br>";
		echo $this->rtelefono."<br>";
		echo $this->redad."<br>";
		echo $this->rdir."<br>";
		echo $this->rsexo."<br>";
		echo $this->rfase."<br>";
		echo $this->rfecha."<br>";
		echo $this->id_reclutar."<br>";
	}
	public function registroReclutarBD($con){
		$sql="INSERT INTO reclutamiento (
            idreclutamiento,nombre,apepaterno,apematerno,
            rtelefono,redad,rdir,rsexo,
            rfase,rfecha,correo,entero_vacante,fuente,referencia,id_reclutar)
            VALUES
            ('".$this->idreclutamiento."','".$this->nombre."','".$this->apepaterno."','".$this->apematerno."',
             '".$this->rtelefono."','".$this->redad."','".$this->rdir."','".$this->rsexo."',
             '".$this->rfase."','".$this->rfecha."','".$this->correo."',
             '".$this->entero_vacante."','".$this->fuente."','".$this->referencia."','".$this->id_reclutar."'
             )";
          $this->execute($sql,$con);// or die (mysqli_error($con)); 
	}
	public function obtenerReclutaReclutarBD($id,$con){
		$sql1="SELECT * FROM reclutamiento WHERE id_reclutar='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idreclutamiento=$row['idreclutamiento'];
         	$this->nombre=$row['nombre'];
         	$this->apepaterno=$row['apepaterno'];
         	$this->apematerno=$row['apematerno'];
         	$this->rtelefono=$row['rtelefono'];
         	$this->redad=$row['redad'];
         	$this->rdir=$row['rdir'];
         	$this->rsexo=$row['rsexo'];
         	$this->rfase=$row['rfecha'];
         	$this->correo=$row['correo'];
         	$this->entero_vacante=$row['entero_vacante'];
         	$this->fuente=$row['fuente'];
         	$this->referencia=$row['referencia'];
         	$this->id_reclutar=$row['id_reclutar'];
        }
	}
	public function regresaIdReclutamiento(){return $this->idreclutamiento;}
	public function regresaNombre(){return $this->nombre;}
	public function regresaApepaterno(){return $this->apepaterno;}
	public function regresaApematerno(){return $this->apematerno;}
	public function regresaRTelefono(){return $this->rtelefono;}
	public function regresaEdad(){return $this->redad;}
	public function regresaDir(){return $this->rdir;}
	public function regresaSexo(){return $this->rsexo;}
	public function regresaFase(){return $this->rfase;}
	public function regresaFecha(){return $this->rfecha;}
	public function regresaCorreo(){return $this->correo;}
	public function regresaEnteroVacante(){return $this->entero_vacante;}
	public function regresaFuente(){return $this->fuente;}
	public function regresaReferencia(){return $this->referencia;}
	public function regresaIdReclutar(){return $this->id_reclutar;}
}
?>