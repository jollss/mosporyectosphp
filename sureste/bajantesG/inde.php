<?php
include("../Config/library.php"); 
//include("../Config/conexionUser.php");  
$con = Conectarse();  
//$con2 = ConectarseMain();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

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
    bajantesG($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>  
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Supervisores Exclusivo OCCIDENTE</div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                        <td></td>
                        <td>ID</td>
                        <td>NOMBRE COMPLETO</td>
                        <td>CORREO</td>
                        <td></td>
                    </tr>
                    <?php
                    $sql="SELECT * FROM usuario 
                    WHERE activo=1 and tipo_idtipo=3";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $idu=$row['idu'];
                        $correo=$row['correo'];
                        $nom=$row['nombre'];
                        $apepa=$row['apaterno'];
                        $apma=$row['amaterno'];
                        $nomcompleto=$nom." ".$apepa." ".$apma;
                        ?>
                        <form action="tecnicosA.php" method="POST">
                        <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>
                            <tr>
                                <th><input type="submit" value="Ver Ordenes" class="btn btn-success"></th>
                                <th><?php echo $idu;?></th>
                                <th><?php echo $nomcompleto;?></th>
                                <th><?php echo $correo;?></th>
                            
                        </form>
                        <form action="bolsaCarga.php" method="POST">
                            <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>                                
                            <th><input type="submit" value="BOLSA" class="btn btn-primary"></th>
                        </form>
                            </tr>
                        <?php
                    }
                    /*
                        $totales=new Usuario();
                        $total=$totales->TotalUBD($con);
                        echo $total;
                        for ($i=0; $i <= $total; $i++) { 
                            $supervisor=new Usuario();
                            $supervisor->obtenerUsuarioBD($i,$con);
                            $tipo=$supervisor->regresaTipoIdTipo();
                            $activo=$supervisor->regresaActivo();
                            echo $i."-".$tipo."-".$activo."<br>";
                            if($tipo==3 && $activo==1){
                                $idu=$supervisor->regresaIdu();
                                $correo=$supervisor->regresaCorreo();
                                $nom=$supervisor->regresaNombre();
                                $apepa=$supervisor->regresaApaterno();
                                $apma=$supervisor->regresaAmaterno();
                                $nomcompleto=$nom." ".$apepa." ".$apma;
                                ?>
                                <form action="tecnicosA.php" method="POST">
                                <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>
                                    <tr>
                                        <th><input type="submit" value="Ver Ordenes" class="btn btn-success"></th>
                                        <th><?php echo $idu;?></th>
                                        <th><?php echo $nomcompleto;?></th>
                                        <th><?php echo $correo;?></th>
                                    
                                </form>
                                <form action="bolsaCarga.php" method="POST">
                                    <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>                                
                                    <th><input type="submit" value="BOLSA" class="btn btn-primary"></th>
                                </form>
                                    </tr>
                                <?php
                            }
                        }*/
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2" ></div>
<div class="col-md-2"></div>

<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>