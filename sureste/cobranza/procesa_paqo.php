<?php
include("../Config/library.php"); 

$con = Conectarse();  
//var_dump($_POST);
//var_dump($_POST['array_selecion']);
function valida($folio_pisav){
    $con2 = Conectarse();
     
    $sql2="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisav'";

    if ($result = mysqli_query($con2, $sql2)) {
        $row_cnt = mysqli_num_rows($result);
        printf("El resultado tiene %d filas.\n", $row_cnt);
        return $row_cnt;
        mysqli_free_result($result);
    }
    //return $a1;
}
foreach ($_POST['array_selecion'] as $valor) {  
if(isset($_POST['paqo']) and isset($_POST['tipo_paqo'])){
	//$folio_pisav=$_POST['validar'];
    $paqo=strtoupper($_POST['paqo']);
    $tipo_paqo=$_POST['tipo_paqo'];
	$folio_pisav=$valor;
    $dia=date('j');
    $mes1=date('n');
    $aaaa=date('Y');
    $hora=date('G');
    $min=date('i');
    $time=$hora.":".$min;
    $fecha_super=$dia."/".$mes1."/".$aaaa." ".$time;
    
    //unset($a1);
    $a1=valida($folio_pisav);
    //echo "VALOR DE A1:".$a1.$a2.$a3."<br>"; 
    
    if($a1==0){
        $sql="INSERT INTO validar_os (id_folio_pisa,paqo,tipo_paqo)
        VALUES('".$folio_pisav."','".$paqo."','".$tipo_paqo."')";
        //echo $sql."<br>";
        if ($con->query($sql) === TRUE) { echo "Nuevo paqo ingresado"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    }if($a1==1){
    	//echo "SI ESTA: ".$folio_pisav."<br>";
    	$sql="UPDATE validar_os SET paqo='$paqo', tipo_paqo='$tipo_paqo' WHERE id_folio_pisa='".$folio_pisav."'";
    	//echo $sql."<br>";
        if ($con->query($sql) === TRUE) { echo "Actualizado el paqo"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    }
    //unset($a1);
}
$valor = $valor+1;
}
echo "<script> document.location=('os_spaqo.php?month=".$mes1."&year=".$aaaa."&option_search=1'); </script>"; 
//echo "FIN";
?>