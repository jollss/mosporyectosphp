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
$con->real_query("SELECT * FROM os inner join dataos where idmos=id_orden and estatus=0 and asignado='$idus'");
$resultado = $con->use_result();
while ($row = $resultado->fetch_assoc()){
    $tos=$tos+1;
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

<?php
    nivel1($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <div class="panel panel-info">

            <div class="panel-heading">Ordenes de Servicio Pendientes de <b>
              <?php echo $name." ".$ap." ".$am; ?><h3><?php echo $tos; ?></b></h3>
              tu menta mensual deberia de ser 48 ordenes de servicio
              de las cuales llevas<br>
              <progress max="48" value="1" ></progress>48
            </div>

            <div class="panel-body">
            <div align="center">

            </div>
                <form action=" dataos.php" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                              <th>ID MOS</th>
                              <th>Cope</th>
                              <th>Teléfono</th>
                              <th>Fecha de Asignacion</th>
                              <th>Folio Pisaplex</th>
                              <th>Folio Pisa</th>
                              <th>Distrito</th>
                              <th>Zona</th>
                              <th>Tipo de Tarea</th>
                            </tr>
                            <?php

                            $tecnicOsS=new Os();
                            //$totalos=$tecnicOsS->totalesOs($con);
                            $totalose=0;
                            $con->real_query("SELECT * FROM os");
                            $resultado = $con->use_result();
                            while ($row = $resultado->fetch_assoc()){
                                $totalose=$row['idmos'];
                            }
                            $con->real_query("SELECT * FROM os inner join dataos where idmos=id_orden and estatus=0 and asignado='$idus'");
                            $resultado = $con->use_result();
                            while ($row = $resultado->fetch_assoc()){
                                $idmos=$row['idmos'];
                                $cope=$row['cope'];
                                $ddmos=$row['ddasig'];
                                $mmos=$row['mmasig'];
                                $yearos=$row['yearasig'];
                                $folio_pisaplex=$row['folio_pisaplex'];
                                $folio_pisa=$row['folio_pisa'];
                                $telefono=$row['telefono'];
                                $tipo_tarea=$row['tipo_tarea'];
                                $distrito=$row['distrito'];
                                $zona=$row['zona'];
                                    ?>
                                    <tr>
                                        <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idmos?>"></th>
                                        <th><?php echo $cope;?></th>
                                        <th><?php echo $telefono;?></th>
                                        <th><?php echo $ddmos."/".$mmos."/".$yearos;?></th>
                                        <th><?php echo $folio_pisaplex;?></th>
                                        <th><?php echo $folio_pisa;?></th>
                                        <th><?php echo $distrito;?></th>
                                        <th><?php echo $zona;?></th>
                                        <th><?php echo $tipo_tarea;?></th>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<div class="col-md-12"></div>
<?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
