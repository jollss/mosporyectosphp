<?php
include("../Config/library.php");
$con = Conectarse();  
$idus=$_GET['id'];
?>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
            $con1 = Conectarse();
            $sql="SELECT * FROM venta WHERE idventa ='$idus'";
            $resultado=$con1->query($sql);
            while($row = $resultado->fetch_assoc())
            {
                $idventa=$row['idventa'];
                $folio_ventas=$row['folio_ventas'];
                $idvendedor=$row['idvendedor'];
                $nombre=$row['nombrev'];
                $ap=$row['apaternov'];
                $am=$row['amaternov'];
                $direccion=$row['direccion'];
                $datos=$row['datos'];
                $telefono_1=$row['telefono_1'];
                $telefono_2=$row['telefono_2'];
                $telefono_3=$row['telefono_3'];
                $terminal=$row['terminal'];
                $dia=$row['dia'];
                $mes=$row['mes'];
                $year=$row['year'];
                $hora=$row['hora'];
                $doc=$row['documentacion'];
                $area=$row['area'];
                $dist=$row['distrito'];

                $fecha=$dia."/".$mes."/".$year." ".$hora;
                $estatus=$row['estatus'];

                //$idfilder=$row[''];
                $contesto=$row['contesto'];
                if($contesto=='SI' or !isset($contesto)){
                    //$iduser=$row[''];
                    $fechafilder=$row['fecha_fielder'];
                    $cliente=$row['cliente'];
                    $atiende=$row['atiende'];
                    $servicio=$row['servicio'];
                    $paquete=$row['paquete'];
                    $direccion=$row['direccion_v'];
                    $colonia=$row['colonia'];
                    $municipio=$row['municipio'];
                    $cp=$row['cp'];
                    $instalacion=$row['gastos_instalacion'];
                    $tiempo_i=$row['tiempo_instalacion'];
                    $obs=$row['observaciones'];
                    $idventa=$row['idventa'];
                }else{
                    $iduser="";
                    $atiende='';
                    $fechafilder=$row['fecha_fielder'];
                    $cliente=$row['cliente'];
                    $servicio=$row['servicio'];
                    $paquete=$row['paquete'];
                    $direccion=$row['direccion'];
                    $colonia=$row['colonia'];
                    $municipio=$row['municipio'];
                    $cp=$row['cp'];
                    $instalacion=$row['gastos_instalacion'];
                    $tiempo_i=$row['tiempo_instalacion'];
                    $obs=$row['observaciones'];
                    $idventa=$row['idventa'];
                    /*
                     echo "
                      <script>
                          alert('REGISTRADO!');
                          document.location=(' inde.php');
                      </script>"; 
                    */
                }
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
                <form action="modVenta.php" method="POST">
                
                    <div class="well col-md-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">No. de Solicitud: <?php //echo $folio_ventas;?></span>
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
                            <span class="input-group-addon" id="sizing-addon3">Terminal: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $terminal;?>" name="terminal" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Area: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $area;?>" name="area" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Distrito: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $dist;?>" name="distrito" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Documentacion</span>
                            <?php //echo $instalacion;?>
                            <select class="form-control" id="sel1" name="documentacion" readonly>
                            <?php 
                            if($doc=="NO" OR $doc==''){
                                ?>
                                <option value='NO' selected="selected">NO</option>
                                <option value='SI'>SI</option>
                            <?php
                            }if($doc=="SI"){
                                ?>
                                <option value='NO'>NO</option>
                                <option value='SI' selected="selected">SI</option>
                            <?php
                            }
                            ?>
                            </select>
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
                <div class="col-md-6">
                <form action="modDetalles.php" method="POST"  name="formulario">
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
                            <input class="form-control" aria-describedby="sizing-addon4" name="nomatiende" value="<?php echo $atiende;?>" id="vr_negativo" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Desea el servicio?</span>
                            <select class="form-control" id="sel1" name="servicio" readonly>
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
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Informacion de Paquete</span>
                            <select class="form-control" id="sel1" name="paquete" readonly>
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
                            <input class="form-control" aria-describedby="sizing-addon4" name="calle_num" value="<?php echo $direccion;?>" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Colonia</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="colonia" value="<?php echo $colonia;?>" readonly> 
                            <span class="input-group-addon" id="sizing-addon3">Municipio</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="municipio" value="<?php echo $municipio;?>" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">CP</span>
                            <input class="form-control" aria-describedby="sizing-addon4" name="CP" value="<?php echo $cp;?>" type="number" readonly> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Gastos de Instalación</span>
                            <?php //echo $instalacion;?>
                            <select class="form-control" id="sel1" name="gastos_inst" readonly>
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
                            <input class="form-control" type="text" aria-describedby="sizing-addon4" name="aprox" value="<?php echo $tiempo_i;?>" readonly> 
                        </div>
                        <textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;" readonly> <?php echo $obs;?> </textarea>
                    </div>
                    <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
                </form>
                </div>
                <div class="col-md-6">
                    <?php
                    $con1 = Conectarse();
                    $sql="SELECT * FROM venta WHERE idventa ='$idus'";
                    $resultado=$con1->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $siac=$row['folio_siac'];
                        $fechaR=$row['fecha_siac'];
                    }
                    if($siac==0){
                    ?>
                    <div class="well">FASE 3
                        <form action="modSiac.php" method="POST">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Folio Siac:</span>
                                <input class="form-control" aria-describedby="sizing-addon4"  name="siac"  readonly> 
                            </div>
                            <!--<div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>-->
                        </form>
                    </div>
                    <?php
                    }else{
                        $con1 = Conectarse();
                        $sql="SELECT * FROM venta WHERE idventa ='$idus'";
                        $resultado=$con1->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            
                            //$tienda->verTienda();
                            $comercial=$row['tienda_comercial'];
                            $telasig=$row['tel_asignado'];
                            $folioOs=$row['folio_os'];
                            $etapa=$row['etapa'];
                            $lps=$row['listo_ps'];
                            $fechaC=$row['fecha_comercial'];
                        }
                        if($comercial==''){
                        ?>
                        <table>
                            <tr>
                                <td><span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span></td>
                            </tr>
                            <tr>
                                <td><span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span></td>
                            </tr>
                        </table>
                            <form action="regComercial.php" method="POST">
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
                                <!--<div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span>
                                    <span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span>
                                </div>-->
                                <table>
                                    <tr>
                                        <td><span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span></td>
                                    </tr>
                                </table>
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
                                <div class="col-md-12"><span class="input-group-addon" id="sizing-addon3">Cambio de Etapa: <?php echo $fechaC;?></span></div>
                                <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
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
                            <div class="panel panel-success">
                                <div class="panel-heading">Datos de Asignacion</div>
                                <div class="panel-body">
                                    Nombre de Supervisor asignado: <label><?php echo $n." ".$ap." ".$am;?></label>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            
            </div>
    </div>    
</div>