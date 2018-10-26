<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
$sql="SELECT * FROM areas_fielder inner join equipos_fielder inner join usuario WHERE idu=id_fielder and idarea=id_area and id_fielder='$iduser'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $nomareaS=$row['nom_area'];
    $idareaS=$row['idarea'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--<script type="text/javascript" src="../js/browserVenta.js"></script>-->
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Lista de Ventas</h3>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div align="center">
    <br><br>
    <!--
    <form accept-charset="utf-8" method="POST">
        <div class="form-group">
            <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="INGRESA NO. DE SOLICITUD O NOMBRE DE CLIENTE" id="bus">
        </div>
    </form>
    -->
     <div id="resultadoBusqueda"></div>
    </div>
</div>
    <div class="col-md-12">
     <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?> 
            </div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
                        <div class="table-responsive" style="height:500px;overflow-y:scroll;">
                        <?php /*?>
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                    <th></th>
                                  <th>Folio Venta</th>
                                  <th>Cliente</th>
                                  <th>Dirección</th>
                                  <th>Teléfono 1</th>
                                  <th>Fecha</th>
                                  <th>Vendedor</th>
                                  <th>ETAPA</th>
                                  <th>Terminal</th>
                                </tr>
                                 <?php
                                    $Total=new Ventas();
                                    $totalU=$Total->totalVentasFull($con);
                                    $aux=0;
                                    for ($i=$totalU; $i >= 0; $i--) { 
                                        
                                        $venta=new Ventas();
                                        $venta->obtenerVentaBD($i,$con);
                                        $id=$venta->regresaIdVenta();
                                        $fventa=$venta->regresaFolioVenta();
                                        $idvendedor=$venta->regresaVendedor();
                                        $nom=$venta->regresaNombre();
                                        $apa=$venta->regresaApaterno();
                                        $ama=$venta->regresaAmaterno();
                                        $dire=$venta->regresaDireccion();
                                        $datos=$venta->regresaDatos();
                                        $tel1=$venta->regresaTel1();
                                        $tel2=$venta->regresaTel2();
                                        $tel3=$venta->regresaTel3();
                                        $dd=$venta->regresaDia();
                                        $mm=$venta->regresaMes();
                                        $y=$venta->regresaYear();
                                        $hr=$venta->regresaHora();
                                        $status=$venta->regresaEstatus();
                                        $vendedor=$venta->regresaVendedorN();
                                        $trmin=$venta->regresaTerminal();
                                        
                                        $us=new Usuario();
                                        $us->obtenerUsuarioBD($idvendedor,$con);
                                        $tipo=$us->regresaTipoIdTipo();
                                        $nomb=$us->regresaNombre();
                                        $apep=$us->regresaApaterno();
                                        $amem=$us->regresaAmaterno();
                                        $con2 = Conectarse();           
                                        $idarea='';                             
                                        $sql2="SELECT * FROM areas_fielder 
                                        inner join equipos_fielder WHERE idarea=id_area and id_fielder ='$idvendedor'";
                                        $resultado2=$con2->query($sql2);
                                        while($row2 = $resultado2->fetch_assoc())
                                        {
                                            $nomarea=$row2['nom_area'];
                                            $idarea=$row2['idarea'];
                                        }
                                        //echo $idvendedor."-".$idareaS."--".$idarea;
                                        if($idarea==$idareaS){
                                            //if($tipo==21 or $tipo==4 or $tipo==23 or $tipo==22 or $tipo==24){
                                                if($fventa!=0){
                                                    $etapa=new TiendaComercial();
                                                    $etapa->obtenerTiendaBD($id,$con);
                                                    $etapaPs=$etapa->regresaEtapa();
                                                ?>
                                                    <tr>
                                                    <form method="POST" action="statusEnd.php">
                                                    <!--<form method="POST" action="dataVenta.php">-->
                                                        <th><input type="submit" name="ident" value="<?php echo $id;?>" class="btn btn-primary"></th>
                                                    </form>
                                                        <th><?php echo $fventa;?></th>
                                                        <th><?php echo $nom." ".$apa." ".$ama;?></th>
                                                        <th><?php echo $dire;?></th>
                                                        <th><a href="tel:<?php echo $tel1;?>"><?php echo $tel1;?></a></th>
                                                        <th><?php echo $dd."/".$mm."/".$y." ".$hr;?></th>
                                                        <th><?php echo $nomb." ".$apep." ".$amem;?></th>
                                                        <th><?php echo $etapaPs;?></th>
                                                        <th><?php echo $trmin;?></th>
                                                    <form method="POST" action="delVenta.php">
                                                        <input type="text" name="ident" value="<?php echo $id;?>" style="display:none;">
                                                        <th><input type="submit" value="ELIMINAR" class="btn btn-danger" onclick="return confirm('DESEAS ELIMINAR POR COMPLETO DE SISTEMA LA VENTA?')"></th>
                                                    </form>
                                                    </tr>
                                                <?php
                                                }
                                            //}
                                        }else{}
                                    }
                                    ?>
                            </table>
                            <?php
                            */

                            ?>
                        <table class="table table-bordered" style="background-color:white; font-sizE:12px;">
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Folio</th>
                          <th>Nombre</th>
                          <th>Dirección</th>
                          <th>Datos</th>
                          <th>Teléfono 1</th>
                          <th>Teléfono 2</th>
                          <th>Teléfono 3</th>
                          <th>Etapa</th>
                          <th>Documentacion</th>
                        </tr>
                      <?php
                      $aux=0;
                      $aux2=0;
                      $sql1="SELECT * FROM venta WHERE idvendedor='$iduser' order by idventa";
                      $resultado=$con->query($sql1);
                      while($row = $resultado->fetch_assoc())
                      {
                        $vendedor=$row['idvendedor'];
                        //if ($vendedor==$iduser) {
                        $id=$row['idventa'];
                        $folio=$row['folio_ventas'];
                        $name=$row['nombrev'];
                        $phone1=$row['telefono_1'];
                        $phone2=$row['telefono_2'];
                        $phone3=$row['telefono_3'];
                        $dir=$row['direccion'];
                        $datos=$row['datos'];
                        
                        $dia=$row['dia'];
                        $mes=$row['mes'];
                        $year=$row['year'];
                        $hora=$row['hora'];
                        $docu=$row['documentacion'];

                        $fecha=$dia."/".$mes."/".$year." ".$hora;
                        $estatus=$row['estatus'];
                        $etapaPs=$row['etapa'];
                      ?> 
                          <tr>
                              <th>
                                <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $id;?>" value="<?php echo $id;?>">VER</button>
                                  <!--<form action="dataVenta.php" method="POST">
                                      <input class="btn btn-info" type="submit" value="<?php echo $id;?>" name="ident" >
                                  </form>-->
                              </th>
                              <!--<th><?php echo $id;?></th> -->
                              <th><?php echo $fecha;?></th> 
                              <th><?php echo $folio;?></th> 
                              <th style="font-size:10px;"><?php echo $name;?></th> 
                              <th style="font-size:10px;"><?php echo $dir;?></th> 
                              <th style="font-size:10px;"><?php echo $datos;?></th> 
                              <th><a href="tel:<?php echo $phone1;?>"><?php echo $phone1;?></a></th> 
                              <th><a href="tel:<?php echo $phone2;?>"><?php echo $phone2;?></a></th> 
                              <th><a href="tel:<?php echo $phone3;?>"><?php echo $phone3;?></a></th> 
                              <!--<th><?php echo $phone2;?></th> 
                              <th><?php echo $phone3;?></th> -->
                              <th><?php echo $etapaPs;?></th>
                              <th><?php echo $docu;?></th>
                              <!--<th><a href="http://maps.google.com/maps?q=loc: <?php echo $latitud;?>,<?php echo $longitud;?>" target="_blank"><img src="../syspic/ubication.png" width="40" height="40"></a></th>-->
                          </tr>
                      <?php   
                        //}                                           
                      }
                      ?>
                      </table>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!--============================================================================================-->      
    </div>
</div>
<!-- Modal -->
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">VENTAS DEL MES</h4>
    </div>
    <div class="modal-body">
      <p>No hay datos por buscar</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
  
</div>
</div>
<script>
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var idmos=$(this).data("id");
        console.log(idmos);
        $('.modal-body').load('dataVentasModal.php?id='+idmos,function(){
            $('.myModal').modal({show:true});
        });
    });
});
</script>
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
