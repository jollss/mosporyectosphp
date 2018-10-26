<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con1 = Conectarse(); 
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idos=$_POST['ident'];
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
$Os=new Os();
$Os->obtenerOsBD($idos,$con);
$idmos=$Os-> regresaIdmos();
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
$etapa='';
$listo='';
$folio_os='';
$sql1="SELECT * from tienda_comercial where folio_os='$folio_pisa'";
$r1=$con1->query($sql1);
while($row1 = $r1->fetch_assoc())
{ 
  $etapa=$row1['etapa'];
  $listo=$row1['listo_ps'];
  $folio_os=$row1['folio_os'];
}
?>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Asignar OS <?php echo $idmos;?></div>
            <div class="panel-body" style="background-color:gray;">
              <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="page-header">
                      COPE (ejemplo: CT CONSTITUCION) <label><?php echo $cope;?></label>
                      EXPEDIENTE <label><?php echo $expediente;?></label></br>
                      Fecha <label><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></label></br>
                      FOLIO PISA <label><?php echo $folio_pisa;?></label></br>
                      FOLIO PISAPLEX <label><?php echo $folio_pisaplex;?></label>
                      <!--<label>Cliente <label><?php echo $cliente;?></label></label>-->
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page-header">
                      Teléfono <label><?php echo $tel;?></label><br>
                      Cliente <label><?php echo $cliente;?></label>
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
                      TIPO TAREA (A9-D2-TE-TS-FC-TI-TV) <label><?php echo $tipo_tarea;?></label><br>
                      <!--TECNOLOGIA (COBRE-FIBRA-HIBRIDA-TECNICA-VOZ) <label><?php echo $tecnologia;?></label><br>-->
                      DISTRITO (ejemplo: NEV0024) <label><?php echo $distrito;?></label><br>
                      ZONA (CENTRAL) <label><?php echo $zona;?></label><br>
                      DILACION ETAPA (TIEMPO CON LA OS ASIGNADA) <label><?php echo $dilacion_etapa;?></label><br>
                      DILACION <label><?php echo $dilacion;?></label><br>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page header" align="center">
                      <?php
                        if($etapa=='PS' AND $listo=='SI' OR $listo=='listo' OR $folio_os==$folio_pisa){
                          ?>
                          <!--<h2><span class="label label-danger">MOS PROYECTOS</span></h2>-->
                          <form action="ventaData.php" method="POST" target="_blank">
                            <input type="text" value="<?php echo $idmos;?>" name="idorden" style="display:none;">
                            <input type="text" value="<?php echo $folio_pisa;?>" name="folio_pisa" style="display:none;">
                            <input type="image" src="../syspic/logo.png">
                            <br>Click para abrir detalles de venta
                          </form>
                          <?php
                        }if(!isset($etapa)){
                          echo "";
                        }else{
                          echo "";
                        }
                      ?>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
              <div class="panel panel-success">
                  <div class="panel-body">
                    <form action="addOsAsig.php" method="POST" enctype="multipart/form-data">
                    <input type="text" value="<?php echo $idmos;?>" style="display:none;" name="os">
                          <!--
                          <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2">Cope </span>
                              <input type="text" class="form-control" placeholder="COPE"  name="cope" aria-describedby="sizing-addon2" required>
                          </div>
                          -->
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
                              $Tecnico=new Usuario();
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
                            <input type="submit" class="btn btn-success" value="ASIGNAR">
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