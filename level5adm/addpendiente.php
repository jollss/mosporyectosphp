<?php
include("../Config/library.php"); 
$con = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Pendiente= new Pendiente();
$id=$Pendiente->obtenerIdPendiente($con);
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
<?php
    nivel2($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Nuevo Pendiente<br><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body">
                <form class="form-horizontal" action=" rpendiente.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Titulo: </label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="title" placeholder="Titulo de pendiente" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3">Detalles: </label>
                        <div class="col-xs-9">
                            <textarea name="detalle" placeholder="Detalles" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                        </div>
                     </div>
                </form>
            </div>
        </div>
        <?php footer();?>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>