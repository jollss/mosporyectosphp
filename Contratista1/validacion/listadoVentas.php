<?php
include("../Config/library.php");
//include("../Models/areas_fielder.php");
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
    <?php nivel4($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Trabajo Pendiente</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <div class="container col-md-12" name="toTop" id="topPos">
            <!--<div class="col-md-12"  style="height:500px;overflow-y:scroll;">-->
            <div class="col-md-12">
            <section class="row" style="height:100px;overflow-x:scroll;">
            <table class="table">
                <tr>
                <?php
                    $sql="SELECT * FROM areas_fielder order by nom_area";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        ?>
                        <td>
                        <form action="listadoVentas.php" method="GET">
                            <input type="number" value="<?php echo $row['idarea'];?>" name="area" style="display:none;" readonly>
                            <button class="btn btn-success" type="submit">
                                <i class="glyphicon glyphicon-globe">  <?php echo $row['nom_area'];?></i>
                            </button>
                        </form>
                        </td>
                        <?php
                    }
                ?>
                </tr>
            </table>
            </section>
            <section>
            <section class="row" style="height:500px;overflow-x:scroll;">
                        <table class="table">
                        <tr>
                            <th>FOLIO VENTA</th>
                            <th>NOMBRE CLIENTE</th>
                            <th>DIRECCION</th>
                            <th>TELEFONO 1</th>
                            <th>TELEFONO 2</th>
                            <th>TELEFONO 3</th>
                            <th>CORREO</th>
                            <th>TIPO DE CLIENTE</th>
                            <th>FECHA DE REGISTRO</th>
                            <th>¿QUIEN VENDIO?</th>
                        </tr>
                <?php 
                if(isset($_GET['area'])){
                    $areas=$_GET['area'];
                    $sql="SELECT * FROM equipos_fielder WHERE id_area='$areas'";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        ?>
                        
                        <?php
                        $fielderid=$row['id_fielder'];
                        $sql2="SELECT * FROM ventas WHERE idvendedor='$fielderid'";
                        $resultado2=$con2->query($sql2);
                        while($row2 = $resultado2->fetch_assoc())
                        {
                            $sql3="SELECT * FROM usuario WHERE idu='$fielderid'";
                            $resultado3=$con3->query($sql3);
                            while($row3 = $resultado3->fetch_assoc())
                            {
                                $n=$row3['nombre'];
                                $ap=$row3['apaterno'];
                                $am=$row3['amaterno'];
                            }
                            ?>
                            <tr>
                                <td>
                                <form action="step3.php" method="POST">
                                <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                    <button class="btn btn-primary" type="submit" >
                                       <?php echo $row2['folio_ventas'];?> 
                                    </button>
                                </form>
                                </td>
                                <td><?php echo $row2['nombre']." ".$row2['apaternov']." ".$row2['amaternov'];?></td>
                                <td><?php echo $row2['direccion'];?></td>
                                <td><?php echo $row2['telefono_1'];?></td>
                                <td><?php echo $row2['telefono_2'];?></td>
                                <td><?php echo $row2['telefono_3'];?></td>
                                <td><?php echo $row2['correo_cliente'];?></td>
                                <td><?php echo $row2['tipo_cliente'];?></td>
                                <td><?php echo $row2['dia']."/".$row2['mes']."/".$row2['year']." ".$row2['hora'];?></td>
                                <td><?php echo $n." ".$ap." ".$am;?></td>
                            </tr>
                            <?php
                        }
                        
                    }
                }
                if(!isset($_GET['area'])){
                        ?>
                        <?php
                        $sql2="SELECT * FROM venta WHERE estatus=1 and contesto='SI'";
                        $resultado2=$con2->query($sql2);
                        while($row2 = $resultado2->fetch_assoc())
                        {
                            $fielderid=$row2['idvendedor'];
                            $sql3="SELECT * FROM usuario WHERE idu='$fielderid'";
                            $resultado3=$con3->query($sql3);
                            while($row3 = $resultado3->fetch_assoc())
                            {
                                $n=$row3['nombre'];
                                $ap=$row3['apaterno'];
                                $am=$row3['amaterno'];
                            }
                            ?>
                            <tr>
                                <td>
                                <form action="step3.php" method="POST">
                                <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                    <button class="btn btn-primary" type="submit" >
                                       <?php echo $row2['folio_ventas'];?> 
                                    </button>
                                </form>
                                </td>
                                <td><?php echo $row2['nombrev']." ".$row2['apaternov']." ".$row2['amaternov'];?></td>
                                <td><?php echo $row2['direccion'];?></td>
                                <td><?php echo $row2['telefono_1'];?></td>
                                <td><?php echo $row2['telefono_2'];?></td>
                                <td><?php echo $row2['telefono_3'];?></td>
                                <td><?php echo $row2['correo_cliente'];?></td>
                                <td><?php echo $row2['tipo_cliente'];?></td>
                                <td><?php echo $row2['dia']."/".$row2['mes']."/".$row2['year']." ".$row2['hora'];?></td>
                                <td><?php echo $n." ".$ap." ".$am;?></td>
                            </tr>
                            <?php
                        }
                    
                }
                ?>
                </table>
                </section>
            </section>
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