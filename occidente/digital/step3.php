<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
//$cnxe = Conectarse(); 
$con = Conectarse();  
//$con2 = Conectarse(); 
//$con3 = Conectarse();
//$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idus=$_POST['ident'];
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/slider.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>
<script type="text/javascript">
  function pagoOnChange(sel) {
      if (sel.value=="NO"){
           divC = document.getElementById("nCuenta");
           divC.style.display = "";

           divT = document.getElementById("nTargeta");
           divT.style.display = "none";

      }else{

           divC = document.getElementById("nCuenta");
           divC.style.display="none";

           divT = document.getElementById("nTargeta");
           divT.style.display = "";
      }
}
</script>
<?php
    cbajantes($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
                $venta=new Ventas();
                $venta->obtenerVentaBD($idus,$con);
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
                $distrito=$venta->regresaDistrito();
                $area=$venta->regresaArea();
                $terminal=$venta->regresaTerminal();
                //$fecha=$venta->regresaFecha();
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
                    /*
                     echo "
                      <script>
                          alert('REGISTRADO!');
                          document.location=(' inde.php');
                      </script>"; 
                    */
                }
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $semana = date("W");
            ?>
            <div class="panel-heading">
                <?php 
                    echo $dia."/".$mes."/".$aaaa;
                    echo "<br><b>FASE 5</b>";
                ?>
            </div>
            <div class="panel-body">
            <div class="col-md-12">
                <form action="modVenta.php" method="POST">
                <input type="" name="idventa" value="<?php echo $idus;?>" style="display:none;">
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
                            <span class="input-group-addon" id="sizing-addon3">Area: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $area;?>" name="datos"  readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Distrito: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $distrito;?>" name="datos"  readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Terminal: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $terminal;?>" name="datos"  readonly> 
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
                        <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
                    </div>
                </form>
                <div class="col-md-4">
                    <input type="" name="idventa" value="<?php echo $idus;?>" style="display:none;">
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
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">Fase 5 Asignacion</div>
                        <div class="panel-body">
                        <?php
                        $asignacion=new AsignacionBajante();
                        $asignacion->obtenerAsignacionBD($idventa,$con);
                        $fechaAsignacion=$asignacion->regresaFechaAsignacion();
                        $idsu=$asignacion->regresaIdSupervisor();
                        $user=new Usuario();//idus
                        $user->obtenerUsuarioBD($idsu,$con);
                        $nms=$user->regresaNombre();
                        $aps=$user->regresaApaterno();
                        $ams=$user->regresaAmaterno();
                        if($fechaAsignacion==''){
                            ?>
                            <label>Sin Asignaciones</label>
                            <?php
                        }
                            else{
                        ?>
                        <BR>Ultima fecha de asignación:<label><?php echo $fechaAsignacion;?></label>
                        <BR>Supervisor:<label><?php echo $nms." ".$ams." ".$aps;?></label>
                        <?php
                        }
                        ?>
                        <form action="regAsignacion.php" method="POST">
                            <input type="text" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Asignar a Supervisor: </span>
                                <div class="form-group">
                                  <select class="form-control" id="sel1" name="user">
                                      <?php
                                      $supervisor=new Usuario();
                                      $TOTAL=$supervisor->TotalUsuariosActivosBD($con);
                                      for ($i=0; $i <= $TOTAL; $i++) { 
                                        $supervisor->obtenerUsuarioBD($i,$con);
                                        $tipo=$supervisor->regresaTipoIdTipo();
                                        if($tipo==3){
                                          $idus=$supervisor->regresaIdu();
                                          $nombre=$supervisor->regresaNombre();
                                          $apaterno=$supervisor->regresaApaterno();
                                          $amaterno=$supervisor->regresaAmaterno();

                                          echo "<option value='".$idus."''>".$nombre." ".$apaterno." ".$amaterno."</option>";
                                        }
                                      }
                                      ?>                      
                                  </select>
                                </div>
                            </div>
                            <div align="center"><input type="submit" value="ASIGNAR" id="envia" name="envia" class="btn btn-success"/></div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
    </div>    
</div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>