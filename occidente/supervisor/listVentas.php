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
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
/*========================================*/
$cantidad_resultados_por_pagina = 8;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: inde.php");
                 die();
             } else { //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
                 $pagina = $_GET["pagina"];
            };
         } else { //Si la string no es numérica, redirige al index (por ejemplo: index.php?pagina=AAA)
             header("Location: inde.php");
            die();
         };
    };

} else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al index.php o lo que sea)
    $pagina = 1;
};
$total_registros=0;
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
    $ventas=new Ventas();
    $totalAux=$ventas->totalVentas($con);
    //$tU->regresaTipoIdTipo();
    for ($i=0; $i <= $totalAux; $i++) { 
        /*$usuarioU=new Usuario();
        $usuarioU->obtenerUsuarioBD($i,$con);
        $tipo=$usuarioU->regresaTipoIdTipo();
        $activo=$usuarioU->regresaActivo();
        if($activo==1 && $tipo==1){
            $total_registros++;
        }*/
    }
    $total_registros=$totalAux;
echo $total_registros;
$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
/*========================================*/
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
        
<?php
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
    <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
            <nav aria-label="Page navigation">
              <ul class="pagination">
              <!--
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php }; ?>
                -->
                </li>
              </ul>
            </nav>
                <div id="resultadoBusqueda">
                <form action="datosV.php" method="POST">
                        <div class="table-responsive" >
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                  <th>Folio</th>
                                  <th>ID</th>
                                  <th>VENDEDOR</th>
                                  <th>CLIENTE</th>
                                  <th>DIRECCION</th>
                                  <th>DATOS</th>
                                  <th>FECHA</th>
                                  <th>TELEFONO</th>
                                </tr>
                                 <?php
                                 $ventas=new Ventas();
                                 $totalU=$ventas->totalVentasFull($con);
                                 $totalU=$totalU-1;
                                    /*
                                    $Total=new Usuario();
                                    $totalU=$Total->TotalUsuariosActivosTBD($con);
                                    */
                                    $aux=0;
                                    $aux2=0;
                                     $paginas=$cantidad_resultados_por_pagina+$empezar_desde;
                                    for ($i=$totalU; $i >= 0; $i--) 
                                    { 
                                        $aux2=$i%2;
                                        $venta=new Ventas();
                                        $venta->obtenerVentaBD($i,$con);
                                        //$activo= $venta->regresaActivo();
                                        $estatus=$venta->regresaEstatus();
                                        //$venta->verVentas();
                                        $idu=$venta->regresaIdVenta();
                                        //$correou=$venta->regresaCorreo();
                                       
                                        if($estatus==1)// && $datosTienda==$idu)
                                        {
                                            $idventa=$venta->regresaIdVenta();

                                            $filder=new Filder();
                                            $filder->obtenerFilderVBD($idventa,$con);
                                            $idfilder=$filder->regresaIdFilder();
                                            $contesto=$filder->regresaContesto();
                                            //echo $idtienda;
                                            $siac=new Foliosiac();
                                            $siac->obtenerSiacBD($idfilder,$con);
                                            $fsiac=$siac->regresaIdFilder();
                                            //echo $idfilder."=".$fsiac."=";
                                            $asignacionS=new AsignacionBajante();
                                            $asignacionS->obtenerAsignacionBD($idventa,$con);
                                            $super=$asignacionS->regresaIdSupervisor();
                                            //echo $super."----".$iduser;
                                            if($contesto=='SI' && $fsiac==$idfilder  && $super==$iduser)
                                            {
                                                $tienda= new TiendaComercial();
                                                $tienda->obtenerTiendaBD($idfilder,$con);
                                                //$tienda->verTienda();
                                                $idtienda=$tienda->regresaIdVenta();
                                                //echo $idtienda."<br>";
                                                //echo $idtienda;
                                                if($idtienda!=''){
                                                    $folio_ventas=$venta->regresaFolioVenta();
                                                    $idvendedor=$venta->regresaVendedor();
                                                    $nombre=$venta->regresaNombre();
                                                    $ap=$venta->regresaApaterno();
                                                    $am=$venta->regresaAmaterno();
                                                    $name=$nombre." ".$ap." ".$am;
                                                    //$venta->verVentas();
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
                                                        if($aux2==0){
                                                        ?>
                                                            <tr>
                                                                <th style="font-size:15px !important;"><?php echo $folio_ventas;?></th>
                                                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idventa;?>"></th>
                                                                <th><?php 
                                                                    $vend=new Usuario();
                                                                    $vend->obtenerUsuarioBD($idvendedor,$con);
                                                                    $nv=$vend->regresaNombre();
                                                                    $apv=$vend->regresaApaterno();
                                                                    $amv=$vend->regresaAmaterno();
                                                                    echo $nv." ".$apv." ".$amv;?>
                                                                </th>      
                                                                <th><?php echo $name;?></th> 
                                                                <th><?php echo $direccion;?></th> 
                                                                <th><?php echo $datos;?></th>
                                                                <th><?php echo $fecha;?></th> 
                                                                <th><?php echo $telefono_1;?></th> 
                                                            </tr>
                                                        <?php
                                                        }if($aux2==1){
                                                            ?>
                                                                <tr style="background-color:orange;">
                                                                    <th style="font-size:15px !important;"><?php echo $folio_ventas;?></th>
                                                                    <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idventa;?>"></th>
                                                                    <th><?php 
                                                                        $vend=new Usuario();
                                                                        $vend->obtenerUsuarioBD($idvendedor,$con);
                                                                        $nv=$vend->regresaNombre();
                                                                        $apv=$vend->regresaApaterno();
                                                                        $amv=$vend->regresaAmaterno();
                                                                        echo $nv." ".$apv." ".$amv;?>
                                                                    </th>                                 
                                                                    <th><?php echo $name;?></th> 
                                                                    <th><?php echo $direccion;?></th> 
                                                                    <th><?php echo $datos;?></th>
                                                                    <th><?php echo $fecha;?></th> 
                                                                    <th><?php echo $telefono_1;?></th> 
                                                                </tr>
                                                            <?php
                                                        }
                                                }
                                            }
                                        }//fin if
                                        /*
                                        else{
                                            echo "Error...";
                                        }*/
                                    }
                                    ?>
                            </table>
                        </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1"></div>
<?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>