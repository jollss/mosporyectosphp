<?php
function regMov($con,$id,$area,$movimiento){
	//echo $id."-".$movimiento;

      $sql="INSERT INTO history
      (usuario_id,usuario_area,movimiento) 
      VALUES 
        ('".$id."','".$area."','".$movimiento."')
      ";
        if ($con->query($sql) === TRUE) {  } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
?>