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
$tos=0;
$TotalOS=new Os();
$ls=$TotalOS->totalAOs($iduser,$con);

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
    <div class="col-md-10">
 
        <div class="panel panel-info">

            <div class="panel-heading">Ordenes de servicio restantes</div>
            <div class="panel-body" style="background-color:gray;">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div align="center">
                 <div id="">
                 <?php
                     $sql1="SELECT * FROM usuario INNER JOIN tipo 
                     WHERE activo=1 AND asignado='$iduser' AND tipo.idtipo=usuario.tipo_idtipo AND tipo_idtipo=1 ORDER BY nombre";
                    $resultado=$con->query($sql1);
                    if(mysqli_num_rows($resultado)==0){
                    echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
                    }
                    else{
                        ?>
                        <form action="infoos.php" method="POST">
                            <div class="table-responsive" >
                                <table class="table table-bordered" style="background-color:white;font-size:11px">
                                    <tr>
                                      <th>No</th>
                                      <th><a > Nombre Completo</a></th> 
                                      <th><a >ID</a></th>
                                      <th><a >Tipo de personal</a></th>
                                      <th>Correo</th>
                                      <th>Celular</th>
                                      <th>Cobre</th>
                                      <th>Fibra</th>
                                      <th>Hibridos</th>
                                      <th>Voz</th>
                                      <th>PSR</th>
                                      <th>TECNICA</th>
                                      <th>RESTANTES</th>
                                    </tr>
                        <?php
                        echo '<b>Datos encontrados</b><br />';
                        $aux=0;
                        $TOTALAUX=0;
                        $acobre=0;
                        $afi=0;
                        $ahib=0;
                        $avoz=0;
                        $atec=0;
                        $apsr=0;
                        while($row = $resultado->fetch_assoc())
                        {
                            $aux=$aux+1;
                        $idus=$row['idu'];
                        $cCO=0;
                        $cFO=0;
                        $cHI=0;
                        $cVO=0;
                        $cPSR=0;
                        $cTE=0;
                        $con2 = Conectarse(); 
                        $con2->real_query("SELECT * FROM os inner join dataos WHERE idmos=id_orden and estatus=0 and asignado='$idus'");// AND semana='$semana'");
                        $re = $con2->use_result();
                        while ($row2 = $re->fetch_assoc()){
                            $tipos=$row2['tipo_os'];
                            if($tipos=='COBRE'){
                                $cCO=$cCO+1;
                            }if($tipos=='FIBRA'){
                                $cFO=$cFO+1;
                            }if($tipos=='HIBRIDA'){
                                $cHI=$cHI+1;
                            }if($tipos=='VOZ'){
                                $cVO=$cVO+1;
                            }if($tipos=='TECNICA'){
                                $cTE=$cTE+1;
                            }if($tipos=='PSR'){
                                $cPSR=$cPSR+1;
                            }
                        }
                        $acobre=$acobre+$cCO; $afi=$afi+$cFO;
                        $ahib=$ahib+$cHI; $avoz=$avoz+$cVO;
                        $atec=$atec+$cTE; $apsr=$apsr+$cPSR;
                         $TOTAL=$cCO+$cFO+$cHI+$cVO+$cPSR+$cTE;
/*=========================================================================*/                           
                        ?> 
                            <tr>
                                <th><?php echo $aux;?></th>
                                <th style="font-size:12px;"><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idu'];?>"></th>
                                <th><?php echo $row['tipo'];?></th>            
                                <th><?php echo $row['correo'];?></th>
                                <th><?php echo $row['cel'];?></th>
                                <th><?php echo $cCO;?></th> 
                                <th><?php echo $cFO;?></th> 
                                <th><?php echo $cHI;?></th> 
                                <th><?php echo $cVO;?></th> 
                                <th><?php echo $cPSR;?></th> 
                                <th><?php echo $cTE;?></th> 
                                <th style="color:red;"><?php echo $TOTAL;?></th> 
                            </tr>
                                
                        <?php
                        $TOTALAUX=$TOTALAUX+$TOTAL;
/*=========================================================================*/                                               
                        }
                        ?>
                        </table>
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                 </div>
            </div>
            </div>
        </div>
    </div>
        <div class="col-md-2">
        <div class="panel panel-warning">

            <div class="panel-heading">Totales</div>
            <div class="panel-body" style="background-color:white;" >
            <b style="font-size:16px;">
                <?php
                if(!isset($acobre)){$acobre=0;}
                if(!isset($afi)){$afi=0;}
                if(!isset($ahib)){$ahib=0;}
                if(!isset($avoz)){$avoz=0;}
                if(!isset($atec)){$atec=0;}
                if(!isset($apsr)){$apsr=0;}
                if(!isset($TOTALAUX)){$TOTALAUX=0;}
                echo "Total cobre: ".$acobre."<br>";
                echo "Total fibra: ".$afi."<br>";
                echo "Total hibrida: ".$ahib."<br>";
                echo "Total voz: ".$avoz."<br>";
                echo "Total tecnica: ".$atec."<br>";
                echo "Total PSR: ".$apsr."<br>";
                echo "TOTAL: ".$TOTALAUX."<br>";
                ?>
            </b>
            </div>
        </div>
        <div class="panel panel-success">
            Bolsa total: <b><?php echo $ls;?></b>
        </div>
        <div class="panel panel-warning">
            <div align="center">
                <form role="form" name="importar" method="post" action="carga.php" enctype="multipart/form-data">
                    <label for="photo">Archivo CSV separado por comas de Excel</label>
                    <div class="drag-drop">
                    <input type="number" name="ident" value="<?php echo $iduser;?>" style="display:none;">
                        <input accept=".csv" name="file" type="file" style="" id="photo" /><br>
                    </div>
                    <input type="hidden" value="upload" name="action" />
                    <button type="submit" class="btn btn-primary"><span>
                            <i class="glyphicon glyphicon-open bottom pulsating"></i>
                        </span>
                    </button>
                </form>
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
