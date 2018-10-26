<?php
include("../Config/library.php"); 
$con = Conectarse(); 
function validas($folio_pisav){
    $con2 = Conectarse();
     
    $sql2="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisav'";
    /*
    $resultado2=$con2->query($sql2);
    while($row2 = $resultado2->fetch_assoc())
    {
        $a1=$row2['fecha_cobranza'];
        //$a2=$row2['fecha_calidad'];
        //$a3=$row2['fecha_coordinador'];
    }*/
    if ($result = mysqli_query($con2, $sql2)) {

        /* determinar el número de filas del resultado */
        $row_cnt = mysqli_num_rows($result);

        printf("El resultado tiene %d filas.\n", $row_cnt);
        return $row_cnt;
        /* cerrar el resulset */
        mysqli_free_result($result);
    }
    //return $a1;
}
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
	$fecha_super=date("d/n/Y", strtotime($_POST['fecha_super']));
	//$fecha_super='26/5/2018';
	echo $fecha_super;
	
	if(isset($fecha_super)){
		foreach ($lineas as $linea_num => $linea)
		{ 
		   //abrimos bucle
		   if($i != 0) 
		   { 
		   		$datos = explode(",",$linea);
		   		$no = $datos[0];
		   		$folioPisa = $datos[1];
		   		echo $folioPisa."<br>";
		   		$a1=validas($folioPisa);
			    //echo "VALOR DE A1:".$a1.$a2.$a3."<br>"; 
			    
			    if($a1==0){
			        $sql="INSERT INTO validar_os (id_folio_pisa,fecha_cobranza,a_cobro)
			        VALUES('".$folioPisa."','".$fecha_super."','1')";
			        //echo $sql."<br>";
			        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
			    }if($a1==1){
			    	//echo "SI ESTA: ".$folio_pisav."<br>"; 
			    	$sql="UPDATE validar_os SET fecha_cobranza='$fecha_super', a_cobro=1 WHERE id_folio_pisa='".$folioPisa."'";
			    	//echo $sql."<br>";
			        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
			    }
		   }
		   $i++;
		}
	}
	
}
echo "<h2>NO PAGADOS= ".$nada." PAGADOS= ".$update." NUEVOS DATOS ".$insert."</h2><br>";
?>
<form role="form" name="importar" method="POST" action="pagoMasv.php" enctype="multipart/form-data">
    <label for="photo">Archivo CSV separado por comas de Excel</label>
    <div class="drag-drop">
        <input accept=".csv" name="file" type="file" style="" id="data" /><br>
    </div>
    <input type="hidden" value="upload" name="action" />
    <input type="date" name="fecha_super" required>
    <button type="submit" class="btn btn-primary"><span>
    		SUBIR
            <i class="glyphicon glyphicon-open bottom pulsating"></i>
        </span>
    </button>
</form>