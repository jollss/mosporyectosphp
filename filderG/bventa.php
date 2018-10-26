<!DOCTYPE html>
<?php
include("../Config/library.php"); 

$con = Conectarse();  
$con2 = Conectarse();
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

?>
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
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Buscar Venta</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<?php
if(!isset($_GET['dato']) or $_GET['dato']==0){ $dato='';}else{$dato=$_GET['dato'];}
?>
<section class="row">
    <div class="col-md-3"></div>
            <div class="panel panel-default col-md-6">
                <div class="panel-heading">Busqueda</div>
                <div class="panel-body">
                    <div align="center">
                        <div><strong>Dato buscado: <?php echo $dato;?></strong></div>
                        <form action="bventa.php" method="GET">
                            <div class="form-group">
                                <input type="search" class="form-control" placeholder="FOLIO VENTA" name="dato" style="background-color:;">
                                <input type="submit" value="BUSCAR" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
    <div class="col-md-3"></div>         
</section>
<?php
if(isset($_GET['dato']) and $_GET['dato']<>'0'){
        $dato=$_GET['dato'];
        $sql="SELECT * FROM venta 
        where folio_siac ='$dato' or folio_ventas like '%$dato' or nombrev like '%$dato'";
        $resultado=$con->query($sql);
        //echo $sql;
        while($row = $resultado->fetch_assoc())
        {    
            $idventa=$row['idventa'];
            $folio_ventas=$row['folio_ventas'];
            $idvendedor=$row['idvendedor'];
            $nombre=$row['nombrev'];
            $apaternov=$row['apaternov'];
            $amaternov=$row['amaternov'];
            $direccion=$row['direccion'];
            $datos=$row['datos'];
            $terminal=$row['terminal'];
            $telefono_1=$row['telefono_1'];
            $telefono_2=$row['telefono_2'];
            $telefono_3=$row['telefono_3'];
            $dia=$row['dia'];
            $mes=$row['mes'];
            $year=$row['year'];
            $hora=$row['hora'];
            $estatus=$row['estatus'];
            $vendedor=$row['vendedor'];
            $documentacion=$row['documentacion'];
            $area=$row['area'];
            $distrito=$row['distrito'];
            $folio_siac=$row['folio_siac'];
            $fecha_siac=$row['fecha_siac'];
            ?>
            <section class="row">
            <?php
            if(!isset($_GET['dato'])){ $dato='';}
            if(isset($_GET['dato'])){
                ?>
                <div class="col-md-4" style="background-color:;border:solid;height:500px;overflow-x:scroll;">
                    <table class="table">
                        <tr>
                            <th>Folio de venta</th>
                            <td style="font-weight: bold;color:red;"><?php echo $folio_ventas;?></td>
                            <th>Fecha</th>
                            <td style="font-weight: bold;color:red;"><?php echo $dia."/".$mes."/".$year." ".$hora;?></td>
                        </tr>
                        <tr>
                            <th>Vendedor</th>
                            <td style=""><?php echo $vendedor;?></td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td><?php echo $nombre." ".$apaternov." ".$amaternov;?></td>
                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <td><?php echo $direccion;?></td>
                            <th>Datos</th>
                            <td><?php echo $datos;?></td>
                        </tr>
                        <tr>
                            <th>Telefonos</th>
                            <td><?php echo $telefono_1;?></td>
                            <td><?php echo $telefono_2;?></td>
                            <td><?php echo $telefono_3;?></td>
                        </tr>
                        <tr>
                            <th>Terminal</th>
                            <td><?php echo $terminal;?></td>
                        </tr>
                        <tr>
                            <th>Area</th>
                            <td><?php echo $area;?></td>
                        </tr>
                        <tr>
                            <th>Distrito</th>
                            <td><?php echo $distrito;?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8" style="background-color:;">
                    <div style="background-color:;border:solid;height:250px;overflow-x:scroll;">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Contesto</th>
                                <th>fecha_filder</th>
                                <th>cliente</th>
                                <th>atiende</th>
                                <th>servicio</th>
                                <th>paquete</th>
                                <th>direccion</th>
                                <th>colonia</th>
                                <th>municipio</th>
                                <th>cp</th>
                                <th>gastos_instalacion</th>
                                <th>tiempo_instalacion</th>
                                <th>observaciones</th>
                            </tr>
                            <?php
                            $sql2="SELECT * FROM filder where idventas = '$idventa' ORDER BY fecha_filder DESC";
                            $resultado2=$con2->query($sql2);
                            while($row2 = $resultado2->fetch_assoc())
                            {   
                                $contst=$row2['contesto'];
                                if(isset($contst)){
                                    $idfilder=$row2['id_filder'];
                                ?>
                                <tr>
                                    <th><?php echo $row2['id_filder'];?></th>
                                    <th><?php echo $row2['contesto'];?></th>
                                    <td><?php echo $row2['fecha_filder'];?></td>
                                    <td><?php echo $row2['cliente'];?></td>
                                    <td><?php echo $row2['atiende'];?></td>
                                    <td><?php echo $row2['servicio'];?></td>
                                    <td><?php echo $row2['paquete'];?></td>
                                    <td><?php echo $row2['direccion'];?></td>
                                    <td><?php echo $row2['colonia'];?></td>
                                    <td><?php echo $row2['municipio'];?></td>
                                    <td><?php echo $row2['cp'];?></td>
                                    <td><?php echo $row2['gastos_instalacion'];?></td>
                                    <td><?php echo $row2['tiempo_instalacion'];?></td>
                                    <td><?php echo $row2['observaciones'];?></td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
        <!--============================================================================================-->
                    <div style="background-color:;border:solid;height:250px;overflow-x:scroll;">
                        <table class="table">
                            <tr>
                                <th>Folio SIAC</th>
                                <th>Fecha SIAC</th>
                            </tr>
                                <tr>
                                    <td><?php echo $folio_siac;?></td>
                                    <td><?php echo $fecha_siac;?></td>
                                </tr>
                            ?>
                        </table>

                        <table class="table">
                            <tr>
                                <th>Tienda Comercial </th>
                                <th>Telefono Asignado</th>
                                <th>FOLIO OS</th>
                                <th>ETAPA</th>
                                <th>LISTO PS</th>
                                <th>Fecha Comercial</th>
                            </tr>
                            <?php
                            $sql4="SELECT * FROM tienda_comercial where id_venta = '$idventa'";
                            $resultado4=$con4->query($sql4);
                            while($row4 = $resultado4->fetch_assoc())
                            {   
                                $id_tienda=$row4['id_tienda'];
                                if(isset($id_tienda)){
                                ?>
                                <tr>
                                    <td><?php echo $row4['tienda_comercial'];?></td>
                                    <td style="font-weight: bold;color:red;"><?php echo $row4['tel_asignado'];?></td>
                                    <td style="font-weight: bold;color:red;"><?php echo $row4['folio_os'];?></td>
                                    <td style="font-weight: bold;color:red;"><?php echo $row4['etapa'];?></td>
                                    <td><?php echo $row4['listo_ps'];?></td>
                                    <td><?php echo $row4['fecha_comercial'];?></td>

                                </tr>
                                <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
        </section>
            <?php
        }
}
?>      


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