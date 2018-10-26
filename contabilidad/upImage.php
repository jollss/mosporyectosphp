<?PHP
include("../Config/library.php"); 
$con = Conectarse(); 
        if(isset($_POST['idmos']) and isset($_POST['lol'])){
            if($_POST['lol']==1){
                    $idmos=$_POST['idmos'];
                    $dato=$_POST['dato'];
                    $files = $_FILES['userfile']['name'];
                    //echo $idmos;
                    //var_dump($files);
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
                        $con->real_query("SELECT * FROM adjunto_os order by idadjunto");
                        $r = $con->use_result();
                        while ($l = $r->fetch_assoc()){
                            $totalAdjuntos=$l['idadjunto'];
                        } 
                            $AdjuntoImg=new Adjunto_os();
                            //$totalAdjuntos=$AdjuntoImg->TotalAdjuntosBD($con);
                            $totalAdjuntos=$totalAdjuntos+1;
                            echo $totalAdjuntos;
                            $AdjuntoImg->ingresaAdjuntoOs($totalAdjuntos,$isUpload,$idmos);
                            $AdjuntoImg->registrarAdjuntoOsBD($con);
                            
                        echo "<form name=form action=buscar.php method=GET>";
                        echo "<input type=text name=dato value=".$dato." style='display:none'>";
                        echo "<input type=text name=lol value=0 style='display:none'>";
                        echo "</form>";
                        echo "<script language=javascript>document.form.submit();</script>";  
                        
            }
        }
?>