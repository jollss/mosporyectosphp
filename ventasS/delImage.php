<?php
include("../Config/library.php");
var_dump($_POST);
$return=$_POST['return'];
$longitud=$_POST['longitud'];
$latitud=$_POST['latitud'];
$idImagen=$_POST['idImagen'];
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$sql="UPDATE adjunto_venta SET 
  	imagen_n='0',folio_venta='0'
 	WHERE idaventa='".$idImagen."'";
 	echo $sql;
execute($sql) or die (mysqli_error($con));
 	echo "<form name=form action=inde.php method=get>";
  	echo "<input type=text name=return value=".$return.">";
  	echo "<input type=text name=longitud value=".$longitud.">";
  	echo "<input type=text name=latitud value=".$latitud.">";
  	echo "</form>";
  	echo "<script language=javascript>document.form.submit();</script>"; 
?>