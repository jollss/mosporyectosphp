<?php
include("../Config/library.php");

$q=$_POST[q];
$con = Conectarse();
$CN=0;
$sql="SELECT * FROM venta where folio_ventas = '$q'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['folio_ventas'];
    $CN=$CN+1;
}
if(isset($areaLider)){
	///echo "<h2>Numero de solicitudes parecidas: ".$CN."</h2>";
	echo "<h3>Folio ya registrado.</h3>";
}
if(!isset($areaLider) AND $CN<>0){
	//echo "<h2>Numero de solicitudes parecidas: ".$CN."</h2>";
	echo "<h3>Folio listo para registrar</h3>";
}
/*
$sql="select * from personas where nombre LIKE '".$q."%'";
$res=mysql_query($sql,$con);

if(mysql_num_rows($res)==0){

echo '<b>No hay sugerencias</b>';

}else{

echo '<b>Sugerencias:</b><br />';

while($fila=mysql_fetch_array($res)){

echo $fila['nombre'].'<br />';

}

}
*/
?>