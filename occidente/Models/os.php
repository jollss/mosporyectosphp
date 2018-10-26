<?php
/**
* 
*/
class Os
{
//Atributos
	var $idmos;
	var $cope;
	var $expediente;
	var $ddcarga;
	var $mmcarga;
	var $yearcarga;
	var $folio_pisaplex;
	var $folio_pisa;
	var $telefono;
	var $cliente;
	var $tipo_tarea;
	var $tecnologia;
	var $distrito;
	var $zona;
	var $dilacion_etapa;
	var $dilacion;
	var $usuario_idu;
	var $pagados;
	var $asignado;
	var $estado_os;
//Metodos
	public function execute($query){ 
	      $con = Conectarse();  
	      return mysqli_query($con,$query);
	}
	public function totalOs($iduser,$con){
		$ls=0;
		$con->real_query("SELECT * FROM os WHERE usuario_idu='$iduser'");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function totalAOs($iduser,$con){
		$ls=0;
		$con->real_query("SELECT * FROM os WHERE usuario_idu='$iduser' and asignado=0");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function totalesOs($con){
		$ls=0;
		$con->real_query("SELECT * FROM os");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function obtenerOsBD($idmos,$con){
		$sql1="SELECT * FROM os WHERE idmos='$idmos'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idmos=$row['idmos'];
			$this->cope=$row['cope'];
			$this->expediente=$row['expediente'];
			$this->ddcarga=$row['ddcarga'];
			$this->mmcarga=$row['mmcarga'];
			$this->yearcarga=$row['yearcarga'];
			$this->folio_pisaplex=$row['folio_pisaplex'];
			$this->folio_pisa=$row['folio_pisa'];
			$this->telefono=$row['telefono'];
			$this->cliente=$row['cliente'];
			$this->tipo_tarea=$row['tipo_tarea'];
			$this->tecnologia=$row['tecnologia'];
			$this->distrito=$row['distrito'];
			$this->zona=$row['zona'];
			$this->dilacion_etapa=$row['dilacion_etapa'];
			$this->dilacion=$row['dilacion'];
			$this->usuario_idu=$row['usuario_idu'];
			$this->pagados=$row['pagados'];
			$this->asignado=$row['asignado'];
			$this->estado_os=$row['estado_os'];	

        }
        return 1;
	}
	public function obtenerOsFolioBD($id,$con){
		//$sql1="SELECT * FROM os WHERE folio_pisa like '%$id%' OR idmos like '%$id%'"
		$sql1="SELECT * FROM os WHERE idmos = '".$id."'";;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idmos=$row['idmos'];
			$this->cope=$row['cope'];
			$this->expediente=$row['expediente'];
			$this->ddcarga=$row['ddcarga'];
			$this->mmcarga=$row['mmcarga'];
			$this->yearcarga=$row['yearcarga'];
			$this->folio_pisaplex=$row['folio_pisaplex'];
			$this->folio_pisa=$row['folio_pisa'];
			$this->telefono=$row['telefono'];
			$this->cliente=$row['cliente'];
			$this->tipo_tarea=$row['tipo_tarea'];
			$this->tecnologia=$row['tecnologia'];
			$this->distrito=$row['distrito'];
			$this->zona=$row['zona'];
			$this->dilacion_etapa=$row['dilacion_etapa'];
			$this->dilacion=$row['dilacion'];
			$this->usuario_idu=$row['usuario_idu'];
			$this->pagados=$row['pagados'];
			$this->asignado=$row['asignado'];
			$this->estado_os=$row['estado_os'];
			
        }
        return 1;
	}
	public function obtenerOsFolioOrderBD($id,$con){
		//$sql1="SELECT * FROM os WHERE folio_pisa like '%$id%' OR idmos like '%$id%'"
		$sql1="SELECT * FROM os WHERE idmos = '$id' ORDER BY yearcarga,mmcarga,ddcarga";;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idmos=$row['idmos'];
			$this->cope=$row['cope'];
			$this->expediente=$row['expediente'];
			$this->ddcarga=$row['ddcarga'];
			$this->mmcarga=$row['mmcarga'];
			$this->yearcarga=$row['yearcarga'];
			$this->folio_pisaplex=$row['folio_pisaplex'];
			$this->folio_pisa=$row['folio_pisa'];
			$this->telefono=$row['telefono'];
			$this->cliente=$row['cliente'];
			$this->tipo_tarea=$row['tipo_tarea'];
			$this->tecnologia=$row['tecnologia'];
			$this->distrito=$row['distrito'];
			$this->zona=$row['zona'];
			$this->dilacion_etapa=$row['dilacion_etapa'];
			$this->dilacion=$row['dilacion'];
			$this->usuario_idu=$row['usuario_idu'];
			$this->pagados=$row['pagados'];
			$this->asignado=$row['asignado'];
			$this->estado_os=$row['estado_os'];
			
        }
        return 1;
	}
	public function obtenerOsFolioPBD($id,$con){
		//$sql1="SELECT * FROM os WHERE folio_pisa like '%$id%' OR idmos like '%$id%'"
		$sql1="SELECT * FROM os WHERE folio_pisa LIKE '$id%'";;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idmos=$row['idmos'];
			$this->cope=$row['cope'];
			$this->expediente=$row['expediente'];
			$this->ddcarga=$row['ddcarga'];
			$this->mmcarga=$row['mmcarga'];
			$this->yearcarga=$row['yearcarga'];
			$this->folio_pisaplex=$row['folio_pisaplex'];
			$this->folio_pisa=$row['folio_pisa'];
			$this->telefono=$row['telefono'];
			$this->cliente=$row['cliente'];
			$this->tipo_tarea=$row['tipo_tarea'];
			$this->tecnologia=$row['tecnologia'];
			$this->distrito=$row['distrito'];
			$this->zona=$row['zona'];
			$this->dilacion_etapa=$row['dilacion_etapa'];
			$this->dilacion=$row['dilacion'];
			$this->usuario_idu=$row['usuario_idu'];
			$this->pagados=$row['pagados'];
			$this->asignado=$row['asignado'];
			$this->estado_os=$row['estado_os'];
			return 1;
        }
	}
	public function existe($id,$con){
		//$sql1="SELECT * FROM os WHERE folio_pisa like '%$id%' OR idmos like '%$id%'"
		$sql1="SELECT * FROM os WHERE folio_pisa = '$id'";;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
			return 1;
        }
	}
	public function obtenerOsAsignadaBD($id,$con){
		$sql1="SELECT * FROM os WHERE asignado='$id'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idmos=$row['idmos'];
			$this->cope=$row['cope'];
			$this->expediente=$row['expediente'];
			$this->ddcarga=$row['ddcarga'];
			$this->mmcarga=$row['mmcarga'];
			$this->yearcarga=$row['yearcarga'];
			$this->folio_pisaplex=$row['folio_pisaplex'];
			$this->folio_pisa=$row['folio_pisa'];
			$this->telefono=$row['telefono'];
			$this->cliente=$row['cliente'];
			$this->tipo_tarea=$row['tipo_tarea'];
			$this->tecnologia=$row['tecnologia'];
			$this->distrito=$row['distrito'];
			$this->zona=$row['zona'];
			$this->dilacion_etapa=$row['dilacion_etapa'];
			$this->dilacion=$row['dilacion'];
			$this->usuario_idu=$row['usuario_idu'];
			$this->pagados=$row['pagados'];
			$this->asignado=$row['asignado'];
			$this->estado_os=$row['estado_os'];

        }
	}
	public function ingresarOs($idmos,$cope,$expediente,$folio_pisaplex,$folio_pisa,
		$telefono,$cliente,$tipo_tarea,$tecnologia,$distrito,$zona,
		$dilacion_etapa,$dilacion,$usuario_idu,$super){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora = date("g");
		$min = date("i");

		$this->idmos=$idmos;
		$this->cope=$cope;
		$this->expediente=$expediente;
		$this->ddcarga=$dia;
		$this->mmcarga=$mes;
		$this->yearcarga=$aaaa;
		$this->folio_pisaplex=$folio_pisaplex;
		$this->folio_pisa=$folio_pisa;
		$this->telefono=$telefono;
		$this->cliente=$cliente;
		$this->tipo_tarea=$tipo_tarea;
		$this->tecnologia=$tecnologia;
		$this->distrito=$distrito;
		$this->zona=$zona;
		$this->dilacion_etapa=$dilacion_etapa;
		$this->dilacion=$dilacion;
		$this->usuario_idu=$usuario_idu;
		$this->asignado=$super;
		$this->pagados=0;
		$this->estado_os=0;
	}
	public function verOs(){
		echo $this->idmos."<br>";
		echo $this->cope."<br>";
		echo $this->expediente."<br>";
		echo $this->ddcarga."<br>";
		echo $this->mmcarga."<br>";
		echo $this->yearcarga."<br>";
		echo $this->folio_pisaplex."<br>";
		echo $this->folio_pisa."<br>";
		echo $this->telefono."<br>";
		echo $this->cliente."<br>";
		echo $this->tipo_tarea."<br>";
		echo $this->tecnologia."<br>";
		echo $this->distrito."<br>";
		echo $this->zona."<br>";
		echo $this->dilacion_etapa."<br>";
		echo $this->dilacion."<br>";
		echo $this->usuario_idu."<br>";
		echo $this->pagados."<br>";
		echo "==================================<br>";
	}
	public function registrarOsBD($con){
		/*
		function ingresaOrdenDeS($query){ 
	      $cone = Conectarse();  
	      return mysqli_query($cone,$query);
		}*/
		$f_pisa=$this->folio_pisa;
		$existe=$this->existe($f_pisa,$con);
		//if(!isset($existe)){ $existe=0;}
		//echo $f_pisa."-".$existe;
		if($existe==1){}
		else{
			$sql="INSERT INTO os (
		    idmos,cope,expediente,
		    ddcarga,mmcarga,yearcarga,folio_pisaplex,
		    folio_pisa,telefono,cliente,
		    tipo_tarea,tecnologia,distrito,zona,
		    dilacion_etapa,dilacion,usuario_idu,pagados,asignado,estado_os)
		    VALUES
		    ('".$this->idmos."','".$this->cope."','".$this->expediente."',
		     '".$this->ddcarga."','".$this->mmcarga."','".$this->yearcarga."','".$this->folio_pisaplex."',
		     '".$this->folio_pisa."','".$this->telefono."','".$this->cliente."',
		     '".$this->tipo_tarea."','".$this->tecnologia."','".$this->distrito."','".$this->zona."',
		     '".$this->dilacion_etapa."','".$this->dilacion."','".$this->usuario_idu."','".$this->pagados."',
		     '0','".$this->estado_os."'
		     )";
			//mysqli_query($con,$sql);
			//echo $sql;
			//ingresaOrdenDeS($sql);
		    $this->execute($sql) or die (mysqli_error($con)); 
		}
	}
	public function asignarOs($iduser,$os,$con){
		$sql="UPDATE os SET 
          	asignado='".$iduser."'
         	WHERE idmos='".$os."'";
          $this->execute($sql) or die (mysqli_error($con));
	}
	public function regresaIdmos(){return $this->idmos;}
	public function regresaCope(){return $this->cope;}
	public function regresaExpediente(){return $this->expediente;}
	public function regresaDDOS(){return $this->ddcarga;}
	public function regresaMMOS(){return $this->mmcarga;}
	public function regresaYEAROS(){return $this->yearcarga;}
	public function regresaFolioPisaplex(){return $this->folio_pisaplex;}
	public function regresaFolioPisa(){return $this->folio_pisa;}
	public function regresaTelefono(){return $this->telefono;}
	public function regresaCliente(){return $this->cliente;}
	public function regresaTipoTarea(){return $this->tipo_tarea;}
	public function regresaTecnologia(){return $this->tecnologia;}
	public function regresaDistrito(){return $this->distrito;}
	public function regresaZona(){return $this->zona;}
	public function regresaDilacionEtapa(){return $this->dilacion_etapa;}
	public function regresaDilacion(){return $this->dilacion;}
	public function regresaUsuarioIdu(){return $this->usuario_idu;}
	public function regresaPagados(){return $this->pagados;}
	public function regresaAsignado(){return $this->asignado;}
	public function regresaEstadoOs(){return $this->estado_os;}
}
?>