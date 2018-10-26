<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
/*========================================*/
$idsuper=$_POST['iduser'];
$Super=new Usuario();
$Super->obtenerUsuarioBD($idsuper,$con);
$nombreS=$Super->regresaNombre();
$apS=$Super->regresaApaterno();
$amS=$Super->regresaAmaterno();
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
    nivel5($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <br><br>
</div>
    <div class="col-md-12">
    <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading">
                <?php echo $dia."/".$mes."/".$aaaa;?>
                <label> 
                <a href="inde.php"><img src="../syspic/back.png" width="30" height="30"></a>
                </label>
            </div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div style="background-color:white;">
                    <div id="container2">
                        <table class="table">
                            <tr>
                                <h2>TECNICOS</h2>
                                <label>Área Bajantes</label><br>
                                <b> Supervisor: <?php echo $nombreS." ".$apS." ".$amS;?></b>
                            </tr>
                        <?php
                        $sql="SELECT * FROM usuario where activo=1 and tipo_idtipo=1 and asignado='$idsuper' ORDER BY nombre";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            ?>
                            <form action="bajanteTecnicoOs.php" method="POST">
                            <input type="text" name="iduser" value="<?php echo $row['idu'];?>" style="display:none;">
                            <tr>
                                <th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                <th><?php echo $row['correo'];?></th>
                                <th><?php echo $row['cel'];?></th>
                                <th><input type="submit" value="OS ASIGNADAS"></th>
                            </tr>
                            </form>
                            <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-12"></div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>