<?php
/*
include("../Config/library.php"); 
$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
header("refresh:12; url=$self"); 
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$correo = $_SESSION['mail'];
$user = $_SESSION['username'];
$idus=0;
$tos=0;
$Yo = new Usuario();
$P=new Pendiente();
$Yo->obtenerUsuarioCorreoBD($correo,$con);
$iduser=$Yo->regresaIdu();
$tod=$P->totalPendiente($con);
for ($i=0; $i < $tod; $i++) {                                 
    $Pendiente=new Pendiente();                                
    $Pendiente->obtenerPendienteBD($i,$con);
    $idp=$Pendiente->regresaIdpe();
    $status=$Pendiente->regresaStatus();
    if($status==0){$tos=$tos+1;}
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
        nivel2($user);
    ?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
    <br><br><br>
    <div class="panel panel-info">
            <div class="panel-heading">
                Pendientes  <a href=" addpendiente.php" class="btn btn-danger">+</a>
                <h4 style="color:red;"><b><?php echo $tos;?></b></h4>
            </div>
            <div class="panel-body" style="background:#B40404;">
                <form action="delpendiente.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="background-color:white;">
                            <tr>
                              <th>No.</th>
                              <th>Fecha</th>
                              <th>Titulo</th>                              
                              <th>Detalles</th>
                              <th>DE</th>
                            </tr>
                            <?php 
                            for ($i=0; $i < $tod; $i++) {                                 
                                $Pendientes=new Pendiente();                                
                                $Pendientes->obtenerPendienteBD($i,$con);
                                $idp=$Pendientes->regresaIdpe();
                                $status=$Pendientes->regresaStatus();
                                
                                $fecha=$Pendientes->regresaFechap();
                                $titulo=$Pendientes->regresaTtituloP();
                                $detalle=$Pendientes->regresaDetallep();
                                $iduser=$Pendientes->regresaUsuario_idu();
                                if($status==0){
                                $Usuarios= new Usuario();
                                $Usuarios->obtenerUsuarioBD($iduser,$con);
                                $usa = $Usuarios->regresaIdu();
                                $den = $Usuarios->regresaNombre();
                                $deap= $Usuarios->regresaApaterno();
                                ?>  
                                <tr style="font-size:12px;">
                                    <th><input class="btn btn-danger" name="ident" type="submit" value="<?php echo $idp;?>"></th>
                                    <th><?php echo $fecha;?></th>
                                    <th><?php echo $titulo;?></th>
                                    <th><?php echo $detalle;?></th>
                                    <th><?php echo $den." ".$deap;?></th>
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
    <?php footer();?>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
*/

include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<?php
    nivel5adm($user);
?>  
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-info">
            <div class="panel-heading">Usuarios</div>
            <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                              <th><a>Nombre Completo</a></th>
                              <th>Correo</th>
                              <th><a>Tipo</th>
                              <th>Celular</th>
                              <th><a>ID</a></th>
                              <th>Estado</th>
                              <th>TIPO DE PERSONAL</th>
                              
                            </tr>
                <?php
                $Usuario_infuser=new Usuario_infuser();
                $tusuarios=$Usuario_infuser->TotalUsuarioRh($con);
                for ($i=0; $i < $tusuarios; $i++) { 
                    $lista=new Usuario();
                    $tipos=new Tipo();
                    $lista->obtenerUsuarioBD($i,$con);
                    $name=$lista->regresaNombre();
                    $ap=$lista->regresaApaterno();
                    $am=$lista->regresaAmaterno();
                    $correos=$lista->regresaCorreo();
                    $am=$lista->regresaAmaterno();
                    $tipo_pe=$lista->regresaTipoIdTipo();
                    $celu=$lista->regresaCel();
                    $idus=$lista->regresaIdu();
                    $activos=$lista->regresaActivo();
                    $tipo_personal=$lista->regresaTipoPersonal();
                    $tipos->obtenerTipoBD($tipo_pe,$con);
                    $ntipo=$tipos->regresaTipo();
                    if($name!='' && $activos!=0){
                ?>
                <form action=" data.php" method="POST">
                            <?php 
                            $aux=0;
                                $mod=$aux%2;
                                    if($mod==0){
                                        ?>  
                                        <tr>
                                            <th style="font-size:12px;"><?php echo $name." ".$ap." ".$am;?></th>
                                            <th><?php echo $correos;?></th>
                                            <th style="font-size:10px;"><?php echo $ntipo;?></th>
                                            <th><?php echo $celu;?></th>
                                            <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idus;?>"></th>
                                            <th><?php if($activos==1){echo "ACTIVO";}if($activos==0){echo "INACTIVO";}?></th>
                                            <th style="font-size:10px;"><?php echo $tipo_personal;?></th>
                                        </tr>
                                        <?php
                                    }if($mod==1){
                                        ?>
                                        <tr style="background-color:orange;">
                                            <th style="font-size:12px;"><?php echo $name." ".$ap." ".$am;?></th>
                                            <th><?php echo $correos;?></th>
                                             <th style="font-size:10px;"><?php echo $ntipo;?></th>
                                            <th><?php echo $celu;?></th>
                                            <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idus;?>"></th>
                                            <th><?php if($activos==1){echo "ACTIVO";}if($activos==0){echo "INACTIVO";}?></th>
                                            <th style="font-size:10px;"><?php echo $tipo_personal;?></th>
                                        </tr>
                                        <?php
                                    }
                                    $aux=$aux+1;
                    }
                }
                                ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>