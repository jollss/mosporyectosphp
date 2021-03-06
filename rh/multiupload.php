<?php
class Multiupload
{
 
    /**
    *sube archivos al servidor a través de un formulario
    *@access public
    *@param array $files estructura de array con todos los archivos a subir
    */

    public function upFiles($files = array())
    {
        function execute($query){
              $con = Conectarse();  
              //return mysqli_query($con,$query);
              if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
        }
        $con = Conectarse();  
        /*
        if($ultimo =mysqli_query($con,"SELECT idU FROM usuario ORDER BY idu")){
          $row_cnt=mysqli_num_rows($ultimo);
          mysqli_free_result($ultimo);
        }
        $id=$row_cnt;*/
        $sql1="SELECT idu FROM usuario ORDER BY idu";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
          $id=$row['idu'];
        }
        $id=$id+1;
        //definimos la ruta de almacen
        $url="../userData/".$id."/";
        //inicializamos un contador para recorrer los archivos
        $i = 0;
        //si no existe la carpeta files la creamos
        if(!is_dir($url)) 
            mkdir($url, 0777);
         $con = Conectarse();  
         /*
            if($ultimo =mysqli_query($con,"SELECT idarchiuser FROM archivosuser ORDER BY idarchiuser")){
              $row_cnt=mysqli_num_rows($ultimo);
              mysqli_free_result($ultimo);
            }
            $idi=$row_cnt+1;  */      
            $sql1="SELECT * FROM archivosuser ORDER BY idarchiuser";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              $idi=$row['idarchiuser'];
            }
            $idi=$idi+1;
         $sql="INSERT INTO archivosuser (
            idarchiuser,acta_na,comp_dom,
            comp_estudios,arch_curp,arch_licencia,
            fotos,est_socioeco,usuario_idus)
            VALUES
            ('".$idi."','','',
              '','','',
             '','','".$id."')";
            //execute($sql) or die (mysqli_error($con)); 
            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
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
                if($this->checkExtension($extension[$i]) === TRUE)
                {
 
                    //comprobamos si el archivo existe o no, si existe renombramos 
                    //para evitar que sean eliminados
                    $_FILES['userfile']['name'][$i] = $this->checkExists($trozos[$i]);  
                    /*==================================================================*/ 
                    
                    //comprobamos si el archivo ha subido
                    if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$url.$_FILES['userfile']['name'][$i]))
                    {
                        //aqui podemos procesar info de la bd referente a este archivo
                        //print_r ($_FILES['userfile']['name'][$i]);
                        $filename=$_FILES['userfile']['name'][$i];
                        //echo $filename;
                        if($i==0){
                             $sql="UPDATE archivosuser SET 
                            acta_na='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==1){
                             $sql="UPDATE archivosuser SET 
                            comp_dom='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==2){
                             $sql="UPDATE archivosuser SET 
                            comp_estudios='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==3){
                             $sql="UPDATE archivosuser SET 
                            arch_curp='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==4){
                             $sql="UPDATE archivosuser SET 
                            arch_licencia='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==5){
                             $sql="UPDATE archivosuser SET 
                            fotos='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        if($i==6){
                             $sql="UPDATE archivosuser SET 
                            est_socioeco='".$_FILES['userfile']['name'][$i]."'
                            WHERE idarchiuser='".$idi."'";
                            //execute($sql) or die (mysqli_error($con));
                            if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
                        }
                        
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
    private function checkExtension($extension)
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
 
    /**
    *funcion que comprueba si el archivo existe, si es asi, iteramos en un loop 
    *y conseguimos un nuevo nombre para el, finalmente lo retornamos
    *@access private
    *@param array 
    *@return array - archivo con el nuevo nombre
    */
    private function checkExists($file)
    {
        $con = Conectarse();  
        /*
        if($ultimo =mysqli_query($con,"SELECT idU FROM usuario ORDER BY idu")){
          $row_cnt=mysqli_num_rows($ultimo);
          mysqli_free_result($ultimo);
        }*/
        $sql1="SELECT idU FROM usuario ORDER BY idu";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
          $id=$row['idu'];
        }
        $id=$idi+1;
        $id=$row_cnt;
        //definimos la ruta de almacen
        $url="../userData/".$id."/";
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