<?php
/**
*
*/
class Pendiente
{
//Atributos
	var $idpe;
	var $fechap;
	var $titulop;
	var $detallep;
	var $status;
	var $de;
	var $usuario_idu;
//Metodos
	public function ingresarPendiente($idpe,$titulop,$detallep,$de,$usuario_idu){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");
		$fecha=$dia."/".$mes."/".$aaaa." Hora:".$hora.":".$min;
		$this->idpe=$idpe;
		$this->fechap=$fecha;
		$this->titulop=$titulop;
		$this->detallep=$detallep;
		$this->status=0;
		$this->de=$de;
		$this->usuario_idu=$usuario_idu;
	}
	public function obtenerIdPendiente($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT idpe FROM pendiente ORDER BY idpe")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		$this->idpe=$row_cnt;
	}
	public function verPendiente(){
		echo $this->idpe;
		echo $this->fechap;
		echo $this->titulop;
		echo $this->detallep;
		echo $this->status;
		echo $this->de;
		echo $this->usuario_idu;
	}
	public function obtenerPendienteBD($id,$con){
		$sql1="SELECT * FROM pendiente WHERE idpe=".$id;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idpe=$row['idpe'];
         	$this->fechap=$row['fechap'];
         	$this->titulop=$row['titulop'];
         	$this->detallep=$row['detallep'];
         	$this->status=$row['status'];
         	$this->de=$row['de'];
         	$this->usuario_idu=$row['usuario_idu'];
        }
	}
	public function registrarPendienteBD($con){
		function execute($query){
		      $con = Conectarse();
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO pendiente (
	    idpe,fechap,titulop,
	    detallep,status,de,usuario_idu)
	    VALUES
	    ('".$this->idpe."','".$this->fechap."','".$this->titulop."',
	    	'".$this->detallep."','".$this->status."','".$this->de."',
	    	'".$this->usuario_idu."'
	     )";
	    execute($sql) or die (mysqli_error($con));
	}
	public function totalPendiente($con){
		$tos=0;
		$con->real_query("SELECT * FROM pendiente");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function borrarPendiente($idp,$con){
		function execute($query){
		      $con = Conectarse();
		      return mysqli_query($con,$query);
		}
		$estado=1;
		$sql="UPDATE pendiente SET
		status='".$estado."'
		WHERE idpe='".$idp."'";
		execute($sql) or die (mysqli_error($con));
	}
	public function regresaIdpe(){return $this->idpe;}
	public function regresaFechap(){return $this->fechap;}
	public function regresaTtituloP(){return $this->titulop;}
	public function regresaDetallep(){return $this->detallep;}
	public function regresaStatus(){return $this->status;}
	public function regresaDe(){return $this->de;}
	public function regresaUsuario_idu(){return $this->usuario_idu;}
}
?>
