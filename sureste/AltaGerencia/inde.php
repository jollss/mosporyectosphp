<?php
include("../Config/library.php");
session_start();
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$nomu=$Yo->regresaNombre();
$apu=$Yo->regresaAPaterno();
$amu=$Yo->regresaIdu();
$pass=$Yo->regresaPssw();
?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php ag($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">INICIO ZONA METRO</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="modal fade col-md-12" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div align="center">
            <img src="../syspic/logo.png">
            </div>
     </div>
         <div class="modal-body" align="center">
            <h1>BIENVENIDO..!!</h1>  
            <label>Estas ingresando con el usuario:</label>
            <br>
            <label>
                <h2><?php echo $nomu." ".$apu." ";?></h2>
            </label>
            <br>
            <label>
                <h2>ZONA SUR</h2>
            </label>
         </div>
         <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-success">INGRESAR</a>
        </div>
      </div>
   </div>
</div>
<div class="col-md-12">
    <div align="center">
        <img src="../syspic/logo.png">
    </div>
    <h1>BIENVENIDO..!!</h1>  
            <label>Estas ingresando con el usuario:</label>
            <br>
            <label>
                <h2><?php echo $nomu." ".$apu." ";?></h2>
            </label>
</div>
<section class="row">
    <table class="table">
        <tr>
            <?php
            //echo $pass."<br>";
            ?>
            <a href="../../AltaGerencia/inde.php">
                <button type="submit" class="btn btn-primary">
                    INGRESAR ZONA METRO
                </button>
            </a>
            <br>
            <!--
            <form action="../occidente/login.php" method="POST">
                <input type="hidden" name="mail" value="<?php echo $mail;?>">
                <input type="hidden" name="password" value="<?php echo $pass;?>">
                <button type="submit" class="btn btn-primary">
                    INGRESAR ZONA OCCIDENTE
                </button>
            </form>-->
            <a href="../../occidente/AltaGerencia/inde.php">
                <button type="submit" class="btn btn-primary">
                    INGRESAR ZONA OCCIDENTE
                </button>
            </a>
            <br>
            <!--<form action="../occidente/login.php" method="POST">-->
            <!--
            <form action="../sureste/login.php" method="POST">
                <input type="hidden" name="tipo" value="5">
                <input type="hidden" name="mail" value="<?php echo $mail;?>">
                <input type="hidden" name="password" value="<?php echo $pass;?>">
                <button type="submit" class="btn btn-primary">
                    INGRESAR ZONA SUR
                </button>
            </form>
            -->
            <a href="../sureste/AltaGerencia/inde.php">
                <button type="submit" class="btn btn-primary">
                    INGRESAR ZONA SUR
                </button>
            </a>
        </tr>
    </table>
</section>
<!--============================================================================================-->      
    </div>
</div>
<script>
       $(document).ready(function()
       {
          //$("#mostrarmodal").modal("show");
          $('#mostrarmodal').modal("show");
       });
    </script>
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
