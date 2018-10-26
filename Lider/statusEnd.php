<?php
include("../Config/library.php");
$idos=$_POST['ident'];
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Detalles de Venta</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
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
                if(!isset($idfilder)){
                    $contesto='';
                    $idfilder='';
                }
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
                    $iduser='';
                    $fechafilder='';
                    $cliente='';
                    $atiende='';
                    $servicio='';
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
                    echo "<br><b>FASE 5</b>";
                ?>
            </div>
            <div class="panel-body">
            <div class="col-md-12">
            <div align="">
                <form action="modVendedor.php" method="POST">
                <!--<form>-->
                <input type="text" name="idventas" value="<?php echo $idventa?>" style="display:none;">
                    <label>Venta realizada por:</label>
                    <select name="idV">
                    <?php
                    $usuarioF=new Usuario();
                    $tU=$usuarioF->TotalUBD($con);
                    for ($i=0; $i < $tU; $i++) { 
                    $usuarioF->obtenerUsuarioBD($i,$con);
                    $idV=$usuarioF->regresaIdu();
                    $nmV=$usuarioF->regresaNombre();
                    $apV=$usuarioF->regresaApaterno();
                    $amV=$usuarioF->regresaAmaterno();
                    $tipoV=$usuarioF->regresaTipoIdTipo();
                        if($tipoV==21 or $tipoV==4 or $tipoV==23 or $tipoV==22 or $tipoV==24){
                            if($idV==$idvendedor){
                            ?>
                                <option value="<?php echo $idV;?>" selected><?php echo $nmV." ".$apV." ".$amV;?></option>
                            <?php
                            }else{
                            ?>
                                <option value="<?php echo $idV;?>"><?php echo $nmV." ".$apV." ".$amV;?></option>
                            <?php
                            }
                        }
                    }
                    ?>
                    </select>
                    <input type="submit" class="btn btn-danger" value="MODIFICAR">
                </form>
            </div>
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
                    $fase6 = new Fase6();
                                $fase6->obtenerFase6BD($idventa,$con);
                                $fechaFase6=$fase6->regresaFechaFase6();
                    ?>
                </div>
                <div class="col-md-12"></div>
               
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><?php  echo "<br>Ultima Modificacion: ".$fechaFase6;?></div>
                        <div class="panel-body">
                        <?php
                            $filial=$fase6->regresaFilialAsignada();
                            $auxiliar=$fase6->regresaNombreAuxiliar();
                            $tecnicoId=$fase6->regresaIdTecnico();
                            $fileOs=$fase6->regresaFileOs();
                            $tecnicoA=new Usuario();
                            $tecnicoA->obtenerUsuarioBD($tecnicoId,$con);
                            $nomT=$tecnicoA->regresaNombre();
                            $apT=$tecnicoA->regresaApaterno();
                            $amT=$tecnicoA->regresaAmaterno();
                            $fase7=new Fase7();
                            $fase7->obtenerfase7BD($idventa,$con);
                            $idVentaF=$fase7->regresaIdVenta();
                            $statusV=$fase7->regresaEstatus();
                        ?>
                        <div class="col-md-6">
                        <?php
                            
                            if ($tecnicoId=='') {
                                $nomT='';
                                $apT='';
                                $amT='';
                            }
                        ?>
                            <div class="panel panel-danger">
                                <?php
                                echo "Filial: ".$filial."<br>";
                                echo "Auxiliar: ".$auxiliar."<br>";
                                echo "Tecnico: ".$nomT." ".$apT." ".$amT."<br>";
                                if ($fileOs=='') {
                                }else{
                                ?>
                                    <a href="../ventasFile/<?php echo $fileOs;?>" target="_blank"><img src="../syspic/pdf.png" width="30" height="30"></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="panel panel-info">
                                <?php
                                    $fventa=new finVenta();
                                    $fventa->obtenerFinVentaBD($idventa,$con);  
                                    echo "Observaciones: ".$fventa->regresaObservaciones()."<br>";
                                    echo "Personal de Telmex: ".$fventa->regresaPersonalTelmex()."<br>";
                                    echo "Fecha: ".$fventa->regresaFecha()."<br>";
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php
                        if($statusV!='OBJETAR'){
                            if ($filial=='' or $auxiliar=='' or $nomT=='') {
                            }else{
                            if($statusV=='POSIBLE OBJECION' and $idVentaF==$idventa or $filial!=''){
                                if($statusV=='LIQUIDAR'){}else{
                            ?>
                                <label>Datos registrados <?php echo $statusV;?></label>
                                <div class="panel panel-success">
                                <div class="panel-heading">FASE 8</div>
                                    <form action="regEndFase8.php" method="POST">
                                    <input type="number" name="ident" value="<?php echo $idventa;?>" style="display:none;">
                                    <input type="number" name="tecnico" value="<?php echo $tecnicoId;?>" style="display:none;">
                                    
                                    <?php
                                    $user=new Usuario();
                                    $total=$user->TotalUBD($con);
                                    ?>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="sel1">Estatus:</label>
                                                <select class="form-control" id="sel1" name="estatus">
                                                    <option value="LIQUIDAR">LIQUIDAR</option>
                                                    <option value="OBJETAR">OBJETAR</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon" id="sizing-addon3">Observaciones de la Instalación: </span>
                                            <textarea class="form-control" rows="5" name="detalles" placeholder="Observaciones"  style="resize:none;" required> </textarea>
                                        </div>
                                        <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-warning"/></div>
                                    </form>
                                </div>
                                <?php
                                    }
                                    }if($statusV=='LIQUIDAR' or $filial!=''){
                                        ?>
                                        <label>Datos registrados <?php echo $statusV;?></label>
                                        <?php
                                    }
                                }
                            }
                                ?>
                                 <?php
                            if($statusV=='OBJETAR'){
                                ?>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Datos de objecion</div>
                                    <div class="panel-body">
                                    <form action="regCausas.php" method="POST">
                                    <input type="number" name="ident" value="<?php echo $idventa;?>" style="display:none;">
                                        <div class="">
                                          <span class="input-group-addon" id="sizing-addon2">Personal que Recibe la Objecion en Telmex:</span><br>
                                        </div>
                                        <div class="">
                                          <input type="text" class="form-control"  placeholder="Nombre Completo"  name="notelmex" required><br>
                                        </div>
                                        <span>Detalles de objeción</span>
                                        <textarea class="form-control" rows="5" name="detalles" placeholder="Detalles de objeción"  style="resize:none;" required> </textarea>
                                        <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-warning"/></div>
                                    </form>
                                    </div>
                                </div>
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
