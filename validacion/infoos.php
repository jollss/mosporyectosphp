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
                <h3 class="page-header">Validar Información</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    
    <div class="col-md-12">
        <div class="panel panel-info">
            <?php
            $sql2="SELECT * FROM venta WHERE idventa='$idventa' AND estatus=0";
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
                $rfc=$row2['rfc_cliente'];
                $correo=$row2['correo_cliente'];
                $d=$row2['dia'];
                $m=$row2['mes'];
                $y=$row2['year'];
                $h=$row2['hora'];
                $terminal=$row2['terminal'];
                $area=$row2['area'];
                $distrito=$row2['distrito'];
                $vendedorV=$row2['vendedor'];
                $paquete_venta=$row2['paquete_venta'];
                $docum=$row2['documentacion'];
                $fecha=$d."/".$m."/".$y." ".$h;
                //$fecha=$row2[regresaFecha();
                $estatus=$row2['estatus'];
            }   
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $semana = date("W");
            ?>
            <div class="col-md-6" style="height:100px;overflow-x:scroll;">
                <table>
                <tr>
                <?php
                
                $con1 = Conectarse();
                $sql="SELECT * FROM adjunto_venta WHERE folio_venta='$folio_ventas'";
                $resultado=$con1->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    $nomImg=$row['imagen_n'];
                    ?>
                    <td>
                    <a href="../adjVentas/<?php echo $nomImg;?>" target="_blank">
                    <img src="../adjVentas/<?php echo $nomImg;?>" height="50" width="50">
                    </a>
                    </td>
                    <?php
                }
                ?>
                </tr>
                </table>
            </div>
            <div class="col-md-6">
                <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $folio_ventas;?>" name="solicitud">
                    <input type="hidden" value="<?php echo $idventa;?>" name="venta">
                    <input type="hidden" value="SI" name="validar">
                    <span class="input-group-addon" id="sizing-addon2">
                    <label>Subir Archivo</label>
                    <input type="file" name="userfile[]" required>
                    <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
                    </span>
                </form>
            </div>
            <div class="panel-heading">
                <?php 
                    echo $dia."/".$mes."/".$aaaa;
                    echo "<br><b>FASE 2</b>";
                ?>
            </div>
            <div class="panel-body">  
            <div class="col-md-12">
            <form action="modVenta.php" method="POST">
            <input type="" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                <!--<div class="well col-md-6">-->
                <label><?php //echo $vendedorV;?></label>
                    <!--<div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">PAQUETE: <?php echo $paquete_venta
                        ;?></span>
                    </div>-->
                    <div class="input-group">
                          <span class="input-group-addon" id="sizing-addon2">Paquete:</span>
                          <!--input type="text" name="terminal" minlength="9" maxlength="10" class="form-control" value="" aria-describedby="sizing-addon2" required>-->
                          <select class="form-control" name="paquete_venta">
                               <option value="<?php echo $paquete_venta;?>" selected><?php echo $paquete_venta;?></option>
                              <option value="RESIDENCIAL $333">RESIDENCIAL $333</option>
                              <option value="RESIDENCIAL $389">RESIDENCIAL $389</option>
                              <option value="RESIDENCIAL FRONTERA $389">RESIDENCIAL FRONTERA $389</option>
                              <option value="RESIDENCIAL $599">RESIDENCIAL $599</option>
                              <option value="RESIDENCIAL $999">RESIDENCIAL $999</option>
                              <option value="RESIDENCIAL PURO 10MB $349">RESIDENCIAL PURO 10MB $349</option>
                              <option value="RESIDENCIAL PURO 20MB $499">RESIDENCIAL PURO 20MB $499</option>
                              <option value="RESIDENCIAL PURO 50MB $649">RESIDENCIAL PURO 50MB $649</option>
                              <option value="RESIDENCIAL PURO 100MB $899">RESIDENCIAL PURO 100MB $899</option>
                              <option value="COMERCIAL $399">COMERCIAL $399</option>
                              <option value="COMERCIAL $549">COMERCIAL $549</option>
                              <option value="COMERCIAL $799">COMERCIAL $799</option>
                              <option value="COMERCIAL $1499">COMERCIAL $1499</option>
                              <option value="COMERCIAL $1789">COMERCIAL $1789</option>
                              <option value="COMERCIAL $2289">COMERCIAL $2289</option>
                              <option value="COMERCIAL $404.84">COMERCIAL $404.84</option>
                              <option value="COMERCIAL RED $706.08">COMERCIAL RED $706.08</option>
                              <option value="COMERCIAL PREMIUM $1209.42">COMERCIAL PREMIUM $1209.42</option>
                              <option value="COMERCIAL (Sin Internet) $899">COMERCIAL (Sin Internet) $899</option>
                          </select>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">No. de Solicitud: <?php //echo $folio_ventas;?></span>
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $folio_ventas;?>" name="folio_ventas"  required> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">RFC: <?php// echo $nombre;?></span>
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $rfc;?>" name="nombre"  required> 
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
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $terminal;?>" name="terminal"> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Area: </span>
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $area;?>" name="area"> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Distrito: </span>
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $distrito;?>" name="distrito"> 
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
                        <span class="input-group-addon" id="sizing-addon3">Correo: <?php// echo $nombre;?></span>
                        <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $correo;?>" name="correo"  required> 
                    </div>
                <!--</div>
                <div class="well col-md-6">-->
                    
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
                <!--</div>-->
            </form>
            </div>
            <form action="regDetalles.php" method="POST"  name="formulario">
                <input type="" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                <div class="input-group input-group-sm">
                <span class="input-group-addon" id="sizing-addon3">Contesto:</span>
                    <select class="form-control" id="sel1" name="contesto" onChange="pagoOnChange(this)">
                        <option value='SI'>SI</option>
                        <option value='NO'>NO</option>
                    </select>
                </div>
                <div id="nCuenta" style="display:none;">
                       Los campos se llenaran en automaticamente con valores en cero (0).
                  </div>
                <div id="nTargeta" style="display:;">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Nombre:</span>
                        <select class="form-control" id="sel1" name="nomcliente" >
                            <option value='SI'>SI</option>
                            <option value='NO'>NO</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">¿Quien atiende?(Nombre)</span>
                        <input class="form-control" aria-describedby="sizing-addon4" name="nomatiende" value="0" id="vr_negativo" required> 
                    </div>
                    <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">Desea el servicio?</span>
                        <select class="form-control" id="sel1" name="servicio" >
                            <option value='SI'>SI</option>
                            <option value='NO'>NO</option>
                        </select>
                    <!--</div> 
                    <div class="input-group input-group-sm">-->
                        <span class="input-group-addon" id="sizing-addon3">Informacion de Paquete</span>
                        <!--<input class="form-control" aria-describedby="sizing-addon4" name="paquete"  required> -->
                        <select class="form-control" id="sel1" name="paquete">
                            <option value='SI'>SI</option>
                            <option value='NO'>NO</option>
                        </select>
                    
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Dirección Calle y Número</span>
                        <input class="form-control" aria-describedby="sizing-addon4" name="calle_num" value="0" required> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Colonia</span>
                        <input class="form-control" aria-describedby="sizing-addon4" name="colonia" value="0" required> 
                    <!--</div>
                    <div class="input-group input-group-sm">-->
                        <span class="input-group-addon" id="sizing-addon3">Municipio</span>
                        <input class="form-control" aria-describedby="sizing-addon4" name="municipio" value="0" required> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">CP</span>
                        <input class="form-control" aria-describedby="sizing-addon4" name="CP" value="0" type="number" required> 
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Gastos de Instalación</span>
                        <!--<input class="form-control" aria-describedby="sizing-addon4" name="gastos_inst"  required> -->
                        <select class="form-control" id="sel1" name="gastos_inst">
                            <option value='1 MES'>1 MES</option>
                            <option value='3 MES'>3 MES</option>
                            <option value='6 MES'>6 MES</option>
                            <option value='9 MES'>9 MES</option>
                            <option value='12 MES'>12 MES</option>
                            <option value='15 MES'>15 MES</option>
                            <option value='18 MESES'>18 MESES</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3">Tiempo aproximado de instalación</span>
                        <input class="form-control" type="text" aria-describedby="sizing-addon4" name="aprox" value="0" required> 
                    </div>
                    <textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;" required> 0 </textarea>
                </div>
                <div align="center"><input type="submit" value="REGISTRAR" id="envia" name="envia" class="btn btn-primary"/></div>
            </form>
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
