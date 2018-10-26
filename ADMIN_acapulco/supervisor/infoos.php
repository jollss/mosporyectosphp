<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();


$idus=$_POST['ident'];
$Tecnico=new Usuario();
$Tecnico->obtenerUsuarioBD($idus,$con);
$nus=$Tecnico->regresaNombre();
$apus=$Tecnico->regresaApaterno();
$amus=$Tecnico->regresaAmaterno();
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
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="panel panel-info">

            <div class="panel-heading">Informe</div>
            <div class="panel-body">
            <table class="table">
                <tr>
                      <th>ID MOS</th>
                      <th>Cope</th>
                      <th>Fecha de Asignacion</th>
                      <th>Folio Pisaplex</th>
                      <th>Folio Pisa</th>
                      <th>Distrito</th>
                      <th>Zona</th>
                      <th>Tipo de Tarea</th>
                </tr>
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana=date('W');
                    echo "<br> Usuario : ".$nus." ".$apus." ".$amus;
                    $TotalOs=new Os();
                    $cuenta=0;
                    $totales=0;
                    //$totales=$TotalOs->totalesOs($iduser,$con);
                    //$totales=$TotalOs->totalesOs($con);
                    //echo $totales;
                    $con->real_query("SELECT * FROM os");
                    $r = $con->use_result();
                    while ($l = $r->fetch_assoc()){
                        $totales=$l['idmos'];
                    }
                    //echo $totales;
                    for ($i=0; $i <= $totales; $i++) { 
                        $os=new Os();
                        $os->obtenerOsBD($i,$con);
                        $tecnicoA=$os->regresaAsignado();
                        $estado=$os->regresaEstadoOs();
                        $idmos=$os->regresaIdmos();
                        $estados=new Dataos();
                        $estados->obtenerDataosOsBD($idmos,$con);
                        $activos=$estados->regresaEstatus();
                        //echo $tecnicoA."-".$idus."<br>";
                        if($tecnicoA==$idus && $estado==0 && $activos==0 ){
                        $cope=$os->regresaCope();
                        $ddmos=$os->regresaDDOS();
                        $mmos=$os->regresaMMOS();
                        $yearos=$os->regresaYEAROS();
                        $folio_pisaplex=$os->regresaFolioPisaplex();
                        $folio_pisa=$os->regresaFolioPisa();
                        $telefono=$os->regresaTelefono();
                        $tipo_tarea=$os->regresaTipoTarea();
                        $distrito=$os->regresaDistrito();
                        $zona=$os->regresaZona();
                    ?>
                        <tr>
                            
                            <!--<th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idmos?>"></th>-->
                            <th><?php echo $idmos?></th>
                            <th><?php echo $cope;?></th>
                            <th><?php echo $ddmos."/".$mmos."/".$yearos;?></th>
                            <th><?php echo $folio_pisaplex;?></th>
                            <th><?php echo $folio_pisa;?></th>
                            <th><?php echo $distrito;?></th>
                            <th><?php echo $zona;?></th>
                            <th><?php echo $tipo_tarea;?></th>
                        </tr>
                        <!--
                        <form action="endU.php" method="POST">
                            <tr>
                                <td><b>    Agregar orden de servicio </b></td>
                                <td>
                                    <input class="btn btn-success" name="addident" type="submit" value="<?php echo $idus;?>">
                                </td>
                            </tr>
                         </form>
                         -->
                 <?php
                        }else
                        {

                        }
                 }
                 ?>
                </table>
           
            <div align="center">
                <div id="graph2" class="responsive" style="min-width: 100%; height: 100%;margin: 0 auto"></div>
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
</script>
</body>
</html>