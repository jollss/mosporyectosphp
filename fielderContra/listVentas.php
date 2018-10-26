<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
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
    <script type="text/javascript" src="../js/browserVenta.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Lista de Ventas</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div align="center">
    <br><br>
    <label>Busqueda rapida CTRL + F y coloca el dato a buscar</label>
    <!--
    <form accept-charset="utf-8" method="POST">
    <div class="form-group">
        <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="INGRESA NO. DE SOLICITUD O NOMBRE DE CLIENTE" id="bus">
    </div>
    </form>
    -->
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
                        <div class="table-responsive" style="height:500px;overflow-y:scroll;">
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                    <th></th>
                                  <th>Folio Venta</th>
                                  <th>Cliente</th>
                                  <th>Dirección</th>
                                  <th>Teléfono 1</th>
                                  <th>Fecha</th>
                                  <th>Vendedor</th>
                                  <th>ETAPA</th>
                                  <th>Terminal</th>
                                </tr>
                                 <?php
                                $con = Conectarse();
                                //$idu=$_GET['iduser'];
                                $sql="SELECT * FROM venta WHERE idvendedor='$iduser' ORDER BY year DESC, mes DESC, dia DESC, hora DESC";
                                $resultado=$con->query($sql);
                                while($row = $resultado->fetch_assoc())
                                {
                                    $fventa=$row['folio_ventas'];
                                    $nom=$row['nombrev'];
                                    $apa=$row['apaternov'];
                                    $ama=$row['amaternov'];
                                    $dire=$row['direccion'];
                                    $tel1=$row['telefono_1'];
                                    $dd=$row['dia'];
                                    $mm=$row['mes'];
                                    $y=$row['year'];
                                    $hr=$row['hora'];
                                    $cons = Conectarse();
                                    $sqls="SELECT * FROM usuario WHERE idu='$iduser'";
                                    $resultados=$cons->query($sqls);
                                    while($rows = $resultados->fetch_assoc())
                                    {
                                        $nomb=$rows['nombre'];
                                        $apep=$rows['apaterno'];
                                        $amem=$rows['apaterno'];
                                    }
                                    $etapaPs=$row['etapa'];
                                    $trmin=$row['terminal'];
                                    $id=$row['idventa'];
                                    ?>
                                    <tr>
                                    <form method="POST" action="statusEnd.php">
                                    <!--<form method="POST" action="dataVenta.php">-->
                                        <th><input type="submit" name="ident" value="<?php echo $id;?>" class="btn btn-primary"></th>
                                    </form>
                                        <th><?php echo $fventa;?></th>
                                        <th><?php echo $nom." ".$apa." ".$ama;?></th>
                                        <th><?php echo $dire;?></th>
                                        <th><a href="tel:<?php echo $tel1;?>"><?php echo $tel1;?></a></th>
                                        <th><?php echo $dd."/".$mm."/".$y." ".$hr;?></th>
                                        <th><?php echo $nomb." ".$apep." ".$amem;?></th>
                                        <th><?php echo $etapaPs;?></th>
                                        <th><?php echo $trmin;?></th>
                                    <form method="POST" action="delVenta.php">
                                        <input type="text" name="ident" value="<?php echo $id;?>" style="display:none;">
                                        <th><input type="submit" value="ELIMINAR" class="btn btn-danger" onclick="return confirm('DESEAS ELIMINAR POR COMPLETO DE SISTEMA LA VENTA?')"></th>
                                    </form>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
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
