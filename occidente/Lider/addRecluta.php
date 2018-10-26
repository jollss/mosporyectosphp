e <?php
include("../Config/library.php");
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
$sql="SELECT * FROM equipos_fielder where id_fielder='$iduser'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['id_area'];
}if(!isset($areaLider)){
    $areaLider=0;
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
                <h3 class="page-header">Agregar BP</h3>
            </div>
        </div>
        <!--<div class="container-fluid col-md-6">-->
        <!-- ... Your content goes here ... -->   
        <div class="container col-md-12" name="toTop" id="topPos">
            <div class="col-md-12">
            <div align="center"></div>
                <div class="panel panel-info">
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana = date("W");
                    ?>
                    <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
                    <div class="panel-body" style="background-color:gray;">
                    <div align="center" style="font-size:12px !important;">
                        <div id="resultadoBusqueda">
                                <div class="table-responsive" style="height:500px;ovrflow-y:scroll;">
                                    <table class="table table-bordered" style="background-color:white;">
                                        <tr>
                                          <th>Id</th>
                                          <th>Nombre Completo</th>
                                          <th>Correo</th>
                                          <th>Celular</th>
                                          <th></th>
                                          <th></th>
                                          <th>Cantidades</th>
                                        </tr>
                                         <?php
                                            $sql="SELECT * FROM usuario INNER JOIN equipos_fielder WHERE activo=1 and asignado='$iduser' AND id_fielder=idu";
                                            //SELECT * FROM usuario I WHERE asignado='$idus'  and nombre like '%$dato%' or apaterno like '%$dato%'
                                            $resultado=$con->query($sql);
                                            while($row = $resultado->fetch_assoc()){
                                                $id=$row['idu'];
                                                $nombre=$row['nombre'];
                                                $paterno=$row['apaterno'];
                                                $materno=$row['amaterno'];
                                                $cel=$row['cel'];
                                                $correo=$row['correo'];
                                                $rCanti=new Reclutadorcantidad();
                                                $rCanti->obtenerReclutaBD($id,$con);
                                                $cantidad=$rCanti->regresaCantidad();

                                                ?>
                                                <tr>
                                                    <td><?php echo $id;?></td>
                                                    <td><?php echo $nombre." ".$paterno." ".$materno;?></td>
                                                    <th><?php echo $correo;?></th>
                                                    <th><?php echo $cel;?></th>
                                                    <form action="addCantidad.php" method="POST">
                                                    <input type="text" value="<?php echo $id?>" name="ident" style="display:none;">
                                                    <th><input class="btn btn-success" name="" type="submit" value="+"></th>
                                                    </form>
                                                    <form action="delCantidad.php" method="POST">
                                                    <?php
                                                     if($cantidad==0 or $cantidad==''){
                                                        ?>
                                                        <th></th>
                                                        <?php
                                                     }else{
                                                    ?>
                                                    <input type="text" value="<?php echo $id?>" name="ident" style="display:none;">
                                                    <th><input class="btn btn-danger" name="" type="submit" value="-"></th>
                                                    <?php
                                                        }
                                                    ?>
                                                    </form>
                                                    <th>
                                                        <?php
                                                        if($cantidad==0 or $cantidad==''){echo '0';}
                                                        else{echo $cantidad;}
                                                        ?>
                                                    </th>
                                                </tr>
                                                <?php
                                                $sql2="SELECT * FROM usuario WHERE activo=1 and asignado='$iduser'";
                                                $resultado2=$con2->query($sql2);
                                                while($row2 = $resultado2->fetch_assoc()){
                                                    $id2=$row2['idu'];
                                                    $nombre2=$row2['nombre'];
                                                    $paterno2=$row['apaterno'];
                                                    $materno2=$row['amaterno'];
                                                    $cel2=$row2['cel'];
                                                    $correo2=$row2['correo'];
                                                    $rCanti2=new Reclutadorcantidad();
                                                    $rCanti2->obtenerReclutaBD($id2,$con);
                                                    $cantidad2=$rCanti2->regresaCantidad();
                                                    if($id2==$id){

                                                    }else{
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $id2;?></td>
                                                        <td><?php echo $nombre2." ".$paterno2." ".$materno2;?></td>
                                                        <th><?php echo $correo2;?></th>
                                                        <th><?php echo $cel2;?></th>
                                                        <form action="addCantidad.php" method="POST">
                                                        <input type="text" value="<?php echo $id2?>" name="ident" style="display:none;">
                                                        <th><input class="btn btn-success" name="" type="submit" value="+"></th>
                                                        </form>
                                                        <form action="delCantidad.php" method="POST">
                                                        <?php
                                                         if($cantidad2==0 or $cantidad2==''){
                                                            ?>
                                                            <th></th>
                                                            <?php
                                                         }else{
                                                        ?>
                                                        <input type="text" value="<?php echo $id2?>" name="ident" style="display:none;">
                                                        <th><input class="btn btn-danger" name="" type="submit" value="-"></th>
                                                        <?php
                                                            }
                                                        ?>
                                                        </form>
                                                        <th>
                                                            <?php
                                                            if($cantidad2==0 or $cantidad2==''){echo '0';}
                                                            else{echo $cantidad2;}
                                                            ?>
                                                        </th>
                                                    </tr>
                                                    <?php
                                                    }
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
        </div>
<!--============================================================================================--><!--============================================================================================-->
        <!--</div>-->
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