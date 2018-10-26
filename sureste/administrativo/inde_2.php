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
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
$tipo_user=$yo->regresaTipoIdTipo();
$tos=0;
$TotalOS=new Os();
$ls=$TotalOS->totalAOs($iduser,$con);

if($tipo_user==41){
    $place="CANCUN";
}if($tipo_user==39){
    $place="VILLA HERMOSA";
}if($tipo_user==38){
    $place="MERIDA";
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
<script type="text/javascript" src="../js/browser2.js"></script>
        
<?php
   administrativo($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
 
        <div class="panel panel-info">

            <div class="panel-heading">Ordenes de <?php echo $place;?></div>
            <div class="panel-body" style="background-color:gray;">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div align="center">
            <?php
            if($tipo_user==41){
                $place="CANCUN";
            }if($tipo_user==39){
                $place="CT VLL";
            }if($tipo_user==38){
                $place="MERIDA";
            }
            ?>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
</body>
</html>
