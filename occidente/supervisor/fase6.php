<?php
include("../Config/library.php");
$con = Conectarse(); 
$filial=strtoupper($_POST['filial_asignada']);
$auxiliar=strtoupper($_POST['nom_auxiliar']);
$tecnico=strtoupper($_POST['user']);
$venta=strtoupper($_POST['ident']);
$files = $_FILES['userfile']['name'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //llamamos a la clase multiupload
    require_once("upload.php");
    //creamos una nueva instancia de la clase multiupload
    $upload = new Upload();
    //llamamos a la funcion upFiles y le pasamos el array de campos file del formulario
    $isUpload = $upload->upFiles($files,$venta);
    if($isUpload=='' || $isUpload==0){
    	$isUpload='';
    }
    
}else{
    throw new Exception("Error Processing Request", 1);
} 
$fase6 = new Fase6();
$idfase6=$fase6->ultimaFse6($con);
$fase6->ingresarFase6($idfase6,$filial,$auxiliar,$tecnico,$isUpload,$venta);
$fase6->registrarFase6BD($con);
//$fase6->verFase6();
echo "
    <script>
        alert('Registro correcto');
        document.location=('listVentas.php');
    </script>"; 
?>