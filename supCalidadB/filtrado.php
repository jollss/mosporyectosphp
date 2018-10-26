<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserG.js"></script>
<?php
    supBajantes($user);
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
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Filtrado -- Fecha Actual <?php echo $dia."/".$mes."/".$aaaa;?></b></div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <label>Filtrado por mes y año.</label>
            </div>
            <!--
                <div align="center">
                    <form accept-charset="utf-8" method="POST">
                        <div class="form-group">
                            <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="Número de Orden o id MOS" id="bus">
                        </div>
                    </form>
                </div>
            -->
                <form action="filtrado.php" method="GET">
                    <div class="col-md-4">
                        <div class="well">
                            <label>Fecha de inicio</label>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1 max=31 placeholder="DD" name="iddcarga"  required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control"  min=1 max=12 placeholder="MM" name="immcarga" required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control"  min=1990 max=<?php echo $aaaa;?> placeholder="YYYY" name="iyyyycarga"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <label>Fecha de fin</label>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1 max=31 placeholder="DD" name="fddcarga"    required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1 max=12 placeholder="MM" name="fmmcarga" value="<?php echo $mes;?>" required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1990 max=<?php echo $aaaa;?> placeholder="YYYY" name="fyyyycarga" value="<?php echo $aaaa;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <div class="form-group col-xl-2">
                                <select class="form-control" name="tipo">
                                    <option value="1">Fecha de carga</option>
                                    <option value="2">Fecha de asignacion</option>
                                    <option value="3">Fecha de objecion</option>
                                    <option value="4">Fecha de liquidacion</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="submit" class="btn btn-primary" value="BUSCAR">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div id="resultadoBusqueda"></div>
            <?php
                if(!isset($_GET['iddcarga'],$_GET['immcarga'],$_GET['iyyyycarga'],$_GET['fddcarga'],
                    $_GET['fddcarga'],$_GET['fddcarga'],$_GET['tipo']))
                {
                    ?>
                    <div class="panel panel-info" align="center">
                        <label>Sin datos por filtrar aún.</label>
                    </div>
                    <?php
                }else{
                    ?>
                    <table border="1" class="table">
                                    <tr>
                                        <th>IDMOS</th>
                                        <th>Folio Pisaplex</th>
                                        <th>Folio Pisa</th>
                                        <th>Teléfono</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Tecnico</th>
                                    </tr>
                    <?php
                    $di=$_GET['iddcarga'];
                    $mi=$_GET['immcarga'];
                    $yi=$_GET['iyyyycarga'];
                    
                    $df=$_GET['fddcarga'];
                    $mf=$_GET['fmmcarga'];
                    $yf=$_GET['fyyyycarga'];
                    $tipo=$_GET['tipo'];
                    if($tipo==1){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                        
                    }
                    if($tipo==2){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                    }if($tipo==3){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                    }if($tipo==4){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                    }
                }
            ?>                
        </div>
    </div>
    <div class="col-md-1" ></div>
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>