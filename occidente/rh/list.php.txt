<?php
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
    nivel2($user);
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
                              <th><a href="list.php">Nombre Completo</a></th>
                              <th>Correo</th>
                              <th><a href="listTipo.php">Tipo</th>
                              <th>Celular</th>
                              <th><a href="listID.php">ID</a></th>
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
                ?>
                <form action="data.php" method="POST">
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