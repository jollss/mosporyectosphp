<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$con3 = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
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
    $aux=0;
    $aux1=0;
    if(!isset($_GET['dato'])){ $dato=''; }if(isset($_GET['dato'])){ $dato=$_GET['dato']; }
?>  
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <div class="panel-heading">Busqueda</div>
        <div class="panel-body" style="background-color:white;">
            <div align="center">
                <div><strong>Dato buscado: <?php echo $dato;?></strong></div>
                <form action="buscar.php" method="GET">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="FOLIO PISA, TELÉFONO o IDMOS" name="dato" style="background-color:;">
                        <input type="submit" value="BUSCAR" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if($dato==''){ echo "Dtos : ".$dato;}
    if(isset($_GET['dato']) AND $dato<>''){
        $con1 = Conectarse();
        $sql="SELECT * FROM os 
        WHERE folio_pisa='$dato' OR telefono='$dato' OR idmos='$dato' ORDER BY idmos DESC";
        $resultado=$con1->query($sql);
        while($row = $resultado->fetch_assoc())
        {
             /*OS*/
            $idmos=$row['idmos'];
            $cope=$row['cope'];
            $expediente=$row['expediente'];
            $ddcarga=$row['ddcarga'];
            $mmcarga=$row['mmcarga'];
            $yearcarga=$row['yearcarga'];
            $folio_pisaplex=$row['folio_pisaplex'];
            $folio_pisa=$row['folio_pisa'];
            $telefono=$row['telefono'];
            $cliente=$row['cliente'];
            $tipo_tarea=$row['tipo_tarea'];
            $tecnologia=$row['tecnologia'];
            $distrito=$row['distrito'];
            $zona=$row['zona'];
            $dilacion_etapa=$row['dilacion_etapa'];
            $dilacion=$row['dilacion'];
            $usuario_idu=$row['usuario_idu'];
            $asignado=$row['asignado'];
            $aux1=1;
            $con4 = Conectarse();
            $sqld="SELECT * FROM dataos
            WHERE '$idmos'=id_orden";
            $resultados=$con4->query($sqld);
            while($rown = $resultados->fetch_assoc())
            {
                $supervisor_idu=$rown['supervisor_idu'];
                $tecnico_asignado_idu=$rown['tecnico_asignado_idu'];
                $estatus=$rown['estatus'];
                $observaciones=$rown['observaciones'];
                $ddos=$rown['ddos'];
                $mmos=$rown['mmos'];
                $yearos=$rown['yearos'];
                $horaos=$rown['horaos'];
                $principal=$rown['principal'];
                $secundario=$rown['secundario'];
                $claro_video=$rown['claro_video'];
                $tipo_os=$rown['tipo_os'];
                $alfanumerico=$rown['alfanumerico'];
                $serie=$rown['serie'];
            }
            if(!isset($estatus)){
                $supervisor_idu='';
                $tecnico_asignado_idu='';
                $estatus='';
                $observaciones='';
                $ddos='';
                $mmos='';
                $yearos='';
                $horaos='';
                $principal='';
                $secundario='';
                $claro_video='';
                $tipo_os='';
                $alfanumerico='';
                $serie='';
            }
            ?>           
            <div class="col-md-4" style="background-color:;border:none;">           
<!--COMENTARIOS SI FUE OBJETADA-->             
                <div class="col-md-12" style="background-color:;border:solid;">
                <?php 
                    if(isset($idmos)){
                            $con1 = Conectarse(); 
                            $sql="SELECT * FROM objecion_os  WHERE id_orden='$folio_pisa' ORDER BY fecha DESC";
                            $resultado=$con1->query($sql);
                            ?>
                        <div style="background-color:;height:100px;overflow-y:scroll;">
                            <table class="table">
                            <?php
                                while($rows = $resultado->fetch_assoc())
                                {
                                    if($rows['id_orden']<>0 or $rows['id_orden']<>''){
                                    ?>
                                         <tr>
                                            <td><?php echo $rows['fecha'];?></td>
                                            <td><?php echo $rows['observaciones'];?></td>
                                            <td><?php echo $rows['personal_telmex'];?></td>
                                            <td><?php echo $rows['distintivo'];?></td>
                                          </tr>
                                    <?php 
                                    }
                                } 
                            ?>
                            </table>
                        </div>
                    <?php
                    }
                    ?>
                </div>
<!--IMAGENES-->
                <!--LISTADO Y BORRADO DE IMAGENES-->
                <section class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10" align="center">
                        <?php
                        $sql3="SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden and idmos='$idmos'";
                        $resultado=$con->query($sql3);
                        while($row = $resultado->fetch_assoc())
                        {
                            $folio_pisa=$row['folio_pisa'];
                        }
                        ?>
                        <div style="background-color:;height:250px;overflow-y:scroll;">
                            <table border="0" style="border-collapse: separate; border-spacing: 10px 5px;">
                                <?php
                                $cuenta=0;
                                $sql3="SELECT * FROM adjunto_os 
                                WHERE os_idos='$idmos'";
                                $resultado=$con3->query($sql3);
                                while($row = $resultado->fetch_assoc())
                                {
                                    /*OS*/
                                    $idadjunto=$row['idadjunto'];
                                    $nombreimg=$row['nombreimg'];
                                    $os_idos=$row['os_idos'];
                                    if($nombreimg<>''){ 
                                    ?>
                                    <tr>
                                    <td align="center" style="pad">
                                        <a href="<?php echo "../os/".$nombreimg;?>" target="_blank">
                                            <img src="../os/<?php echo $nombreimg;?>" width="70" height="70">
                                        </a>
                                        <form accept="buscar.php" method="GET">
                                            <input value="<?php echo $idadjunto;?>" name="borrarid" size="5" style="display:none" readonly>
                                            <input value="<?php echo $nombreimg;?>" name="nom"  style="display:none" readonly>
                                            <input value="<?php echo $dato;?>" name="dato"  style="display:none" readonly>
                                            <button class="btn btn-danger" type="submit">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                        <label style="font-size:10px;">Imagen No. <?php echo $cuenta;?></label>
                                    </td>
                                    </tr>
                                    <?php
                                    $cuenta=$cuenta+1;
                                    }
                                }
                                ?>
                            </table>
                            <?php
                                if(isset($_GET['borrarid']) and isset($_GET['nom']) AND isset($dato)){
                                    $adjunto=$_GET['borrarid'];
                                    $nombre=$_GET['nom'];
                                    $sql="UPDATE adjunto_os SET os_idos='' and nombreimg='' WHERE idadjunto='".$adjunto."'";
                                    if ($con->query($sql) === TRUE) { echo "borrar"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
                                    $path="../os/".$nombre;
                                    unlink($path);
                                    echo "<h1>BORRAR</h1>";
                                    
                                    echo "<form name=form action=buscar.php method=GET>";
                                    echo "<input type=text name=dato value=".$dato.">";
                                    echo "</form>";
                                    echo "<script language=javascript>document.form.submit();</script>";
                                    
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </section> 
                <!--CARGA DE NUEVAS IMAGENES-->
                <section class="row">
                    <div class="col-md-12" style="background-color:gray;" border=1 align="center">
                    <a href="download_img.php?idmos=<?php echo $idmos;?>&pisa=<?php echo $folio_pisa;?>" target="_blank">
                        <button>DOWNLOAD</button>
                    </a>
                    <form name="formu" id="formu" action="upImage.php" method="POST" enctype="multipart/form-data">
                        <input value="<?php echo $dato;?>" style="display:none;" name="dato">
                        <input value="<?php echo $idmos;?>" style="display:none;" name="idmos">
                        <input value="1" style="display:none;" name="lol">
                        <dl>            
                           <dt><label>Imagenes a Subir:</label></dt>
                           <dd>
                           <div id="adjuntos">
                            <input type="file" name="userfile[]" accept=".jpg,.JPG,.jpeg,.JPEG"/><br />
                           </div>
                           </dd>
                           <dd><input type="submit" value="SUBIR IMAGEN" id="envia" class="btn btn-success"/></dd>
                        </dl>
                    </form>
                    </div>
                </section> 
<!--NOMBRE DEL TECNICO-->                
                <div class="col-md-12 table-responsive" style="background-color:white;border:solid;">
                    <?php
                    if(isset($usuario_idu) or isset($asignado)){
                        ?>
                        <label style="color:green;">TECNICO ASIGNADO</label><br>
                        <?php
                        $sql3="SELECT * FROM usuario WHERE idu='$asignado'";
                        $resultado=$con3->query($sql3);
                        while($row = $resultado->fetch_assoc())
                        {
                            $nombre=$row['nombre'];
                            $apaterno=$row['apaterno'];
                            $amaterno=$row['amaterno'];
                            ?>
                             <label><?php echo $nombre." ".$apaterno." ".$amaterno;?></label>
                            <?php
                        }
                    }
                    ?>
                    <br><br>
                    <?php
                    if(isset($usuario_idu) or isset($asignado)){
                        ?>
                        <label style="color:green;">SUPERVISOR ASIGNADO</label><br>
                        <?php
                        $sql3="SELECT * FROM usuario WHERE idu='$supervisor_idu'";
                        $resultado=$con3->query($sql3);
                        while($row = $resultado->fetch_assoc())
                        {
                            $nombres=$row['nombre'];
                            $apaternos=$row['apaterno'];
                            $amaternos=$row['amaterno'];
                            ?>
                             <label><?php echo $nombres." ".$apaternos." ".$amaternos;?></label>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
          
            <div class="col-md-8">
<!--OPCIONES-->
        <div class="col-md-12">
<!--DATOS DE VALIDACION-->   
            <?php
            if(isset($_GET['dato']) and isset($_GET['lol']) and $_GET['lol']==0){
                $folio_p=$_GET['dato'];
                date_default_timezone_set('America/Mexico_City');
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $hora=date('G');
                $min=date('i');
                $time=$hora.":".$min;
                $fecha_super=$dia."/".$mes."/".$aaaa." ".$time;
                $sql="UPDATE validar_os SET fecha_cobranza='$fecha_super' WHERE id_folio_pisa='".$folio_p."'";
                if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
            }
            ?>                            
            
            <?php
            $conPisa=Conectarse();
            $sql="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisa'";
            $res=$conPisa->query($sql);
            while($rows = $res->fetch_assoc())
            {
                $id_f=$rows['id_folio_pisa'];
                $fecha_sup=$rows['fecha_sup'];
                $fecha_calidad=$rows['fecha_calidad'];
                $fecha_coordinador=$rows['fecha_coordinador'];
                $fecha_cobranza=$rows['fecha_cobranza'];
                $a_cobro=$rows['a_cobro'];
            }
            if(!isset($id_f) or $fecha_coordinador==''){
                echo "<h3>Imagenes sin validar por coordinador</h3>";
                /*
                $sql="INSERT INTO validar_os (
                id_folio_pisa,fecha_sup,fecha_calidad,fecha_cobranza,a_cobro)
                VALUES
                ('".$folio_pisa."','','','',0)";
                if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }*/
            }
            if(isset($id_f) and $fecha_cobranza==''){
                ?>
                <td>
                <table border="2">
                    <tr>
                        <td><label>VALIDAR</label></td>
                        <td>Supervisor: <?php echo $fecha_sup;?></td>
                        <td>Calidad: <?php echo $fecha_calidad;?></td>
                        <td>Coordinador: <?php echo $fecha_coordinador;?></td>
                        <td>
                        <form action="buscar.php" method="GET">
                            <input type="number" name="dato" value="<?php echo $folio_pisa;?>" style="display:none;" readonly>
                            <input type="number" name="lol" value="0" style="display:none;" readonly>
                            <button type="submit" class="btn btn-primary">
                                VALIDAR
                            </button>
                        </form>
                        </td>
                    </tr>
                </table>
                </td>
                <?php
            }if(isset($id_f) and $fecha_cobranza<>''){
                ?>
                <td>
                <table border="2">
                    <tr>
                        <td><label>VALIDAR ARCHIVO-FOTOGRAFICO  </label></td>
                        <td>
                        <button class="btn btn-success">
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                        </button>
                        </td>
                    </tr>
                </table>
                </td>
                <?php
            }
            ?>
        </div>
       <div class="col-md-12" style="background-color:;border:solid;">
            <!--OPCIONES-->
            <?php
            if($aux==1 or isset($idmos)){
            ?>
                <table>
                    <tr>
                        <td>
                            <form action="osPDF.php" method="POST" target="_blank">
                                <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                                <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                                <input type="image" class="btn btn-default" src="../syspic/pdf_icon.png" width="70">
                                <label>GENERAR PDF</label>
                            </form>    
                        </td>
                        <td>
                            <form action="carsoForm.php" method="POST" target="_blank">
                                <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                                <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                                <input type="image" class="btn btn-default" src="../syspic/carso.JPG" width="70">
                                <label>CARSO</label>
                            </form>
                        </td>
                    </tr>
                </table>
            <?php
            }
            ?>
        </div>                 
<!--DATOS DE LA ORDEN-->          
                <div style="background-color:gray;border:solid;" class="table-responsive">
                    <table class="table" style="background-color:white;">
                        <tr>
                            <th>IDMOS:</th>                    
                            <th>COPE:</th>
                            <th>EXPEDIENTE:</th>
                            <th>FECHA DE CARGA:</th>
                            <th>FOLIO PISAPLEX</th>
                            <th>FOLIO PISA</th>
                            <TH>TELEFONO</TH>
                            
                        </tr>
                        <tr>
                            <td><?php echo $idmos;?></td>
                            <td><?php echo $cope;?></td>
                            <td><?php echo $expediente;?></td>
                            <td style="color:red;"><b><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></b></td>
                            <td style="color:red;"><b><?php echo $folio_pisaplex;?></b></td>
                            <td style="color:red;"><b><?php echo $folio_pisa;?></b></td>
                            <td><?php echo $telefono;?></td>
                        </tr>
                        <tr>
                            <th>CLIENTE</th>
                            <th>TIPO DE TAREA</th>
                            <TH>DISTRITO</TH>
                            <TH>ZONA</TH>
                            <TH>DILACION ETAPA</TH>
                            <TH>DILACION</TH>
                            <th></th>
                        </tr>
                        <tr>
                            <td><?php echo $cliente;?></td>
                            <td><?php echo $tipo_tarea;?></td>
                            <td><?php echo $distrito;?></td>
                            <td><?php echo $zona;?></td>
                            <td><?php echo $dilacion_etapa;?></td>
                            <td><?php echo $dilacion;?></td>
                            <th></th>
                        </tr>
                    </table>
                </div>
                <div style="background-color:gray;border:solid;" class="table-responsive">
                    <table class="table" style="background-color:white;">
                        <tr>
                            <th>ESTATUS</th>                    
                            <th>OBSERVACIONES</th>
                            <th>FECHA DE CIERRE</th>
                            <th>PRINCIPAL</th>
                            <th>SECUNDARIO</th>
                        </tr>
                        <tr>
                            <td><?php 
                                if($estatus==0){
                                    echo "ABIERTA";
                                }if($estatus==1){
                                    echo "OBJETADA";
                                }if($estatus==2){
                                    echo "LIQUIDADA";
                                }if($estatus==5){
                                    echo "";
                                }
                                ?>
                            </td>
                            <td><?php echo $observaciones;?></td>
                            <td style="color:red;"><b><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></b></td>
                            <td><?php echo $principal;?></td>
                            <td><?php echo $secundario;?></td>
                        </tr>
                        <tr>
                            <th>CLARO VIDEO</th>                    
                            <th>TIPO DE OS</th>
                            <th>ALFANUMERICO</th>
                            <th>SERIE</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><?php 
                                echo $claro_video;
                                ?>
                            </td>
                            <td><?php echo $tipo_os;?></td>
                            <td><?php echo $alfanumerico;?></td>
                            <td><?php echo $serie;?></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div style="background-color:gray;border:solid;" class="table-responsive">
                    <?php
                    if(isset($idmos)){
                        $sql="SELECT * FROM material WHERE idos='$idmos'";
                        $resultado=$con1->query($sql);
                        while($re = $resultado->fetch_assoc())
                        {
                            /*MATERIAL*/
                            $modem=$re['modem'];
                            $rosetas=$re['rosetas'];
                            $metraje=$re['metraje'];
                            $tipo_instalacion=$re['tipo_instalacion'];
                        }
                        ?>
                        <table class="table" style="background-color:white;">
                            <tr>
                                <th>MODEM</th>                    
                                <th>ROSETAS</th>
                                <th>METRAJE</th>
                                <th>TIPO DE INSTALACION</th>
                            </tr>
                            <tr>
                            <?php
                            if(!isset($modem)){

                            }else{
                            ?>
                                <td><?php echo $modem;?></td>
                                <td><?php echo $rosetas;?></td>
                                <td><?php echo $metraje;?></td>
                                <td><?php echo $tipo_instalacion;?></td>
                            <?php
                            }
                            ?>
                            </tr>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>    
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