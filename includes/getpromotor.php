<?php
	require ('../conexion.php');

	$idu = $_POST['idu'];

	$query = "SELECT idu,nombre,apaterno,amaterno,tipo FROM usuario AS u
 INNER JOIN tipo AS t
 ON t.idtipo=u.tipo_idtipo

  WHERE asignado='$idu' AND tipo='PROMOTOR'";
	$resultado=$mysqli->query($query);
$html= "<option value='0'>Selecciona Promotor</option>";
	while($row = $resultado->fetch_assoc())
	{
		$html.= "<option value='".$row['idu']."'>".$row['nombre'].' '.$row['apaterno'].' '.$row['amaterno'].'/'.$row['tipo']."</option>";
	}
	echo $html;
?>
