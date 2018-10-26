<?php
include("../Config/library.php"); 
$con = Conectarse();
//include("clase_conexion.php");
$id_foto=date('YmdHis');//extraemos la fecha del servidor
$sql="insert into fotos values ('".$id_foto."','','')";
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
//$inserta_foto=mysql_query($consulta,$con);
$sub=(substr($id,-18));
$id_foto=str_replace(".jpg", "", $sub);//20120214052450
$sql="update fotos set id_foto=id_foto, nombre='$nombre', des='$des' where id_foto='$id_foto'";
if ($con->query($sql) === TRUE) { echo "New update created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

$filename = "fotos/".$id_foto.'.jpg';//nombre del archivo
$result = file_put_contents( $filename, file_get_contents('php://input') );//renombramos la fotografia y la subimos
if (!$result) {
	print "No se pudo subir al servidor\n";
	exit();
}

//$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $filename;//generamos la respuesta como la ruta completa
$url = '/' . $filename;//generamos la respuesta como la ruta completa
print "$url\n";//20120214060943.jpg

?>
