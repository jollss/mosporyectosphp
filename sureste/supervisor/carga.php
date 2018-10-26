<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse();  
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
$tos=0;
$TotalOS=new Os();
$ls=$TotalOS->totalAOs($iduser,$con);
$idus=$_POST['ident'];
$id=0;
$TecnicoU = new Usuario();
$TecnicoU->obtenerUsuarioBD($idus,$con);
$nus=$TecnicoU->regresaNombre();
$apus=$TecnicoU->regresaApaterno();
$amus=$TecnicoU->regresaAmaterno();
$Yo2= new Usuario();
$Yo2->obtenerUsuarioCorreoBD($mail,$con);
$c_division=$Yo2->regresaIdu();
$noC=0;
$siC=0;
function existePSR($tel,$con){
  //$sql1="SELECT * FROM os WHERE folio_pisa like '%$id%' OR idmos like '%$id%'"
  $sql1="SELECT * FROM os WHERE telefono = '$tel'";;
      $resultado=$con->query($sql1);
      while($row = $resultado->fetch_assoc())
     {
      return 1;
      }
}
$copes = array("CT TUXTLA","CT VLL","CT PCB","CT MOJ","CT UAX","CT CAA","CT CMO","CT TAP","CT CAM","CT CNC","CT PAH",
    );
//9 COPES
function cope_existe($existe,$copes_in,$copes_cmp,$foliopisa){
  //echo $copes_in."---";
  //0 ES IGUAL DIFERENTE DE 0 ES DIFERENTE
  //echo $existe;
  //if($copes_in==$copes_cmp[0]){
  //if($copes_in=="CT CONSTITUCION"){
  if (strcmp($copes_in, "CT TUXTLA") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT VLL") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT PCB") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT MOJ") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT UAX") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT CAA") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT CMO") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT TAP") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT CAM") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }if (strcmp($copes_in, "CT CNC") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }
  if (strcmp($copes_in, "CT PAH") === 0){
    //echo $foliopisa."-".$existe."---".$copes_cmp[0]."=".$copes_in."-SI<br>";
    return 1;
  }
  else{
    return 0;
  } 
}
$psr="PSR12345";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser2.js"></script>
        
<?php
   nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">CARGA DE BOLSA</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <div class="panel panel-info">
                    <div class="panel-heading">Información</div>
                    <div class="panel-body">
                      <p style="color:red;">El siguiente listado muestra las OS que no fueron cargadas</p>
                    </div>
                </div>
                <?php
                //var_dump($copes);
                ?>
                 <div id="" style="background-color:white;height: 300px;overflow: scroll;">
                 <table class="table">
                   <tr>
                      <th>FOLIO PISA</th>
                      <th>COPE</th>
                      <th>EXPEDIENTE</th>
                      <th>FOLIO PISAPLEX</th>
                      <th>TELEFONO</th>
                      <th>CLIENTE</th>
                      <th>DISTRITO</th>
                      <th>ZONA</th>
                      <th></th>
                    </tr>
                 <?php
                 extract($_POST);
                  if ($action == "upload") {
                        $archivo = $_FILES['file']['tmp_name'];
                        $row = 0; 
                        if (is_readable($archivo)) {
                          $fp = fopen ($archivo,"r"); 
                          while ($data = fgetcsv ($fp, 10000, ",")) 
                          { 
                            $num = count ($data); 
                                $pagados=0;
                                $row++; 
                                $cope=strtoupper($data[1]);
                                $expediente=$data[2];
                                $folio_pisaplex=$data[4];
                                if($folio_pisaplex==$psr){
/*PSR*/                                  
                                  $telefono=$data[6];
                                  $cliente=$data[7];
                                  $tipo_tarea=$data[8];
                                  $tecnologia='NA';
                                  //$tecnologia=$data[9];
                                  $distrito=$data[10];
                                  $zona=$data[11];
                                  $dilacion_etapa=$data[12];
                                  $dilacion=$data[13];
                                  //echo $folio_pisa."<br>";
                                  $con->real_query("SELECT * FROM os");
                                  $r = $con->use_result();
                                  while ($l = $r->fetch_assoc()){
                                      $id=$l['idmos']; 
                                  } 
                                  $MOS=new Os();
                                  $nOs=new Os();
                                  $folio_pisa="PSR".$id;
                                  //echo $folio_pisa."<br>";
                                  
                                  $valida=strlen($folio_pisa);
                                  $nOs->ingresarOs($id,$cope,$expediente,$folio_pisaplex,$folio_pisa,
                                  $telefono,$cliente,$tipo_tarea,$tecnologia,$distrito,$zona,$dilacion_etapa,$dilacion,
                                  $idus,$c_division);
                                  $es=$nOs->existe($folio_pisa,$con);
                                  $esPSR=existePSR($telefono,$con);
                                  
                                  $bandera=1;
                                  if($es==1){
                                    $regreso=cope_existe($es,$cope,$copes,$folio_pisa);  
                                    //echo "<td>".$regreso."</td>";
                                  }if($es==0 or $es<>1){
                                    $es=0;
                                    $regreso=cope_existe($es,$cope,$copes,$folio_pisa);
                                    //echo "<td>".$regreso."</td>";
                                  }
                                  if($regreso==0 or $es==1 ){//or $esPSR==1){
                                        if($es==1  or $valida>8 or $valida<7){
                                          echo "<th style='color:red;font-weight:bold;'>".$folio_pisa."</th>";
                                        }else{
                                          echo "<th>".$folio_pisa."</th>";
                                        }
                                        if($regreso==0){
                                          echo "<th style='color:red;font-weight: bold;'>".$cope."</th>";
                                        }else{
                                          echo "<th>".$cope."</th>";
                                        }
                                        ?>
                                        <th><?php echo $expediente;?></th>
                                        <th><?php echo $folio_pisaplex;?></th>
                                        <th><?php echo $telefono;?></th>
                                        <?php
                                        /*
                                        if($esPSR==1){
                                          echo "<th style='color:red;font-weight: bold;'>".$telefono."</th>";
                                        }else{
                                          echo "<th>".$telefono."</th>";
                                        }*/
                                        ?>
                                        <th><?php echo $cliente;?></th>
                                        <th><?php echo $distrito;?></th>
                                        <th><?php echo $zona;?></th>
                                      </tr>
                                      <?php
                                      $noC=$noC+1;
                                  }if($regreso==1 and $es==0){
                                      $id=$id+1;
                                      
                                      $dia=date('j');
                                      $mes=date('n');
                                      $aaaa=date('Y');
                                      $hora = date("g");
                                      $min = date("i");
                                      $sql="INSERT INTO os (
                                        idmos,cope,expediente,ddcarga,mmcarga,yearcarga,folio_pisaplex,
                                        folio_pisa,telefono,cliente,tipo_tarea,tecnologia,distrito,zona,
                                        dilacion_etapa,dilacion,usuario_idu,pagados,asignado,estado_os)
                                        VALUES
                                        ('".$id."','".$cope."','".$expediente."','".$dia."','".$mes."','".$aaaa."','".$folio_pisaplex."',
                                         '".$folio_pisa."','".$telefono."','".$cliente."','".$tipo_tarea."','".$tecnologia."','".$distrito."','".$zona."',
                                         '".$dilacion_etapa."','".$dilacion."','".$idus."','0',
                                         '0','0'
                                         )";
                                        if ($con->query($sql) === TRUE) {
                                            //echo "<h2 style='color:red;font-family: 'Times New Roman', Times, serif;'>Bolsa Cargada Correctamente.</h2>";
                                            //$siC=$siC+1;
                                        } else {
                                          if (!mysqli_query($con, $sql)) {
                                              printf("Errormessage: %s\n", mysqli_error($con));
                                              echo "<br>";
                                          }
                                        }
                                        
                                        $siC=$siC+1;
                                  } 
                                  
                                }
/*DIFERENTE DE PSR*/                                
                                if($folio_pisaplex<>$psr){
                                  $telefono=$data[6];
                                  $cliente=$data[7];
                                  $tipo_tarea=$data[8];
                                  $tecnologia='NA';
                                  //$tecnologia=$data[9];
                                  $distrito=$data[10];
                                  $zona=$data[11];
                                  $dilacion_etapa=$data[12];
                                  $dilacion=$data[13];
                                  //echo $folio_pisa."<br>";
                                  $con->real_query("SELECT * FROM os");
                                  $r = $con->use_result();
                                  while ($l = $r->fetch_assoc()){
                                      $id=$l['idmos']; 
                                  } 
                                  $MOS=new Os();
                                  $nOs=new Os();
                                  $folio_pisa=$data[5];
                                  $valida=strlen($folio_pisa);
                                  $es_entero=is_int($folio_pisa);
                                  $nOs->ingresarOs($id,$cope,$expediente,$folio_pisaplex,$folio_pisa,
                                  $telefono,$cliente,$tipo_tarea,$tecnologia,$distrito,$zona,$dilacion_etapa,$dilacion,
                                  $idus,$c_division);
                                  $es=$nOs->existe($folio_pisa,$con);
                                  $bandera=1;
                                  if($es==1){
                                    $regreso=cope_existe($es,$cope,$copes,$folio_pisa);  
                                    //echo "<td>".$regreso."</td>";
                                  }if($es==0 or $es<>1){
                                    $es=0;
                                    $regreso=cope_existe($es,$cope,$copes,$folio_pisa);
                                    //echo "<td>".$regreso."</td>";
                                  }
                                  if($regreso==0 or $es==1 or $es_entero==FALSE){
                                        if($es==1  or $valida>8 or $valida<7 or $es_entero==FALSE){
                                          echo "<th style='color:red;font-weight:bold;'>".$folio_pisa."</th>";
                                        }else{
                                          echo "<th>".$folio_pisa."</th>";
                                        }
                                        if($regreso==0){
                                          echo "<th style='color:red;font-weight: bold;'>".$cope."</th>";
                                        }else{
                                          echo "<th>".$cope."</th>";
                                        }
                                        ?>
                                        <th><?php echo $expediente;?></th>
                                        <th><?php echo $folio_pisaplex;?></th>
                                        <th><?php echo $telefono;?></th>
                                        <th><?php echo $cliente;?></th>
                                        <th><?php echo $distrito;?></th>
                                        <th><?php echo $zona;?></th>
                                      </tr>
                                      <?php
                                      $noC=$noC+1;
                                  }if($regreso==1 and $es==0 and ($valida==8 or $valida==7)){
                                      $id=$id+1;
                                      
                                      $dia=date('j');
                                      $mes=date('n');
                                      $aaaa=date('Y');
                                      $hora = date("g");
                                      $min = date("i");
                                      $sql="INSERT INTO os (
                                        idmos,cope,expediente,ddcarga,mmcarga,yearcarga,folio_pisaplex,
                                        folio_pisa,telefono,cliente,tipo_tarea,tecnologia,distrito,zona,
                                        dilacion_etapa,dilacion,usuario_idu,pagados,asignado,estado_os)
                                        VALUES
                                        ('".$id."','".$cope."','".$expediente."','".$dia."','".$mes."','".$aaaa."','".$folio_pisaplex."',
                                         '".$folio_pisa."','".$telefono."','".$cliente."','".$tipo_tarea."','".$tecnologia."','".$distrito."','".$zona."',
                                         '".$dilacion_etapa."','".$dilacion."','".$idus."','0',
                                         '0','0'
                                         )";
                                        if ($con->query($sql) === TRUE) {
                                            //echo "<h2 style='color:red;font-family: 'Times New Roman', Times, serif;'>Bolsa Cargada Correctamente.</h2>";
                                            //$siC=$siC+1;
                                        } else {
                                          if (!mysqli_query($con, $sql)) {
                                              printf("Errormessage: %s\n", mysqli_error($con));
                                              echo "<br>";
                                          }
                                        }
                                        
                                        $siC=$siC+1;
                                  } 
                                }
                          } 
                          fclose ($fp); 
                          echo "
                          <script language='JavaScript'> 
                              alert('Reporte de Carga de Bolsa');
                          </script>"; 
                        }       
                    }
                 ?>
                 </table>
                 </div>
                 <div class="well" style="font-weight: bold;">
                    No cargadas: <?php echo $noC;?>
                    Cargadas Correctamente: <?php echo $siC;?>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
</body>
</html>