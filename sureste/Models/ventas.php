<?php
/**
* 
*/
class Ventas
{
	
	var $idventa;
	var $folio_ventas;
	var $idvendedor;
	var $nombre;
	var $apaternov;
	var $amaternov;
	var $direccion;
	var $datos;
	var $terminal;
	var $telefono_1;
	var $telefono_2;
	var $telefono_3;
	var $dia;
	var $mes;
	var $year;
	var $time;
	var $estatus;
	var $vendedor;
	var $documentacion;
	var $area;
	var $distrito;
	var $rfc;
	var $mail;
	var $tipo_cliente;
	var $paquete_venta;
	public function totalVentas($con){
		$ls=0;
		$con->real_query("SELECT * FROM ventas WHERE estatus=0");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function totalVentasFull($con){
		$ls=0;
		$con->real_query("SELECT * FROM ventas");
	    $r = $con->use_result();
	    while ($l = $r->fetch_assoc()){
	        $ls++;
	    }
	    return $ls;
	}
	public function delAllVenta($id,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE ventas SET 
          	folio_ventas='',idvendedor='0',vendedor=''
         	WHERE idventa='".$id."'";
		//$sql="DELETE FROM ventas WHERE idventa='".$id."'";
		execute($sql) or die (mysqli_error($con));

	}
	public function ingresaVentas($id,$folio_ventas,$idvendedor,$nombre,$apaternov,$amaternov,$direccion,$datos,
		$terminal,$telefono_1,$telefono_2,$telefono_3,$estatus,$documentacion,$rfc,$mail,$tipo_cliente,$paquete_venta){
		date_default_timezone_set('America/Mexico_City');
		$dia=date('j');
		$mes=date('n');
		$aaaa=date('Y');
		$hora=date('G');
		$min=date('i');
		$time=$hora.":".$min;

		$this->idventa=$id;
		$this->folio_ventas=$folio_ventas;
		$this->idvendedor=$idvendedor;
		$this->nombre=$nombre;
		$this->apaternov=$apaternov;
		$this->amaternov=$amaternov;
		$this->direccion=$direccion;
		$this->datos=$datos;
		$this->terminal=$terminal;
		$this->telefono_1=$telefono_1;
		$this->telefono_2=$telefono_2;
		$this->telefono_3=$telefono_3;
		$this->dia=$dia;
		$this->mes=$mes;
		$this->year=$aaaa;
		$this->time=$time;
		$this->estatus=$estatus;
		$this->vendedor=0;
		$this->documentacion=$documentacion;
		$this->area='';
		$this->distrito='';
		$this->rfc=$rfc;
		$this->mail=$mail;
		$this->tipo_cliente=$tipo_cliente;
		$this->paquete_venta=$paquete_venta;
	}
	public function obtenerUltimo($con){
		$row_cnt=0;
		$sql1="SELECT * FROM ventas";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$row_cnt=$row['idventa'];
        }
        $total=$row_cnt+1;
		return $total;
	}
	public function verVentas(){
		echo $this->idventa;echo "<br>";
		echo $this->folio_ventas;echo "<br>";
		echo $this->idvendedor;echo "<br>";
		echo $this->nombre;echo "<br>";
		echo $this->apaternov;echo "<br>";
		echo $this->amaternov;echo "<br>";
		echo $this->direccion;echo "<br>";
		echo $this->datos;echo "<br>";
		echo $this->terminal;echo "<br>";
		echo $this->telefono_1;echo "<br>";
		echo $this->telefono_2;echo "<br>";
		echo $this->telefono_3;echo "<br>";
		echo $this->dia;echo "<br>";
		echo $this->mes;echo "<br>";
		echo $this->year;echo "<br>";
		echo $this->time;echo "<br>";
		echo $this->estatus;echo "<br>";
		echo "Vendedor:".$this->vendedor;echo "<br>";
		echo $this->documentacion."<br>";
		echo $this->area."<br>";
		echo $this->distrito."<br>";
		echo "---------------------------";
	}
	public function modificarPaquete($paquete_venta,$con,$id){
		$sql="UPDATE ventas SET 
          	paquete_venta='$paquete_venta'
         	WHERE idventa='".$id."'";
         	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function registrarVentaBD($con){
		$hora=$this->time;

	    $sql="INSERT INTO ventas (
	    idventa,folio_ventas,idvendedor,
	    nombre,apaternov,amaternov,direccion,
	    datos,terminal,telefono_1,telefono_2,telefono_3,
	    dia,mes,year,hora,
	    estatus,vendedor,documentacion,area,distrito,
	    rfc_cliente,correo_cliente,tipo_cliente,paquete_venta)
	    VALUES
	    ('".$this->idventa."','".$this->folio_ventas."','".$this->idvendedor."',
	     '".$this->nombre."','".$this->apaternov."','".$this->amaternov."','".$this->direccion."',
	     '".$this->datos."','".$this->terminal."','".$this->telefono_1."','".$this->telefono_2."',
	     '".$this->telefono_3."','".$this->dia."','".$this->mes."','".$this->year."',
	     '".$hora."','".$this->estatus."','".$this->vendedor."','".$this->documentacion."','".$this->area."','".$this->distrito."',
	     '".$this->rfc."','".$this->mail."','".$this->tipo_cliente."','".$this->paquete_venta."')";
	//echo "---------------------------";
		//mysqli_query($con,$sql);
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	    //execute($sql) or die (mysqli_error($con)); 
	}
	public function obtenerVentaBD($id,$con){
		$sql1="SELECT * FROM ventas WHERE '$id'=idventa";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idventa=$row['idventa'];
         	$this->folio_ventas=$row['folio_ventas'];
			$this->idvendedor=$row['idvendedor'];
			$this->direccion=$row['direccion'];
			$this->datos=$row['datos'];
			$this->nombre=$row['nombre'];
			$this->apaternov=$row['apaternov'];
			$this->amaternov=$row['amaternov'];
			$this->terminal=$row['terminal'];
			$this->telefono_1=$row['telefono_1'];
			$this->telefono_2=$row['telefono_2'];
			$this->telefono_3=$row['telefono_3'];
			$this->dia=$row['dia'];
			$this->mes=$row['mes'];
			$this->year=$row['year'];
			$this->time=$row['hora'];
			$this->estatus=$row['estatus'];
			$this->vendedor=$row['vendedor'];
			$this->documentacion=$row['documentacion'];
			$this->area=$row['area'];
			$this->distrito=$row['distrito'];
			$this->mail=$row['correo_cliente'];
			$this->rfc=$row['rfc_cliente'];
			$this->paquete_venta=$row['paquete_venta'];
        }
	}
	public function obtenerVentaVendedorBD($id,$con){
		$sql1="SELECT * FROM ventas WHERE '$id'=idvendedor";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idventa=$row['idventa'];
         	$this->folio_ventas=$row['folio_ventas'];
			$this->idvendedor=$row['idvendedor'];
			$this->direccion=$row['direccion'];
			$this->datos=$row['datos'];
			$this->nombre=$row['nombre'];
			$this->apaternov=$row['apaternov'];
			$this->amaternov=$row['amaternov'];
			$this->terminal=$row['terminal'];
			$this->telefono_1=$row['telefono_1'];
			$this->telefono_2=$row['telefono_2'];
			$this->telefono_3=$row['telefono_3'];
			$this->dia=$row['dia'];
			$this->mes=$row['mes'];
			$this->year=$row['year'];
			$this->time=$row['hora'];
			$this->estatus=$row['estatus'];
			$this->vendedor=$row['vendedor'];
			$this->documentacion=$row['documentacion'];
			$this->area=$row['area'];
			$this->distrito=$row['distrito'];
			$this->mail=$row['correo_cliente'];
			$this->rfc=$row['rfc_cliente'];
			$this->paquete_venta=$row['paquete_venta'];
        }
	}
	public function cambiarEstatus($id,$con){
		$sql="UPDATE ventas SET 
          	estatus='1'
         	WHERE idventa='".$id."'";
          //execute($sql) or die (mysqli_error($con));
         	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	/*public function cambiarVendedor($id,$data,$con){
		$sql="UPDATE ventas SET 
          	idvendedor='".$data."'
         	WHERE idventa='".$id."'";
          execute($sql) or die (mysqli_error($con));
	}*/
	public function cambiarArea($id,$data,$con){
		
		$sql="UPDATE ventas SET 
          	area='$data'
         	WHERE idventa='".$id."'";
          //execute($sql) or die (mysqli_error($con));
         	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function cambiarDistrito($id,$data,$con){
		
		$sql="UPDATE ventas SET 
          	distrito='$data'
         	WHERE idventa='".$id."'";
          //execute($sql) or die (mysqli_error($con));
         	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function cambiarVendedor($id,$data,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE ventas SET 
          	idvendedor='$data'
         	WHERE idventa='".$id."'"; 
          //execute($sql) or die (mysqli_error($con));
        if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function modificarVenta($id,$folio_ventas,$nombre,$apaterno,$amaterno,$dir,$datos,$terminal,$tel1,$tel2,$tel3,$documentacion,$con){
		function execute($query){
		      $con = Conectarse();  
		      return mysqli_query($con,$query);
		}
		$sql="UPDATE ventas SET 
          	folio_ventas='".$folio_ventas."',
          	nombre='".$nombre."',
          	apaternov='".$apaterno."',
          	amaternov='".$amaterno."',
          	direccion='".$dir."',
          	datos='".$datos."',
          	terminal='".$terminal."',
          	telefono_1='".$tel1."',
          	telefono_2='".$tel2."',
          	telefono_3='".$tel3."',
          	documentacion='".$documentacion."'
         	WHERE idventa='".$id."'";
          //execute($sql) or die (mysqli_error($con));
         if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	public function regresaIdVenta(){return $this->idventa;}
	public function regresaFolioVenta(){return $this->folio_ventas;}
	public function regresaVendedor(){return $this->idvendedor;}
	public function regresaNombre(){return $this->nombre;}
	public function regresaApaterno(){return $this->apaternov;}
	public function regresaAmaterno(){return $this->amaternov;}
	public function regresaDireccion(){return $this->direccion;}
	public function regresaDatos(){return $this->datos;}
	public function regresaTerminal(){return $this->terminal;}
	public function regresaTel1(){return $this->telefono_1;}
	public function regresaTel2(){return $this->telefono_2;}
	public function regresaTel3(){return $this->telefono_3;}
	public function regresaDia(){return $this->dia;}
	public function regresaMes(){return $this->mes;}
	public function regresaYear(){return $this->year;}
	public function regresaHora(){return $this->time;}
	public function regresaEstatus(){return $this->estatus;}
	public function regresaVendedorN(){return $this->vendedor;}
	public function regresaDocumentacion(){return $this->documentacion;}
	public function regresaArea(){return $this->area;}
	public function regresaDistrito(){return $this->distrito;}
	public function regresaRFC(){return $this->rfc;}
	public function regresaCorreo(){return $this->mail;}
	public function regresaPaquete(){return $this->paquete_venta;}
}
?>