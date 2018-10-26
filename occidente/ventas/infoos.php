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

$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
$tos=0;
$idus=$_POST['ident'];
$con2->real_query("SELECT * FROM usuario WHERE idu='$idus'");
    $resultado = $con2->use_result();
    while ($row = $resultado->fetch_assoc()){
        $tos++;
        $nus=$row['nombre'];
        $apus=$row['apaterno'];
        $amus=$row['amaterno'];
    }
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
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php ventasS($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Ventas de: <?php echo $nus." ".$apus." ".$amus;?></h4>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">TOTAL DE VENTAS</div>
            <div class="panel-body" >
            <?php
            $venta=new Ventas();
            $totales=$venta->totalVentasFull($con);
            ?>
                    <div class="table-responsive"><!-- style="max-height:450px;">-->
                        <table class="table table-bordered" style="background-color:white;">
                            <tr>
                              <th></th>
                              <th>ID VENTA</th>
                              <th>CLIENTE</th>
                              <th>FOLIO</th>
                              <th>DIRECCION</th>
                              <th>FECHA</th>
                              <th>TELEFONO 1</th>
                              <th>ETAPA</th>
                            </tr>
                            <?php
                            $aux=0;
                            for ($i=0; $i < $totales; $i++) { 
                                $venta->obtenerVentaBD($i,$con);
                                $id=$venta->regresaIdVenta();
                                $idvendedor=$venta->regresaVendedor();
                                $folioV=$venta->regresaFolioVenta();
                                $name=$venta->regresaNombre();
                                $app=$venta->regresaApaterno();
                                $apm=$venta->regresaAmaterno();
                                $tel1=$venta->regresaTel1();
                                $dir=$venta->regresaDireccion();
                                $dia=$venta->regresaDia();
                                $mes=$venta->regresaMes();
                                $year=$venta->regresaYear();
                                $hora=$venta->regresaHora();
                                $fecha=$dia."/".$mes."/".$year." ".$hora;
                                $etapa=new TiendaComercial();
                                $etapa->obtenerTiendaBD($id,$con);
                                $etapaPs=$etapa->regresaEtapa();
                                if ($idvendedor==$idus) {
                                $aux=$aux+1;
                                $usuariov=new Usuario();
                                $usuariov->obtenerUsuarioBD($idvendedor,$con);
                                $nombres=$usuariov->regresaNombre();
                                $ap=$usuariov->regresaApaterno();
                                $am=$usuariov->regresaAmaterno();
                                ?>
                                <tr style="background-color:orange;">
                                    <th>
                                      <form action="dataVenta.php" method="POST">
                                          <input class="btn btn-info" type="submit" value="<?php echo $id;?>" name="ident" >
                                      </form>
                                    </th>
                                    <th><?php echo $aux;?></th> 
                                    <th style="font-size:12px !important;"><?php echo $name." ".$app." ".$apm;?></th>
                                    <th><?php echo $folioV;?></th>
                                    <th style="font-size:10px;"><?php echo $dir;?></th>
                                    <th style="font-size:10px !important;"><?php echo $fecha;?></th>
                                    <th><a href="tel:<?php echo $tel1;?>"><?php echo $tel1;?></a></th>
                                    <th><?php echo $etapaPs;?></th>
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
