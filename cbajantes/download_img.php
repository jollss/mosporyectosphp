<?php
ob_start();
include("../Config/library.php"); 

$con3 = Conectarse();  
$idmos=$_GET['idmos'];
$pisa=$_GET['pisa'];
$contador=1;
// Creamos un instancia de la clase ZipArchive
$zip = new ZipArchive(); 
$name="".$pisa.".zip";
if ($zip->open($name, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$name>\n");
}
// Creamos y abrimos un archivo zip temporal
$zip->open($name,ZipArchive::CREATE);
// Añadimos un directorio
//$dir = $idmos;
$ruta = "./";
 
$filehandle = opendir($ruta);
 
while ($file = readdir($filehandle)) {
	if ($file != "." && $file != ".." && substr($file,-4)==".zip") {
		// Eliminamos archivos que ya existan para ahorrar espacios
		unlink($file);//Destruye el archivo temporal 
	}
}

$zip->addEmptyDir($dir);
$sql3="SELECT * FROM adjunto_os WHERE os_idos='$idmos'";
	$resultado=$con3->query($sql3);
	while($row = $resultado->fetch_assoc())
	{
	//OS
	    $idadjunto=$row['idadjunto'];
	    $nombreimg=$row['nombreimg'];
	    $os_idos=$row['os_idos'];
	    if($nombreimg<>''){
	    	$path ="../os/".$nombreimg;
	    	// Añadimos un archivo en la raid del zip.
	    	$zip->addFile($path,$pisa."_1234_1234_".$contador.".jpg");	
	    	echo $path."<br>";
	    	
	    	$contador++;
	    }
	}
echo "numficheros: " . $zip->numFiles . "\n";
echo "estado:" . $zip->status . "\n";
// Una vez añadido los archivos deseados cerramos el zip.
$zip->close();
header("Location: ".$name);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>