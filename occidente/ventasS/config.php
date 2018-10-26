<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();   
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$name=$Yo->regresaNombre();
$ap=$Yo->regresaApaterno();
$am=$Yo->regresaAmaterno();
$cel=$Yo->regresaCel();
$tel=$Yo->regresaTel();
$dir=$Yo->regresaDireccion();
$tipos=$Yo->regresaTipoIdTipo();

$tiposU=new Tipo();
$tiposU->obtenerTipoBD($tipos,$con);
$ntipo=$tiposU->regresaTipo();
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
    <?php ventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Configuración</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div align="center"><h3><?php echo $user;?></h3><label><?php echo $ntipo;?></label></div>
        <div class="panel panel-info">
            <div class="panel-heading">Modificar Datos</div>
            <div class="panel-body">
            <form class="form-horizontal" action=" moduser.php" method="POST">
                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre(s): </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Apellido Paterno: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputApaterno"  name="ap" value="<?php echo $ap;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Apellido Materno: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputMaterno"  name="am" value="<?php echo $am;?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Contraseña: </label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" id="inputPssw"  name="pssw" placeholder="Nueva Contraseña" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Celular:</label>
                    <div class="col-xs-9">
                       <input type="text" class="form-control" value="<?php echo $cel;?>" aria-describedby="sizing-addon2" readonly>
                    </div>
                    <label class="control-label col-xs-3">Teléfono:</label>
                     <div class="col-xs-9">
                        <input type="text" class="form-control" value="<?php echo $tel;?>" aria-describedby="sizing-addon2" readonly>
                    </div>
                    <label class="control-label col-xs-3">Dirección:</label>
                     <div class="col-xs-9">
                        <input type="text" class="form-control" value="<?php echo $dir;?>" aria-describedby="sizing-addon2" readonly>
                     </div>
                </div>

                <div class="form-group">
                    <input type="text" name="iduser" value="<?php echo $iduser;?>" style="visibility:hidden">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" class="btn btn-primary" value="Modificar">
                        <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </div>
                </div>
            </form>
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
