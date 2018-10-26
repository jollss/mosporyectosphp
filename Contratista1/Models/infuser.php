<?php
/**
* Datos para insert de infuser
*/
class Infuser extends Usuario
{
//atributos
	var $idinfo;
	var $departamento;
	var $hora_entrada;
	var $hora_salida;
	var $tipo_contrato;
	var $fecha_nacimiento;
	var $nacionalidad;
	var $sexo;
	var $peso;
	var $correo_alterno;
	var $nss;
	var $ife;
	var $rfc;
	var $vig_licencia;
	var $salario;
	var $usuario_iduu;
//metodos	
	public function obtenerIdInfuser($con){
		$row_cnt=0;
		/*
		if($ultimo =mysqli_query($con,"SELECT idinfo FROM infuser ORDER BY idinfo")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}*/
		$sql1="SELECT * FROM infuser ORDER BY idinfo";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
          $idinfo=$row['idinfo'];
      	}
		$this->idinfo=$idinfo+1;
	}
	public function ingresarInfuser($departamento,$hora_entrada,$hora_salida,$tipo_contrato,
		$fecha_nacimiento,$nacionalidad,$sexo,$peso,$correo_alterno,$nss,$ife,$rfc,$vig_licencia,$salario,$usuario_iduu){
		$this->departamento=strtoupper($departamento);
		$this->hora_entrada=$hora_entrada;
		$this->hora_salida=$hora_salida;
		$this->tipo_contrato=strtoupper($tipo_contrato);	
		$this->fecha_nacimiento=$fecha_nacimiento;
		$this->nacionalidad=strtoupper($nacionalidad);
		$this->sexo=strtoupper($sexo);
		$this->peso=$peso;
		$this->correo_alterno=$correo_alterno;
		$this->nss=strtoupper($nss);
		$this->ife=strtoupper($ife);
		$this->rfc=strtoupper($rfc);
		$this->vig_licencia=strtoupper($vig_licencia);
		$this->salario=$salario;
		$this->usuario_iduu=$usuario_iduu;
	}
	public function verInfuser(){
		echo $this->idinfo;echo "<br>";
		echo $this->departamento;echo "<br>";
		echo $this->hora_entrada;echo "<br>";
		echo $this->hora_salida;echo "<br>";
		echo $this->tipo_contrato;echo "<br>";
		echo $this->fecha_nacimiento;echo "<br>";
		echo $this->nacionalidad;echo "<br>";
		echo $this->sexo;echo "<br>";
		echo $this->peso;echo "<br>";
		echo $this->correo_alterno;echo "<br>";
		echo $this->nss;echo "<br>";
		echo $this->ife;echo "<br>";
		echo $this->rfc;echo "<br>";
		echo $this->vig_licencia;echo "<br>";
		echo $this->salario;echo "<br>";
		echo $this->usuario_iduu;echo "<br>";
	}
	public function obtenerInfuserBD($idu,$con){
		$sql1="SELECT * FROM infuser WHERE idinfo=".$idu;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idinfo=$row['idinfo'];
         	$this->departamento=$row['departamento'];
			$this->hora_entrada=$row['hora_entrada'];
			$this->hora_salida=$row['hora_salida'];
			$this->tipo_contrato=$row['tipo_contrato'];
			$this->fecha_nacimiento=$row['fecha_nacimiento'];
			$this->nacionalidad=$row['nacionalidad'];
			$this->sexo=$row['sexo'];
			$this->peso=$row['peso'];
			$this->correo_alterno=$row['correo_alterno'];
			$this->nss=$row['nss'];
			$this->ife=$row['ife'];
			$this->rfc=$row['rfc'];
			$this->vig_licencia=$row['vig_licencia'];
			$this->salario=$row['salario'];
			$this->usuario_iduu=$row['usuario_iduu'];
        }
	}
	public function obtenerInfuserUBD($idu,$con){
		$sql1="SELECT * FROM infuser WHERE usuario_iduu=".$idu;
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idinfo=$row['idinfo'];
         	$this->departamento=$row['departamento'];
			$this->hora_entrada=$row['hora_entrada'];
			$this->hora_salida=$row['hora_salida'];
			$this->tipo_contrato=$row['tipo_contrato'];
			$this->fecha_nacimiento=$row['fecha_nacimiento'];
			$this->nacionalidad=$row['nacionalidad'];
			$this->sexo=$row['sexo'];
			$this->peso=$row['peso'];
			$this->correo_alterno=$row['correo_alterno'];
			$this->nss=$row['nss'];
			$this->ife=$row['ife'];
			$this->rfc=$row['rfc'];
			$this->vig_licencia=$row['vig_licencia'];
			$this->salario=$row['salario'];
			$this->usuario_iduu=$row['usuario_iduu'];
        }
	}
	public function registrarInfouserBD($con){
		/*function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}*/
		$sql="INSERT INTO infuser (
	    idinfo,departamento,hora_entrada,
	    hora_salida,tipo_contrato,fecha_nacimiento,nacionalidad,
	    sexo,peso,correo_alterno,
	    nss,ife,rfc,vig_licencia,
	    salario,usuario_iduu)
	    VALUES
	    ('".$this->idinfo."','".$this->departamento."','".$this->hora_entrada."',
	     '".$this->hora_salida."','".$this->tipo_contrato."','".$this->fecha_nacimiento."','".$this->nacionalidad."',
	     '".$this->sexo."','".$this->peso."','".$this->correo_alterno."',
	     '".$this->nss."','".$this->ife."','".$this->rfc."','".$this->vig_licencia."',
	     '".$this->salario."','".$this->usuario_iduu."'
	     )";
	    //execute($sql) or die (mysqli_error($con)); 
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
	}
	public function regresaIdinfo(){return $this->idinfo;}
	public function regresaDepartamento(){return $this->departamento;}
	public function regresaHoraEntrada(){return $this->hora_entrada;}
	public function regresaHoraSalida(){return $this->hora_salida;}
	public function regresaTipoContrato(){return $this->tipo_contrato;}
	public function regresaFechaNacimiento(){return $this->fecha_nacimiento;}
	public function regresaNacionalidad(){return $this->nacionalidad;}
	public function regresaSexo(){return $this->sexo;}
	public function regresaPeso(){return $this->peso;}
	public function regresaCorreoAlterno(){return $this->correo_alterno;}
	public function regresaNss(){return $this->nss;}
	public function regresaIfe(){return $this->ife;}
	public function regresaRfc(){return $this->rfc;}
	public function regresaVigLicencia(){return $this->vig_licencia;}
	public function regresaSalario(){return $this->salario;}
	public function regresaUsuarioIduu(){return $this->usuario_iduu;}
}
?>