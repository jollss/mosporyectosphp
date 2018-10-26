<?php
include("../Config/library.php");
require_once("upload.php");
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
   nivel3($user);
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
                <div class="col-md-12"></div>
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <?php 
                                $fase6 = new Fase6();
                                $fase6->obtenerFase6BD($idventa,$con);
                                $fechaFase6=$fase6->regresaFechaFase6();
                                echo $dia."/".$mes."/".$aaaa;
                                echo "<br><b>FASE 6</b>";
                                echo "<br>Ultima Modificacion: ".$fechaFase6;
                            ?>
                        </div>
                        <div class="panel-body">
                            <!--<form action="fase6.php" method="POST" enctype="multipart/form-data">-->
                            <form action="addROsV.php" method="POST" enctype="multipart/form-data">
                            <!--
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">FILIAL ASIGNADA: </span>
                                    <input class="form-control" aria-describedby="sizing-addon4" type="text" value="" name="filial_asignada"  required> 
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="sizing-addon3">NOMBRE AUXILIAR O PROPORCIONA INF: </span>

                                    <input class="form-control" aria-describedby="sizing-addon4" type="text"value="" name="nom_auxiliar"  required>                       
                                </div>
                                <div class="form-group">
                                  <label for="sel1">Tecnicos:</label>
                                  <select class="form-control" id="sel1" name="user">
                                      <?php
                                      $Yo = new Usuario();
                                      $Yo->obtenerUsuarioCorreoBD($mail,$con);
                                      $iduser=$Yo->regresaIdu();
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
                                        }else{
                                          //echo "<option value='".$idus."''>NADA</option>";
                                        }
                                      }
                                      ?>                      
                                  </select>

                                  <label for="photo">Adjuntar PDF</label>
                                    <input type="number" name="ident" value="<?php echo $idventa;?>" style="display:none;">
                                    <input accept=".pdf" name="userfile[]" type="file" style="" id="photo" /><br>
                                    
                                </div>
                                -->
                                <input type="text" value="<?php echo $idventa;?>" name="ident" style="display:none;">
                                <div align="center"><input type="submit" value="REGISTRAR OS" id="envia" name="envia" class="btn btn-primary"/></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
                            if ($tecnicoId=='') {
                                $nomT='';
                                $apT='';
                                $amT='';
                            }
                            //echo $tecnicoId;
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
                            <?php
                            $fase7=new Fase7();
                            $fase7->obtenerfase7BD($idventa,$con);
                            $idVentaF=$fase7->regresaIdVenta();
                            $statusV=$fase7->regresaEstatus();
                            if ($filial=='' or $auxiliar=='' or $nomT=='') {
                            }else{
                                if($statusV=='POSIBLE OBJECION' and $idVentaF==$idventa or $filial!='')
                                {
                                    if($statusV=='OBJETAR' or $statusV=='POSIBLE OBJECION' OR $statusV==''){
                                        ?>
                                            <label>Datos registrados <?php echo $statusV;?></label>
                                            <div class="panel panel-success">
                                            <div class="panel-heading">FASE 7</div>
                                                <form action="fase7.php" method="POST">
                                                <input type="number" name="ident" value="<?php echo $idventa;?>" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="sel1">Estatus:</label>
                                                        <select class="form-control" id="sel1" name="estatus">
                                                            <option value="LIQUIDADA">LIQUIDAR</option>
                                                            <option value="POSIBLE OBJECION">POSIBLE OBJECION</option>
                                                        </select>
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
                                }if($statusV=='LIQUIDADA' or $filial!='')
                                {
                                    ?>
                                    <label>Datos registrados <?php echo $statusV;?></label>
                                    <?php
                                }
                            }
                            ?>
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