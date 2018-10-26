<?php
ob_start();
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
$cantidad_resultados_por_pagina = 20;
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser2.js"></script>
        
<?php
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Reasignacion de trabajo</div>
            <div class="panel-body" style="background-color:gray;">
            <?php
            //$folioP=$_GET['folioP'];
            if(!isset($_GET['folioP'])){$folioP=0;}else{$folioP=$_GET['folioP'];}
            ?>
            <div align="left">
              <form action="reAdd.php" method="GET">
                <div class="input-group">
                  <input type="text" class="form-control input-sm" name="folioP" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                      <i class="glyphicon glyphicon-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div align="center" style="background-color:white;">
              <table class="table table-bordered" style="background-color:white;font-size:11px">
                <tr style="font-size:12px;">
                  <th>ID MOS</th>
                  <th>Cope</th>
                  <th>Expediente</th>
                  <th>Fecha de Carga</th>
                  <th>Folio Pisaplex</th>
                  <th>Folio Pisa</th>
                  <th>Teléfono</th>
                  <th>Cliente</th>
                  <th>Tipo de Tarea</th>
                  <!--<th>Tecnologia</th>-->
                  <th>Distrito</th>
                  <th>Zona</th>
                  <th>Dilacion Etapa</th>
                  <th>Dilacion</th>
                </tr>
                <form action="reAddF.php" method="POST">
                            <?php
                            //for ($i=$empezar_desde; $i <= $paginas; $i++) { 
                              $Orden = new Os();
                              $Orden->obtenerOsFolioPBD($folioP,$con);
                              $activo=$Orden->regresaEstadoOs();
                              $id=$Orden->regresaIdmos();
                              $asignado=$Orden->regresaAsignado();
                              $super=$Orden->regresaUsuarioIdu();
                              //echo $asignado;
                              if($asignado!=0  and $super==$iduser){
                                
                                /*----------------*/
                                $dataos=new Dataos();
                                $existe=$dataos->ExisteDataos($id,$con);
                                $estatus=$dataos->regresaEstatus();

                                  /*----------------*/
                                  $cope=$Orden->regresaCope();
                                  $expediente=$Orden->regresaExpediente();
                                  $ddcarga=$Orden->regresaDDOS();
                                  $mmcarga=$Orden->regresaMMOS();
                                  $yearcarga=$Orden->regresaYEAROS();
                                  $folio_pisaplex=$Orden->regresaFolioPisaplex();
                                  $folio_pisa=$Orden->regresaFolioPisa();
                                  $telefono= $Orden->regresaTelefono();
                                  $cliente= $Orden->regresaCliente();
                                  $tipo_tarea= $Orden->regresaTipoTarea();
                                  $tecnologia=$Orden-> regresaTecnologia();
                                  $distrito= $Orden->regresaDistrito();
                                  $zona= $Orden->regresaZona();
                                  $dilacion_etapa= $Orden->regresaDilacionEtapa();
                                  $dilacion=$Orden-> regresaDilacion();
                                  $asignado=$Orden-> regresaAsignado();
                                  ?>
                                  
                                  <tr>
                                    <th><input class="btn btn-info"  name="ident" type="submit" value="<?php echo $id;?>"></th>
                                    <th><?php echo $cope;?></th>
                                    <th><?php echo $expediente;?></th>
                                    <th><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></th>
                                    <th><?php echo $folio_pisaplex;?></th>
                                    <th><?php echo $folio_pisa;?></th>
                                    <th><?php echo $telefono;?></th>
                                    <th><?php echo $cliente;?></th>
                                    <th><?php echo $tipo_tarea;?></th>
                                    <!--<th><?php echo $tecnologia;?></th>-->
                                    <th><?php echo $distrito;?></th>
                                    <th><?php echo $zona;?></th>
                                    <th><?php echo $dilacion_etapa;?></th>
                                    <th><?php echo $dilacion;?></th>
                                  </tr>
                                
                                  <?php
                                
                                }else{}
                           // }
                            ?>
                            </form>
              </table>
            </div>
              <?php
              $dia=date('j');
              $mes=date('n');
              $aaaa=date('Y');
              $semana = date("W");
              ?>
            <div align="center" style="height:500px;overflow-y:scroll;">
                 <div id="">                   
                    <div class="table-responsive" >
                        <table class="table table-bordered" style="background-color:white;font-size:11px">
                            <tr style="font-size:12px;">
                              <th></th>
                              <th>ID MOS</th>
                              <th>Cope</th>
                              <th>Expediente</th>
                              <th>Fecha de Carga</th>
                              <th>Folio Pisaplex</th>
                              <th>Folio Pisa</th>
                              <th>Teléfono</th>
                              <th>Cliente</th>
                              <th>Tipo de Tarea</th>
                              <!--<th>Tecnologia</th>-->
                              <th>Distrito</th>
                              <th>Zona</th>
                              <th>Dilacion Etapa</th>
                              <th>Dilacion</th>
                            </tr>
                            <div>
                              <form action="reAddF.php" method="POST">
                              <?php
                              $int=0;
                              
                              //echo "<br>".$empezar_desde."--".$total_registros;
                              //echo $paginas;
                              $tOs=new Os();
                              $totalAux=$tOs->totalesOs($con);
                              //$total=$tOs->totalesOs($con);
                              //echo $totalAux;
                              //for ($i=0; $i <= $totalAux; $i++) { 
                              for ($i=$totalAux; $i >= 0; $i--) {
                                $Orden = new Os();
                                $Orden->obtenerOsBD($i,$con);
                                $activo=$Orden->regresaEstadoOs();
                                $id=$Orden->regresaIdmos();
                                $asignado=$Orden->regresaAsignado();
                                $super=$Orden->regresaUsuarioIdu();
                                //echo $asignado;
                                //if($activo==0 and $id>=$empezar_desde and $id<=$total_registros and $asignado==0 and $id!=0){
                                if($asignado!=0  and $super==$iduser){
                                  $int=$int+1;
                                  $cope=$Orden->regresaCope();
                                  $expediente=$Orden->regresaExpediente();
                                  $ddcarga=$Orden->regresaDDOS();
                                  $mmcarga=$Orden->regresaMMOS();
                                  $yearcarga=$Orden->regresaYEAROS();
                                  $folio_pisaplex=$Orden->regresaFolioPisaplex();
                                  $folio_pisa=$Orden->regresaFolioPisa();
                                  $telefono= $Orden->regresaTelefono();
                                  $cliente= $Orden->regresaCliente();
                                  $tipo_tarea= $Orden->regresaTipoTarea();
                                  $tecnologia=$Orden-> regresaTecnologia();
                                  $distrito= $Orden->regresaDistrito();
                                  $zona= $Orden->regresaZona();
                                  $dilacion_etapa= $Orden->regresaDilacionEtapa();
                                  $dilacion=$Orden-> regresaDilacion();
                                  $asignado=$Orden-> regresaAsignado();
                                  $con1 = Conectarse();
                                  $etapa='';
                                  $listo='';
                                  $sql1="SELECT * from tienda_comercial where folio_os='$folio_pisa'";
                                  $r1=$con1->query($sql1);
                                  while($row1 = $r1->fetch_assoc())
                                  { 
                                    $etapa=$row1['etapa'];
                                    $listo=$row1['listo_ps'];
                                  }
                                  ?>
                                  
                                  <tr>
                                    <th><?php echo $int;?></th>
                                    <th><input class="btn btn-info"  name="ident" type="submit" value="<?php echo $id;?>"></th>
                                    <th><?php echo $cope;?></th>
                                    <th><?php echo $expediente;?></th>
                                    <th><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></th>
                                    <th><?php echo $folio_pisaplex;?></th>
                                    <th><?php echo $folio_pisa;?></th>
                                    <th><?php echo $telefono;?></th>
                                    <th><?php echo $cliente;?></th>
                                    <th><?php echo $tipo_tarea;?></th>
                                    <!--<th><?php echo $tecnologia;?></th>-->
                                    <th><?php echo $distrito;?></th>
                                    <th><?php echo $zona;?></th>
                                    <th><?php echo $dilacion_etapa;?></th>
                                    <th><?php echo $dilacion;?></th>
                                    <th>
                                    <?php
                                      if($etapa=='PS' AND $listo=='SI' OR $listo=='listo'){
                                        echo "MOS PROYECTOS";
                                      }if(!isset($etapa)){
                                        echo "";
                                      }else{
                                        echo "";
                                      }
                                    ?>
                                    </th>
                                  </tr>
                                
                                  <?php
                                  }else{}
                              }
                              ?>
                              </form>
                            </div>
                        </table>
                    </div>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>