<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
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
    lider($user);
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
                $termi=$venta->regresaTerminal();
                $dia=$venta->regresaDia();
                $mes=$venta->regresaMes();
                $year=$venta->regresaYear();
                $hora=$venta->regresaHora();
                $nvende=$venta->regresaVendedorN();
                $docum=$venta->regresaDocumentacion();
                $area=$venta->regresaArea();
                $dist=$venta->regresaDistrito();
                $fecha=$dia."/".$mes."/".$year." ".$hora;
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
                    $iduser='';
                    $fechafilder='';
                    $cliente='';
                    $atiende='';
                    //$servicio='';
                    $paquete='';
                    $direccion='';
                    $colonia='';
                    $municipio='';
                    $cp='';
                    $instalacion='';
                    $tiempo_i='';
                    $obs='';
                    $idventa='';
                }
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $semana = date("W");
            ?>
            <div class="panel-heading">
                <?php 
                    echo $dia."/".$mes."/".$aaaa;
                    echo "<br><b>FASE 3</b>";
                ?>
            </div>
            <div class="panel-body">
            <div class="col-md-12">
            <label><?php if($nvende==0 or $nvende==''){}else{ echo $nvende;}?></label>
                <form action="modVenta.php" method="POST">
                <input type="" name="idventa" value="<?php echo $idus;?>" style="display:none;">
                    <div class="well col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">No. de Solicitud: <?php //echo $folio_ventas;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $folio_ventas;?>" name="folio_ventas"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Nombre: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $nombre;?>" name="nombre"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Apellido Paterno: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $ap;?>" name="apaterno"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Apellido Materno: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $am;?>" name="amaterno"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Dirección: <?php //echo $direccion;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $direccion;?>" name="dir"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Detalles: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $datos;?>" name="datos"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Terminal: </span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $termi;?>" name="terminal"> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Area: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $area;?>" name="area" > 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Distrito: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $dist;?>" name="distrito" > 
                        </div>
                        <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">DOCUMENTACION:</span>
                        <?php
                        if($docum=='NO' or $docum=='')
                        {
                        ?>
                            <select class="form-control" id="sel1" name="documentacion">
                                <option value='SI'>SI</option>
                                <option value='NO' selected="selected">NO</option>
                            </select>
                        <?php
                        }else{
                        ?>
                            <select class="form-control" id="sel1" name="documentacion">
                                <option value='SI' selected="selected">SI</option>
                                <option value='NO'>NO</option>
                            </select>
                        <?php
                        }
                        ?>
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
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_1;?>" name="tel1"  required> 
                            </span>
                            <span class="input-group-addon" id="sizing-addon3">
                            <?php //echo $telefono_2;?>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_2;?>" name="tel2"  required> 
                            </span>
                            <span class="input-group-addon" id="sizing-addon3">
                            <?php //echo $telefono_3;?>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_3;?>" name="tel3"  required> 
                            </span>
                        </div>
                        <div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>
                    </div>
                </form>
                <div class="col-md-4">
                <!--
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
                -->
                <form action="modDetalles.php" method="POST"  name="formulario">
                    <input type="text" name="idventa" value="<?php echo $idfilder;?>" style="display:none;">
                    <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Contesto:<?php echo $contesto;?></span>
                    <span class="input-group-addon" id="sizing-addon3">Nombre:<?php echo $cliente;?></span>
                    </div>
                    <div id="nCuenta" style="display:none;">
                           Los campos se llenaran en automaticamente con valores en cero (0).
                      </div>
                    <div id="nTargeta" style="display:;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">¿Quien atiende?(Nombre)</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="nomatiende" value="<?php echo $atiende;?>" id="vr_negativo" required> 
                        </div>
                        <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Desea el servicio?</span>
                            <select class="form-control" id="sel1" name="servicio" >
                                <?php
                                if($servicio=="SI"){
                                    ?>
                                    <option value='SI' selected="selected">SI</option>
                                    <option value='NO'>NO</option>
                                <?php
                                }
                                if($servicio=="NO"){
                                    ?>
                                    <option value='SI' >SI</option>
                                    <option value='NO' selected="selected">NO</option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="input-group-addon" id="sizing-addon3">Informacion de Paquete</span>
                            <select class="form-control" id="sel1" name="paquete">
                                <?php
                                if($paquete=="SI"){
                                    ?>
                                    <option value='SI' selected="selected">SI</option>
                                    <option value='NO'>NO</option>
                                <?php
                                }
                                if($paquete=="NO"){
                                    ?>
                                    <option value='SI' >SI</option>
                                    <option value='NO' selected="selected">NO</option>
                                <?php
                                }
                                ?>
                            </select>
                        
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Dirección Calle y Número</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="calle_num" value="<?php echo $direccion;?>" required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Colonia</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="colonia" value="<?php echo $colonia;?>" required> 
                            <span class="input-group-addon" id="sizing-addon3">Municipio</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="municipio" value="<?php echo $municipio;?>" required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">CP</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="CP" value="<?php echo $cp;?>" type="number" required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Gastos de Instalación</span>
                            <?php //echo $instalacion;?>
                            <select class="form-control" id="sel1" name="gastos_inst">
                            <?php 
                            if($instalacion=="NA"){
                                ?>
                                <option value='NA' selected="selected">NA</option>
                                <option value='1 MES'>1 MES</option>
                                <option value='18 MESES'>18 MESES</option>
                            <?php
                            }
                            if($instalacion=="1 MES"){
                                ?>
                                <option value='NA'>NA</option>
                                <option value='1 MES' selected="selected">1 MES</option>
                                <option value='18 MESES'>18 MESES</option>
                            <?php
                            }
                            if($instalacion=="18 MESES"){
                                ?>
                                <option value='NA'>NA</option>
                                <option value='1 MES'>1 MES</option>
                                <option value='18 MESES' selected="selected">18 MESES</option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Tiempo aproximado de instalación</span>
                            <input class="form-control" type="text" aria-describedby="sizing-addon4" name="aprox" value="<?php echo $tiempo_i;?>" required> 
                        </div>
                        <textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;" required> <?php echo $obs;?> </textarea>
                    </div>
                    <div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>
                </form>
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
                                <input class="form-control" aria-describedby="sizing-addon4"  name="siac"  required> 
                            </div>
                            <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>
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
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="tienda"  value="" required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Teléfono: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" type="tel" value="" pattern=".{10}" name="tel"  required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Orden de Servicio: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="folio_o"  value="" required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Etapa: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="" required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value="" required> 
                                </div>
                                <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-success"/></div>
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
                                    <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $comercial;?>" name="tienda"  required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Teléfono: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" type="tel" pattern=".{10}" value="<?php echo $telasig;?>" name="tel"  required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Orden de Servicio: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="folio_o" value="<?php echo $folioOs;?>" required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Etapa: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="<?php echo $etapa;?>" required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value="<?php echo $lps;?>" required> 
                                </div>
                                <div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>
                            </form>
                            <?php
                            $asignacion=new AsignacionBajante();
                            $asignacion->obtenerAsignacionBD($idventa,$con);
                            $supervisor=$asignacion->regresaIdSupervisor();
                            $super=new Usuario();
                            $super->obtenerUsuarioBD($supervisor,$con);
                            $n=$super->regresaNombre();
                            $ap=$super->regresaApaterno();
                            $am=$super->regresaAmaterno();
                            if($supervisor=='' || $supervisor==0){}
                            else{
                            ?>
                            <div class="col-md-12"></div>
                            <div class="panel panel-success">
                                <div class="panel-heading">Datos de Asignacion</div>
                                <div class="panel-body">
                                    Nombre de Supervisor asignado: <label><?php echo $n." ".$ap." ".$am;?></label>
                                </div>
                            </div>
                            <?php
                            }
                            /*
                            $fase7=new Fase7();
                            $fase7->obtenerfase7BD($idventa,$con);
                            $estatusF=$fase7->regresaEstatus();
                            if($estatusF=='POSIBLE OBJECION'){
                                //echo $estatusF;
                                ?>
                                <div class="panel panel-success">
                                    <div class="panel-heading">Información de posible objeción</div>
                                    <div class="panel-body">
                                        <form action="" method="POST">
                                        <input type="text" name="idventa" value="<?php echo $idventa;?>">
                                            <div class="input-group input-group-sm">
                                            <span class="input-group-addon" id="sizing-addon3">Nuevo Estatus</span>
                                                <select class="form-control" id="sel1" name="servicio">
                                                    <option>OBJETAR</option>
                                                    <option>LIQUIDAR</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <span class="input-group-addon" id="sizing-addon3">Observaciones de la Instalación</span>
                                                <!--<input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="<?php echo $etapa;?>" required> -->
                                                <textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;" required> </textarea>
                                                <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }if($estatusF=='LIQUIDADA'){
                                ?>
                                <div class="panel panel-success">
                                    <div class="panel-heading">LIQUIDADA</div>
                                </div>
                                <?php
                            }*/
                        }
                    }
                    ?>
                </div>
            </div>
            
            </div>
    </div>    
</div>
<div class="col-md-12"></div>
<?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>