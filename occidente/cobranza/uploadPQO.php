<?php
include("../Config/library.php"); 
$con = Conectarse(); 
if(isset($_FILES)){
	//var_dump($_FILES);
	//obtenemos el archivo .csv
	$tipo = $_FILES['file']['type']; 
	$tamanio = $_FILES['file']['size'];
	$archivotmp = $_FILES['file']['tmp_name'];
	//cargamos el archivo
	$lineas = file($archivotmp);
	$existe=0;
	$insert=0;
	$update=0;
	foreach ($lineas as $linea_num => $linea)
	{ 
	   //abrimos bucle
	   /*si es diferente a 0 significa que no se encuentra en la primera línea 
	   (con los títulos de las columnas) y por lo tanto puede leerla*/
	   if($i != 0) 
	   { 
	   		$datos = explode(",",$linea);
	   		$no = $datos[0];
	   		$folioPisa = $datos[1];
	   		$telefono = $datos[2];
	   		$paqo = $datos[3];
	       	$factura = $datos[4];
	       	
	       	/*$sql="SELECT * FROM os 
	 		inner join validar_os
	 		where folio_pisa=id_folio_pisa and idmos=id_orden and id_folio_pisa='$folioPisa'";
	 		*/
	 		/*
	 		$sql="SELECT * FROM os WHERE folio_pisa='$folioPisa'";
		    $resultado=$con->query($sql);
	        while($row = $resultado->fetch_assoc())
	        {
	        */ 
	        	$idmos=$row['idmos'];
	        	$con2 = Conectarse();
	        	$sql2="SELECT * FROM validar_os WHERE id_folio_pisa='$folioPisa'";
			    $resultado2=$con2->query($sql2);
		        while($row2 = $resultado2->fetch_assoc())
		        {
		        	$folio_validado=$row2['id_folio_pisa'];
		        }
		        if($folio_validado==$folioPisa){
	        		$existe=1;
	        	}if($folio_validado<>$folioPisa or $folio_validado=='')	      	{
	        		$existe=0;
	        	}
		        //echo $existe."<br>";
		        
		        if($existe==1 and $folioPisa<>''){
		        	echo $existe."--".$no."----".$folioPisa."-".$factura."-".$paqo."---VALIDADO<br>";
		        	$cons = Conectarse(); 
		        	$sqls="UPDATE validar_os SET 
		          	paqo='$paqo',
		          	factura_os='$factura'
		         	WHERE id_folio_pisa='".$folioPisa."'";
		         	//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
		         	if ($cons->query($sql) === TRUE) { 
		         		//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
		         	} else { if (!mysqli_query($cons, $sqls)) { printf("Error al actualizar: %s\n", mysqli_error($cons)); echo "<br>";} }
		         	$update++;
		        }if($existe==0){
		        	
		        	$cons = Conectarse(); 
		        	$sql="INSERT INTO validar_os(id_folio_pisa,fecha_sup,fecha_calidad,
					fecha_coordinador,fecha_cobranza,a_cobro,
					paqo,tipo_paqo,factura_os) 
					VALUES ('".$folioPisa."','','',
					'','','',
					'".$paqo."','','".$factura."')";
		         	//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
		         	if ($cons->query($sql) === TRUE) { 
		         		//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
		         	} else { if (!mysqli_query($cons, $sqls)) { printf("Error al ingresar: %s\n", mysqli_error($cons)); echo "<br>";} }
		         	$insert++;
		         	echo $existe."--".$no."----".$folioPisa."-".$factura."-".$paqo."---INSERTADO<br>";
		         	
		        }
		        
	        //}
	   }
	   $i++;
	}
}
echo "<h2>INSERTADOS= ".$insert." ACTUALIZADOS= ".$update."</h2><br>";
?>
<form role="form" name="importar" method="POST" action="uploadPQO.php" enctype="multipart/form-data">
    <label for="photo">Archivo CSV separado por comas de Excel</label>
    <div class="drag-drop">
        <input accept=".csv" name="file" type="file" style="" id="data" /><br>
    </div>
    <input type="hidden" value="upload" name="action" />
    <button type="submit" class="btn btn-primary"><span>
    		SUBIR
            <i class="glyphicon glyphicon-open bottom pulsating"></i>
        </span>
    </button>
</form>