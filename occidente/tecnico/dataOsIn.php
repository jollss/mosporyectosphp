<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
$name=$Yo->regresaNombre();
$ap=$Yo->regresaApaterno();
$am=$Yo->regresaAmaterno();
$tos=0;
$tecnicOs=new Os();
//$totalos=$tecnicOs->totalesOs($con);
$fase6=new Fase6();
$totalos=$fase6->ultimaFse6($con);
for ($i=0; $i <$totalos; $i++) { 
    $fase6->obtenerFase6INBD($i,$con);
    $asignado=$fase6->regresaIdTecnico();
    $fechaAsig=$fase6->regresaFechaFase6();
    if($asignado==$idus){
        $tos++;
    }
}
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
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Faltantes <b><?php echo $name." ".$ap." ".$am; ?><h3><?php echo $tos; ?></b></h3></div>
            <div class="panel-body">
            <div align="center">
            </div>
                <form action="datosV.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                              <th>ID</th>
                              <th>FOLIO</th>
                              <th>Folio Siac</th>
                              <th>Fecha de Asignacion</th>
                              <th>Filial</th>
                              <th>Auxiliar</th>
                            </tr>
                            <?php 
                            $totalfase6=$fase6->ultimaFse6($con);
                            for ($i=0; $i <= $totalfase6; $i++) { 
                                $faseN=new Fase6();
                                $faseN->obtenerFase6INBD($i,$con);
                                $asignado=$faseN->regresaIdTecnico();
                                if($asignado==$idus){
                                    $id=$faseN->regresaIdFse6();
                                    $filialas=$faseN->regresaFilialAsignada();
                                    $auxiliarV=$faseN->regresaNombreAuxiliar();
                                    $fechaAsig=$faseN->regresaFechaFase6();
                                    $idventa=$faseN->regresaIdVenta();
                                    $datosC=new Filder();
                                    $datosC->obtenerFilderVBD($idventa,$con);
                                    $idfilder=$datosC-> regresaIdFilder();
                                    $siacF=new Foliosiac();
                                    $siacF->obtenerSiacBD($idfilder,$con);
                                    $siac=$siacF->regresaFolioSiac();
                                    $fechaR=$siacF->regresaFechaSiac();
                                    $venta=new Ventas();
                                    $venta->obtenerVentaBD($idventa,$con);
                                    $idventa=$venta->regresaIdVenta();
                                    $folio_ventas=$venta->regresaFolioVenta();
                                    ?>
                                    <tr>
                                        <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idventa?>"></th>
                                        <th><?php echo $folio_ventas;?></th>
                                        <th><?php echo $siac;?></th>
                                        <th><?php echo $fechaAsig;?></th>
                                        <th><?php echo $filialas;?></th>
                                        <th><?php echo $auxiliarV;?></th>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>