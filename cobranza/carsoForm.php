<?php
include("../Config/library.php"); 
require_once("Multiupload.php");
$con = Conectarse();  
$con3 = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
if(!isset($_POST['idmos'])){
    $idmos=$_GET['idmos'];
}if(!isset($_GET['idmos'])){
    $idmos=$_POST['idmos'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserBajantes.js"></script>
<?php
    cobranza($user);
?>
</div>
<div class="row"><br><br><br><br></div>
<div class="col-md-12">
<!--Section imagenes-->
    <section class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" align="center">
            <?php
            $sql3="SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden and idmos='$idmos'";
            $resultado=$con->query($sql3);
            while($row = $resultado->fetch_assoc())
            {
                $folio_pisa=$row['folio_pisa'];
            }
            ?>
            <div style="background-color:;height:140px;overflow-y:scroll;">
                <table border="0" style="border-collapse: separate; border-spacing: 10px 5px;">
                    <tr>
                    <?php
                    $cuenta=0;
                    $sql3="SELECT * FROM adjunto_os 
                    WHERE os_idos='$idmos'";
                    $resultado=$con3->query($sql3);
                    while($row = $resultado->fetch_assoc())
                    {
                        /*OS*/
                        $idadjunto=$row['idadjunto'];
                        $nombreimg=$row['nombreimg'];
                        $os_idos=$row['os_idos'];
                        if($cuenta==0){
                            ?>
                            <td align="center" style="pad">
                                <a href="<?php echo "../os/".$nombreimg;?>" target="_blank">
                                    <img src="../os/<?php echo $nombreimg;?>" width="70" height="70">
                                </a>
                                <br>
                                <label style="font-size:10px;">Imagen No. <?php echo $cuenta;?></label>
                            </td>
                            <?php
                        }else{
                        ?>
                        <td align="center" style="pad">
                            <a href="<?php echo "../os/".$nombreimg;?>" target="_blank">
                                <img src="../os/<?php echo $nombreimg;?>" width="70" height="70">
                            </a>
                            <form accept="carsoForm.php" method="POST">
                                <input value="<?php echo $idadjunto;?>" name="borrarid" size="5" style="display:none" readonly>
                                <input value="<?php echo $nombreimg;?>" name="nom"  style="display:none" readonly>
                                <input value="<?php echo $os_idos;?>" name="idmos"  style="display:none" readonly>
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </form>
                            <label style="font-size:10px;">Imagen No. <?php echo $cuenta;?></label>
                        </td>
                        <?php
                        }
                        $cuenta=$cuenta+1;
                    }
                    ?>
                    </tr>
                </table>
                <?php
                    if(isset($_POST['borrarid']) and isset($_POST['nom'])){
                        $adjunto=$_POST['borrarid'];
                        $nombre=$_POST['nom'];

                        $sql="UPDATE adjunto_os SET os_idos='' and nombreimg='' WHERE idadjunto='".$adjunto."'";
                        if ($con->query($sql) === TRUE) { echo "borrar"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
                        $path="../os/".$nombre;
                        unlink($path);
                        echo "<form name=form action=carsoForm.php method=post>";
                            echo "<input type=text name=idmos value=".$idmos.">";
                            echo "<input type=text name=lol value=0>";
                            echo "</form>";
                            echo "<script language=javascript>document.form.submit();</script>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-1"></div>
    </section>
<!--Section alta imagenes-->
    <section class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="background-color:gray;" border=1 align="center">
        <form name="formu" id="formu" action="carsoForm.php" method="POST" enctype="multipart/form-data">
            <input value="<?php echo $idmos;?>" style="display:none;" name="idmos">
            <input value="1" style="display:none;" name="lol">
            <dl>            
               <dt><label>Imagenes a Subir:</label></dt>
               <dd>
               <div id="adjuntos">
                <input type="file" name="userfile[]" accept=".jpg,.JPG,.jpeg,.JPEG"/><br />
               </div>
               </dd>
               <dd><input type="submit" value="SUBIR IMAGEN" id="envia" name="envia" class="btn btn-success"/></dd>
            </dl>
        </form>
        <?php
        if(isset($_POST['idmos']) and isset($_POST['lol'])){
            if($_POST['lol']==1){
                    $idmos=$_POST['idmos'];
                    $files = $_FILES['userfile']['name'];
                    echo $idmos;
                    var_dump($files);
                    /*===============================================*/
                    function upFiles($files = array(),$idmod)
                    {
                        date_default_timezone_set('America/Mexico_City');
                        $dia=date('j');
                        $mes=date('n');
                        $aaaa=date('Y');
                        $date=$dia."_".$mes."_".$aaaa;
                        //definimos la ruta de almacen
                        //$url="../os/".$date."/";
                        $url="../os/";
                        //inicializamos un contador para recorrer los archivos
                        $i = 0;
                        //si no existe la carpeta files la creamos
                        if(!is_dir($url)) 
                            mkdir($url, 0777);
                        /*================================================================*/ 
                        //recorremos los input files del formulario
                        foreach($files as $file) 
                        {
                            //si se está subiendo algún archivo en ese indice
                            if($_FILES['userfile']['tmp_name'][$i])
                            {
                                //separamos los trozos del archivo, nombre extension
                                $trozos[$i] = explode(".", $_FILES["userfile"]["name"][$i]);
                 
                                //obtenemos la extension
                                $extension[$i] = end($trozos[$i]);
                 
                                //si la extensión es una de las permitidas
                                if(checkExtension($files,$extension[$i],$idmod) === TRUE)
                                {
                 
                                    //comprobamos si el archivo existe o no, si existe renombramos 
                                    //para evitar que sean eliminados
                                    $_FILES['userfile']['name'][$i] = checkExists($trozos[$i],$idmod);  
                                    /*==================================================================*/ 
                                    //comprobamos si el archivo ha subido
                                    if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$url.$_FILES['userfile']['name'][$i]))
                                    {
                                        //aqui podemos procesar info de la bd referente a este archivo
                                        //print_r ($_FILES['userfile']['name'][$i]);
                                        $filename=$_FILES['userfile']['name'][$i];
                                        return $filename;
                                    }
                                //si la extension no es una de las permitidas
                                }else{
                                    //echo "la extension no esta permitida";
                                     echo "
                                    <script>
                                        alert('Alguna Imagen con extencion no permitida');
                                    </script>"; 
                                }
                            //si ese input file no ha sido cargado con un archivo
                            }else{
                                //echo "sin imagen";
                                return "";
                            }
                            //echo "<br />";
                            //en cada pasada por el loop incrementamos i para acceder al siguiente archivo
                            $i++;     
                        }   
                    }
                    function checkExtension($files,$extension,$idmod)
                    {
                        //aqui podemos añadir las extensiones que deseemos permitir
                        $extensiones = array("jpg","png","gif","pdf");
                        if(in_array(strtolower($extension), $extensiones))
                        {
                            return TRUE;
                        }else{
                            return FALSE;
                        }
                    }
                    function checkExists($file,$idmod)
                    {
                        date_default_timezone_set('America/Mexico_City');
                        $dia=date('j');
                        $mes=date('n');
                        $aaaa=date('Y');
                        $date=$dia."_".$mes."_".$aaaa;
                        //definimos la ruta de almacen
                        
                        //$url="../os/".$date."/";
                        $url="../os/";
                        $id=$idmod;
                        //asignamos de nuevo el nombre al archivo
                        //$archivo = $file[0] . '.' . end($file);
                        $archivo = $id. '.' . end($file);
                        $i = 0;
                        //mientras el archivo exista entramos
                        while(file_exists($url.$archivo))
                        {
                            $i++;
                            $archivo = $id."_".$i."".".".end($file);       
                        }
                        //devolvemos el nuevo nombre de la imagen, si es que ha 
                        //entrado alguna vez en el loop, en otro caso devolvemos el que
                        //ya tenia
                        return $archivo;
                    }
                    $isUpload = upFiles($files,$idmos);

                    
                        $con->real_query("SELECT * FROM adjunto_os");
                        $r = $con->use_result();
                        while ($l = $r->fetch_assoc()){
                            $totalAdjuntos=$l['idadjunto'];
                        } 
                            $AdjuntoImg=new Adjunto_os();
                            $totalAdjuntos=$AdjuntoImg->TotalAdjuntosBD($con);
                            $totalAdjuntos=$totalAdjuntos+1;
                            $AdjuntoImg->ingresaAdjuntoOs($totalAdjuntos,$isUpload,$idmos);
                            $AdjuntoImg->registrarAdjuntoOsBD($con);
                        echo "<form name=form action=carsoForm.php method=post>";
                        echo "<input type=text name=idmos value=".$idmos.">";
                        echo "<input type=text name=lol value=0>";
                        echo "</form>";
                        echo "<script language=javascript>document.form.submit();</script>";  
            }
        }
        ?>
        </div>
        <div class="col-md-3"></div>
    </section>
<!--Section datos de la orden--> 
<section class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10" align="center" style="background-color: rgba(182, 94, 44, 0.7);">
    
        <form action="osPDFCARSO.php" method="POST" target="_blank">
            <input type="text" name="idmos" value="<?php echo $idmos;?>" style="display:none;" readonly>
            <label>GENERAR PDF</label><br>
            <button type="submit" class="btn btn-success">
                <img src="../syspic/carso.JPG" width="150" height="100">
            </button>
        </form>
        <form action="osPDFCARSO2.php" method="POST" target="_blank">
            <input type="text" name="idmos" value="<?php echo $idmos;?>" style="display:none;" readonly>
            <label>GENERAR PDF v2</label><br>
            <button type="submit" class="btn btn-success">
                <img src="../syspic/carso.JPG" width="50" height="30">
            </button>
        </form>
        
    </div>
    <div class="col-md-1"></div>
</section>
</div>

<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>