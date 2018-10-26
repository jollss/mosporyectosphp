<?php
class Upload
{
 
    /**
    *sube archivos al servidor a través de un formulario
    *@access public
    *@param array $files estructura de array con todos los archivos a subir
    */

    public function upFiles($files = array(),$idmod)
    {
        date_default_timezone_set('America/Mexico_City');
        $dia=date('j');
        $mes=date('n');
        $aaaa=date('Y');
        $date=$dia."_".$mes."_".$aaaa;
        //definimos la ruta de almacen
        $url="../ventasFile/";
        //inicializamos un contador para recorrer los archivos
        $i = 0;
        //si no existe la carpeta files la creamos
        if(!is_dir($url)) 
            mkdir($url, 0777);
            
        /*
        if($aux==0){
            $con = Conectarse();
            $id=0;
            $idi=$idmod;
            $sql="INSERT INTO osfile (
            idarchiuser,acta_na,comp_dom,
            comp_estudios,arch_curp,arch_licencia,
            fotos,est_socioeco,usuario_idufile)
            VALUES
            ('".$idi."','','',
              '','','',
             '','','".$idi."')";
            execute($sql) or die (mysqli_error($con)); 
                    
        }else{
            $idi=$idmod;
        }
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
                if($this->checkExtension($files,$extension[$i],$idmod) === TRUE)
                {
 
                    //comprobamos si el archivo existe o no, si existe renombramos 
                    //para evitar que sean eliminados
                    $_FILES['userfile']['name'][$i] = $this->checkExists($trozos[$i],$idmod);  
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
 
    /**
    *funcion privada que devuelve true o false dependiendo de la extension
    *@access private
    *@param string 
    *@return boolean - si esta o no permitido el tipo de archivo
    */
    private function checkExtension($files,$extension,$idmod)
    {
        //aqui podemos añadir las extensiones que deseemos permitir
        $extensiones = array("docx","txt","doc","pdf");
        if(in_array(strtolower($extension), $extensiones))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
 
    /**
    *funcion que comprueba si el archivo existe, si es asi, iteramos en un loop 
    *y conseguimos un nuevo nombre para el, finalmente lo retornamos
    *@access private
    *@param array 
    *@return array - archivo con el nuevo nombre
    */
    private function checkExists($file,$idmod)
    {
        date_default_timezone_set('America/Mexico_City');
        $dia=date('j');
        $mes=date('n');
        $aaaa=date('Y');
        $date=$dia."_".$mes."_".$aaaa;
        //definimos la ruta de almacen
        $url="../ventasFile/".$date."/";
        $id=$idmod;
        //asignamos de nuevo el nombre al archivo
        //$archivo = $file[0] . '.' . end($file);
        $archivo = $id. '.' . end($file);
        $i = 0;
        //mientras el archivo exista entramos
        while(file_exists($url.$archivo))
        {
            $i++;
            $archivo = $id."(".$i.")".".".end($file);       
        }
        //devolvemos el nuevo nombre de la imagen, si es que ha 
        //entrado alguna vez en el loop, en otro caso devolvemos el que
        //ya tenia
        return $archivo;
    }
}
?>