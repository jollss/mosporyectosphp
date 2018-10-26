<?php

	require ('../conexion.php');

	$id_zona = $_POST['idu'];

	$queryM = "SELECT u.idu,u.nombre,t.tipo,u.id_zona FROM usuario AS u
INNER JOIN tipo AS t
ON t.idtipo=u.tipo_idtipo


WHERE t.tipo='DIR. DE OP. FIELDERS' AND asignado='$id_zona'";
	$resultadoM = $mysqli->query($queryM);

	$html= "<option value='0'>Selecciona Coordinador</option>";

	while($rowM = $resultadoM->fetch_assoc())
	{
		$dato=$rowM['nombre'];
if($dato=='MARCO A.'){}
	elseif($dato=='MARIANA FLOR'){}
		elseif($dato=='GABRIELA'){}
	else{
		$html.= "<option value='".$rowM['idu']."'>".$rowM['nombre']."/GABRIELA</option>";
	}
}
	echo $html;
?>
