<?php
include("../Config/library.php"); 
$idmos=$_POST['idmos'];
echo $idmos;
/*----------------------------------------*/
function execute($query){ 
  $con = Conectarse();  
  return mysqli_query($con,$query);
}

//$Os=new Os();
//$Os->obtenerOsBD($idmos,$con);
$sql="UPDATE os SET 
	asignado='0'
	WHERE idmos='".$idmos."'";
execute($sql) or die (mysqli_error($con));
$sql="UPDATE dataos SET 
	tecnico_asignado_idu='0'
	WHERE id_orden='".$idmos."'";
execute($sql) or die (mysqli_error($con));
echo "
    <script>
        alert('MODIFICACION EXITOSA!');
        document.location=('inde.php');
    </script>"; 
?>