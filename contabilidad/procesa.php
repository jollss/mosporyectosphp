<?php
include("../Config/library.php"); 

$con = Conectarse();  
//var_dump($_POST);
//var_dump($_POST['array_selecion']);
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
foreach ($_POST['array_selecion'] as $valor) {
//	echo $valor."<br>";    
if(isset($_POST['mes']) and isset($_POST['anio']) and isset($_POST['option_search']) and isset($_POST['validar'])){
	$mes=$_POST['mes'];
	$aaaa=$_POST['anio'];
	$opcion=$_POST['option_search'];
	//$folio_pisav=$_POST['validar'];
	$folio_pisav=$valor;
    $dia=date('j');
    $mes1=date('n');
    $aaaa=date('Y');
    $hora=date('G');
    $min=date('i');
    $time=$hora.":".$min;
    $fecha_super=$dia."/".$mes1."/".$aaaa." ".$time;
    
    //unset($a1);
    $a1=validas($folio_pisav);
    //echo "VALOR DE A1:".$a1.$a2.$a3."<br>"; 
    
    if($a1==0){
        $sql="INSERT INTO validar_os (id_folio_pisa,fecha_cobranza,a_cobro)
        VALUES('".$folio_pisav."','".$fecha_super."','1')";
        //echo $sql."<br>";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    }if($a1==1){
    	//echo "SI ESTA: ".$folio_pisav."<br>"; 
    	$sql="UPDATE validar_os SET fecha_cobranza='$fecha_super', a_cobro=1 WHERE id_folio_pisa='".$folio_pisav."'";
    	//echo $sql."<br>";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    }
    //unset($a1);
}
$valor = $valor+1;
}
echo "<script> document.location=('pagos.php?mes=".$mes."&anio=".$aaaa."&option_search=1'); </script>"; 
//echo "FIN";
?>