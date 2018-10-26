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
$super=$Super->regresaAsignado();
$idu=$Super->regresaIdu();
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
                    <form action="bajanteSupervisor.php" method="POST" >
                            <input type="text" name="iduser" value="<?php echo $super;?>" style="display:none;">
                            <input type="image" src="../syspic/back.png" width="30" height="30" alt="Submit">
                    </form>
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
                            <tr style="color:green !important;">
                                <th>Folio Pisa</th>
                                <th>Tipo de OS</th>
                                <th>Fecha de Carga de OS</th>
                                <th>Fecha de Cierre de OS</th>
                                <th></th>
                            </tr>
                        <?php
                        $sql="SELECT * FROM os inner join dataos 
                        where dataos.id_orden=os.idmos AND os.asignado='$idsuper' order by yearos,mmos,ddos desc";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            ?>
                            <form action="bajanteOsData.php" method="POST">
                            <input type="text" name="idos" value="<?php echo $row['idmos'];?>" style="display:none;">
                            <input type="text" name="idTec" value="<?php echo $idu;?>" style="display:none;">
                            <tr>
                                <th><?php echo $row['folio_pisa'];?></th>
                                <th><?php echo $row['tipo_os'];?></th>
                                <th><?php echo $row['ddcarga']."/".$row['mmcarga']."/".$row['yearcarga'];?></th>
                                <th style="color:red; font-size:15px;"><?php echo $row['ddos']."/".$row['mmos']."/".$row['yearos']." ".$row['horaos'];?></th>
                                <th><input type="submit" value="DATOS COMPLETOS"></th>
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