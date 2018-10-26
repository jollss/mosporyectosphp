<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browserVentaC.js"></script>
        
<?php
    cbajantes($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div align="center">
    <br><br>
    <form accept-charset="utf-8" method="POST">
    <div class="form-group">
        <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="INGRESA FOLIO DE VENTAS O NOMBRE DE CLIENTE" id="bus">
    </div>
    </form>
     <div id="resultadoBusqueda"></div>
    </div>
</div>
    <div class="col-md-12">
    <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?> 
            </div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
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
                                            if($contesto=='SI' && $fsiac==$idfilder)
                                            {
                                                $tienda= new TiendaComercial();
                                                $tienda->obtenerTiendaBD($idfilder,$con);
                                                $etapa=$tienda->regresaEtapa();
                                                $idtienda=$tienda->regresaIdVenta();
                                                //echo $idtienda."<br>";
                                                //echo $idtienda;
                                                //if($idtienda!=''){
                                                if($etapa=='PS' OR $etapa=='ps'){
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
                                                    $d=$venta->regresaDia();
                                                    $m=$venta->regresaMes();
                                                    $ye=$venta->regresaYear();
                                                    $hr=$venta->regresaHora();
                                                    $fecha=$d."/".$m."/".$ye." ".$hr;
                                                    $estatus=$venta->regresaEstatus();
                                                        if($aux2==0){
                                                        ?>
                                                        <form action=" step3.php" method="POST">
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
                                                                <th><?php echo $etapa;?></th> 
                                                            </tr>
                                                        </form>
                                                        <?php
                                                        }if($aux2==1){
                                                            ?>
                                                            <form action=" step3.php" method="POST">
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
                                                            </form>
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
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-12"></div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>