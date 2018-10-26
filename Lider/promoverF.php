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
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tipoYo=$Yo->regresaTipoIdTipo();
$asignadoYo=$Yo->regresaAsignado();
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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Promover empleado</h3>
            </div>
        </div>
<!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <div class="col-md-12">
            <div align="center">
                <!--
                <button role="button" href="#" onclick="alertas();" id="">
                    <span class="ui-button-text">Error</span>
                </button>
                -->
            </div>
                <div class="panel panel-info">
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana = date("W");
                    if(!isset($_GET['tipoGet']) or $_GET['tipoGet']==''){ $tipoGet=33;}else{ $tipoGet=$_GET['tipoGet'];}
                    if(!isset($_GET['promo']) or $_GET['promo']=='' or !isset($_GET['ident']) or $_GET['ident']=='' ){ 
                        $promo=''; 
                        $vende='';
                        //$sql='';
                    }//if($promo!='' and $vende!=''){ 
                    if(isset($_GET['promo']) or  isset($_GET['ident'])){
                        $promo=$_GET['promo'];
                        $vende=$_GET['ident'];
                        $sql="UPDATE usuario SET 
                        tipo_idtipo='".$promo."'
                        WHERE idu='".$vende."'";
                        if ($con->query($sql) === TRUE) { echo ""; } 
                        else{ 
                            if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con));}
                        } 
                    }
                    ?>
                    <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
                    <div class="panel-body" style="background-color:gray;">
                    <form action="promoverF.php" method="GET">
                        <select name="tipoGet" class="form-control">
                            <!--<option value="35">DIRECCION DE AREA</option>
                            <option value="29">DIRECCION DE RH</option>
                            <option value="20">RECLUTADORES</option>
                            <option value="30">SUB DIRECCION</option>
                            <option value="31">COORDINADOR</option>
                            <option value="32">LIDERES</option>-->
                            <option value="33">GERENTE</option>
                            <option value="34">CHIEF OFFICER</option>
                            <option value="24">SUPERVISOR</option>
                            <option value="21">PROMOTOR</option>
                            <option value="27">BEGINER PROMOTER</option>
                        </select>
                        <input type="text" value="<?php echo $vende;?>" name="ident" style="display:none;" readonly>
                        <input type="text" value="<?php echo $promo;?>" name="promo" style="display:none;" readonly>
                        <input type="submit" class="btn btn-primary" value="VER">
                    </form>
                    <div align="center" style="font-size:12px !important;">
                        <div id="resultadoBusqueda" style="height:500px;overflow-y:scroll;">
                                <div class="table-responsive" >
                                    <table class="table table-bordered" style="background-color:white;">
                                        <tr>
                                          <th>Nombre Completo</th>
                                          <th>ID</th>
                                          <th>Correo</th>
                                          <th>Teléfono</th>
                                          <th>Celular</th>
                                          <th></th>
                                        </tr>
                                         <?php
                                            $Total=new Usuario();
                                            $totalU=$Total->TotalUBD($con);
                                            $totalU=$totalU-1;
                                            for ($i=0; $i < $totalU; $i++) { 
                                                $Usuario=new Usuario();
                                                $Usuario->obtenerUsuarioBD($i,$con);
                                                $activo= $Usuario->regresaActivo();
                                                $tipo=$Usuario->regresaTipoIdTipo();
                                                $activoU=$Usuario->regresaActivo();
                                                $idu=$Usuario->regresaIdu();
                                                $correou=$Usuario->regresaCorreo();
                                                if($activoU==1){
                                                    if($tipo==$tipoGet){
                                                        $Venta=new Usuario();
                                                        $Venta->obtenerUsuarioBD($i,$con);
                                                        $nombres=$Venta->regresaNombre();
                                                        $ap=$Venta->regresaApaterno();
                                                        $am=$Venta->regresaAmaterno();
                                                        $cel=$Venta->regresaCel();
                                                        ?>
                                                        <tr>
                                                            <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                            <th><?php echo $idu;?></th>
                                                            <th><?php echo $correou;?></th>
                                                            <th><?php echo $cel;?></th>
                                                            <form action="promoverF.php" method="GET">
                                                            <input type="text" name="tipoGet" value="<?php echo $tipoGet;?>" style="display:none;" readonly>
                                                            <input name="ident" type="text" value="<?php echo $idu;?>" style="display:none;" readonly>
                                                            <th>
                                                                <select name="promo" class="form-control">
                                                                    <!--<option value="35">DIRECCION DE AREA</option>
                                                                    <option value="29">DIRECCION DE RH</option>
                                                                    <option value="20">RECLUTADORES</option>
                                                                    <option value="30">SUB DIRECCION</option>
                                                                    <option value="31">COORDINADOR</option>
                                                                    <option value="32">LIDERES</option>-->
                                                                    <option value="33">GERENTE</option>
                                                                    <option value="34">CHIEF OFFICER</option>
                                                                    <option value="24">SUPERVISOR</option>
                                                                    <option value="21">PROMOTOR</option>
                                                                    <option value="27">BEGINER PROMOTER</option>
                                                                </select>
                                                                <input class="btn btn-danger"  type="submit" value="PROMOVER">
                                                            </th>
                                                            </form>
                                                        </tr>
                                                        <?php
                                                    }else{}
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
