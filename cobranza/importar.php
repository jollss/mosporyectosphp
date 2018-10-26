<?php
error_reporting(0);
$zona=($_POST['zona']);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($zona==1){
  require_once '../cobranza/PHPExcel/Classes/PHPExcel.php';
  include("../sureste/Config/library.php");
  $con = Conectarse();
  $paco=($_POST['paco']);
  $tipo=($_POST['tipo']);
  $archivoa =$paco."".$_FILES['archivo']['name'];
  $query = " SELECT ruta FROM documento_excel WHERE ruta='$archivoa'";
  $result = $con->query($query);
  while($filas = $result->fetch_assoc()) {
    $ruta=$filas['ruta'];
  }

  if($ruta!="" ){
    echo"  <script>
       alert('Este Archivo ya se encuentra registrado con el PACO:.$paco! y nombre del archivo:.$ruta');
       document.location=('paqocarga.php');
       </script>";

  }
  else{


  $tipos = $_FILES['archivo']['type'];
  $tipo = explode(".",$_FILES['archivo']['name']);
  $dir = 'C:/xampp/htdocs/php/cobranza/';

  if (isset($_FILES['archivo']['tmp_name'])) {
  if ($tipo[1] == 'xlsx'){

  if (!copy($_FILES['archivo']['tmp_name'], $dir.$paco.$_FILES['archivo']['name'])){
  }
    $sql = "INSERT INTO documento_excel ( nombre, ruta)
            VALUES ('$dir','$archivoa')";
  $result = $con->query($sql);
  }
  }
  $archivo = $archivoa;
  $inputFileType = PHPExcel_IOFactory::identify($archivo);
  $objReader = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel = $objReader->load($archivo);
  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();
  $tipo=($_POST['tipo']);
  $query2 = " SELECT paco  FROM excel_folios_bitacora WHERE paco='$paco'";

  $result222 = $con->query($query2);
  while($filas1 = $result222->fetch_assoc()) {
   $pacos=$filas1['paco'];

  }

  if($pacos!=""){
  echo"  <script>
      alert('No Debiste de Pasar aqui pero si llegaste hasta aqui te comento que el paco y folios ya estan registrados asi que preguntale a ING. Joel Espinosa Sanchez ya que esta Raro!');
      document.location=('paqocarga.php');
      </script>";
  }
  else{
  for ($row = 2; $row <= $highestRow; $row++){
    $folio= $sheet->getCell("A".$row)->getValue();



      $sql33 = "INSERT INTO excel_folios_bitacora ( folio_pisa,tipo,paco,nombre_archivo,guardar)
                VALUES ('$folio','$tipo','$paco','$archivo','SI')";
            $resulta = $con->query($sql33);

  }
  }
  }
  if($resulta==""){

  }
  else{
  for ($row = 2; $row <= $highestRow; $row++){
    $folio= $sheet->getCell("A".$row)->getValue();
  $result = mysqli_query($con,
   "
  SELECT COUNT(*) as total,folio_pisa FROM excel_folios_bitacora WHERE folio_pisa='$folio'
   ");
   $row = mysqli_fetch_array($result);
   $total = $row['total'];
   $folio_pisas = $row['folio_pisa'];
   if($total==2){
   $sql321 = "UPDATE excel_folios_bitacora SET guardar='NO' WHERE folio_pisa='$folio_pisas' ";
   //echo $sql321;
   $result321 = $con->query($sql321);
  }
  }
  }
  if($result321!=""){
    echo "NO PPASA NADA ";
  }
  else{


    $quer = " SELECT folio_pisa,paco,tipo  FROM excel_folios_bitacora WHERE paco='$paco'  and guardar='SI' " ;

    $resu = $con->query($quer);
    while($fil= $resu->fetch_assoc()) {
     $folio_pisa=$fil['folio_pisa'];
     $paco=$fil['paco'];
      $tipo=$fil['tipo'];

   $SQ="UPDATE validar_os SET paqo='$paco', tipo_paqo='$tipo' WHERE id_folio_pisa='$folio_pisa' and a_cobro='1'";
  $re = $con->query($SQ);
  echo"  <script>
     alert('Pacos Modificados Correctamente,si en alguno folio_pisa no se cargo es porque el folio pisa no existe con la comparacion del excel!');
      document.location=('tuscargados.php?paco=$paco');
     </script>";
  }
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  elseif($zona==2){
    require_once '../cobranza/PHPExcel/Classes/PHPExcel.php';
    include("../occidente/Config/library.php");
    $con = Conectarse();
    $paco=($_POST['paco']);
    $tipo=($_POST['tipo']);
    $archivoa =$paco."".$_FILES['archivo']['name'];
    $query = " SELECT ruta FROM documento_excel WHERE ruta='$archivoa'";
    $result = $con->query($query);
    while($filas = $result->fetch_assoc()) {
      $ruta=$filas['ruta'];
    }

    if($ruta!="" ){
      echo"  <script>
         alert('Este Archivo ya se encuentra registrado con el PACO:.$paco! y nombre del archivo:.$ruta');
         document.location=('paqocarga.php');
         </script>";

    }
    else{


    $tipos = $_FILES['archivo']['type'];
    $tipo = explode(".",$_FILES['archivo']['name']);
    $dir = 'C:/xampp/htdocs/php/cobranza/';

    if (isset($_FILES['archivo']['tmp_name'])) {
    if ($tipo[1] == 'xlsx'){

    if (!copy($_FILES['archivo']['tmp_name'], $dir.$paco.$_FILES['archivo']['name'])){
    }
      $sql = "INSERT INTO documento_excel ( nombre, ruta)
              VALUES ('$dir','$archivoa')";
    $result = $con->query($sql);
    }
    }
    $archivo = $archivoa;
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $tipo=($_POST['tipo']);
    $query2 = " SELECT paco  FROM excel_folios_bitacora WHERE paco='$paco'";

    $result222 = $con->query($query2);
    while($filas1 = $result222->fetch_assoc()) {
     $pacos=$filas1['paco'];

    }

    if($pacos!=""){
    echo"  <script>
        alert('No Debiste de Pasar aqui pero si llegaste hasta aqui te comento que el paco y folios ya estan registrados asi que preguntale a ING. Joel Espinosa Sanchez ya que esta Raro!');
        document.location=('paqocarga.php');
        </script>";
    }
    else{
    for ($row = 2; $row <= $highestRow; $row++){
      $folio= $sheet->getCell("A".$row)->getValue();



        $sql33 = "INSERT INTO excel_folios_bitacora ( folio_pisa,tipo,paco,nombre_archivo,guardar)
                  VALUES ('$folio','$tipo','$paco','$archivo','SI')";
              $resulta = $con->query($sql33);

    }
    }
    }
    if($resulta==""){

    }
    else{
    for ($row = 2; $row <= $highestRow; $row++){
      $folio= $sheet->getCell("A".$row)->getValue();
    $result = mysqli_query($con,
     "
    SELECT COUNT(*) as total,folio_pisa FROM excel_folios_bitacora WHERE folio_pisa='$folio'
     ");
     $row = mysqli_fetch_array($result);
     $total = $row['total'];
     $folio_pisas = $row['folio_pisa'];
     if($total==2){
     $sql321 = "UPDATE excel_folios_bitacora SET guardar='NO' WHERE folio_pisa='$folio_pisas'";
     //echo $sql321;
     $result321 = $con->query($sql321);
    }
    }
    }
    if($result321!=""){
      echo "NO PPASA NADA ";
    }
    else{


      $quer = " SELECT folio_pisa,paco,tipo  FROM excel_folios_bitacora WHERE paco='$paco'  and guardar='SI'" ;

      $resu = $con->query($quer);
      while($fil= $resu->fetch_assoc()) {
       $folio_pisa=$fil['folio_pisa'];
       $paco=$fil['paco'];
        $tipo=$fil['tipo'];

     $SQ="UPDATE validar_os SET paqo='$paco', tipo_paqo='$tipo' WHERE id_folio_pisa='$folio_pisa' and a_cobro='1'";
    $re = $con->query($SQ);
    echo"  <script>
       alert('Pacos Modificados Correctamente,si en alguno folio_pisa no se cargo es porque el folio pisa no existe con la comparacion del excel!');
        document.location=('tuscargados.php?paco=$paco');
       </script>";
    }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($zona==3){
require_once 'PHPExcel/Classes/PHPExcel.php';
include("../Config/library.php");
$con = Conectarse();
$paco=($_POST['paco']);
$tipo=($_POST['tipo']);
$id=($_POST['id']);
date_default_timezone_set('America/Mexico_City');
$hoy = date("Y-m-d H:i:s");
$archivoa =$paco."".$_FILES['archivo']['name'];
$query = " SELECT ruta FROM documento_excel WHERE ruta='$archivoa'";
$result = $con->query($query);
while($filas = $result->fetch_assoc()) {
  $ruta=$filas['ruta'];
}
if($ruta!="" ){
 echo"  <script>
     alert('Este Archivo ya se encuentra registrado con el PACO:.$paco! y nombre del archivo:.$ruta');
    document.location=('paqocarga.php');
    </script>";
}
else{
$tipos = $_FILES['archivo']['type'];
$tipo = explode(".",$_FILES['archivo']['name']);
$dir = 'C:/xampp/htdocs/php/cobranza/';
if (isset($_FILES['archivo']['tmp_name'])) {
if ($tipo[1] == 'xlsx'){
if (!copy($_FILES['archivo']['tmp_name'], $dir.$paco.$_FILES['archivo']['name'])){
}
  $sql = "INSERT INTO documento_excel ( nombre, ruta,zona,fecha_carga,usuario_cargo_excel,paco)
          VALUES ('$dir','$archivoa',$zona,'$hoy',$id,'$paco')";
$result = $con->query($sql);
}
}
$archivo = $archivoa;
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$tipo=($_POST['tipo']);
$query2 = " SELECT paco  FROM excel_folios_bitacora WHERE paco='$paco'";
$result222 = $con->query($query2);
while($filas1 = $result222->fetch_assoc()) {
 $pacos=$filas1['paco'];
}
if($pacos!=""){
echo"  <script>
   alert('No Debiste de Pasar aqui pero si llegaste hasta aqui te comento que el paco y folios ya estan registrados asi que preguntale a ING. Joel Espinosa Sanchez ya que esta Raro!');
   document.location=('paqocarga.php');
   </script>";
}
else{
for ($row = 2; $row <= $highestRow; $row++){
  $folio= $sheet->getCell("A".$row)->getValue();
    $sql33 = "INSERT INTO excel_folios_bitacora ( folio_pisa,tipo,paco,nombre_archivo,guardar,fecha_carga_Datos,encontrado)
              VALUES ('$folio','$tipo','$paco','$archivo','SI','$hoy','NO')";
       $resulta = $con->query($sql33);
}
}
}
if($resulta==""){
}
else{
$querys = " SELECT folio_pisa  FROM excel_folios_bitacora WHERE paco='$paco'";
$resus = $con->query($querys);
while($fi= $resus->fetch_assoc()) {
$foliopisaas=$fi['folio_pisa'];
$result = mysqli_query($con,"SELECT COUNT(*) as total,folio_pisa FROM excel_folios_bitacora WHERE folio_pisa='$foliopisaas'");
 $row = mysqli_fetch_array($result);
 $total = $row['total'];
 $folio_pisas = $row['folio_pisa'];
 if($total>=2){
 $sql321 = "UPDATE excel_folios_bitacora SET guardar='NO' WHERE folio_pisa='$folio_pisas'";
$result321 = $con->query($sql321);
}
}
}
if($result321==""){
}
else{
  $quer = " SELECT folio_pisa,paco,tipo
  FROM excel_folios_bitacora AS bitaexcel
  INNER JOIN validar_os AS vaos
   WHERE paco='$paco' AND vaos.id_folio_pisa=bitaexcel.folio_pisa AND guardar='SI'" ;
  $resu = $con->query($quer);
  while($fil= $resu->fetch_assoc()) {
   $folio_pisa=$fil['folio_pisa'];
   $paco=$fil['paco'];
    $tipo=$fil['tipo'];
 $SQ="UPDATE validar_os SET paqo='$paco', tipo_paqo='$tipo' WHERE id_folio_pisa='$folio_pisa' and a_cobro='1'";
 $SQL="UPDATE excel_folios_bitacora SET encontrado='SI' WHERE folio_pisa='$folio_pisa' ";
$re = $con->query($SQ);
$rea = $con->query($SQL);

echo"  <script>
   alert('Pacos Modificados Correctamente,si en alguno folio_pisa no se cargo es porque el folio pisa no existe con la comparacion del excel!');
   document.location=('tuscargados.php?paco=$paco&zona=$zona');
   </script>";
}


}
if($re==""){

  echo"  <script>
     alert('Se Registraron pero no se hiso algun movimiento te invito a consultarlo!');
     document.location=('os_cpaqo.php');
     </script>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
?>
