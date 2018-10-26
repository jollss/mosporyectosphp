<?php



	$id_zona = $_POST['id_zona'];

if($id_zona==1){
	require ('../conexion.php');
  $id_zona = $_POST['id_zona'];

	$queryD = "SELECT id_zona as zona,tipo,nombre,idu,apaterno,amaterno FROM usuario AS u
INNER JOIN tipo AS t
ON t.idtipo=u.tipo_idtipo
WHERE tipo_idtipo=35 AND id_zona='$id_zona'";
	$resultadoD = $mysqli->query($queryD);

	$html= "<option value='0'>Selecciona Director</option>";

	while($rowD = $resultadoD->fetch_assoc())
	{

		$html.= "<option value='".$rowD['idu']."'>".$rowD['nombre'].' '.$rowD['apaterno'].' '.$rowD['amaterno']."</option>";

}
	echo $html;

}
  elseif($id_zona==2){
    require ('../conexionO.php');
    $id_zona = $_POST['id_zona'];

    $queryD = "SELECT tipo,nombre,idu,apaterno FROM usuario AS u
    INNER JOIN tipo AS t
    ON t.idtipo=u.tipo_idtipo
    WHERE tipo_idtipo=35 AND id_zona='$id_zona'";
    $resultadoD = $mysqli->query($queryD);

    $html= "<option value='0'>Selecciona Director</option>";

    while($rowD = $resultadoD->fetch_assoc())
    {

      $html.= "<option value='".$rowD['idu']."'>".$rowD['nombre'].' '.$rowD['tipo']."</option>";

    }
    echo $html;
  }
  elseif($id_zona==3){
    require ('../conexionS.php');
    $id_zona = $_POST['id_zona'];

    $queryD = "SELECT tipo,nombre,idu,apaterno FROM usuario AS u
    INNER JOIN tipo AS t
    ON t.idtipo=u.tipo_idtipo
    WHERE tipo_idtipo=35 AND id_zona='$id_zona'";
    $resultadoD = $mysqli->query($queryD);

    $html= "<option value='0'>Selecciona Director</option>";

    while($rowM = $resultadoD->fetch_assoc())
    {

      $html.= "<option value='".$rowD['idu']."'>".$rowD['nombre']."</option>";

    }
    echo $html;
  }
    else{
      echo "no existe ";
    }

  ?>
