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
//$idos=$_POST['ident'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
<?php
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<?php
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$fecha=$dia."/".$mes."/".$aaaa;

$Os=new Os();
$idmos=$Os-> totalesOs($con);
//$idmos=$idmos+1;
/*
$cope=$Os-> regresaCope();
$expediente=$Os-> regresaExpediente();
$ddcarga=$Os-> regresaDDOS();
$mmcarga=$Os-> regresaMMOS();
$yearcarga=$Os-> regresaYEAROS();
$folio_pisaplex=$Os-> regresaFolioPisaplex();
$folio_pisa=$Os-> regresaFolioPisa();
$tel=$Os-> regresaTelefono();
$cliente=$Os-> regresaCliente();
$tipo_tarea=$Os-> regresaTipoTarea();
$tecnologia=$Os-> regresaTecnologia();
$distrito=$Os-> regresaDistrito(); 
$zona=$Os-> regresaZona();
$dilacion_etapa=$Os-> regresaDilacionEtapa();
$dilacion=$Os-> regresaDilacion();
*/
$copes = array("CT PUERTO VALLARTA",
    );
?>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Nueva OS No.<?php echo $idmos+1;?></div>
          <form action="addOsRN.php" method="POST" enctype="multipart/form-data">
            <div class="panel-body" style="background-color:gray;">
              <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="page-header">
                      COPE (ejemplo: CT CONSTITUCION) <label>
                      <select name="cope">
                        <?php
                          foreach ($copes as $v) {
                              //echo "\$copes[$i] => $v.\n";
                              echo "<option values='".$v."'>".$v."</option>";
                              $i++;
                          }
                        ?>
                      </select>
                      <br>
                      <!--<input type="text" value="CT " name="cope"><?php// echo $cope;?></label><br>-->
                      EXPEDIENTE <label><input type="text" value="" name="expediente"><?php //echo $expediente;?></label></br>
                      Fecha <label><?php echo $fecha;?></label></br>
                      FOLIO DE OS <label><input type="text" value="" name="foliopisa" maxlength="8" minlength="7"><?php //echo $folio_pisa;?></label></br>
                      FOLIO PISAPLEX <label><input type="text" value="" name="foliopisaplex"><?php //echo $folio_pisaplex;?></label>
                      <!--<label>Cliente <label><?php echo $cliente;?></label></label>-->
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page-header">
                      Teléfono <label>
                      <input type="tel" class="form-control" placeholder="Teléfono"  pattern=".{10}" name="tel" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." required>
                      <?php //echo $tel;?></label><br>
                      Cliente <label><input type="text" value="" name="cliente"><?php //echo $cliente;?></label>
                      <!--<label>Zona <label><?php echo $zona;?></label></label>
                      <label>DILACION ETAPA (TIEMPO CON LA OS ASIGNADA) <label><?php echo $dilacion_etapa;?></label></label>
                      <label>Dilacion <label><?php echo $dilacion;?></label></label>
                      <label>Cope</label>-->
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="page-header">
                      TIPO TAREA (A9-D2-TE-TS-FC-TI-TV) 
                      <label>
                      <select class="form-control" id="sel1" name="tipo_tarea">
                            <option value="A9">A9</option> 
                            <option value="D2">D2</option> 
                            <option value="TE">TE</option>
                            <option value="TS">TS</option>
                            <option value="FC">FC</option>
                            <option value="TI">TI</option>
                            <option value="TV">TV</option>
                            <option value="PQ2">PQ2</option>
                      </select>
                      <?php //echo $tipo_tarea;?></label><br>
                      <!--TECNOLOGIA (COBRE-FIBRA-HIBRIDA-TECNICA-VOZ) <label><?php echo $tecnologia;?></label><br>-->
                      DISTRITO (ejemplo: NEV0024) <label><input type="text" value="" name="distrito"><?php //echo $distrito;?></label><br>
                      ZONA (CENTRAL) <label><input type="text" value="" name="zona"><?php //echo $zona;?></label><br>
                      DILACION ETAPA (TIEMPO CON LA OS ASIGNADA) <label><input type="text" value="" name="dilacion_etapa"><?php //echo $dilacion_etapa;?></label><br>
                      DILACION <label><input type="text" value="" name="dilacion"><?php //echo $dilacion;?></label><br>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
              <div class="panel panel-success">
                  <div class="panel-body">
                    <input type="text" value="<?php echo $idmos;?>" style="display:none;" name="os">
            
                          <br>
                          <div align="center">
                            <input type="file" name="userfile[]" value="fileupload" id="fileupload">
                            <label for="fileupload"> Subir Word</label>
                          </div>

                        <div class="form-group">
                          <label for="sel1">Tipo de OS:</label>
                          <select class="form-control" id="sel1" name="tipo_os">
                            <option value="COBRE">COBRE</option> 
                            <option value="FIBRA">FIBRA</option> 
                            <option value="HIBRIDA">HIBRIDA</option>
                            <option value="TECNICA">TECNICA</option>
                            <option value="VOZ">VOZ</option>
                            <option value="PSR">PSR</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sel1">Tecnicos:</label>
                          <select class="form-control" id="sel1" name="user">
                              <?php
                              $sql4="SELECT * FROM usuario where asignado='$iduser'";
                              $resultado4=$con4->query($sql4);
                              while($row4 = $resultado4->fetch_assoc())
                              {
                                  $idus=$row4['idu'];
                                  $nombre=$row4['nombre'];
                                  $apaterno=$row4['apaterno'];
                                  $amaterno=$row4['amaterno'];

                                  echo "<option value='".$idus."''>".$idus."-".$nombre." ".$apaterno." ".$amaterno."</option>";
                              }
                              $Tecnico=new Usuario();
                              //$TOTAL=$Tecnico->TotalUsuariosActivosBD($con);
                              /*
                              $TOTAL=$Tecnico->TotalUBD($con);
                              for ($i=0; $i <= $TOTAL; $i++) { 
                                $Tecnico->obtenerUsuarioBD($i,$con);
                                $asignadoU=$Tecnico->regresaAsignado();
                                if($asignadoU==$iduser){
                                  $idus=$Tecnico->regresaIdu();
                                  $nombre=$Tecnico->regresaNombre();
                                  $apaterno=$Tecnico->regresaApaterno();
                                  $amaterno=$Tecnico->regresaAmaterno();

                                  echo "<option value='".$idus."''>".$idus."-".$nombre." ".$apaterno." ".$amaterno."</option>";
                                }
                              }*/
//                              $Tecnico->obtenerUsuarioBD($idu,$con);
                              /*
                              $con3->real_query("SELECT * FROM usuario WHERE asignado='$iduser' AND tipo_idtipo = 1");
                                $result = $con3->use_result();
                                while ($line = $result->fetch_assoc()){
                                  $iduser=$line['idu'];
                                  $nombre=$line['nombre'];
                                  $apaterno=$line['apaterno'];
                                  $amaterno=$line['amaterno'];
                                  echo "<option value='".$iduser."''>".$nombre." ".$apaterno." ".$amaterno."</option>";
                                }
                                */
                              ?>                      
                          </select>
                        </div>
                        <div class="" align="center">
                            <input type="submit" class="btn btn-primary" value="CREAR Y ASIGNAR">
                        </div>
                      
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="col-md-12" style="background-color:gray;">
                
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