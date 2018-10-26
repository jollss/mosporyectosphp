<?php
/**
* 
*/
class Dataos extends Os
{
//atributos
	var $iddataos;
	var $supervisor_idu;
	var $tecnico_asignado_idu;
	var $estatus;
	var $observaciones;
	/*fecha de modificacion de estatus*/
	var $ddos;
	var $mmos;
	var $yearos;
	var $horaos;
	var $id_orden;
	var $file_os;
	/*fecha de asignacion de os*/
	var $ddasig;
	var $mmasig;
	var $yearasig;
	var $principal;
	var $secundario;
	var $claro_video;
	var $tipo_os;
	var $alfanumerico;
	var $serie;
//metodos
	public function obtenerDataosBD($idu,$con){
		$sql1="SELECT * FROM dataos WHERE iddataos='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->iddataos=$row['iddataos'];
         	$this->supervisor_idu=$row['supervisor_idu'];
         	$this->tecnico_asignado_idu=$row['tecnico_asignado_idu'];
         	$this->estatus=$row['estatus'];
         	$this->observaciones=$row['observaciones'];
         	$this->ddos=$row['ddos'];
			$this->mmos=$row['mmos'];
			$this->yearos=$row['yearos'];
			$this->horaos=$row['horaos'];
			$this->id_orden=$row['id_orden'];
			$this->file_os=$row['file_os'];
			$this->principal=$row['principal'];
			$this->secundario=$row['secundario'];
			$this->claro_video=$row['claro_video'];
			$this->ddasig=$row['ddasig'];
			$this->mmasig=$row['mmasig'];
			$this->yearasig=$row['yearasig'];
			$this->tipo_os=$row['tipo_os'];
			$this->alfanumerico=$row['alfanumerico'];
			$this->serie=$row['serie'];
        }
	}
	public function obtenerDataosOsBD($idu,$con){
		$sql1="SELECT * FROM dataos WHERE id_orden='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->iddataos=$row['iddataos'];
         	$this->supervisor_idu=$row['supervisor_idu'];
         	$this->tecnico_asignado_idu=$row['tecnico_asignado_idu'];
         	$this->estatus=$row['estatus'];
         	$this->observaciones=$row['observaciones'];
         	$this->ddos=$row['ddos'];
			$this->mmos=$row['mmos'];
			$this->yearos=$row['yearos'];
			$this->horaos=$row['horaos'];
			$this->id_orden=$row['id_orden'];
			$this->file_os=$row['file_os'];
			$this->principal=$row['principal'];
			$this->secundario=$row['secundario'];
			$this->claro_video=$row['claro_video'];
			$this->ddasig=$row['ddasig'];
			$this->mmasig=$row['mmasig'];
			$this->yearasig=$row['yearasig'];
			$this->tipo_os=$row['tipo_os'];
			$this->alfanumerico=$row['alfanumerico'];
			$this->serie=$row['serie'];
        }
	}
	public function ingresaDataos($iddataos,$supervisor_idu,$tecnico_asignado_idu,
		$estatus,$observaciones,$id_orden,$file_os,$tipo_os){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");

		$this->iddataos=$iddataos;
		$this->supervisor_idu=$supervisor_idu;
		$this->tecnico_asignado_idu=$tecnico_asignado_idu;
		$this->estatus=$estatus;
		$this->observaciones=$observaciones;
		$this->ddos=0;
		$this->mmos=0;
		$this->yearos=0;
		$this->horaos=0;
		$this->id_orden=$id_orden;
		$this->file_os=$file_os;
		$this->ddasig=$dia;
		$this->mmasig=$mes;
		$this->yearasig=$aaaa;
		$this->principal="";
		$this->secundario="";
		$this->claro_video="";
		$this->tipo_os=$tipo_os;
		$this->alfanumerico="";
		$this->serie="";
	}
	public function TotalDataosBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM dataos");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos=$row['iddataos'];
	    }
	    $tos=$tos+1;
	    return $tos;
	}
	public function ExisteDataos($id,$con){
		//$consulta="select * from dataos where id_orden=".$id;
		$total = mysqli_num_rows(mysqli_query($con,"SELECT * FROM dataos WHERE id_orden='$id'"));
		echo $total;
		if($total==0){
		//echo 'No hay usuarios';
		return 0;
		}else{
		//echo 'Hay un total de '.$total.' usuarios';
		return 1;
		}
	}
	public function registroDataosBD($con){
		  $sql="INSERT INTO dataos (
          iddataos,supervisor_idu,tecnico_asignado_idu,
          estatus,observaciones,
          ddos,mmos,yearos,horaos,id_orden,file_os,ddasig,mmasig,yearasig,
          principal,secundario,claro_video,tipo_os,alfanumerico,serie)
          VALUES
          ('".$this->iddataos."','".$this->supervisor_idu."','".$this->tecnico_asignado_idu."',
          	'".$this->estatus."','".$this->observaciones."',
            '".$this->ddos."','".$this->mmos."','".$this->yearos."','".$this->horaos."',
            '".$this->id_orden."','".$this->file_os."',
            '".$this->ddasig."','".$this->mmasig."','".$this->yearasig."',
            '".$this->principal."','".$this->secundario."','".$this->claro_video."','".$this->tipo_os."','".$this->alfanumerico."','".$this->serie."'
            )"; 
          $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function verDataos(){
		echo $this->iddataos."<br>";
		echo $this->supervisor_idu."<br>";
		echo $this->tecnico_asignado_idu."<br>";
		echo $this->estatus."<br>";
		echo $this->observaciones."<br>";
		echo $this->ddos."<br>";
		echo $this->mmos."<br>";
		echo $this->yearos."<br>";
		echo $this->horaos."<br>";
		echo $this->id_orden."<br>";
		echo $this->file_os."<br>";
		echo $this->ddasig."<br>";
		echo $this->mmasig."<br>";
		echo $this->yearasig."<br>";
		echo $this->principal."<br>";
		echo $this->secundario."<br>";
		echo $this->claro_video."<br>";
		echo $this->tipo_os."<br>";
		echo $this->alfanumerico."<br>";
		echo $this->serie."<br>";
	}
	public function modPrincipal($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        principal='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modSecundario($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        secundario='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modClaroV($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        claro_video='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modEstatus($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        estatus='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modAlfanumerico($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        alfanumerico='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modSerie($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        serie='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modObservaciones($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        observaciones='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modTecnico($dato,$id,$con){
		$sql="UPDATE dataos SET 
	        tecnico_asignado_idu='$dato'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function modFecha($id,$con){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora=date('G') ;
		$min=date('i');
		$seg=date('s');
		$tiempo=$hora.":".$min.":".$seg;
		$sql="UPDATE dataos SET 
	        ddos='$dia',
	        mmos='$mes',
	        yearos='$aaaa',
	        horaos='$tiempo'
	        WHERE id_orden='".$id."'";
	        $this->execute($sql) or die (mysqli_error($con));
	}
	public function regresaIddataos(){return $this->iddataos;}
	public function regresaSupervisorIdu(){return $this->supervisor_idu;}
	public function regresaTecnicoAsignacionIdu(){return $this->tecnico_asignado_idu;}
	public function regresaEstatus(){return $this->estatus;}
	public function regresaObservaciones(){return $this->observaciones;}
	public function regresaDDOS(){return $this->ddos;}
	public function regresaMMOS(){return $this->mmos;}
	public function regresaYEAROS(){return $this->yearos;}
	public function regresaHORAOS(){return $this->horaos;}
	public function regresaIdOrden(){return $this->id_orden;}
	public function regresaFileOs(){return $this->file_os;}
	public function regresaDDASIG(){return $this->ddasig;}
	public function regresaMMASIG(){return $this->mmasig;}
	public function regresaYEARASIG(){return $this->yearasig;}
	public function regresaPrincipal(){return $this->principal;}
	public function regresaSecundario(){return $this->secundario;}
	public function regresaClaroVideo(){return $this->claro_video;}
	public function regresaTipoOs(){return $this->tipo_os;}
	public function regresaAlfanumerico(){return $this->alfanumerico;}
	public function regresaSerie(){return $this->serie;}
}
?>