<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con1 = Conectarse(); 
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idos=$_POST['idorden'];
$folio_pisa=$_POST['folio_pisa'];
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
<?php
    nivel3($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<?php
/*---------------------------------------------------------------*/
$etapa='';
$listo='';
$sql1="SELECT *
from ventas inner join filder inner join tienda_comercial
where idventa=idventas and id_tienda=id_filder  and folio_os='$folio_pisa'";
$r1=$con1->query($sql1);
while($row1 = $r1->fetch_assoc())
{ 
  /*============================================================*/
  $folio_ventas=$row1['folio_ventas'];
  $nombre=$row1['nombre'];
  $apaternov=$row1['apaternov'];
  $amaternov=$row1['amaternov'];
  $direccion=$row1['direccion'];
  $datos=$row1['datos'];
  $terminal=$row1['terminal'];
  $tel1=$row1['telefono_1'];
  $tel2=$row1['telefono_2'];
  $tel3=$row1['telefono_3'];
  $vendedor=$row1['vendedor'];
  /*============================================================*/
  $tienda_comercial=$row1['tienda_comercial'];
  $tel_asignado=$row1['tel_asignado'];
  $folio_os=$row1['folio_os'];
  $etapa=$row1['etapa'];
  $listo=$row1['listo_ps'];
  $f_comercial=$row1['fecha_comercial'];
  $id_venta=$row1['id_venta'];
  $ventasid=$row1['idventa'];
  $id_tienda=$row1['id_tienda'];
  /*============================================================*/
}
$sql2="SELECT * from filder 
where idventas='$ventasid'";
$r2=$con2->query($sql2);
while($row2 = $r2->fetch_assoc())
{ 
  $direccion2=$row2['direccion'];
  $colonia=$row2['colonia'];
  $municipio=$row2['municipio'];
  $cp=$row2['cp'];
}
/*---------------------------------------------------------------*/
?>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Datos de Ventaz <?php echo $folio_pisa;?></div>
            <div class="panel-body" style="background-color:gray;">
              <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="page-header">
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Folio Venta</span>
                            <input type="text" class="form-control" value="<?php echo $folio_ventas;?>" aria-describedby="basic-addon1" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Folio Os</span>
                            <b><input  style="color:red !important;" type="text" class="form-control" value="<?php echo $folio_os;?>" aria-describedby="basic-addon1" readonly></b>
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nombre de Cliente</span>
                          </div>
                          <div class="input-group"> 
                            <input type="text" class="form-control" value="<?php echo $nombre;?>" aria-describedby="basic-addon1" readonly>
                            <input type="text" class="form-control" value="<?php echo $apaternov;?>" aria-describedby="basic-addon1" readonly>
                            <input type="text" class="form-control" value="<?php echo $amaternov;?>" aria-describedby="basic-addon1" readonly>
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Dirección</span>
                            <textarea rows="4" cols="38" readonly><?php echo $direccion." ".$colonia." ".$municipio." ".$cp;?></textarea>
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Datos extra</span>
                            <textarea rows="4" cols="38" readonly><?php echo $datos;?></textarea>
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">TERMINAL</span>
                            <input type="text" class="form-control" value="<?php echo $terminal;?>" aria-describedby="basic-addon1" readonly>
                          </div>
                        </div>
                    </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="page-header">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Vendedor (Puede o no contener información)</span>
                      </div>
                      <div class="input-group">
                        <input type="text" class="form-control" value="<?php echo $vendedor;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Contacto 1</span>
                        <input type="text" class="form-control" value="<?php echo $tel1;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Contacto 2</span>
                        <input type="text" class="form-control" value="<?php echo $tel2;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Contacto 3</span>
                        <input type="text" class="form-control" value="<?php echo $tel3;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Tienda Comercial</span>
                        <input type="text" class="form-control" value="<?php echo $tienda_comercial;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">TELÉFONO ASIGNADO</span>
                        <input type="text" class="form-control" value="<?php echo $tel1;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">ETAPA</span>
                        <input type="text" class="form-control" value="<?php echo $etapa;?>" aria-describedby="basic-addon1" readonly>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Fecha de cambio de ETAPA</span>
                        <b><input style="color:red !important;" type="text" class="form-control" value="<?php echo $f_comercial;?>" aria-describedby="basic-addon1" readonly></b>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">¿Listo para instalar?</span>
                        <b><input style="color:red !important;" type="text" class="form-control" value="<?php echo $listo;?>" aria-describedby="basic-addon1" readonly></b>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="page-header" align="center">
                    Ubicación:<br>
                    (Si no cuenta con ubicacion registrada no aparecera)
                        <?php
                          $longitud='';
                          $latitud='';
                          $sql3="SELECT * from ubicacion_venta 
                          where idventa='$id_tienda'";
                          $r3=$con3->query($sql3);
                          while($row3 = $r3->fetch_assoc())
                          { 
                            $longitud=$row3['longitud'];
                            $latitud=$row3['latitud'];
                          }
                          echo $longitud." ".$latitud;
                          if($longitud<>'' or $latitud<>''){
                        ?>
                        <div class="input-group" align="center">
                            <a href="https://www.google.com/maps?q=<?php echo $latitud;?>,<?php echo $longitud;?>" target="_blank"><img src="../syspic/ubication.png" width="50" height="50"></a>
                        </div>
                        <?php
                        }else{}
                        ?>
                        <div>
                          <h3>Registro de venta hecho por:</h3>
                          <?php
                          $sql4="SELECT * from filder inner join ventas 
                          where filder.idventas=ventas.idventa and filder.id_filder='$id_venta'";
                            $r4=$con4->query($sql4);
                            while($row4 = $r4->fetch_assoc())
                            { 
                              $userVenta=$row4['id_user'];
                            }
                            $sql43="SELECT * from usuario where idu='$userVenta'";
                            $r4=$con4->query($sql43);
                            while($row4 = $r4->fetch_assoc())
                            { 
                              $nombreR=$row4['nombre'];
                              $apR=$row4['apaterno'];
                              $amR=$row4['amaterno'];
                            }
                            echo $nombreR." ".$apR." ".$amR;
                          ?>
                        </div>
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