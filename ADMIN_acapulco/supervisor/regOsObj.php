<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
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
    <div class="col-md-12" style="background-color:gray;height:100px;overflow-y:scroll;">
    <?php
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$fecha=$dia."/".$mes."/".$aaaa;
if(!isset($_GET['dato']) or !isset($idmos)){ 
  $dato='';
  $idmos='';
  $cope='';
  $expediente='';
  $ddcarga='';
  $mmcarga='';
  $yearcarga='';
  $folio_pisaplex='';
  $folio_pisa='';
  $telefono='';
  $cliente='';
  $tipo_tarea='';
  $tecnologia='';
  $distrito='';
  $zona='';
  $dilacion_etapa='';
  $dilacion='';
  $usuario_idu='';
  $asignado='';
}
if(isset($_GET['dato'])){
   $dato=$_GET['dato'];
   //$aux1=0;
        $con1 = Conectarse(); 
        $sql="SELECT * FROM os INNER JOIN dataos
        WHERE idmos=id_orden AND estatus=1 AND supervisor_idu='$iduser' AND  folio_pisa='$dato'";
        $resultado=$con1->query($sql);
        while($row = $resultado->fetch_assoc())
        {
            /*OS*/
            $idmos=$row['idmos'];
            $cope=$row['cope'];
            $expediente=$row['expediente'];
            $ddcarga=$row['ddcarga'];
            $mmcarga=$row['mmcarga'];
            $yearcarga=$row['yearcarga'];
            $folio_pisaplex=$row['folio_pisaplex'];
            $folio_pisa=$row['folio_pisa'];
            $telefono=$row['telefono'];
            $cliente=$row['cliente'];
            $tipo_tarea=$row['tipo_tarea'];
            $tecnologia=$row['tecnologia'];
            $distrito=$row['distrito'];
            $zona=$row['zona'];
            $dilacion_etapa=$row['dilacion_etapa'];
            $dilacion=$row['dilacion'];
            $usuario_idu=$row['usuario_idu'];
            $asignado=$row['asignado'];
            $tipo_os=$row['tipo_os'];
            $tecnico=$row['tecnico_asignado_idu'];
            $aux1=1;
        }        
}
?>
    <?php
    if(!isset($_GET['coment'])){$coment='';}
    if(isset($_GET['coment']) AND $_GET['coment']<>''){
      $id=0;
      $coment=$_GET['coment'];
      $fecha_hora_actual = date('Y-m-d H:i:s');
      $idmos=$folio_pisa;
      $personalTmx=$_GET['telmex'];
      $distintivo=$_GET['dist'];
      $sql1="SELECT * FROM objecion_os";
      $resultado=$con->query($sql1);
      while($row = $resultado->fetch_assoc())
      {
        $id=$row['idobjecion'];
      }
      if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
      $id=$id+1;
      //echo $id;
      $sql="INSERT INTO objecion_os (
          idobjecion,id_orden,fecha,
          observaciones,personal_telmex,
          distintivo)
          VALUES
          ('".$id."','".$idmos."','".$fecha_hora_actual."',
            '".$coment."','".$personalTmx."',
            '".$distintivo."')"; 
      if ($con->query($sql) === TRUE) { echo "Nuevo comentario registrado<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    }
    ?>
      <form action="regOsObj.php" method="GET">
          <table>
            <input type="text" value="<?php echo $folio_pisa;?>" name="dato" style="display:;border:none;background:none;" readonly>
            <tr>
              <td><input type="text" class="form-control" placeholder="AUXILIAR TELMEX" size="70" name="telmex" aria-describedby="sizing-addon2" value="" required></td>
              <td>
              <label>Distintivo de la orden</label>
              <input type="text" class="" placeholder="Ej. A" size="2" name="dist" aria-describedby="" value="" required>
                <!--<select name="dist">
                      <option value="A">A</option> 
                      <option value="B">B</option> 
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      <option value="H">H</option>
                      <option value="I">I</option>
                </select>-->
              </td>
            </tr>
            <tr>
              <td><input type="text" class="form-control" placeholder="COMENTARIO" size="70" name="coment" aria-describedby="sizing-addon2" value="" required></td>
              <td><input type="submit" class="btn btn-primary" value="COMENTAR"></td>
            </tr>
          </table>
      </form>
    </div>
<div class="container col-md-12" name="toTop" id="topPos">

    <div class="col-md-4">
      <div class="panel panel-default">
          <div class="panel-heading">Busqueda</div>
          <div class="panel-body" style="background-color:white;">
              <div align="center">
                  <div><strong>Dato buscado: <?php echo $dato;?></strong></div>
                  <form action="regOsObj.php" method="GET">
                      <div class="form-group">
                          <input type="search" class="form-control" placeholder="FOLIO PISA, IDMOS o TELEFONO" name="dato" style="background-color:;">
                          <input type="submit" value="BUSCAR" class="btn btn-primary">
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div style="background-color:;height:400px;overflow-y:scroll;">
        <table class="table">
        <?php
        $auxiliar=0;
        $con1 = Conectarse(); 
        $sql="SELECT * FROM objecion_os WHERE id_orden='$folio_pisa' ORDER BY fecha DESC";
        $resultado=$con1->query($sql);
        while($row = $resultado->fetch_assoc())
        {
          $auxiliar=1;
        ?>
          <tr>
            <td><?php echo $row['fecha'];?></td>
            <td><?php echo $row['observaciones'];?></td>
            <td><?php echo $row['personal_telmex'];?></td>
            <td><?php echo $row['distintivo'];?></td>
          </tr>
        <?php 
        } 
        if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
        ?>
        </table>
      </div>
    </div>
    <?php 
    if(isset($aux1)){
      ?>
    <div class="col-md-8" style="height:600px;overflow-y:scroll;">
        <div class="panel panel-info">
          <form action="addOsRNRe.php" method="POST" enctype="multipart/form-data">
            <div class="panel-body" style="background-color:gray;">
              <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="page-header">
                      COPE (ejemplo: CT CONSTITUCION) <label><input type="text" value="<?php echo $cope; ?>" name="cope"><?php// ?></label><br>
                      EXPEDIENTE <label><input type="text" value="<?php echo $expediente;?>" name="expediente"><?php //?></label></br>
                      Fecha <label><?php echo $fecha;?></label></br>
                      FOLIO PISA <br><label><input type="text" size="8" value="<?php echo $folio_pisa;?>" name="foliopisa" readonly>
                      </label>
                      
                      </label>
                      FOLIO PISAPLEX <label><input type="text"  size="8" value="<?php echo $folio_pisaplex;?>" name="foliopisaplex"></label>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page-header">
                      Teléfono <label>
                      <input type="tel" class="form-control" placeholder="Teléfono"  pattern=".{10}" name="tel" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." value="<?php echo $telefono;?>" required>
                      </label><br>
                      Cliente 
                      <!--<label><input type="text" value="" name="cliente" value="<?php echo $cliente; ?>"></label>-->
                      <label><input type="text"  size="30" value="<?php echo $cliente;?>" name="cliente"></label>
                      <?php //echo $cliente; ?>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="page-header">
                      TIPO TAREA (A9-D2-TE-TS-FC-TI-TV) 
                      <label><input type="text" value="<?php echo $tipo_tarea;?>" name="tipo_tarea"></label><br>
                      <!--TECNOLOGIA (COBRE-FIBRA-HIBRIDA-TECNICA-VOZ) <label><?php echo $tecnologia;?></label><br>-->
                      DISTRITO (ejemplo: NEV0024) <label><input type="text" value="<?php echo $distrito;?>" name="distrito"></label><br>
                      ZONA (CENTRAL) <label><input type="text" value="<?php echo $zona;?>" name="zona"></label><br>
                      DILACION ETAPA (TIEMPO CON LA OS ASIGNADA) <label><input type="text" value="<?php echo $dilacion_etapa;?>" name="dilacion_etapa"></label><br>
                      DILACION <label><input type="text" value="<?php echo $dilacion;?>" name="dilacion"></label><br>
                    </div>
                </div>
              </div>
              <div class="col-md-12">
              <div class="panel panel-success">
                  <div class="panel-body">
                    <input type="text" value="<?php echo $idmos;?>" style="display:none;" name="os">
                          <br>
                        <div class="form-group">
                          <b><p>Anterior: <input type="text" value="<?php echo $tipo_os;?>" style="display:;border:none;border:none;" name="tipo_os_anterior" readonly></p></b>
                          <label for="sel1">Tipo de OS:</label>
                          <select class="form-control" id="sel1" name="tipo_os">
                            <option value="<?php echo $tipo_os;?>" selected><?php echo $tipo_os;?></option>
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
                              $sql="SELECT * FROM usuario where idu='$tecnico'";
                              $resultado=$con->query($sql);
                              while($row = $resultado->fetch_assoc())
                              {
                                  $idus=$row['idu'];
                                  $nombre=$row['nombre'];
                                  $apaterno=$row['apaterno'];
                                  $amaterno=$row['amaterno'];

                                  echo "<option value='".$idus."''>".$idus."-".$nombre." ".$apaterno." ".$amaterno."</option>";
                              }
                              $Tecnico=new Usuario();
                              //$TOTAL=$Tecnico->TotalUsuariosActivosBD($con);
                              /*$TOTAL=$Tecnico->TotalUBD($con);
                              for ($i=0; $i <= $TOTAL; $i++) { */
                                /*
                                $Tecnico->obtenerUsuarioBD($tecnico,$con);
                                $asignadoU=$Tecnico->regresaAsignado();
                                if($asignadoU==$iduser){
                                  $idus=$row[''];;
                                  $nombre=$Tecnico->regresaNombre();
                                  $apaterno=$Tecnico->regresaApaterno();
                                  $amaterno=$Tecnico->regresaAmaterno();

                                  echo "<option value='".$idus."''>".$idus."-".$nombre." ".$apaterno." ".$amaterno."</option>";
                                }
                                */
                              //}
                              ?>                      
                          </select>
                        </div>
                        <div class="" align="center">
                        <?php
                        if($auxiliar==1){
                        ?>
                            <input type="submit" class="btn btn-primary" value="CREAR Y ASIGNAR">
                        <?php
                        }else{
                          ?>
                          <label>Registra un comentario</label>
                          <?php
                        }
                        ?>
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

    <?php
    }else{
      ?>
      <tr>
        <td style="color:red;"><label>ORDEN ABIERTA, LIQUIDADA O NO CORRESPONDE A TU COPE</label></td>
      </tr>
      <?php
    }
    ?>
</div>
<div class="col-md-12">
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