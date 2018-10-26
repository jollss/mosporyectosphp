<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idv=$_POST['ident'];

$idv=$_POST['ident'];
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
    <script type="text/javascript" src="../js/browserVentas.js"></script>
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
                <h3 class="page-header">Datos de venta</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <div class="container col-md-12" name="toTop" id="topPos">
            <div class="col-md-12">
                <div class="panel panel-info">
                <?php
                        $dia=date('j');
                        $mes=date('n');
                        $aaaa=date('Y');
                        $semana = date("W");
                    ?>
                    <div class="panel-heading">
                        <?php 
                            echo $dia."/".$mes."/".$aaaa;
                            echo "<br><b>BUSCAR</b>";
                        ?>
                    </div>
                    <div class="panel-body" style="background-color:black;">
                    <div align="center">
                    <?php 
                    echo $idv;
                    /*----------------------------------*/
                    $venta=new Ventas();
                    $venta->obtenerVentaBD($idv,$con);
                    $folio=$venta->regresaFolioVenta();
                    $idvende=$venta->regresaVendedor();
                    $cn=$venta->regresaNombre();
                    $apc=$venta->regresaApaterno();
                    $ampc=$venta->regresaAmaterno();
                    $dir=$venta->regresaDireccion();
                    $datos=$venta->regresaDatos();
                    $tel1=$venta->regresaTel1();
                    $tel2=$venta->regresaTel2();
                    $tel3=$venta->regresaTel3();
                    $diav=$venta->regresaDia();
                    $mesv=$venta->regresaMes();
                    $yearv=$venta->regresaYear();
                    $horav=$venta->regresaHora();
                    $estatus=$venta->regresaEstatus();
                    $vendedorV=$venta->regresaVendedorN();
                    $terminal=$venta->regresaTerminal();
                    /*----------------------------------*/
                    $filder=new Filder();
                    $filder->obtenerFilderVBD($idv,$con);
                    $idfilder=$filder->regresaIdFilder();
                    $contesto=$filder->regresaContesto();
                    $iduser=$filder->regresaIdUser();
                    $fechaFilder=$filder->regresaFechaFilder();
                    $clientef=$filder->regresaCliente();
                    $atiendef=$filder->regresaAtiende();
                    $serviciof=$filder->regresaServicio();
                    $paquetef=$filder->regresaPaquete();
                    $dirf=$filder->regresaDireccion();
                    $coloniaf=$filder->regresaColonia();
                    $municipiof=$filder->regresaMunicipio();
                    $cpf=$filder->regresaCP();
                    $instf=$filder->regresaGastosInstalacion();
                    $tiempoins=$filder->regresaTiempoInstalacion();
                    $obs=$filder->regresaObservaciones();
                    $idventa=$filder->regresaIdVenta();
                    /*----------------------------------*/
                    $siac=new FolioSiac();
                    $siac->obtenerSiacBD($idfilder,$con);
                    $idsiac=$siac->regresaIdSiac();
                    $folios=$siac->regresaFolioSiac();
                    $fechaSiac=$siac->regresaFechaSiac();
                    /*----------------------------------*/
                    $tienda=new TiendaComercial();
                    $tienda->obtenerTiendaBD($idventa,$con);
                    $idtienda=$tienda->regresaIdTienda();
                    $tiendacom=$tienda->regresaTiendaComercial();
                    $telasig=$tienda->regresaTelAsignado();
                    $folioos=$tienda->regresaFolioOs();
                    $etapa=$tienda->regresaEtapa();
                    $listops=$tienda->regresaListoPs();
                    $fechacomerc=$tienda->regresaFechaComercial();
                    $idvent=$tienda->regresaIdVenta();
                    /*----------------------------------*/
                    ?>
                    <div style="background-color:white;">
                            <?php 
                            $vendedor = new Usuario();
                            $vendedor->obtenerUsuarioBD($idvende,$con);
                            $nomv=$vendedor->regresaNombre();
                            $apv=$vendedor->regresaApaterno();
                            $amv=$vendedor->regresaAmaterno();
                            echo "<B>VENDEDOR: </B>".$nomv." ".$apv." ".$amv;
                            ?>
                        </div>
                    <div class="panel panel-info col-md-3">
                        <div class="panel-heading">Datos de Venta</div>
                        <div class="panel-body">
                        <label><?php echo $vendedorV;?></label>
                        <table class="table">
                            <tr>
                                <th>No. de Solicitud</th>
                                <th><?php echo $folio;?></th>
                            </tr>
                            <tr>
                                <th>Terminal:</th>
                                <th><?php echo $terminal;?></th>
                            </tr>
                            <tr>
                                <th>Cliente</th>
                                <th style="font-size:10px;"><?php echo $cn." ".$apc." ".$ampc;?></th>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <th style="font-size:10px;"><?php echo $dir;?></th>
                            </tr>
                            <tr>
                                <th>Datos</th>
                                <th style="font-size:10px;"><?php echo $datos;?></th>
                            </tr>
                            <tr>
                                <th>Teléfonos</th>
                            </tr>
                            <tr>
                                <th><?php echo $tel1;?></th>
                                <th><?php echo $tel2;?></th>
                                <th><?php echo $tel3;?></th>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="panel panel-info col-md-3">
                        <div class="panel-heading">Datos Fase 2</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Fecha de Registro F2</th>
                                    <th><?php echo $fechaFilder;?></th>
                                </tr>
                                <tr>
                                    <th>Contesto <?php echo $contesto;?></th>
                                    <th>Cliente <?php echo $clientef;?></th>
                                </tr>
                                <tr>
                                    <th>Paquete <?php echo $paquetef;?></th>
                                    <th>Servicio <?php echo $serviciof;?></th>
                                </tr>
                                <tr>
                                    <th>Atiende</th>
                                    <th style="font-size:10px;"><?php echo $atiendef;?></th>
                                </tr>
                                <tr>
                                    <th style="font-size:11px;">Dirección <?php echo $dirf;?></th>
                                    <th style="font-size:11px;">Colonia <?php echo $coloniaf;?></th>
                                </tr>
                                <tr>
                                    <th style="font-size:11px;">Municipio <?php echo $municipiof;?></th>
                                    <th style="font-size:11px;">CP <?php echo $cpf;?></th>
                                </tr>
                                <tr>
                                    <th>Gastos Instalación</th>
                                    <th style="font-size:10px;"><?php echo $instf;?></th>
                                </tr>
                                <tr>
                                    <th>Tiempo de Instalación</th>
                                    <th style="font-size:10px;"><?php echo $tiempoins;?></th>
                                </tr>
                                <tr>
                                    <th>Observaciónes</th>
                                    <th style="font-size:10px;"><?php echo $obs;?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-info col-md-3">
                        <div class="panel-heading">FOLIO SIAC</div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <th style="font-size:10px;">Fecha de Registro de Folio SIAC</th>
                                    <th><?php echo $fechaSiac;?></th>
                                </tr>
                                <tr>
                                    <th style="font-size:10px;">Folio SIAC</th>
                                    <th><?php echo $folios;?></th>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-heading">DATOS TIENDA</div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <th>Fecha Registro</th>
                                    <td><?php echo $fechacomerc;?></td>
                                </tr>
                                <tr>
                                    <th>Tienda Comercial</th>
                                    <td><?php echo $tiendacom;?></td>
                                </tr>
                                <tr>
                                    <th>Teléfono Asignado</th>
                                    <td><?php echo $telasig;?></td>
                                </tr>
                                <tr>
                                    <th>Folio Os</th>
                                    <td><?php echo $folioos;?></td>
                                </tr>
                                <tr>
                                    <th>Etapa</th>
                                    <td><?php echo $etapa;?></td>
                                </tr>

                            </table>
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
