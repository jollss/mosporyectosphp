<?php
/**
* Clase modelo para usuarios
*/
class Usuario
{
//Atributos
		var $idu;
		var $activo;
		var $correo;
		var $nombre;
		var $apaterno;
		var $amaterno;
		var $pssw;
		var $nocuenta;
		var $cel;
		var $tel;
		var $fecha_ingreso;
		var $fecha_seguro;
		var $direccion;
		var $estado_civil;
		var $estatura;
		var $licencia;
		var $curp;
		var $tel_emerg;
		var $checador;
		var $tipo_personal;
		var $asignado;
		var $tipo_idtipo;
//Metodos
	public function obtenerIdu($con){
		$row_cnt=0;
		if($ultimo =mysqli_query($con,"SELECT idu FROM usuario ORDER BY idu")){
		  $row_cnt=mysqli_num_rows($ultimo);
		  mysqli_free_result($ultimo);
		}
		$this->idu=$row_cnt;
	}
	public function ingresarUsuario($id,$correo,$nombre,$apaterno,$amaterno,$pssw,$nocuenta,$cel,$tel,$fecha_ingreso,$fecha_seguro,$direccion,$estado_civil,$estatura,$licencia,$curp,$tel_emerg,$checador,$tipo_personal,$tipo_idtipo){
		$this->idu=$id;
		$this->activo=1;
		$this->correo=$correo;
		$this->nombre=strtoupper($nombre);
		$this->apaterno=strtoupper($apaterno);
		$this->amaterno=strtoupper($amaterno);
		$this->pssw=md5($pssw);
		$this->nocuenta=strtoupper($nocuenta);
		$this->cel=$cel;
		$this->tel=$tel;
		$this->fecha_ingreso=$fecha_ingreso;
		$this->estado_civil=$estado_civil;
		$this->fecha_seguro=$fecha_seguro;
		$this->direccion=strtoupper($direccion);
		$this->estatura=$estatura;
		$this->licencia=strtoupper($licencia);
		$this->curp=strtoupper($curp);
		$this->tel_emerg=$tel_emerg;
		$this->checador=$checador;
		$this->tipo_personal=$tipo_personal;
		$this->asignado=0;
		$this->tipo_idtipo=$tipo_idtipo;
	}
	public function verUsuario(){
		echo $this->idu;echo "<br>";
		echo $this->activo;echo "<br>";
		echo $this->correo;echo "<br>";
		echo $this->nombre;echo "<br>";
		echo $this->apaterno;echo "<br>";
		echo $this->amaterno;echo "<br>";
		echo $this->pssw;echo "<br>";
		echo $this->nocuenta;echo "<br>";
		echo $this->cel;echo "<br>";
		echo $this->tel;echo "<br>";
		echo $this->fecha_ingreso;echo "<br>";
		echo $this->fecha_seguro;echo "<br>";
		echo $this->direccion;echo "<br>";
		echo $this->estado_civil;echo "<br>";
		echo $this->estatura;echo "<br>";
		echo $this->licencia;echo "<br>";
		echo $this->curp;echo "<br>";
		echo $this->tel_emerg;echo "<br>";
		echo $this->checador;echo "<br>";
		echo $this->tipo_personal;echo "<br>";
		echo $this->asignado;echo "<br>";
		echo $this->tipo_idtipo;echo "<br>";
	}
	public function obtenerUsuarioBD($idu,$con){
		$sql1="SELECT * FROM usuario WHERE idu='$idu'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idu=$row['idu'];
         	$this->activo=$row['activo'];
			$this->correo=$row['correo'];
			$this->nombre=$row['nombre'];
			$this->apaterno=$row['apaterno'];
			$this->amaterno=$row['amaterno'];
			$this->pssw=$row['pssw'];
			$this->nocuenta=$row['nocuenta'];
			$this->cel=$row['cel'];
			$this->tel=$row['tel'];
			$this->fecha_ingreso=$row['fecha_ingreso'];
			$this->fecha_seguro=$row['fecha_seguro'];
			$this->direccion=$row['direccion'];
			$this->estado_civil=$row['estado_civil'];
			$this->estatura=$row['estatura'];
			$this->licencia=$row['licencia'];
			$this->curp=$row['curp'];
			$this->tel_emerg=$row['tel_emerg'];
			$this->checador=$row['checador'];
			$this->tipo_personal=$row['tipo_personal'];
			$this->asignado=$row['asignado'];
			$this->tipo_idtipo=$row['tipo_idtipo'];
        }
	}
	public function obtenerUsuarioCorreoBD($mail,$con){
		$sql1="SELECT * FROM usuario WHERE correo='$mail'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idu=$row['idu'];
         	$this->activo=$row['activo'];
			$this->correo=$row['correo'];
			$this->nombre=$row['nombre'];
			$this->apaterno=$row['apaterno'];
			$this->amaterno=$row['amaterno'];
			$this->pssw=$row['pssw'];
			$this->nocuenta=$row['nocuenta'];
			$this->cel=$row['cel'];
			$this->tel=$row['tel'];
			$this->fecha_ingreso=$row['fecha_ingreso'];
			$this->fecha_seguro=$row['fecha_seguro'];
			$this->direccion=$row['direccion'];
			$this->estado_civil=$row['estado_civil'];
			$this->estatura=$row['estatura'];
			$this->licencia=$row['licencia'];
			$this->curp=$row['curp'];
			$this->tel_emerg=$row['tel_emerg'];
			$this->checador=$row['checador'];
			$this->tipo_personal=$row['tipo_personal'];
			$this->asignado=$row['asignado'];
			$this->tipo_idtipo=$row['tipo_idtipo'];
        }
	}
	public function existeUsuario($mail,$con){
		$sql1="SELECT * FROM usuario WHERE correo='$mail'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$correo=$row['correo'];
        }
        if($correo==$mail){
        	return 1;
        }else{
        	return 0;
        }
	}
	public function existeNombreUsuario($nombre,$apep,$apma,$con){
		$sql1="SELECT * FROM usuario WHERE nombre='$nombre' and apaterno='$apep' and amaterno='$apma'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$nom=$row['nombre'];
        	$app=$row['apaterno'];
        	$apm=$row['amaterno'];
        }
        if($nom==$nombre and $app==$apep and $apm==$apma){
        	return 1;
        }else{
        	return 0;
        }
	}
	public function registrarUsuarioBD($con){
		/*function execute($query){
		      $con = Conectarse();
		      return mysqli_query($con,$query);
		}*/
		$sql="INSERT INTO usuario (
	    idu,activo,correo,
	    nombre,apaterno,amaterno,pssw,
	    nocuenta,cel,tel,
	    fecha_ingreso,fecha_seguro,direccion,estado_civil,
	    estatura,licencia,curp,tel_emerg,checador,tipo_personal,asignado,tipo_idtipo,bandera_contrase)
	    VALUES
	    ('".$this->idu."','".$this->activo."','".$this->correo."',
	     '".$this->nombre."','".$this->apaterno."','".$this->amaterno."','".$this->pssw."',
	     '".$this->nocuenta."','".$this->cel."','".$this->tel."',
	     '".$this->fecha_ingreso."','".$this->fecha_seguro."','".$this->direccion."','".$this->estado_civil."',
	     '".$this->estatura."','".$this->licencia."','".$this->curp."','".$this->tel_emerg."','".$this->checador."',
	     '".$this->tipo_personal."','".$this->asignado."','".$this->bandera_contrase."','".$this->tipo_idtipo."'
	     )";
	    //execute($sql) or die (mysqli_error($con));
		if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function cambiarAsignado($id,$con){
		function execute($query){
		      $con = Conectarse();
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE usuario SET
          	asignado='0'
         	WHERE idu='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}
	public function TotalUsuariosActivosBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM usuario WHERE activo=1");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function TotalUsuariosActivosTBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM usuario WHERE activo=1 AND tipo_idtipo=1");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function TotalUBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM usuario");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function TotalUsuariosNoActivosBD($con){
		$tos=0;
		$con->real_query("SELECT * FROM usuario WHERE activo=0");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function regresaIdu(){return $this->idu;}
	public function regresaActivo(){return $this->activo;}
	public function regresaCorreo(){return $this->correo;}
	public function regresaNombre(){return $this->nombre;}
	public function regresaApaterno(){return $this->apaterno;}
	public function regresaAmaterno(){return $this->amaterno;}
	public function regresaPssw(){return $this->pssw;}
	public function regresaNocuenta(){return $this->nocuenta;}
	public function regresaCel(){return $this->cel;}
	public function regresaTel(){return $this->tel;}
	public function regresaFechaIngreso(){return $this->fecha_ingreso;}
	public function regresaFechaSeguro(){return $this->fecha_seguro;}
	public function regresaDireccion(){return $this->direccion;}
	public function regresaEstadoCivil(){return $this->estado_civil;}
	public function regresaEstatura(){return $this->estatura;}
	public function regresaLicencia(){return $this->licencia;}
	public function regresaCurp(){return $this->curp;}
	public function regresaTelEmergencia(){return $this->tel_emerg;}
	public function regresaChecador(){return $this->checador;}
	public function regresaTipoPersonal(){return $this->tipo_personal;}
	public function regresaAsignado(){return $this->asignado;}
	public function regresaTipoIdTipo(){return $this->tipo_idtipo;}
}
?>
