<?php
/**
* 
*/
class Reclutadorcantidad
{
	
	var $id_cantidad;
	var $idvendedor;
	var $cantidad;
	private function execute($query){
	      $con = Conectarse();  
	      return mysqli_query($con,$query);
	}
	public function ingresarRCantidad($id,$vendedor,$cantidad){
		$this->id_cantidad=$id;
		$this->idvendedor=$vendedor;
		$this->cantidad=$cantidad;
	}
	public function verRCantidad(){
		echo $this->id_cantidad."<br>";
		echo $this->idvendedor."<br>";
		echo $this->cantidad."<br>";
	}
	public function TotalReclutasBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM reclutadorcantidad");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function registroReclutaBD($con){
		  $sql="INSERT INTO reclutadorcantidad (
          id_cantidad,idvendedor,cantidad)
          VALUES
          ('".$this->id_cantidad."','".$this->idvendedor."','".$this->cantidad."'
            )"; 
          $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function modCantidad($dato,$id,$con){
		$sql="UPDATE reclutadorcantidad SET 
	        cantidad='$dato'
	        WHERE idvendedor='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function obtenerReclutaBD($idu,$con){
		$sql1="SELECT * FROM reclutadorcantidad WHERE idvendedor='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->id_cantidad=$row['id_cantidad'];
         	$this->idvendedor=$row['idvendedor'];
         	$this->cantidad=$row['cantidad'];
        }
	}
	public function regresaIdCantidad(){return $this->id_cantidad;}
	public function regresaIdVendedor(){return $this->idvendedor;}
	public function regresaCantidad(){return $this->cantidad;}
}
?>