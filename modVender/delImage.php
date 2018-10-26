<?php
include("../Config/library.php");
$con = Conectarse();
$con2 = Conectarse();
var_dump($_POST);
$return=$_POST['return'];
$longitud=$_POST['longitud'];
$latitud=$_POST['latitud'];
$idImagen=$_POST['idImagen'];
$main=$_POST['main'];
$sql2="SELECT * FROM adjunto_venta WHERE idaventa='$idImagen'";
$resultado2=$con2->query($sql2);
while($row2 = $resultado2->fetch_assoc())
{
	$imagen_n=$row2['imagen_n'];
}
unlink("../adjVentas/".$imagen_n);
$sql="UPDATE adjunto_venta SET 
  	imagen_n='0',folio_venta='0'
 	WHERE idaventa='".$idImagen."'";
 //	echo $sql;
if ($con->query($sql) === TRUE) { echo "Nueva venta registrada correctamente<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
//execute($sql) or die (mysqli_error($con));

 	echo "<form name=form action=../".$main." method=get>";
  	echo "<input type=text name=return value=".$return.">";
  	echo "<input type=text name=longitud value=".$longitud.">";
  	echo "<input type=text name=latitud value=".$latitud.">";
  	echo "</form>";
  	echo "<script language=javascript>document.form.submit();</script>"; 
  	
?>
