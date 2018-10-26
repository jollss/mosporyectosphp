<?php
/**
* clase unica de tipo
*/
class Tipo
{
//Atributos
	var $idtipo;
	var $tipo;
//Metodos
	public function obtenerIdtipo($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT idtipo FROM tipo ORDER BY idtipo")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		$this->idtipo=$row_cnt;
	}
	public function ingresarTipo($idtipo,$tipo){
		$this->idtipo = $idtipo;
		$this->tipo = $tipo;
	}
	public function verTipo(){
		echo $this->idtipo;
		echo $this->tipo;
	}
	public function obtenerTipoBD($id,$con){
		$sql1="SELECT * FROM tipo WHERE idtipo='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idtipo=$row['idtipo'];
         	$this->tipo=$row['tipo'];
        }
	}
	public function registrarTipoBD($con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="INSERT INTO tipo (
	    idtipo,tipo)
	    VALUES
	    ('".$this->idtipo."','".$this->tipo."'
	     )";
	    execute($sql) or die (mysqli_error($con)); 
	}
	public function totalTipo($con){
		$totales=0;
		$sql1="SELECT * FROM tipo";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idtipo=$row['idtipo'];
         	$this->tipo=$row['tipo'];
         	$totales=$totales+1;
        }
        return $totales;
	}
	public function regresaIdtipo(){return $this->idtipo;}
	public function regresaTipo(){return $this->tipo;}
}
?>