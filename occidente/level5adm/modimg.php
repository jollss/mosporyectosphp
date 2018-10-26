<?php
@session_start();
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
include("../Config/conexion2.php");  
  require_once '../Config/conexion.php';
  $con = Conectarse();  
  function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$idmods=$_POST['idmod'];
//solo se puede acceder si es una peticion post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //llamamos a la clase multiupload
    require_once("modmultiupload.php");
    //array de campos file del formulario
    $files = $_FILES['userfile']['name'];
    //creamos una nueva instancia de la clase multiupload
    $upload = new Multiupload();
    //llamamos a la funcion upFiles y le pasamos el array de campos file del formulario
    $isUpload = $upload->upFiles($files,$idmods);
}else{
    throw new Exception("Error Processing Request", 1);
} 

echo "
    <script>
        alert('ALTA DE IMAGENES CORRECTO!');
        document.location=('inde.php');
    </script>";  
    
?>
