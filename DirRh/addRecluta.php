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
$tos=0;
/*========================================*/
/*========================================*/
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
    Grh($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
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
                
                        <div class="table-responsive" style="height:500px;overflow-y:scroll;">
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
                                    for ($i=0; $i < $totalU; $i++) { 
                                        $aux2=$i%2;
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        if($activo==1 and $idu<>0 and $tipo==20 or $tipo==21 or $tipo==4 or $tipo==23 or $tipo==24){
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
                                                <th style="font-size:15px;color:red;">
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
                </form>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>

</body>
</html>