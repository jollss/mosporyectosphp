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
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$idt=$_POST['idTec'];
$Super=new Usuario();
$Super->obtenerUsuarioBD($idt,$con);
$nombreS=$Super->regresaNombre();
$apS=$Super->regresaApaterno();
$amS=$Super->regresaAmaterno();
$super=$Super->regresaAsignado();
$idu=$Super->regresaIdu();
/*========================================*/
$idsuper=$_POST['idos'];
$osData=new Os();
$osData->obtenerOsFolioBD($idsuper,$con);
$cope=$osData->regresaCope();
$expediente=$osData->regresaExpediente();
$ddos=$osData->regresaDDOS();
$mmos=$osData->regresaMMOS();
$yearos=$osData->regresaYEAROS();
$foliopisaplex=$osData->regresaFolioPisaplex();
$foliopisa=$osData->regresaFolioPisa();
$tel=$osData->regresaTelefono();
$cliente=$osData->regresaCliente();
$tipotarea=$osData->regresaTipoTarea();
$distrito=$osData->regresaDistrito();
$zona=$osData->regresaZona();
$diletapa=$osData->regresaDilacionEtapa();
$dilacion=$osData->regresaDilacion();
$os=$osData->regresaAsignado();
$idmos=$osData->regresaIdmos();
/*========================================*/
$dataos=new Dataos();
$dataos->obtenerDataosOsBD($idmos,$con);
$observ=$dataos->regresaObservaciones();
$ddoos=$dataos->regresaDDOS();
$mmoos=$dataos->regresaMMOS();
$yearoos=$dataos->regresaYEAROS();
$horaoos=$dataos->regresaHORAOS();
$fechaC=$ddoos."/".$mmoos."/".$yearoos." ".$horaoos;
$ddasig=$dataos->regresaDDASIG();
$mmasig=$dataos->regresaMMASIG();
$yearasig=$dataos->regresaYEARASIG();
$fechaAs=$ddasig."/".$mmasig."/".$yearasig;
$principal=$dataos->regresaPrincipal();
$secundario=$dataos->regresaSecundario();
$clarov=$dataos->regresaClaroVideo();
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
            <div class="panel-heading">
                <?php echo $dia."/".$mes."/".$aaaa;?>
                <label>
                    <form action="bajanteTecnicoOs.php" method="POST" >
                            <input type="text" name="iduser" value="<?php echo $os;?>" style="display:none;">
                            <input type="image" src="../syspic/back.png" width="30" height="30" alt="Submit">
                    </form>
                </label>
                <div align="center">
                    <label><?php echo $nombreS." ".$apS." ".$amS;?></label>
                </div> 
            </div>
            <div class="panel-body" style="background-color:gray;">
                <div class="col-md-6">
                    <div class="panel panel-info">
                    <div class="panel-heading">Datos de OS</div>
                    <div class="panel-body">
                        <table border="" class="table">
                            <tr><th>Cope:</th><td> <?php echo $cope;?></td></tr>
                            <tr><th>Expediente: </th><td><?php echo $expediente;?></td></tr>
                            <tr><th>Fecha de Carga: </th><td><?php echo $ddos."/".$mmos."/".$yearos;?></td></tr>
                            <tr><th>Folio Pisaplex:</th><td> <?php echo $foliopisaplex;?></td></tr>
                            <tr><th>Folio Pisa: </th><td><?php echo $foliopisa;?></td></tr>
                            <tr><th>Teléfono: </th><td><?php echo $tel;?></td></tr>
                            <tr><th>Cliente: </th><td><?php echo $cliente;?></td></tr>
                            <tr><th>Tipo Tarea: </th><td><?php echo $tipotarea;?></td></tr>
                            <tr><th>Distrito: </th><td><?php echo $distrito;?></td></tr>
                            <tr><th>Zona: </th><td><?php echo $zona;?></td></tr>
                            <tr><th>Dilacion Etapa: </th><td><?php echo $diletapa;?></td></tr>
                            <tr><th>Dilacion: </th><td><?php echo $dilacion;?></td></tr>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-info">
                    <div class="panel-heading">Datos de Cierre de OS</div>
                    <div class="panel-body">
                        <table border="" class="table">
                            <tr><th>Observaciones:</th><td> <?php echo $observ;?></td></tr>
                            <tr><th>Fecha de cierre: </th><td><?php echo $fechaC;?></td></tr>
                            <tr><th>Fecha de asignacion: </th><td><?php echo $fechaAs;?></td></tr>
                            <tr><th>Principal:</th><td> <?php echo $principal;?></td></tr>
                            <tr><th>Secundario: </th><td><?php echo $secundario;?></td></tr>
                            <tr><th>Claro Video: </th><td><?php echo $clarov;?></td></tr>
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