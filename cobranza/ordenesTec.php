<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$tecnicoo=$_POST['tecnico'];
$super=$_POST['supervisor'];
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
    cobranza($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>  
</head>
<body>
<br><br><br><br>
<!--<div class="col-md-12" style="background-color:black;">-->
<div class="col-md-12 panel panel-primary">
    <div class="panel-heading">
    <?php
    $tecnico=new Usuario();
    $tecnico->obtenerUsuarioBD($tecnicoo,$con);
    $n=$tecnico->regresaNombre();
    $ap=$tecnico->regresaApaterno();
    $am=$tecnico->regresaAmaterno();
    $nomc=$n." ".$ap." ".$am;
    echo "<h3>Ordenes de ".$nomc."</h3>";
    ?>
    <form action="tecnicosA.php" method="POST">
        <input type="text" value="<?php echo $super;?>" style="display:none;" name="super" readonly>
        <input type="image" src="../syspic/back.png" width="40" height="40">
    </form>
    </div>
<!--************************************************-->
    <div class="table-responsive panel-body">
        <div class="col-md-4">
            <div class="panel-heading" align="center">
                <label><h3>PENDIENTES</h3></label>
            </div>
                <div  style="background-color:;height:500px;overflow-y:scroll;">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td><b>ID</b></td>
                            <td><b>FOLIO PISA</b></td>
                            <td><b>FOLIO PISAPLEX</b></td>
                            <td><b>FECHA DE ASIGNACION</b></td>
                        </tr>
                        <?php
                        $totalOsO=new Os();
                        $totaluno=$totalOsO->totalesOs($con);
                        //$datos=new Dataos();
                        //$totaluno=$datos->TotalDataosBD($con);
                        $cont1=0;
                        for ($i=$totaluno; $i >= 0; $i--) {
                                $orden=new Os();
                                $data=new Dataos();
                                //$orden->obtenerOsFolioBD($i,$con);
                                $orden->obtenerOsFolioOrderBD($i,$con);
                                $asignado=$orden->regresaAsignado();
                                $idmos=$orden->regresaIdmos();
                                $pisa=$orden->regresaFolioPisa();
                                $pisaplex=$orden->regresaFolioPisaplex();
                                $data->obtenerDataosOsBD($idmos,$con);
                                $estatus=$data->regresaEstatus();
                                //$diaos=$data->regresaDDOS();
                                //$mmos=$data->regresaMMOS();
                                //$aaaos=$data->regresaYEAROS();
                                //$hos=$data->regresaHORAOS();
                                $diaos=$data->regresaDDASIG();
                                $mmos=$data->regresaMMASIG();
                                $aaaos=$data->regresaYEARASIG();
                            if($asignado==$tecnicoo && $estatus==0){
                                $cont1=$cont1+1;
                                ?>
                                <tr>
                                <form action="dataosT.php" method="POST">
                                <input type="text" value="<?php echo $tecnicoo;?>" name="tecnico" style="display:none;" readonly>
                                <input type="text" value="<?php echo $super;?>" name="supervisor" style="display:none;" readonly>
                                    <td><?php echo $cont1;?></td>
                                    <td><input type="submit" class="btn btn-primary" name="idmos" value="<?php echo $idmos;?>"></td>
                                    <td><?php echo $pisa;?></td>
                                    <td><?php echo $pisaplex;?></td>
                                    <td style="color:blue;"><label><?php echo $diaos." - ".$mmos." - ".$aaaos;?></label></td>
                                </form>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
        </div>
        <div class="col-md-4">
            <div class="panel-heading" align="center">
                <label><h3>OBJETADAS</h3></label>
            </div>
                <div  style="background-color:;height:500px;overflow-y:scroll;">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td><b>ID</b></td>
                            <td><b>FOLIO PISA</b></td>
                            <td><b>FOLIO PISAPLEX</b></td>
                            <td><b>FECHA DE OBJECION</b></td>
                        </tr>
                        <?php
                            $totalOsO=new Os();
                            $totaluno=$totalOsO->totalesOs($con);
                            //for ($i=0; $i <= $totaluno; $i++) { 
                            /*
                            $con->real_query("SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden ");
                            $resultado = $con->use_result();
                            while ($row = $resultado->fetch_assoc()){
                                $tos++;
                            }
                            */
                            $cont2=0;
                        for ($i=$totaluno; $i >= 0; $i--) {
                                $orden=new Os();
                                $data=new Dataos();
                                //$orden->obtenerOsFolioBD($i,$con);
                                $orden->obtenerOsFolioOrderBD($i,$con);
                                $asignado=$orden->regresaAsignado();
                                $idmos=$orden->regresaIdmos();
                                $pisa=$orden->regresaFolioPisa();
                                $pisaplex=$orden->regresaFolioPisaplex();
                                $data->obtenerDataosOsBD($idmos,$con);
                                $estatus=$data->regresaEstatus();
                                $diaos=$data->regresaDDOS();
                                $mmos=$data->regresaMMOS();
                                $aaaos=$data->regresaYEAROS();
                                $hos=$data->regresaHORAOS();
                            if($asignado==$tecnicoo && $estatus==1){
                                $cont2=$cont2+1;
                                ?>
                                <tr>
                                <form action="dataosT.php" method="POST">
                                    <input type="text" value="<?php echo $tecnicoo;?>" name="tecnico" style="display:none;" readonly>
                                    <input type="text" value="<?php echo $super;?>" name="supervisor" style="display:none;" readonly>
                                    <td><?php echo $cont2;?></td>
                                    <td><input type="submit" class="btn btn-danger" name="idmos" value="<?php echo $idmos;?>"></td>
                                    <td><?php echo $pisa;?></td>
                                    <td><?php echo $pisaplex;?></td>
                                    <td style="color:red;"><label><?php echo $diaos." - ".$mmos." - ".$aaaos." ".$hos;?></label></td>
                                </form>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
        </div>
        <div class="col-md-4">
            <div class="panel-heading" align="center">
                <label><h3>LIQUIDADAS</h3></label>
            </div>
                <div  style="background-color:;height:500px;overflow-y:scroll;">
                    <table class="table">
                        <tr>
                            <td><b>ID</b></td>
                            <td><b>FOLIO PISA</b></td>
                            <td><b>FOLIO PISAPLEX</b></td>
                            <td><b>FECHA DE OBJECION</b></td>
                        </tr>
                        <?php
                        $totalOsO=new Os();
                        $totaluno=$totalOsO->totalesOs($con);
                        //for ($i=0; $i <= $totaluno; $i++) { 
                        $cont3=0;
                        for ($i=$totaluno; $i >= 0; $i--) {
                            $orden=new Os();
                            $data=new Dataos();
                            //$orden->obtenerOsFolioBD($i,$con);
                            $orden->obtenerOsFolioOrderBD($i,$con);
                            $asignado=$orden->regresaAsignado();
                            $idmos=$orden->regresaIdmos();
                            $pisa=$orden->regresaFolioPisa();
                            $pisaplex=$orden->regresaFolioPisaplex();
                            $data->obtenerDataosOsBD($idmos,$con);
                            $estatus=$data->regresaEstatus();
                            $diaos=$data->regresaDDOS();
                            $mmos=$data->regresaMMOS();
                            $aaaos=$data->regresaYEAROS();
                            $hos=$data->regresaHORAOS();
                            if($asignado==$tecnicoo && $estatus==2){
                                $cont3=$cont3+1;
                                ?>
                                <tr>
                                <form action="dataosT.php" method="POST">
                                    <input type="text" value="<?php echo $tecnicoo;?>" name="tecnico" style="display:none;" readonly>
                                    <input type="text" value="<?php echo $super;?>" name="supervisor" style="display:none;" readonly>
                                    <td><?php echo $cont3;?></td>
                                    <td><input type="submit" class="btn btn-success" name="idmos" value="<?php echo $idmos;?>"></td>
                                    <td><?php echo $pisa;?></td>
                                    <td><?php echo $pisaplex;?></td>
                                    <td style="color:green;"><label><?php echo $diaos." - ".$mmos." - ".$aaaos." ".$hos;?></label></td>
                                </form>
                                </tr>
                                <?php
                            }
                        }
                        ?>
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