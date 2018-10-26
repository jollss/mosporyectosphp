<?php
/**
* 
*/
class Adjunto_venta
{
	
	var $idaventa;
	var $imagen_n;
	var $folio_venta;	
	public function totalAdjuntos($con){
		$ls=0;
		$con->real_query("SELECT * FROM adjunto_venta");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        //$ls=$l['idaventa'];
	        $ls=$ls+1;
	    }
	    $ls=$ls+1;
	    return $ls;
	}
	public function ingresaVentas($id,$imagen_n,$folio_venta){

		$this->idaventa=$id;
		$this->imagen_n=$imagen_n;
		$this->folio_venta=$folio_venta;
	}
	public function verVentas(){
		echo $this->idventa;echo "<br>";
		echo $this->folio_venta;echo "<br>";
		echo $this->idvendedor;echo "<br>";
		echo "---------------------------<br>";
	}
	public function registrarVentaBD($con){
	    $sql="INSERT INTO adjunto_venta (
	    idaventa,imagen_n,folio_venta)
	    VALUES
	    ('".$this->idaventa."','".$this->imagen_n."','".$this->folio_venta."')";
		//mysqli_query($con,$sql);
		if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	    //execute($sql) or die (mysqli_error($con)); 
	}
	public function obtenerAdjuntoVBD($id,$con){
		$sql1="SELECT * FROM adjunto_venta WHERE '$id'=idaventa";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idaventa=$row['idaventa'];
         	$this->imagen_n=$row['imagen_n'];
			$this->folio_venta=$row['folio_venta'];
        }
	}
	
	public function regresaIdAdjuntoV(){return $this->idaventa;}
	public function regresaImagenN(){return $this->imagen_n;}
	public function regresaFolioVenta(){return $this->folio_venta;}
}
?>