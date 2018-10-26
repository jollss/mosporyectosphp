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
$idventa=$_POST['ident'];
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
    <?php ventas($user);?>
    <br><br>
    <br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Datos de Venta</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
            $sql1="SELECT * FROM venta WHERE idventa='$idventa'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                
                $idventa=$row['idventa'];
                $folio_ventas=$row['folio_ventas'];
                $idvendedor=$row['idvendedor'];
                $nombre=$row['nombrev'];
                $ap=$row['apaternov'];
                $am=$row['amaternov'];
                $direccion1=$row['direccion'];
                $datos=$row['datos'];
                $telefono_1=$row['telefono_1'];
                $telefono_2=$row['telefono_2'];
                $telefono_3=$row['telefono_3'];

                $d=$row['dia'];
                $m=$row['mes'];
                $y=$row['year'];
                $h=$row['hora'];
                $fecha=$d."/".$m."/".$y." ".$h;
                $estatus=$row['estatus'];

                    //$idventa=$row[''];
                    $longitud=$row['longitud'];
                    $latitud=$row['latitud'];
                $contesto=$row['contesto'];
                if($contesto=='SI'){
                    
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

                    $siac=$row['folio_siac'];
                    $fechaR=$row['fecha_siac'];
                    //$tienda->verTienda();
                    $comercial=$row['tienda_comercial'];
                    $telasig=$row['tel_asignado'];
                    $folioOs=$row['folio_os'];
                    $etapa=$row['etapa'];
                    $lps=$row['listo_ps'];
                    $fechaC=$row['fecha_comercial'];
                }else{
                    $iduser="";
                    $fechafilder="";
                    $cliente="";
                    $atiende="";
                    $servicio="";
                    $paquete="";
                    $direccion="";
                    $colonia="";
                    $municipio="";
                    $cp="";
                    $instalacion="";
                    $tiempo_i="";
                    $obs="";
                    $siac=0;
                    //$idventa="";
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
                    //echo "<br><b>FASE 5</b>";
                ?>
            </div>
            <div class="panel-body">
            <!--<div class="col-md-12">-->
            <div class="input-group col-md-12" align="center" style="background-color:gray;">
                <div class="col-md-6">
                  <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $folio_ventas;?>"  name="solicitud" readonly>
                    <span class="input-group-addon" id="sizing-addon2">
                    <label>Imagen de Documentacion:</label>
                    <input type="file" name="userfile[]">
                    <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
                    </span>
                  </form>
                  </div>
                  <div class="col-md-6" style="background-color:orange;">
                    <?php
                      $sql1="SELECT * FROM adjunto_venta WHERE folio_venta='$folio_ventas'";
                      $resultado=$con->query($sql1);
                      while($row = $resultado->fetch_assoc())
                      {
                        $folioventa=$row['folio_venta'];
                        $imagen_n=$row['imagen_n'];
                        ?>
                        <a href="../adjVentas/<?php echo $imagen_n;?>" target="_blank"><img src="../adjVentas/<?php echo $imagen_n;?>" width="40" height="40"></a>
                        <?php
                      }
                      ?>
                </div>
            </div>
            <div class="col-md-12" align="center" style="background-color:;">
                <?php
                    if(!isset($latitud) and !isset($longitud)){
                        echo "SIN REGISTRO DE UBICACION";
                    }
                    if(isset($latitud) and isset($longitud)){
                        echo "<a href='https://maps.google.com/?q=".$latitud.",".$longitud."' target='_blank'><img src='../syspic/ubication.png' width='40' height='40'>Ubicacion</a>";
                    }else{}
                ?>
            </div>
            <div class="input-group col-md-12" align="center" style="background-color:;">
                <form action="modVenta.php" method="POST">
                <input type="" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                    <div class="well col-md-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Id: </span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $idventa;?>" name="folio_ventas"  readonly> 
                        </div>
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
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $direccion1;?>" name="dir"  readonly> 
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
                        <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
                    </div>
                </form>
                <div class="col-md-6">
                    <!--<input type="" name="idventa" value="<?php echo $idus;?>" style="display:none;">-->
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
                <div class="col-md-6">
                    <?php
                    if($siac==0){
                    ?>
                    <div class="well">FASE 3
                        <form action="modSiac.php" method="POST">
                            <!--<input type="text" name="id" value="<?php echo $idfilder;?>" style="display:none;">-->
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon" id="sizing-addon3">Folio Siac:</span>
                                <input class="form-control" aria-describedby="sizing-addon4"  name="siac"  readonly> 
                            </div>
                            <!--<div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>-->
                        </form>
                    </div>
                    <?php
                    }else{
                       
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
                    <div class="panel panel-info">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                        <?php
                        $asignacion=new AsignacionBajante();
                        $asignacion->obtenerAsignacionBD($idventa,$con);
                        $fechaAsignacion=$asignacion->regresaFechaAsignacion();
                        $supervisorId=$asignacion->regresaIdSupervisor();
                        $super=new Usuario();
                        $super->obtenerUsuarioBD($supervisorId,$con);
                        $no=$super->regresaNombre();
                        $ape=$super->regresaApaterno();
                        $ame=$super->regresaAmaterno();
                        if($fechaAsignacion=='' || $siac==''){
                            ?>
                            <label>Sin Asignaciones</label>
                            <?php
                        }
                        else{
                            ?>
                            <BR>Ultima fecha de asignación:<label><?php echo $fechaAsignacion;?></label>
                            <br>Supervisor: <?php echo $no." ".$ape." ".$ame;?>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
                
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
