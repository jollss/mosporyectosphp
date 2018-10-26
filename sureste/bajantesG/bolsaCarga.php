<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
if(!isset($_POST['super'])){
    $super=$_GET['super'];
}if(!isset($_GET['super'])){
    $super=$_POST['super'];
}
if(!isset($idmos)){
    $idmos='';
}
if(!isset($idmosOS)){
    $idmosOS="";
    $folio_pisaOS="";
    $ddcargaOS="";
    $mmcargaOS="";
    $yearcargaOS="";
    $cope="";
    $expediente="";
    $folio_pisaplex="";
    $telefono="";
    $cliente="";
    $tipo_tarea="";
    $distrito="";
    $zona="";
    $dilacion_etapa="";
    $dilacion="";
    $folio_pisaOS="";
    $ddcargaOS="";
    $mmcargaOS="";
    $yearcargaOS="";
}
if(!isset($_GET['dia']) && !isset($_GET['mes']) && !isset($_GET['year'])){
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    $year=$aaaa;
}else{
    $dia=$_GET['dia'];
    $mes=$_GET['mes'];
    $year=$_GET['year'];
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
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    bajantesG($user);
?>  
</head>
<body>
<br><br><br><br>
<!--<div class="col-md-12" style="background-color:black;">-->
<div class="col-md-12 panel panel-primary">
    <div class="panel-heading">
        <a href="inde.php">
            <input type="image" src="../syspic/back.png" width="40" height="40">
        </a>
    </div>
<!--************************************************-->
    <div class="table-responsive panel-body">
    <div align="center" style="background-color:gray;height:50px;">
        <form action="bolsaCarga.php" method="GET">
            <input type="number" value="" name="dia" min="1" max="31" placeholder="DD" size="4" style="display:;" >
            <input type="number" value="" name="mes" min="1" max="12" placeholder="MM" size="4" style="display:;" >
            <input type="number" value="" name="year" min="1900" placeholder="AAAA" size="4" style="display:;" >
            <input type="text"  name="idmos" value="<?php echo $idmos;?>" readonly="readonly" style="display:none;">
            <input type="text" value="<?php echo $super;?>" name="super" style="display:none;">
            <input type="submit" value="BUSCAR">
        </form>
    </div>
        <div class="col-md-4">
            <div class="panel-heading" align="center">
                <label><h3>CANTIDAD DE BOLSA CARGADA POR FECHA</h3></label>
                <?php
                
                $cont=0;
                $sql1="SELECT * FROM os WHERE usuario_idu='$super' AND ddcarga='$dia' and mmcarga='$mes' and yearcarga='$year' ";
                $resultado=$con->query($sql1);
                while($row = $resultado->fetch_assoc())
                {
                    $cont=$cont+1;
                }
                echo "<b>Bolsa del día: ".$dia."/".$mes."/".$year." TOTAL = ".$cont."</b>";
                ?>
            </div>
                <div  style="background-color:;height:500px;overflow-y:scroll;">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td><b>ID MOS</b></td>
                            <td><b>FECHA DE CARGA</b></td>                            
                            <td><b>FOLIO PISA</b></td>
                            <!--<td><b>FECHA DE ASIGNACION</b></td>-->
                        </tr>
                        <?php
                        $cont=0;
                        //$sql1="SELECT * FROM os WHERE usuario_idu='$super' order by yearcarga,mmcarga,ddcarga";
                        $sql1="SELECT * FROM os WHERE usuario_idu='$super' AND ddcarga='$dia' and mmcarga='$mes' and yearcarga='$year' ";
                        $resultado=$con->query($sql1);
                        while($row = $resultado->fetch_assoc())
                        {
                            $idmos=$row['idmos'];
                            $folio_pisa=$row['folio_pisa'];
                            $ddcarga=$row['ddcarga'];
                            $mmcarga=$row['mmcarga'];
                            $yearcarga=$row['yearcarga'];
                            $cont=$cont+1;
                            ?>
                            <tr>
                            <form action="bolsaCarga.php" method="GET">
                                <td><?php echo $cont;?></td>
                                <input type="number" value="<?PHP echo $dia;?>" name="dia" min="1" max="31" placeholder="DD" size="4" style="display:none;" readonly>
                                <input type="number" value="<?PHP echo $mes;?>" name="mes" min="1" max="12" placeholder="MM" size="4" style="display:none;" readonly>
                                <input type="number" value="<?PHP echo $year;?>" name="year" min="1900" placeholder="AAAA" size="4" style="display:none;" readonly>
                                <td><input type="submit" class="btn btn-primary" name="idmos" value="<?php echo $idmos;?>"></td>
                                <input type="text" value="<?php echo $super;?>" name="super" style="display:none;">
                                <td><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></td>
                                <td><?php echo $folio_pisa;?></td>
                            </form>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
        </div>
        <div class="col-md-8">
            <div class="panel-heading" align="center">
                <label><h3>DATOS</h3></label>
            </div>
                <div style="background-color:;height:500px;overflow-y:scroll;">
                <?php
                if(isset($_GET['idmos'])){
                    $idorden=$_GET['idmos'];
                    //echo $idorden;
                }if(!isset($_GET['idmos'])){
                    $idorden=0;
                }
                //$sql1="SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden AND idmos='$idorden'";
                $sql1="SELECT * FROM os  WHERE  idmos='$idorden'";
                    $resultado=$con->query($sql1);
                    while($row = $resultado->fetch_assoc())
                    {
                        $idmosOS=$row['idmos'];
                        $cope=$row['cope'];
                        $expediente=$row['expediente'];
                        $folio_pisaplex=$row['folio_pisaplex'];
                        $telefono=$row['telefono'];
                        $cliente=$row['cliente'];
                        $tipo_tarea=$row['tipo_tarea'];
                        $distrito=$row['distrito'];
                        $zona=$row['zona'];
                        $dilacion_etapa=$row['dilacion_etapa'];
                        $dilacion=$row['dilacion'];
                        $folio_pisaOS=$row['folio_pisa'];
                        $ddcargaOS=$row['ddcarga'];
                        $mmcargaOS=$row['mmcarga'];
                        $yearcargaOS=$row['yearcarga'];
                        //$contOS=$contOS+1;
                    }
                ?>
                <table class="table">
                    <tr>
                        <td><b>ID:</b></td>
                        <td><b>FOLIO PISA</b></td>
                        <td><b>FOLIO PISAPLEX</b></td>
                        <td><b>COPE</b></td>
                    </tr>
                    <tr>
                        <td><?php echo $idmosOS;?></td>
                        <td><?php echo $folio_pisaOS;?></td>
                        <td><?php echo $folio_pisaplex;?></td>
                        <td><?php echo $cope;?></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td><b>EXPEDIENTE:</b></td>
                        <td><b>TELEFONO</b></td>
                        <td><b>CLIENTE</b></td>
                        <td><b>ZONA</b></td>
                    </tr>
                    <tr>
                        <td><?php echo $expediente;?></td>
                        <td><?php echo $telefono;?></td>
                        <td><?php echo $cliente;?></td>
                        <td><?php echo $zona;?></td>
                    </tr>
                </table>

                </div>
        </div>
    </div>
<!--************************************************-->
</div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>