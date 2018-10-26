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
/*========================================*/
$idF=$_POST['iduser'];
$vend=new Usuario();
$vend->obtenerUsuarioBD($idF,$con);
$tipo=$vend->regresaTipoIdTipo();
$nomV=$vend->regresaNombre();
$apV=$vend->regresaApaterno();
$amV=$vend->regresaAmaterno();
$Tventa=new Ventas();
$totalV=$Tventa->totalVentasFull($con);
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
    nivel5($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <br><br>
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
                <label> 
                <a href="fielderPersonal.php"><img src="../syspic/back.png" width="30" height="30"></a>
                </label>
                <tr><h2>Área Fielders</h2><label><?php echo $nomV." ".$apV." ".$amV;?></label></tr>
            </div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div class="col-md-12" style="background-color:white;">
                    <div id="container2">
                        <table class="table">
                        <tr style="color:red;">
                            <th>CLIENTE</th>
                            <th>FECHA DE VENTA</th>
                            <th>DIRECCION</th>
                            <th>TELÉFONO</th>
                            <?php if($tipo==4){ ?>
                            <th>NOMBRE DE VENDEDOR</th>
                            <?php } ?>
                        </tr>
                        <?php
                        //for ($i=0; $i <= $totalV; $i++) { 
                        for ($i=$totalV; $i >= 0; $i--) { 
                            $venta=new Ventas();
                            $venta->obtenerVentaBD($i,$con);
                            $vendedor=$venta->regresaVendedor();
                            $ncliente=$venta->regresaNombre();
                            $apcliente=$venta->regresaApaterno();
                            $amcliente=$venta->regresaAmaterno();
                            $fd=$venta->regresaDia();
                            $fm=$venta->regresaMes();
                            $fy=$venta->regresaYear();
                            $fh=$venta->regresaHora();
                            $fecha=$fd."/".$fm."/".$fy." ".$fh;
                            $dir=$venta->regresaDireccion();
                            $tel1=$venta->regresaTel1();
                            $nLupita=$venta->regresaVendedorN();
                            if($vendedor==$idF){
                                ?>
                                <tr>
                                    <th><?php echo $ncliente." ".$apcliente." ".$amcliente;?></th>
                                    <th><?php echo $fecha;?></th>
                                    <th><?php echo $dir;?></th>
                                    <th><?php echo $tel1;?></th>
                                    <?php if($tipo==4){ ?>
                                    <th><?php echo $nLupita;?></th>
                                    <?php } ?>
                                </tr>
                                <?php
                            }
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