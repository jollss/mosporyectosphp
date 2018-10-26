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
                <h1 class="page-header">
               Listado de
                <?php
                if(isset($_GET['area'])){
                    $areas=$_GET['area'];
                    $sql="SELECT * FROM areas_fielder where idarea='$areas'";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        if($row['nom_area']<>''){
                            echo $row['nom_area'];
                        }
                    }
                }if(!isset($_GET['area'])){
                    echo "TODAS LAS AREAS";
                }
                ?>
                </h1>
                <P>Se muestra todas las ventas con un estado de venta diferente a P o POSTEADO (Presiona CTRL + F para buscar un dato)</P>
            </div>
            <section class="row" style="height:100px;overflow-x:scroll;">
                <table class="table">
                    <tr>
                        <td><label class="btn btn-success" style="background-color: DarkCyan  !important;">ABIERTA</label></td>
                        <td><label class="btn btn-default">COMERCIAL</label></td>
                        <td><label class="btn btn-warning">SOLICITUD DUPLICADA</label></td>
                        <td><label class="btn btn-danger">CANCELADO</label></td>
                        <td><label class="btn btn-success" style="background-color: blue !important;">POSTEADO</label></td>
                        <td><label class="btn btn-primary">DEMANDA/INFRAESTRUCTURA</label></td>
                        <!--
                        <option value="I">I ... ABIERTA</option>
                        <option value="P">P ... POSTEADO</option>
                        <option value="X">X... CANCELADO</option>
                        <option value="C">C... COMERCIAL </option>
                        <option value="CC">CC... ADEUDO </option>
                        <option value="ID">ID... DEMANDA/INFRAESTRUCTURA</option>
                        <option value="SOLICITUD DUPLICADA">SOLICITUD DUPLICADA </option>
                        -->
                    </tr>
                </table>
            </section>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <div class="container col-md-12" name="toTop" id="topPos">
            <div class="col-md-12">
                <section class="row" style="height:100px;overflow-x:scroll;">
                <table class="table">
                    <tr>
                    <?php
                        $sql="SELECT * FROM areas_fielder order by nom_area";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            if($row['nom_area']<>''){
                            ?>
                            <td>
                            <form action="listadoVentas.php" method="GET">
                                <input type="number" value="<?php echo $row['idarea'];?>" name="area" style="display:none;" readonly>
                                <button class="btn btn-primary" type="submit">
                                    <i class="glyphicon glyphicon-globe">  <?php echo $row['nom_area'];?></i>
                                </button>
                            </form>
                            </td>
                            <?php
                            }
                        }
                    ?>
                    </tr> 
                </table>
                </section>
            </div>
            <div class="col-md-12">
                <section class="row" style="height:500px;overflow-x:scroll;">
                            <table class="table" border="2">
                            <tr>
                                <th>FOLIO VENTA</th>
                                <th>ETAPA</th>
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
                    function  selectEtapa($etapa){
                        //echo $etapa; 
                        /*
                        <option value="ABIERTA">I ... ABIERTA</option>
                                            <option value="P">P ... POSTEADO</option>
                                            <option value="CANCELADA">X... CANCELADO</option>
                                            <option value="COMERCIAL">C... COMERCIAL </option>
                                            <option value="ADEUDO">CC... ADEUDO </option>
                                            <option value="DEMANDA/INFRAESTRUCTURA">ID... DEMANDA/INFRAESTRUCTURA</option>
                                            <option value="SOLICITUD DUPLICADA">SOLICITUD DUPLICADA </option>
                                            <option value="">NINGUNO</option>
                        */
                        if($etapa=='COMERCIAL' or $etapa=='C'){
                            ?>
                            <label class="btn btn-default"><?php echo $etapa;?></label>
                            <?php
                        }if($etapa=='SOLICITUD DUPLICADA'){
                            ?>
                            <label class="btn btn-warning"><?php echo $etapa;?></label>
                            <?php
                        }if($etapa=='CANCELADA' OR $etapa=='X'){
                            ?>
                            <label class="btn btn-danger"><?php echo $etapa;?></label>
                            <?php
                        }if($etapa=='P' OR $etapa=='POSTEADO'){
                            ?>
                            <label class="btn btn-success" style="background-color: blue !important;"><?php echo $etapa;?></label>
                            <?php
                        }
                        if($etapa=='DEMANDA/INFRAESTRUCTURA' or $etapa=='ID'){
                            ?>
                            <label class="btn btn-primary"><?php echo $etapa;?></label>
                            <?php
                        }if($etapa=='ABIERTA' OR $etapa=='I'){
                            ?>
                            <label class="btn btn-success" style="background-color: DarkCyan  !important;"><?php echo $etapa;?></label>
                            <?php
                        }if($etapa=='ADEUDO' or $etapa=='CC'){
                            ?>
                            <label class="btn btn-success" style="background-color: DarkSlateBlue  !important;"><?php echo $etapa;?></label>
                            <?php
                        }
                        if($etapa==''){
                            ?>
                            <label style="background-color: DarkSlateBlue  !important;color:white !important;">NINGUNA</label>
                            <?php
                        }
                        /*if($etapa<>'ADEUDO' OR $etapa<>'ABIERTA' OR $etapa<>'DEMANDA/INFRAESTRUCTURA' OR $etapa<>'P' OR $etapa<>'CANCELADA' OR $etapa<>'SOLICITUD DUPLICADA' OR $etapa<>'COMERCIAL'){
                            ?>
                            <label class="btn" style="background-color: DarkSlateBlue  !important;"><?php echo $etapa;?></label>
                            <?php
                        }*/
                    }
                    if(!isset($_GET['area'])){
                            ?>
                            <?php
                            $sql2="SELECT * FROM venta WHERE estatus=1 and contesto='SI' AND idvendedor<>0 order by folio_os desc";
                            $resultado2=$con2->query($sql2);
                            while($row2 = $resultado2->fetch_assoc())
                            {
                                $fielderid=$row2['idvendedor'];
                                $folio_os=$row2['folio_os'];
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
                                    <?php
                                    if($folio_os<>''){
                                    ?>
                                    <form action="step3.php" method="POST">
                                    <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                        <button class="btn btn-success" type="submit" >
                                           <?php echo $row2['folio_ventas'];?> 
                                        </button>
                                    </form>
                                    <?php
                                    }if($folio_os==''){
                                    ?>
                                    <form action="step3.php" method="POST">
                                    <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                        <button class="btn btn-danger" type="submit" >
                                           <?php echo $row2['folio_ventas'];?> 
                                        </button>
                                    </form>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td><?php selectEtapa($row2['etapa']);?></td>
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
                        
                    }if(isset($_GET['area'])){
                        $area=$_GET['area'];
                            $sql2="SELECT * FROM venta WHERE estatus=1 and contesto='SI' AND idvendedor<>0 order by folio_os desc";
                            $resultado2=$con2->query($sql2);
                            while($row2 = $resultado2->fetch_assoc())
                            {
                                $fielderid=$row2['idvendedor'];
                                $folio_os=$row2['folio_os'];
                                $sql3="SELECT * FROM usuario inner join equipos_fielder inner join areas_fielder WHERE idu=id_fielder and id_area=idarea and idarea='$area' and idu='$fielderid'";
                                $resultado3=$con3->query($sql3);
                                while($row3 = $resultado3->fetch_assoc())
                                {
                                    $n=$row3['nombre'];
                                    $ap=$row3['apaterno'];
                                    $am=$row3['amaterno'];
                                }
                                if(isset($n)){
                                    ?>
                                    <tr>
                                        <td>
                                        <?php
                                        if($folio_os<>''){
                                        ?>
                                        <form action="step3.php" method="POST">
                                        <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                            <button class="btn btn-success" type="submit" >
                                               <?php echo $row2['folio_ventas'];?> 
                                            </button>
                                        </form>
                                        <?php
                                        }if($folio_os==''){
                                        ?>
                                        <form action="step3.php" method="POST">
                                        <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                                            <button class="btn btn-danger" type="submit" >
                                               <?php echo $row2['folio_ventas'];?> 
                                            </button>
                                        </form>
                                        <?php
                                        }
                                        ?>
                                        </td>
                                        <td><?php selectEtapa($row2['etapa']);?></td>
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
                    }
                    ?>
                    </table>
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