<?php
include("../Config/library.php");
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$tecnico=$yo->regresaIdu();
function ejecuta($sql){
  $con = Conectarse(); 
  if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
function BD($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
$principal=$_POST['principal'];
$secundario=$_POST['secundario'];
$claro_video=$_POST['claro_video'];
$estado=$_POST['estado'];
$modem=$_POST['modem'];
$rosetas=$_POST['rosetas'];
//$metraje=$_POST['metraje'];
if(!isset($_POST['f_25'])){
  $metraje_25=0;
}if(!isset($_POST['f_50'])){ 
  $metraje_50=0;
}if(!isset($_POST['f_75'])){
  $metraje_75=0;
}if(!isset($_POST['f_125'])){
  $metraje_125=0;
}if(isset($_POST['f_25'])){
  $metraje_25=$_POST['f_25'];  
}if(isset($_POST['f_50'])){
  $metraje_50=$_POST['f_50'];  
}if(isset($_POST['f_75'])){
  $metraje_75=$_POST['f_75'];  
}if(isset($_POST['f_125'])){
  $metraje_125=$_POST['f_125'];  
}
/*
$metraje_50=$_POST['f_50'];
$metraje_75=$_POST['f_75'];
$metraje_125=$_POST['f_125'];
*/
//$metraje_cobre=$_POST['m_cobre'];
//$metraje=$metraje_25+$metraje_50+$metraje_75+$metraje_125+$metraje_cobre;
$metraje=$_POST['metraje'];
$cableado=$_POST['cableado']; 

$orden=$_POST['os_idorden'];
$detalle=strtoupper($_POST['detalles']);
$detalle = preg_replace('/\n , /',' ', $detalle);
$alfa=strtoupper($_POST['alfanumerico']);
$serie=strtoupper($_POST['serie']);
$tipo_instalacion=strtoupper($_POST['tipo_instalacion']);
$id=0;
$detalles=new Dataos();
$detalles->obtenerDataosBD($orden,$con);

$adjunto=new Adjunto_os();
$aux=$adjunto->ExisteAdjuntoBD($orden,$con);
if($aux==0){
  echo "
  <script>
      alert('FALTAN IMAGENES!');
      document.location=(' dataosuall.php');
  </script>"; 
}else{

  /*===============================================*/
  
  if(isset($orden) && isset($estado)&& isset($detalles))
  {
      $dataOS=new Dataos();
      $dataOS->obtenerOsBD($orden,$con);
      
      $dataOS->obtenerDataosOsBD($orden,$con);
      $tecnico=$dataOS->regresaTecnicoAsignacionIdu();
      $tipo_os=$dataOS->regresaTipoOs();
      
      $cantidad = new Cantidades();
      $cantidad->obtenerCantidadesBD($tecnico,$con);
      $cantidad->actualizaCantidadesMenosBD($tipo_os,$tecnico,$con);
      //echo $tipo_os;
      $dataOS->modPrincipal($principal,$orden,$con);
      $dataOS->modSecundario($secundario,$orden,$con);
      $dataOS->modClaroV($claro_video,$orden,$con);
      $dataOS->modEstatus($estado,$orden,$con);
      $dataOS->modObservaciones($detalle,$orden,$con);
      $dataOS->modFecha($orden,$con);

      $dataOS->modSerie($serie,$orden,$con);
      $dataOS->modAlfanumerico($alfa,$orden,$con);
      $material=new  Material();
      $id=$material->totalesMaterial($con);
      $material->ingresarMaterial($id,$orden,$modem,$rosetas,$metraje,$tipo_instalacion);
       $sql="UPDATE material SET 
                metraje='".$metraje."',
                f_25='".$metraje_25."',
                f_50='".$metraje_50."',
                f_75='".$metraje_75."',
                f_125='".$metraje_125."',
                cobre='".$metraje_cobre."'
              WHERE idos='".$orden."'";
              ejecuta($sql);
      $material->registrarMaterialBD($con);
      
          $_POST['ident']=$orden; 
          /*
          echo "
          <script>
              alert('REGISTRO EXITOSO!');
          </script>";   
          
          echo "<form name=form action=dataos.php method=post>";
          echo "<input type=text name=ident value=".$orden.">";
          echo "</form>";
          echo "<script language=javascript>document.form.submit();</script>";
          */
          /*
            $comentarios=" ORDEN TECNICO uso: "." Tipo de Instalacion=".$tipo_instalacion." Modem=".$modem." Rosetas=".$rosetas." Metraje=".$metraje;
            $fecha_hora_actual = date('Y-m-d H:i:s'); 
            $idcoment=0;
            $sql12="SELECT * FROM coment_material";
            $resultado2=$con->query($sql12);
            while($row2 = $resultado2->fetch_assoc())
            {
                $idcoment=$row2['idcoment'];
            }
            $idcoment=$idcoment+1;
            $sql3="INSERT INTO coment_material (
            idcoment,id_materiales,comentario,
            fecha_coment)
            VALUES
            ('".$idcoment."','".$tecnico."','".$comentarios."','".$fecha_hora_actual."')";
            BD($sql3);

          $sql="UPDATE materiales SET 
                modem_m=modem_m-'".$modem."',
                roseta_op_m=roseta_op_m-'".$rosetas."',
                metraje_m=metraje_m-'".$metraje."'
              WHERE id_empleado='".$tecnico."'";
              ejecuta($sql);
             */
              
          echo "
          <script>
              alert('REGISTRO EXITOSO!!');
              document.location=(' dataosuall.php');
          </script>"; 
        }else{
        echo "
          <script>
              alert('ERROR EN DATOS!');
              document.location=(' dataosuall.php');
          </script>"; 
        } 
        
  }
//} 
?>
