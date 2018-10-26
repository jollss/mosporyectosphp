<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
$name=$Yo->regresaNombre();
$ap=$Yo->regresaApaterno();
$am=$Yo->regresaAmaterno();
$tos=0;
$tecnicOs=new Os();
$totalos=$tecnicOs->totalesOs($con);
for ($i=0; $i <=$totalos; $i++) { 
    //echo "valor de tos".$tos."<br>";
    $tecnicOs->obtenerOsBD($i,$con);
    $asignado=$tecnicOs->regresaAsignado();
    $idmos=$tecnicOs->regresaIdmos();
    $estado=new Dataos();
    $estado->obtenerDataosOsBD($idmos,$con);
    $activos=$estado->regresaEstatus();
    //echo "idmos fuera:".$idmos."<br>";
    if($asignado==$idus && $activos==0){

        $tos++;
      //  echo "os:".$idmos."-activos".$activos."-valor tos:".$tos."<br>";
    }
}
    //echo $totalos;
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
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Ordenes de Servicio Pendientes de <b><?php echo $name." ".$ap." ".$am; ?><h3><?php echo $tos; ?></b></h3></div>
            <div class="panel-body">
            <div align="center">
            </div>
                <form action=" dataos.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                            for ($i=0; $i <= $totalos; $i++) { 
                                $Os=new Os();
                                $Os->obtenerOsBD($i,$con);
                                $idmos=$Os->regresaIdmos();
                                $asignado=$Os->regresaAsignado();
                                $estado=new Dataos();
                                $estado->obtenerDataosOsBD($idmos,$con);
                                $activos=$estado->regresaEstatus();
                                if($asignado==$idus && $activos==0){
                                    $cope=$Os->regresaCope();
                                    $ddmos=$Os->regresaDDOS();
                                    $mmos=$Os->regresaMMOS();
                                    $yearos=$Os->regresaYEAROS();
                                    $folio_pisaplex=$Os->regresaFolioPisaplex();
                                    $folio_pisa=$Os->regresaFolioPisa();
                                    $telefono=$Os->regresaTelefono();
                                    $tipo_tarea=$Os->regresaTipoTarea();
                                    $distrito=$Os->regresaDistrito();
                                    $zona=$Os->regresaZona();
                                    ?>
                                    <tr>
                                        <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idmos?>"></th>
                                        <th><?php echo $cope;?></th>
                                        <th><?php echo $ddmos."/".$mmos."/".$yearos;?></th>
                                        <th><?php echo $folio_pisaplex;?></th>
                                        <th><?php echo $folio_pisa;?></th>
                                        <th><?php echo $distrito;?></th>
                                        <th><?php echo $zona;?></th>
                                        <th><?php echo $tipo_tarea;?></th>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
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