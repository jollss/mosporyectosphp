<?php
/**
* 
*/
class Adjunto_os
{
//Atributos
	var $idadjunto;
	var $nombreimg;
	var $os_idos;
//Metodos
	public function TotalAdjuntosBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM adjunto_os");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function ExisteAdjuntoBD($id,$con){
		$aux=0;
		$con->real_query("SELECT * FROM adjunto_os WHERE os_idos = '$id'");
            $result = $con->use_result();
            while ($line = $result->fetch_assoc()){
              $aux=1;
            }
			if($aux==0){
				return $aux;
			}else{
				return $aux;
			}
	}
	public function TotalAdjuntosOsBD($id,$con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT * FROM adjunto_os WHERE os_idos='$id'")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	    return $tos;
	}
	public function registrarAdjuntoOsBD($con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
		$sql="INSERT INTO adjunto_os (
	    idadjunto,nombreimg,os_idos)
	    VALUES
	    ('".$this->idadjunto."','".$this->nombreimg."','".$this->os_idos."'
	     )";
	    //execute($sql) or die (mysqli_error($con)); 
	    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}

	public function obtenerId($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT idadjunto FROM adjunto_os ORDER BY idadjunto")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		return $row_cnt;
	}
	public function obtenerAdjuntoOsBD($id,$con){
		$sql1="SELECT * FROM adjunto_os WHERE idadjunto='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idadjunto=$row['idadjunto'];
         	$this->nombreimg=$row['nombreimg'];
			$this->os_idos=$row['os_idos'];
        }
	}
	public function TotalAdjunto($id,$con){
		//$consulta="select * from dataos where id_orden=".$id;
		$total = mysqli_num_rows(mysqli_query($con,"SELECT * FROM adjunto_os WHERE os_idos='$id'"));
		//echo $total;
		if($total==0){
		//echo 'No hay usuarios';
		return $total;
		}else{
		//echo 'Hay un total de '.$total.' usuarios';
		return $total;
		}
	}
	public function obtenerAdjuntoBD($id,$con){
		$sql1="SELECT * FROM adjunto_os WHERE os_idos='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idadjunto=$row['idadjunto'];
         	$this->nombreimg=$row['nombreimg'];
			$this->os_idos=$row['os_idos'];
        }
	}
	public function verAdjuntoOs(){
		echo $this->idadjunto;echo "<br>";
		echo $this->nombreimg;echo "<br>";
		echo $this->os_idos;echo "<br>";
	}
	public function ingresaAdjuntoOs($idadjunto,$nombreimg,$os_idos){
		$this->idadjunto=$idadjunto;
		$this->nombreimg=$nombreimg;
		$this->os_idos=$os_idos;
	}
	public function regresaIdadjunto(){return $this->idadjunto;}
	public function regresaNombreImg(){return $this->nombreimg;}
	public function regresaOsIdos(){return $this->os_idos;}
}
?>