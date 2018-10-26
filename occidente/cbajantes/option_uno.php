<?php
include("../Config/library.php"); 
$con = Conectarse();  
$con1 = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
/*---------------------------------*/
$idmos=$_POST['idmos'];
$tipo=$_POST['tipo_opcion'];
/*---------------------------------*/
$cope=$_POST['cope'];
$expediente=$_POST['expediente'];
$folio_pisaplex=$_POST['folio_pisaplex'];
$telefono=$_POST['telefono'];
$cliente=$_POST['cliente'];
$tipo_tarea=$_POST['tipo_tarea'];
$distrito=$_POST['distrito'];
$zona=$_POST['zona'];
$dilacion_etapa=$_POST['dilacion_etapa'];
$dilacion=$_POST['dilacion_etapa'];
/*---------------------------------*/
$observaciones=$_POST['observaciones'];
$principal=$_POST['principal'];
$secundario=$_POST['secundario'];
$claro_video=$_POST['claro_video'];
$tipo_os=$_POST['tipo_os'];
/*-------------------------------*/
$supervisor=$_POST['supervisor'];
$tecnico=$_POST['tecnico'];
/*-------------------------------*/
$sql="UPDATE os SET 
cope='$cope',expediente='$expediente',folio_pisaplex='$folio_pisaplex',telefono='$telefono',cliente='$cliente',
tipo_tarea='$tipo_tarea',distrito='$distrito',zona='$zona',dilacion_etapa='$dilacion_etapa',dilacion='$dilacion',
usuario_idu='$supervisor',asignado='$tecnico'
WHERE idmos='".$idmos."'";
$sql2="UPDATE dataos SET 
observaciones='$observaciones',principal='$principal',secundario='$secundario',claro_video='$claro_video',
tipo_os='$tipo_os',
supervisor_idu='$supervisor',tecnico_asignado_idu='$tecnico'
WHERE id_orden='".$idmos."'";
if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on OS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
if ($con1->query($sql2) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con1, $sql2)) { printf("Errormessage: %s\n", mysqli_error($con1)); echo "<br>";} }

echo "
<script>
  alert('MODIFICACION CORRECTA!');
</script>";   

echo "<form name=form action=modOs.php method=post>";
echo "<input type=text name=idmos value=".$idmos.">";
echo "<input type=text name=tipo value=".$tipo.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";
?>