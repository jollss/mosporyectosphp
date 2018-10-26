<?php
include("../Config/library.php");
$con = Conectarse();  
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$datos=strtoupper($_POST['info']);
//$name=$name." ".$ap." ".$am;
$orden =$_POST['idorden'];
$supervisor =$_POST['super'];
$super=$_POST['supervisor'];
$tecnico =$_POST['tecnico'];
//echo $orden."----<br>";
if(isset($iduser) && isset($datos)&& isset($orden)&& isset($supervisor))
{
	$informacion=new Info_Supbajantes();
	$id=$informacion->TotalInfoBD($con);
	$id=$id+1;
  	$informacion->ingresaInfo($id,$datos,$orden,$supervisor);
  	
  	$informacion->registroInfoBD($con);

	echo "
	<script>
	    alert('REGISTRO EXITOSO!');
	</script>"; 
	echo "<form name=form action=dataosT.php method=post>";
	echo "<input type=text name=tecnico value=".$tecnico.">";
	echo "<input type=text name=supervisor value=".$super.">";
	echo "<input type=text name=idmos value=".$orden.">";
	echo "</form>";
	echo "<script language=javascript>document.form.submit();</script>";            

}else{
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php'); 
  </script>"; 
}
?>