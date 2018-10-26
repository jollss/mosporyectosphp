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
    <?php gventas($user);?>
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
                                          <th>No</th>
                                          <th>Nombre Completo</th>
                                          <th>ID</th>
                                          <th>Correo</th>
                                          <th>Celular</th>
                                          <th></th>
                                          <th></th>
                                          <th>Cantidades</th>
                                        </tr>
                                         <?php
                                            $Total=new Usuario();
                                            $totalU=$Total->TotalUBD($con);
                                            $aux=0;
                                            $aux2=0;
                                            
                                            //echo $totalU."<br>";
                                            for ($i=0; $i < $totalU; $i++) { 
                                                $aux2=$i%2;
                                                
                                                $Usuario=new Usuario();
                                                $Usuario->obtenerUsuarioBD($i,$con);
                                                $activo= $Usuario->regresaActivo();
                                                $tipo=$Usuario->regresaTipoIdTipo();
                                                
                                                $idu=$Usuario->regresaIdu();
                                                $correou=$Usuario->regresaCorreo();
                                                //echo $i."<br>";
                                                if($activo==1 and $tipo==21 or $tipo==4 or $tipo==23 or $tipo==27 or $tipo==24){
                                                    $aux=$aux+1;
                                                    $Venta=new Usuario();
                                                    $Venta->obtenerUsuarioBD($i,$con);
                                                    $nombres=$Venta->regresaNombre();
                                                    $ap=$Venta->regresaApaterno();
                                                    $am=$Venta->regresaAmaterno();
                                                    $cel=$Venta->regresaCel();
                                                    $rCanti=new Reclutadorcantidad();
                                                    $rCanti->obtenerReclutaBD($idu,$con);
                                                    $cantidad=$rCanti->regresaCantidad();
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $aux;?></th> 
                                                        <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                        <th><?php echo $idu;?></th> 
                                                        <th><?php echo $correou;?></th>
                                                        <th><?php echo $cel;?></th>
                                                        <form action="addCantidad.php" method="POST">
                                                        <input type="text" value="<?php echo $idu?>" name="ident" style="display:none;">
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
                                                        <input type="text" value="<?php echo $idu?>" name="ident" style="display:none;">
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