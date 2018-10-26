<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$con2 = Conectarse();  
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php nivel4($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificar datos de venta</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
            $sql2="SELECT * FROM venta WHERE idventa='$idus'";
            $resultado2=$con2->query($sql2);
            while($row2 = $resultado2->fetch_assoc())
            {
                $idventa=$row2['idventa'];
                $folio_ventas=$row2['folio_ventas'];
                $idvendedor=$row2['idvendedor'];
                $nombre=$row2['nombrev'];
                $ap=$row2['apaternov'];
                $am=$row2['amaternov'];
                $direccion=$row2['direccion'];
                $datos=$row2['datos'];
                $telefono_1=$row2['telefono_1'];
                $telefono_2=$row2['telefono_2'];
                $telefono_3=$row2['telefono_3'];
                $terminal=$row2['terminal'];
                $dia=$row2['dia'];
                $mes=$row2['mes'];
                $year=$row2['year'];
                $hora=$row2['hora'];
                $doc=$row2['documentacion'];
                $area=$row2['area'];
                $dist=$row2['distrito'];

                $fecha=$dia."/".$mes."/".$year." ".$hora;
                $estatus=$row2['estatus'];

                $idfilder=$row2['idvendedor'];
                $contesto=$row2['contesto'];
                if($contesto=='SI' or !isset($contesto)){
                    $iduser=$row2['idvendedor'];
                    $fechafilder=$row2['fecha_fielder'];
                    $cliente=$row2['cliente'];
                    $atiende=$row2['atiende'];
                    $servicio=$row2['servicio'];
                    $paquete=$row2['paquete'];
                    $direccion=$row2['direccion_v'];
                    $colonia=$row2['colonia'];
                    $municipio=$row2['municipio'];
                    $cp=$row2['cp'];
                    $instalacion=$row2['gastos_instalacion'];
                    $tiempo_i=$row2['tiempo_instalacion'];
                    $obs=$row2['observaciones'];
                    //$idventa=$row2[''];
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
                <input type="" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                    <div class="well col-md-12">
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
                            <span class="input-group-addon" id="sizing-addon3">Terminal: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $terminal;?>" name="terminal" > 
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
                            <span class="input-group-addon" id="sizing-addon3">Documentacion</span>
                            <?php //echo $instalacion;?>
                            <select class="form-control" id="sel1" name="documentacion">
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
                <div class="col-md-6">
                <form action="modDetalles.php" method="POST"  name="formulario">
                    <input type="text" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
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
                        </div>
                        <div class="input-group input-group-sm">
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
                            <input type="text" name="gastos_inst" value="<?php echo $instalacion;?>" class="form-control">
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
                <div class="col-md-6">
                    <?php
                    $sql2="SELECT * FROM venta WHERE idventa='$idus'";
                    $resultado2=$con2->query($sql2);
                    while($row2 = $resultado2->fetch_assoc())
                    {
                        $siac=$row2['folio_siac'];//regresaFolioSiac();
                        $fechaR=$row2['fecha_siac'];//$siacF->regresaFechaSiac();
                    }
                    if($siac==0){
                    ?>
                    <div class="well">FASE 3
                        <form action="modSiac.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $idventa;?>" >
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Folio Siac:</span>
                                <input class="form-control" aria-describedby="sizing-addon4"  name="siac"  required> 
                            </div>
                            <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>
                        </form>
                    </div>
                    <?php
                    }else{
                        $sql2="SELECT * FROM venta WHERE idventa='$idus'";
                        $resultado2=$con2->query($sql2);
                        while($row2 = $resultado2->fetch_assoc())
                        {
                            //$tienda=new TiendaComercial(); 
                            //$tienda->obtenerTiendaBD($idfilder,$con);
                            //$idT=$row2['id'];//regresaIdTienda();
                            //$row2[''];verTienda();
                            $comercial=$row2['tienda_comercial'];// regresaTiendaComercial();
                            $telasig=$row2['tel_asignado'];// regresaTelAsignado();
                            $folioOs=$row2['folio_os'];// regresaFolioOs();
                            $etapa=$row2['etapa'];// regresaEtapa();
                            $lps=$row2['listo_ps'];// regresaListoPs();
                            $fechaC=$row2['fecha_comercial'];// regresaFechaComercial();
                        }
                        if($etapa==''){
                        ?>
                        <table>
                            <tr>
                                <td><span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span></td>
                            </tr>
                            <tr>
                                <td><span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span></td>
                            </tr>
                        </table>
                            <form action="modTienda.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $idventa;?>">
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
                                    <!--
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="" required> 
                                    -->
                                    <select name="estapa" class="form-control" required>
                                        <option value="I">I ... INSTALACION</option>
                                        <option value="P">P ... POSTEADO</option>
                                        <option value="X">X... CANCELADO</option>
                                        <option value="C">C... COMERCIAL </option>
                                        <option value="">NINGUNO</option>
                                    </select>
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
                                <input type="hidden" name="id" value="<?php echo $idventa;?>" >
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
                                    <!--<input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value="<?php echo $etapa;?>" required> -->
                                    <select name="estapa" class="form-control" required>
                                        <option value="<?php echo $etapa;?>"><?php echo $etapa;?></option>
                                        <option value="I">I ... INSTALACION</option>
                                        <option value="P">P ... POSTEADO</option>
                                        <option value="X">X... CANCELADO</option>
                                        <option value="C">C... COMERCIAL </option>
                                        <option value="">NINGUNO</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
                                    <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value="<?php echo $lps;?>" required> 
                                </div>
                                <div class="col-md-12"><span class="input-group-addon" id="sizing-addon3">Cambio de Etapa: <?php echo $fechaC;?></span></div>
                                <div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>
                            </form>
                            <?php
                            /*
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
                            */
                        }
                    }
                    ?>
                </div>
            </div>
            
            </div>
    </div>    
</div>
<!--============================================================================================-->      
    </div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
