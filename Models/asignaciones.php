<?php
/**
* 
*/
class asignaciones
{
	
	function crear($idu,$con)
	{
		# code...
		date_default_timezone_set('America/Mexico_City');
  	$dia=date('j');
  	$mes=date('n');
  	$aaaa=date('Y');
  	$semana=date('W');
    $sql="INSERT INTO contador_fielder (
    id_usuarios,contador_asignado,contador_ventas,fecha_referenciauno,semana,mes)
    VALUES
    ('".$idu."',0,0,'".$dia."/".$mes."/".$aaaa."',".$semana.",".$mes.")";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
	function actualizar($idu,$contador_asignado,$con)
  {
		date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana=date('W');
  /*$sql="UPDATE contador_fielder SET fecha_referenciauno='".$dia."/".$mes."/".$aaaa."',semana='".$semana."',mes='".$mes."' WHERE ";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }*/
    $contador_asignado=$contador_asignado+1;
    $sql="UPDATE contador_fielder SET contador_asignado='".$contador_asignado."' WHERE id_usuarios='".$idu."'";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
	}
function crearNuevo($yo)
  {
    # code...
    $con = Conectarse();
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana=date('W');
    $sql="INSERT INTO contador_fielder (
    id_usuarios,contador_asignado,contador_ventas,fecha_referenciauno,semana,mes)
    VALUES
    ('".$yo."',0,0,'".$dia."/".$mes."/".$aaaa."',".$semana.",".$mes.")";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }       
  }
function actualizarMe($yo,$contador_asignado,$con)
  {
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana=date('W');
  /*$sql="UPDATE contador_fielder SET fecha_referenciauno='".$dia."/".$mes."/".$aaaa."',semana='".$semana."',mes='".$mes."' WHERE ";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }*/
    $contador_asignado=$contador_asignado+1;
    $sql="UPDATE contador_fielder SET contador_asignado='".$contador_asignado."' WHERE id_usuarios='".$yo."'";
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
  }

function existencia($idu,$yo,$con){
    $conex = Conectarse();
    $tiene="SELECT * FROM contador_fielder WHERE id_usuarios='".$yo."'";
    $res=$conex->query($tiene);
    while($data = $res->fetch_assoc())
    {
      $id_usuarios=$data['id_usuarios'];
      $contador_asignado=$data['contador_asignado'];
      $contador_ventas=$data['contador_ventas'];
      $fecha_referenciauno=$data['fecha_referenciauno'];
    }
    if(isset($id_usuarios)){
          //actualiza
              //echo "actualiza 1";
              $this->actualizarMe($yo,$contador_asignado,$con);
              $conex = Conectarse();
              $tiene="SELECT * FROM contador_fielder WHERE id_usuarios='".$idu."'";
              $res=$conex->query($tiene);
              while($data = $res->fetch_assoc())
              {
                $id_usuarios=$data['id_usuarios'];
                $contador_asignado=$data['contador_asignado'];
                $contador_ventas=$data['contador_ventas'];
                $fecha_referenciauno=$data['fecha_referenciauno'];
              }
              if(isset($id_usuarios)){
                  //actualiza
                  //echo "actualiza 12";
                  //$this->actualizar($yo,$contador_asignado,$con);
                  $this->crear($idu,$con);
              }if(!isset($id_usuarios)){
                  //ingresa
                //echo "ingresa 12";
                  $this->crear($idu,$con);
              }
        
              //echo "actualiza primer ronda".$idu."-".$yo."-";
    }if(!isset($id_usuarios)){
        //ingresa
        //echo "ingresa 1";
        $this->crearNuevo($yo);
        $conex = Conectarse();
        $tiene="SELECT * FROM contador_fielder WHERE id_usuarios='".$idu."'";
        $res=$conex->query($tiene);
        while($data = $res->fetch_assoc())
        {
          $id_usuarios=$data['id_usuarios'];
          $contador_asignado=$data['contador_asignado'];
          $contador_ventas=$data['contador_ventas'];
          $fecha_referenciauno=$data['fecha_referenciauno'];
        }
        if(isset($id_usuarios)){
            //actualiza
           // echo "actualiza 22";
            $this->actualizar($idu,$contador_asignado,$con);
        }if(!isset($id_usuarios)){
            //ingresa
          //echo "ingresa 22";
            $contador_asignado=0;
            $this->crear($idu,$con);
        }
    }
  		        
	}
}
?>