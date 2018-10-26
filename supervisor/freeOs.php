<?php
include("../Config/library.php"); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$con = Conectarse();
$con1 = Conectarse();
var_dump($_POST);
$idmos=$_POST['idmos'];

$sql3="SELECT * FROM adjunto_os WHERE os_idos='$idmos'";
$resultado=$con->query($sql3);
while($row = $resultado->fetch_assoc())
{
	
	$os=$row['idadjunto'];
	$nomimg=$row['nombreimg'];
	unlink('../os/'.$nomimg);
	$sql2="UPDATE adjunto_os SET nombreimg='',os_idos=''
	WHERE idadjunto='".$os."'";
	
	if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }
}
	/*$sql="UPDATE os SET asignado='0'
	WHERE idmos='".$os."'";*/
	
	$sql2="UPDATE dataos SET estatus='0',observaciones='',ddos='0',mmos='0',yearos='0',
	horaos='',principal='',secundario='',claro_video='',alfanumerico='',serie=''
	WHERE id_orden='".$os."'";
	
	if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }

	echo "
	<script>
  		alert('MODIFICACION CORRECTA!');
	</script>";
	echo "<form name=form action=buscar.php method=GET>";
	echo "<input type=text name=dato value=".$os.">";
	echo "</form>";
	echo "<script language=javascript>document.form.submit();</script>"; 
	
?>