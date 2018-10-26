<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
var_dump($_POST);
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idu=$_POST['cambio'];
//$activo=$_POST['activo'];
/*
$sql="UPDATE venta SET 
idvendedor='0'
WHERE idu='".$idu."'";
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }


*/
$dataCount=count($_POST['select']);
for ($i=0; $i < $dataCount; $i++) { 
	$j=$_POST['select'][$i];
	$sql="UPDATE venta SET 
	idvendedor='".$idu."'
	WHERE idventa='".$j."'";
	if ($con->query($sql) === TRUE) { echo "Update data successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
echo "<form name=form action=moVentas.php method=GET>";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";
?>