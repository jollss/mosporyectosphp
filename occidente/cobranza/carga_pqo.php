<?php
include("../Config/library.php"); 
$con = Conectarse();  
$url=$_POST['url'];
//obtenemos el archivo .csv
$tipo = $_FILES['file']['type']; 
$tamanio = $_FILES['file']['size'];
$archivotmp = $_FILES['file']['tmp_name'];
//cargamos el archivo
$lineas = file($archivotmp);
//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;
$l=0;
//var_dump($_FILES);
//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea 
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0) 
   { 
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
       leyendo hasta que encuentre un ; */
       $datos = explode(",",$linea);
       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
       //$nombre = utf8_encode($datos[0]);
       $folioPisa = $datos[1];
       $factura = $datos[2];
       $paqo = $datos[5];
       //$profesion = utf8_encode($datos[2]);
 		$sql="SELECT * FROM os 
 		inner join dataos inner join validar_os
 		where folio_pisa=id_folio_pisa and idmos=id_orden and id_folio_pisa='$folioPisa'";
	    $resultado=$con->query($sql);
        while($row = $resultado->fetch_assoc())
        {
			//echo $folioPisa." ".$paqo."<br>";
			$j=$row['id_folio_pisa'];
			$tipo_os=$row['tipo_os'];
      $factura=$row['factura_os'];
      $paqo=$row['paqo'];
			//$l++;
        }
        if(isset($folioPisa) and isset($paqo) and isset($j) and isset($tipo_os)){
        	
        	if($j==$folioPisa and ($paqo=='' or $factura=='')){
	     		$l++;	
	       		$sql="UPDATE validar_os SET 
	          	paqo='$paqo',
	          	factura_os='$factura'
	         	WHERE id_folio_pisa='".$folioPisa."'";
	         	//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
	         	if ($con->query($sql) === TRUE) { 
	         		//echo $l."--".$folioPisa." ".$paqo." ".$j." ".$tipo_os."<br>";
	         	} else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	         	
        	}
    	}
   }
 
   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle
}
//alert('MODIFICACION EXITOSA! Por favor sal e ingresa de nuevo para ver cambios reflejados.');
  echo "
    <script>
        alert('".$l." folios fueron registrados');
        document.location=('".$url."');
    </script>"; 
?>