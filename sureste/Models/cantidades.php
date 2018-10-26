<?php
/**
* Clase modelo para usuarios
*/
class Cantidades
{
//Atributos
		var $cobre;
		var $fibra;
		var $hibrida;
		var $voz;
		var $psr;
		var $tecnica;
		var $usuario_idu;
		
//Metodos
	public function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
	public function crear($id){
		$this->cobre=0;
		$this->fibra=0;
		$this->hibrida=0;
		$this->voz=0;
		$this->psr=0;
		$this->tecnica=0;
		$this->usuario_idu=$id;
	}
	public function ingresarCantidad($cobre,$fibra,$hibrida,$voz,$tecnica,$psr,$usuario_idu){
		$this->cobre=$cobre;
		$this->fibra=$fibra;
		$this->hibrida=$hibrida;
		$this->voz=$voz;
		$this->psr=$psr;
		$this->tecnica=$tecnica;
		$this->usuario_idu=$usuario_idu;
	}
	public function verUsuario(){
		echo $this->cobre;echo "<br>";
		echo $this->fibra;echo "<br>";
		echo $this->hibrida;echo "<br>";
		echo $this->voz;echo "<br>";
		echo $this->psr;echo "<br>";
		echo $this->tecnica;echo "<br>";
		echo $this->usuario_idu;echo "<br>";
	}
	public function actualizaCantidadesBD($tipo_os,$iduser,$con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
	    if($tipo_os=='COBRE'){
	      $sql="UPDATE cantidades SET 
	        cobre=cobre+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='FIBRA'){
	      $sql="UPDATE cantidades SET 
	        fibra=fibra+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='HIBRIDA'){
	      $sql="UPDATE cantidades SET 
	        hibrida=hibrida+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='VOZ'){
	      $sql="UPDATE cantidades SET 
	        voz=voz+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='PSR'){
	      $sql="UPDATE cantidades SET 
	        psr=psr+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='TECNICA'){
	      $sql="UPDATE cantidades SET 
	        tecnica=tecnica+1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	}
	public function actualizaCantidadesMenosBD($tipo_os,$iduser,$con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
	    if($tipo_os=='COBRE'){
	      $sql="UPDATE cantidades SET 
	        cobre=cobre-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='FIBRA'){
	      $sql="UPDATE cantidades SET 
	        fibra=fibra-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='HIBRIDA'){
	      $sql="UPDATE cantidades SET 
	        hibrida=hibrida-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='VOZ'){
	      $sql="UPDATE cantidades SET 
	        voz=voz-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='PSR'){
	      $sql="UPDATE cantidades SET 
	        psr=psr-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	    if($tipo_os=='TECNICA'){
	      $sql="UPDATE cantidades SET 
	        tecnica=tecnica-1
	        WHERE usuario_idu='".$iduser."'";
	        $this->execute($sql) or die (mysqli_error($con));
	    }
	}
	public function obtenerCantidadesBD($idu,$con){
		$sql1="SELECT * FROM cantidades WHERE usuario_idu='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->cobre=$row['cobre'];
         	$this->fibra=$row['fibra'];
			$this->hibrida=$row['hibrida'];
			$this->voz=$row['voz'];
			$this->psr=$row['psr'];
			$this->tecnica=$row['tecnica'];
			$this->usuario_idu=$row['usuario_idu'];			
        }
	}
	
	public function registrarCantidadesBD($con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
		$sql="INSERT INTO cantidades (
	    cobre,fibra,hibrida,
	    tecnica,voz,psr,usuario_idu)
	    VALUES
	    ('".$this->cobre."','".$this->fibra."','".$this->hibrida."',
	     '".$this->tecnica."','".$this->voz."','".$this->psr."','".$this->usuario_idu."'
	     )";
	    $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function regresaCobre(){return $this->cobre;}
	public function regresaFibra(){return $this->fibra;}
	public function regresaHibrida(){return $this->hibrida;}
	public function regresaTecnica(){return $this->tecnica;}
	public function regresaVoz(){return $this->voz;}
	public function regresaPsr(){return $this->psr;}
	public function regresaUsuarioIdu(){return $this->usuario_idu;}
}
?>