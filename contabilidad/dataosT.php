<?php
include("../Config/library.php"); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$tecnicoo=$_POST['tecnico'];
$super=$_POST['supervisor'];
$idmos=$_POST['idmos'];
/*-------------------------*/
$orden=new Os();
$orden->obtenerOsBD($idmos,$con);
$cope=$orden->regresaCope();
$expediente=$orden->regresaExpediente();
$dos=$orden->regresaDDOS();
$mos=$orden->regresaMMOS();
$yos=$orden->regresaYEAROS();
$pisaplex=$orden->regresaFolioPisaplex();
$folio_pisa=$orden->regresaFolioPisa();
$tel=$orden->regresaTelefono();
$clientes=$orden->regresaCliente();
$tarea=$orden->regresaTipoTarea();
$distrito=$orden->regresaDistrito();
$zona=$orden->regresaZona();
$dilacion_etapa=$orden->regresaDilacionEtapa();
$dilacion=$orden->regresaDilacion();
$asignado=$orden->regresaAsignado();
$estado=$orden->regresaEstadoOs();
/*=====================================*/

$datosOS=new Dataos();
$total=$datosOS->TotalDataosBD($con);
//for ($i=0; $i <=$total ; $i++) { 
$datosOS->obtenerDataosOsBD($idmos,$con);
//$datosOS->regresaSupervisorIdu();
$tecnicoasig=$datosOS->regresaTecnicoAsignacionIdu();
//if($tecnicoasig==$tecnicoo){
    $IDDATA=$datosOS->regresaIddataos();
    $estatus=$datosOS->regresaEstatus();
    $observaciones=$datosOS->regresaObservaciones();
    $ddos=$datosOS->regresaDDOS();
    $mmos=$datosOS->regresaMMOS();
    $yearos=$datosOS->regresaYEAROS();
    $horaos=$datosOS->regresaHORAOS();
    //$idorden=$datosOS->regresaIdOrden();
    $fileos=$datosOS->regresaFileOs();
    $ddasig=$datosOS->regresaDDASIG();
    $mmasig=$datosOS->regresaMMASIG();
    $yearasig=$datosOS->regresaYEARASIG();
    $principal=$datosOS->regresaPrincipal();
    $secundario=$datosOS->regresaSecundario();
    $clarovideo=$datosOS->regresaClaroVideo();
    $tipoos=$datosOS->regresaTipoOs();
    $alfanumerico=$datosOS->regresaAlfanumerico();
    $serie=$datosOS->regresaSerie();
//}
//}
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
<div class="col-md-12 panel panel-primary">
    <div class="panel-heading">
        <?php
        $tecnico=new Usuario();
        $tecnico->obtenerUsuarioBD($tecnicoo,$con);
        $n=$tecnico->regresaNombre();
        $ap=$tecnico->regresaApaterno();
        $am=$tecnico->regresaAmaterno();
        $nomc=$n." ".$ap." ".$am;
        echo "<h3>Orden de ".$nomc."</h3>";
        ?>
        <form action="ordenesTec.php" method="POST">
            <input type="text" value="<?php echo $super;?>" style="display:none;" name="super" readonly>
            <input type="text" value="<?php echo $tecnicoo;?>" style="display:none;" name="tecnico" readonly>
            <input type="image" src="../syspic/back.png" width="40" height="40">
        </form>
    </div>
<!--************************************************-->
    <div class="table-responsive panel-body">
        <div class="col-md-6 panel panel-primary">
            <div class="panel-heading" align="center">
                <label>Datos de Orden</label>
            </div>
            <div  style="background-color:;">
                <table class="table">
                <tr>
                    <th>Cope: </th>
                    <td><?php echo $cope;?></td>
                    <th>Expediente: </th>
                    <td><?php echo $expediente;?></td>
                    <th>Fecha de Carga: </th>
                    <td><?php echo $dos."-".$mos."-".$yos;?></td>
                </tr>
                <tr>
                    <th>Pisaplex: </th>
                    <td><?php echo $pisaplex;?></td>
                    <th>Folio Pisa: </th>
                    <td><?php echo $folio_pisa;?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Teléfono: </th>
                    <td><?php echo $tel;?></td>
                    <th></th>
                    <td></td>
                    <th>Folio Pisa: </th>
                    <td><?php echo $folio_pisa;?></td>
                </tr>
                <tr>
                    <th>Tarea: </th>
                    <td><?php echo $tarea;?></td>
                    <th>Distrito: </th>
                    <td><?php echo $distrito;?></td>
                    <th>Zona: </th>
                    <td><?php echo $zona;?></td>
                </tr>
                <tr>
                    <th>Dilacion: </th>
                    <td><?php echo $dilacion;?></td>
                    <th>Dilacion Etapa: </th>
                    <td><?php echo $dilacion_etapa;?></td>
                    <th></th>
                    <td></td>
                </tr>  
                </table>
            </div>
        </div>
        
        <div class="col-md-6 panel panel-primary">
            <div class="panel-heading" align="center">
                <label>Informacion</label>
            </div>
            <div  style="background-color:;">
                <table class="table">
                <tr>
                    <th>Observaciones: </th>
                    <td><?php echo $observaciones;?></td>
                    <th>Fecha de Trabajo: </th>
                    <td><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Principal: </th>
                    <td><?php echo $principal;?></td>
                    <th>Secundario: </th>
                    <td><?php echo $secundario;?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Claro Video: </th>
                    <td><?php echo $clarovideo;?></td>
                    <th>Tipo de Orden: </th>
                    <td><?php echo $tipoos;?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Alfanumerico: </th>
                    <td><?php echo $alfanumerico;?></td>
                    <th>Serie: </th>
                    <td><?php echo $serie;?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                <!--
                    <th>Archivo de Orden: </th>
                    <td>
                    <?php 
                    echo "Archivo".$fileos." - ".$IDDATA;
                        if($fileos==''){
                            ?>
                            <label>No hay archivo de orden</label>
                            <?php
                        }else{
                            ?>
                            <a href="../os/<?php echo $fileos;?>"><img src="../syspic/see.png" width="30" height="30"></a>
                            <?php
                        }
                    ?>
                    </td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                -->
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