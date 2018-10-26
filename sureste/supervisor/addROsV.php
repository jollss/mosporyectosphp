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
$osN=new Os();
$idmos=$osN-> totalesOs($con);
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$fecha=$dia."/".$mes."/".$aaaa;
$venta=new Ventas();
$venta->obtenerVentaBD($idos,$con);
$idventa=$venta->regresaIdVenta();
$folio_ventas=$venta->regresaFolioVenta();
$idvendedor=$venta->regresaVendedor();
$nombre=$venta->regresaNombre();
$ap=$venta->regresaApaterno();
$am=$venta->regresaAmaterno();
$direccion=$venta->regresaDireccion();
$datos=$venta->regresaDatos();
$telefono_1=$venta->regresaTel1();
$telefono_2=$venta->regresaTel2();
$telefono_3=$venta->regresaTel3();
$d=$venta->regresaDia();
$m=$venta->regresaMes();
$ye=$venta->regresaYear();
$hr=$venta->regresaHora();
$fecha=$d."/".$m."/".$ye." ".$hr;
$estatus=$venta->regresaEstatus();
$datosC=new Filder();
$datosC->obtenerFilderVBD($idventa,$con);
$idfilder=$datosC-> regresaIdFilder();
$contesto=$datosC-> regresaContesto();
$asignacionS=new AsignacionBajante();
$asignacionS->obtenerAsignacionBD($idventa,$con);
$super=$asignacionS->regresaIdSupervisor();
//echo $super."----".$iduser;
if($contesto=='SI'){
    $iduser=$datosC-> regresaIdUser();
    $fechafilder=$datosC-> regresaFechaFilder();
    $cliente=$datosC-> regresaCliente();
    $atiende=$datosC-> regresaAtiende();
    $servicio=$datosC-> regresaServicio();
    $paquete=$datosC-> regresaPaquete();
    $direccion=$datosC-> regresaDireccion();
    $colonia=$datosC-> regresaColonia();
    $municipio=$datosC-> regresaMunicipio();
    $cp=$datosC-> regresaCP();
    $instalacion=$datosC-> regresaGastosInstalacion();
    $tiempo_i=$datosC-> regresaTiempoInstalacion();
    $obs=$datosC-> regresaObservaciones();
    $idventa=$datosC-> regresaIdVenta();
}else{
}
?>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Nueva OS No.<?php echo $idmos;?></div>
            <!--*************************************************-->
            <div class="col-md-12">
            <div class="well col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Folio Venta: <?php //echo $folio_ventas;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $folio_ventas;?>" name="folio_ventas"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Nombre: <?php// echo $nombre;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $nombre;?>" name="nombre"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Apellido Paterno: <?php// echo $nombre;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $ap;?>" name="apaterno"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Apellido Materno: <?php// echo $nombre;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $am;?>" name="amaterno"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Dirección: <?php //echo $direccion;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $direccion;?>" name="dir"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Detalles: <?php //echo $datos;?></span>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $datos;?>" name="datos"  readonly> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Fecha:<?php echo $fecha;?></span>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Telefonos</span>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">
                    <?php //echo $telefono_1;?>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_1;?>" name="tel1"  readonly> 
                    </span>
                    <span class="input-group-addon" id="sizing-addon3">
                    <?php //echo $telefono_2;?>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_2;?>" name="tel2"  readonly> 
                    </span>
                    <span class="input-group-addon" id="sizing-addon3">
                    <?php //echo $telefono_3;?>
                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_3;?>" name="tel3"  readonly> 
                    </span>
                </div>
            </div>
                
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Contesto:<?php echo $contesto;?></span>
                        <span class="input-group-addon" id="sizing-addon3">Nombre:<?php echo $cliente;?></span>
                    </div>
                    <div id="nCuenta" style="display:none;">
                           
                    </div>
                    <div id="nTargeta" style="display:;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">¿Quien atiende?(Nombre): <?php echo $atiende;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Desea el servicio? <?php echo $servicio;?></span>
                            <span class="input-group-addon" id="sizing-addon3">Informacion de Paquete: <?php echo $paquete;?></span>                    
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Dirección Calle y Número: <?php echo $direccion;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Colonia: <?php echo $colonia;?></span>
                            <span class="input-group-addon" id="sizing-addon3">Municipio: <?php echo $municipio;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">CP: <?php echo $cp;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Gastos de Instalación: <?php echo $instalacion;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Tiempo aproximado de instalación: <?php echo $tiempo_i;?></span>
                        </div>
                        <textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;" readonly> <?php echo $obs;?> </textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $siacF=new Foliosiac();
                    $siacF->obtenerSiacBD($idfilder,$con);
                    $siac=$siacF->regresaFolioSiac();
                    $fechaR=$siacF->regresaFechaSiac();
                    if($siac==0){
                    ?>
                    <div class="well">FASE 3
                        <form action="modSiac.php" method="POST">
                            <input type="text" name="id" value="<?php echo $idfilder;?>" style="display:none;">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Folio Siac:</span>
                                <input class="form-control" aria-describedby="sizing-addon4"  name="siac"  readonly> 
                            </div>
                           <!-- <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>-->
                        </form>
                    </div>
                    <?php
                    }else{
                        $tienda=new TiendaComercial(); 
                        $tienda->obtenerTiendaBD($idfilder,$con);
                        $idT=$tienda->regresaIdTienda();
                        //$tienda->verTienda();
                        $comercial=$tienda-> regresaTiendaComercial();
                        $telasig=$tienda-> regresaTelAsignado();
                        $folioOs=$tienda-> regresaFolioOs();
                        $etapa=$tienda-> regresaEtapa();
                        $lps=$tienda-> regresaListoPs();
                        $fechaC=$tienda-> regresaFechaComercial();
                        if($idT==''){
                        ?>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span>
                                <span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span>
                            </div>
                            <form action="regComercial.php" method="POST">
                                <input type="text" name="id" value="<?php echo $idfilder;?>" style="display:none;">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Tienda Comercial: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="tienda"  value="" readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Teléfono: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" type="tel" value="" pattern=".{10}" name="tel"  readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Orden de Servicio: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="folio_o"  value="" readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Etapa: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="" readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value="" readonly> 
                                </div>
                                <!--<div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-success"/></div>-->
                            </form>
                        <?php
                        }else{
                            ?>
                            <form action="modTienda.php" method="POST">
                                <input type="text" name="id" value="<?php echo $idT;?>" style="display:none;">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span>
                                    <span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span>
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Tienda Comercial: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $comercial;?>" name="tienda"  readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Teléfono: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" type="tel" pattern=".{10}" value="<?php echo $telasig;?>" name="tel"  readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Orden de Servicio: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="folio_o" value="<?php echo $folioOs;?>" readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Etapa: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="<?php echo $etapa;?>" readonly> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value="<?php echo $lps;?>" readonly> 
                                </div>
                                <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!--*********************************************************************************-->
            
            <!--*********************************************************************************-->
          <form action="addOsRN.php" method="POST" enctype="multipart/form-data">
          <input type="number" name="ident" value="<?php echo $idos;?>" style="display:none;">
            <div class="panel-body" style="background-color:gray;">
             
              <div class="col-md-4">
                <div class="panel panel-info">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">FILIAL ASIGNADA: </span>
                    <input class="form-control" aria-describedby="sizing-addon4" type="text" value="" name="filial_asignada"  required> 
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">NOMBRE AUXILIAR O PROPORCIONA INF: </span>

                    <input class="form-control" aria-describedby="sizing-addon4" type="text"value="" name="nom_auxiliar"  required>                       
                </div>
                    <div class="page-header">
                      COPE (ejemplo: CT CONSTITUCION) <label><input type="text" value="" name="cope"><?php// echo $cope;?></label><br>
                      EXPEDIENTE <label><input type="text" value="" name="expediente"><?php //echo $expediente;?></label></br>
                      Fecha <label><?php echo $fecha;?></label></br>
                      FOLIO PISA <label><input type="text" value="" name="foliopisa" required><?php //echo $folio_pisa;?></label></br>
                      FOLIO PISAPLEX <label><input type="text" value="" name="foliopisaplex" required><?php //echo $folio_pisaplex;?></label>
                      <!--<label>Cliente <label><?php echo $cliente;?></label></label>-->
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="page-header">
                      Teléfono <label>
                      <input type="tel" class="form-control" placeholder="Teléfono"  pattern=".{10}" name="tel" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." required>
                      <?php //echo $tel;?></label><br>
                      Cliente <label><input type="text" value="" name="cliente"><?php //echo $cliente;?></label>

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
                              $yo=new Usuario();
                              $yo->obtenerUsuarioCorreoBD($mail,$con);
                              $iduser=$yo->regresaIdu();
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

                                  echo "<option value='".$idus."''>".$nombre." ".$apaterno." ".$amaterno."</option>";
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