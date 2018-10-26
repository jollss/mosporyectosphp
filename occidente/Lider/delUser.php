<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idu=$_POST['idu'];
$activo=$_POST['activo'];
//$venta=new Ventas();
//echo $idventa;

//$venta-> delAllVenta($idventa,$con);
if($activo==1){
	$sql="UPDATE usuario SET 
	activo='0'
	WHERE idu='".$idu."'";
	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}if($activo==0){
	$sql="UPDATE usuario SET 
	activo='1'
	WHERE idu='".$idu."'";
	if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
echo "<form name=form action=regUser.php method=GET>";
echo "<input type=text name=dato value=".$idu.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";

?>