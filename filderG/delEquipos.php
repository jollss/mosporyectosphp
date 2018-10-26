<?php
include("../Config/library.php");
$con = Conectarse();
$id=$_POST['id'];
$sql="UPDATE areas_fielder SET nom_area='' WHERE idarea='".$id."'";
if ($con->query($sql) === TRUE) { 
	//echo "New record created successfully<br>"; 
	echo "
	  <script>
	      alert('AREA ELIMINADA!');
	      document.location=('equiposF.php'); 
	  </script>";
} else { 

	if (!mysqli_query($con, $sql)) { 
		//printf("Errormessage: %s\n", mysqli_error($con)); 
		echo "
	  <script>
	      alert('ERROR AL ELIMINAR!');
	      document.location=('equiposF.php'); 
	  </script>";
	}
}
?>