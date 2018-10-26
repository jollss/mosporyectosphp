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
/*TIPO*/
if(!isset($_POST['tipo'])){ $tipoGet=$_GET['tipo'];}
if(!isset($_GET['tipo'])){ $tipoGet=$_POST['tipo'];}
/*========================================*/
/*SUPERVISOR*/
if(!isset($_POST['ident'])){ $ident=$_GET['ident'];}
if(!isset($_GET['ident'])){ $ident=$_POST['ident'];}
/*========================================*/
/*VENDEDOR*/
if(!isset($_GET['idpersona'])){ $idpersona=$_POST['ident'];}
if(isset($_GET['idpersona'])) { $idpersona=$_GET['idpersona'];}
/*========================================*/
$usuarioN=new Usuario();
$usuarioN->obtenerUsuarioBD($ident,$con);
$totalUser=$usuarioN->TotalUBD($con);
/*========================================*/
function ejecutar($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
}
/*========================================*/
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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <!--<h1 class="page-header">INICIO</h1>-->
                <div class="panel-heading">
                <?php
                $sql="SELECT * FROM usuario WHERE activo=1 AND idu='$idpersona'";
                $resultado=$con->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    echo "<h2>Ventas de:".$row['nombre']." ".$row['apaterno']." ".$row['amaterno']."</h2>";
                }
                ?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
<!-- ........ Your content goes here ................................................. -->
            <div class="col-md-3">
                <div class="panel panel-info">
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana = date("W");
                    ?>
                    <div class="panel-heading">
                        <!--<a href="inde.php">
                        <img src="../syspic/back.png" width="30" height="30"></a>-->
                        <?php 
                        echo "
                        <form action='inde.php' method='GET'>
                                <input type='text' name='tipoGet' value='".$tipoGet."' style='display:none;' readonly>
                                <input type='image' src='../syspic/back.png' width='30' height='30'>
                        </form>
                        ";
                        echo $dia."/".$mes."/".$aaaa;?>
                    </div>
                    <div class="panel-body" style="background-color:gray;">
                        <div align="center" style="font-size:12px !important;">
                            <div id="" >
                                <div class="table-responsive" style="height:200px;ovrflow-y:scroll;">
                                    <table class="table" style="background-color:white;">
                                        <tr>
                                            <td>ID</td>
                                            <td>NOMBRE</td>
                                        </tr>
                                        <?php
                                        for ($i=0; $i <= $totalUser; $i++) { 
                                            $acargo=new Usuario();
                                            $acargo->obtenerUsuarioBD($i,$con);
                                            $asignado=$acargo->regresaAsignado();
                                            $idu=$acargo->regresaIdu();
                                            $nom=$acargo->regresaNombre();
                                            $app=$acargo->regresaApaterno();
                                            $apm=$acargo->regresaAmaterno();
                                            $celu=$acargo->regresaCel();
                                            if($asignado==$ident){
                                                $idu=$acargo->regresaIdu();
                                                $nom=$acargo->regresaNombre();
                                                $app=$acargo->regresaApaterno();
                                                $apm=$acargo->regresaAmaterno();
                                                $celu=$acargo->regresaCel();
                                                echo "
                                                <form action='infoData.php' method='GET'>
                                                    <tr>
                                                        <input type='text' name='ident' value='".$ident."' style='display:none;' readonly>
                                                        <input type='text' name='tipo' value='".$tipoGet."' style='display:none;' readonly>
                                                        <td><input class='btn btn-info' type='submit' name='idpersona' value='".$idu."'></td>
                                                        <td>".$nom." ".$app." ".$apm."</td>
                                                    </tr>
                                                </form>
                                                ";
                                            }else{}
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info">
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana = date("W");
                    ?>
                    <div class="panel-heading">
                        Equipo
                    </div>
                    <div class="panel-body" style="background-color:gray;">
                        <div align="center" style="font-size:12px !important;">
                            <div id="" >
                                <div class="table-responsive" style="height:250px;ovrflow-y:scroll;">
                                    <table class="table" style="background-color:white;">
                                        <tr>
                                            <td>ID</td>
                                            <td>NOMBRE</td>
                                        </tr>
                                        <?php
                                        for ($i=0; $i <= $totalUser; $i++) { 
                                            $acargo=new Usuario();
                                            $acargo->obtenerUsuarioBD($i,$con);
                                            $asignado=$acargo->regresaAsignado();
                                            $idu=$acargo->regresaIdu();
                                            $nom=$acargo->regresaNombre();
                                            $app=$acargo->regresaApaterno();
                                            $apm=$acargo->regresaAmaterno();
                                            $celu=$acargo->regresaCel();
                                            if($asignado==$idpersona and $asignado<>0){
                                                $idu=$acargo->regresaIdu();
                                                $nom=$acargo->regresaNombre();
                                                $app=$acargo->regresaApaterno();
                                                $apm=$acargo->regresaAmaterno();
                                                $celu=$acargo->regresaCel();
                                                echo "
                                                <form action='infoData.php' method='GET'>
                                                    <tr>
                                                        <input type='text' name='ident' value='".$ident."' style='display:none;' readonly>
                                                        <input type='text' name='tipo' value='".$tipoGet."' style='display:none;' readonly>
                                                        <td><input class='btn btn-warning' type='submit' name='idpersona' value='".$idu."'></td>
                                                        <td>".$nom." ".$app." ".$apm."</td>
                                                    </tr>
                                                </form>
                                                ";
                                            }else{}
                                            
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="container"></div>
            </div>
            <div class="col-md-12">
                <div id="" class="table-responsive" style="height:300px;ovrflow-y:scroll;">
                    <table class="table">
                        <tr>
                            <th>FOLIO VENTA</th>
                            <th>CLIENTE</th>
                            <th>DIRECCION</th>
                            <th>TERMINAL</th>
                            <th>TELEFONO 1</th>
                        </tr>
                        <?php
                        $ventasU=new Ventas();
                        $totales=$ventasU->totalVentasFull($con);
                        for ($i=0; $i < $totales; $i++){ 
                            $ventasU->obtenerVentaBD($i,$con);
                            $idvendedor=$ventasU->regresaVendedor();
                            $nomC=$ventasU->regresaNombre();
                            $apC=$ventasU->regresaApaterno();
                            $amC=$ventasU->regresaAmaterno();
                            $nombreCliente=$nomC." ".$apC." ".$amC;
                            $folioV=$ventasU->regresaFolioVenta();
                            $dir=$ventasU->regresaDireccion();
                            $termi=$ventasU->regresaTerminal();
                            $tel1=$ventasU->regresaTel1();
                            if($idvendedor==$idpersona and $idvendedor<>0){
                                ?>
                                <tr>
                                    <td><?php echo $folioV;?></td>
                                    <td><?php echo $nombreCliente;?></td>
                                    <td><?php echo $dir;?></td>
                                    <td><?php echo $termi;?></td>
                                    <td><?php echo $tel1;?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            
<!--=====================================================================================-->                
        </div>   
    </div>
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
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'PRODUCTIVIDAD'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Registros',
        colorByPoint: true,
        data: [
            <?php  
            $aux2=0;
            $aux=0;
            $aux3=0;
            $aux4=0;
            $sql1="SELECT * from ventas inner join tienda_comercial where idventa=id_venta and etapa='PS' AND idvendedor='$idpersona'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $aux2=$aux2+1;
            }
            $sql1="SELECT * from ventas inner join tienda_comercial where idventa=id_venta and etapa='ABIERTA' AND idvendedor='$idpersona'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $aux3=$aux3+1;
            }
            $sql1="SELECT * from ventas inner join tienda_comercial where idventa=id_venta and etapa='CANCELADA' AND idvendedor='$idpersona'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $aux4=$aux4+1;
            }
            $sql1="SELECT * from ventas inner join tienda_comercial where idventa=id_venta and etapa='POSTEADA' and idvendedor='$idpersona'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $aux=$aux+1;
            }
            echo "
                {
                    name: 'PS',
                    y: ".$aux2."
                },";
            echo "
                {
                    name: 'POSTEADA',
                    y: ".$aux."
                },";
            echo "
                {
                    name: 'ABIERTA',
                    y: ".$aux3."
                },";
            echo "
                {
                    name: 'CANCELADA',
                    y: ".$aux4."
                },";
            ?>
        ]
    }]
});
</script>
</body>
</html>