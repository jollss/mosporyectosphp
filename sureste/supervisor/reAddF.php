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
$idos=$_POST['ident'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
$orden=new Os();
$orden->obtenerOsBD($idos,$con);
$idorden=$orden->regresaIdmos();
$cope=$orden->regresaCope();
$expediente=$orden->regresaExpediente();
$dd=$orden->regresaDDOS();
$mm=$orden->regresaMMOS();
$year=$orden->regresaYEAROS();
$folio_pisaplex=$orden->regresaFolioPisaplex();
$folio_pisa=$orden->regresaFolioPisa();
$tel=$orden->regresaTelefono();
$cliente=$orden->regresaCliente();
$tipo_tarea=$orden->regresaTipoTarea();
$distrito=$orden->regresaDistrito();
$zona=$orden->regresaZona();
$dilacion_etapa=$orden->regresaDilacionEtapa();
$dilacion=$orden->regresaDilacion();
$idasignado=$orden->regresaAsignado();
$dataos=new Dataos();
$dataos->obtenerDataosOsBD($idorden,$con);
$tipoOs=$dataos->regresaTipoOs();
$tec=new Usuario();
$tec->obtenerUsuarioBD($idasignado,$con);
$nt=$tec->regresaNombre();
$apt=$tec->regresaApaterno();
$amt=$tec->regresaAmaterno();
$nomt=$nt." ".$apt." ".$amt;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--FORMULARIO DE REASIGNACION-->
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
  //$idmos=$Os->totalesOs($con);
  $idmos=$idorden;
?>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Modifica Tecnico<a href="reAdd.php"><img src="../syspic/back.png" height="40" width="40"></a></div>
          <form action="reAddR.php" method="POST" enctype="multipart/form-data">
          <input type="text" value="<?php echo $idmos;?>" style="display:none;" name="os">
          <input type="text" value="<?php echo $idos;?>" name="orden" style="display:none;">
          <input type="text" value="<?php echo $idasignado;?>" name="asignado" style="display:none;">
            <div class="panel-body" style="background-color:gray;">
              <div class="col-md-4">
                <div class="panel panel-info">
                <div align="center"><?php echo "ID MOS: ".$idmos;?></div>
                    <div class="page-header">
                      COPE (ejemplo: CT CONSTITUCION) <label><?php echo $cope;?></label><br>
                      EXPEDIENTE <label><?php echo $expediente;?></label></br>
                      Fecha <label><?php echo $fecha;?></label></br>
                      FOLIO PISA <label><?php echo $folio_pisa;?></label></br>
                      FOLIO PISAPLEX <label><?php echo $folio_pisaplex;?></label>
                      
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page-header">
                      Teléfono <label><?php echo $tel;?></label><br>
                      Cliente <label><?php echo $cliente;?></label>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="page-header">
                      TIPO TAREA (A9-D2-TE-TS-FC-TI-TV) 
                      <label>
                      <?php echo $tipo_tarea;?></label><br>
                      <!--TECNOLOGIA (COBRE-FIBRA-HIBRIDA-TECNICA-VOZ) <label><?php echo $tecnologia;?></label><br>-->
                      DISTRITO (ejemplo: NEV0024) <label><?php echo $distrito;?></label><br>
                      ZONA (CENTRAL) <label><?php echo $zona;?></label><br>
                      DILACION ETAPA (TIEMPO CON LA OS ASIGNADA) <label><?php echo $dilacion_etapa;?></label><br>
                      DILACION <label><?php echo $dilacion;?></label><br>
                    </div>
                </div>
                <div class="panel panel-danger">
                  <label>Nombre de tecnico Actual:</label>
                  <h2><?php echo $nomt;?></h2><br>
                </div>
              </div>
              <div class="col-md-4">
              <div class="panel panel-success">
                  <div class="panel-body">
                    <input type="text" value="<?php echo $idmos;?>" style="display:none;" name="os">
                          <br>
<!--                          
                          <div align="center">
                            <input type="file" name="userfile[]" value="fileupload" id="fileupload">
                            <label for="fileupload"> Subir Word</label>
                          </div>
-->
                        <div class="form-group">
                          <label for="sel1">Tipo de OS:</label><label><?php echo $tipoOs;?></label><br>
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
                              $Tecnico=new Usuario();
                              //$TOTAL=$Tecnico->TotalUsuariosActivosBD($con);
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
                              }
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