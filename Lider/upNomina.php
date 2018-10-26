<?php
include("../Config/library.php");
require_once("carga_nomina.php");
$con = Conectarse();
//var_dump($_POST);

      /*===============================================*/
      $files=$_FILES;
      //var_dump($files);
      $fecha = str_replace("/","",$_POST['fecha']);
       
      $name=$_POST['area']."-".$fecha;
      $upload = new Carga_Nomina();
      $isUpload = $upload->upFiles($files,$name);
      $sql="UPDATE validar_venta SET 
        file_nomina='".$name."'
      WHERE fecha_pago='".$_POST['fecha']."'";
 // echo $sql;
  if ($con->query($sql) === TRUE AND $name<>'') { echo "Archivo actualizado<br>"; } 
  else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
        
    echo "
    <script>
      location.href='firmar_nomina.php';
    </script>"; 
      

?>