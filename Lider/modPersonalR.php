<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idu=$_POST['id'];
$name=$_POST['name'];
$apa=$_POST['apa'];
$ama=$_POST['ama'];
$cel=$_POST['cel'];
$tel=$_POST['tel'];

$sql="UPDATE usuario SET 
nombre='$name',
apaterno='$apa',
amaterno='$ama',
cel='$cel',
tel='$tel'
WHERE idu='".$idu."'";
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

echo "<form name=form action=modPersonal.php method=POST>";
echo "<input type=text name=idu value=".$idu.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";

?>