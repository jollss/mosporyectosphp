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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/slider.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>
        
<?php
    ventasS($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <!--<div class="col-md-6">
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            echo "<b><br> Datos de: ".$nus." ".$apus." ".$amus."</b>";
            ?>
            <div align="center">
                <div id="graph3" class="responsive" style="min-width: 100%; height: 100%;margin: 0 auto"></div>
            </div>
            </div>
        </div>
    </div>-->
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">TOTAL DE VENTAS</div>
            <div class="panel-body" >
            <?php
            //echo $idus;
            $venta=new Ventas();
            $totales=$venta->totalVentasFull($con);
            //echo $totales;
            ?>
                <!--<form action="" method="POST">-->
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
                <!--</form>-->
            </div>
        </div>
    </div>
</div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
<!--
<script type="text/javascript">
    Highcharts.chart('graph3', {
    chart: {
        plotBackgroundColor: 'white',
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: '<br>',
        align: 'center',
        verticalAlign: 'middle',
        y: 40,
        color:'white'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'black'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Ordenes de Servicio',
        innerSize: '65%',
        data: [
        <?php
            $con->real_query("SELECT * FROM usuario WHERE idu='$idus' ORDER BY idu");
            $result = $con->use_result();
            $ordenes=0;
            while ($line = $result->fetch_assoc()){
                $cCO=0;
                $cFO=0;
                $cHI=0;
                $cVO=0;
                $cTE=0;
                $cPCR=0;
                $contador=0;
                $con3->real_query("SELECT * FROM  cantidades
                                WHERE usuario_idu='$idus' ");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    //echo "data: [".$ls['usuario_idu'].",]";
                    $contador=$contador+1;
                    $cCO= $ls['cobre'];
                    $cFO= $ls['fibra'];
                    $cHI= $ls['hibrida'];
                    $cVO= $ls['voz'];
                    $cTE= $ls['tecnica'];
                    $cPCR= $ls['psr'];
                }
                echo"[";
                echo "'COBRE',".$cCO;
                echo"],";
                echo"[";
                echo "'FIBRA OPTICA',".$cFO;
                echo"],";
                echo"[";
                echo "'HIBRIDO',".$cHI;
                echo"],";
                echo"[";
                echo "'TECNICA',".$cTE;
                echo"],";
                echo"[";
                echo "'VOZ',".$cVO;
                echo"],";
                echo"[";
                echo "'PSR',".$cPCR;
                echo"],";
                /*
                $contador=0;
                $con3->real_query("SELECT * FROM os WHERE usuario_idu='$idus' AND mm='$mes' ORDER BY dd");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    //echo "data: [".$ls['usuario_idu'].",]";
                    $contador=$contador+1;
                }
                echo"[";
                echo "'ABIERTO',".$contador;
                echo"],";*/
             }
             ?>
        ]
    }]
});
</script>-->
</body>
</html>