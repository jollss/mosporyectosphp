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
$as=$Yo->regresaAsignado();
$tos=0;
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
<script type="text/javascript" src="../js/browser5.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<div class="modal fade col-md-12" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
            <img src="../syspic/logo.png">
            <h3>Quejas Registradas</h3>
     </div>
         <div class="modal-body">
            <h4>Verifica con el supervisor de calidad.</h4>
            <?php
            $con2->real_query("SELECT * FROM os inner join dataos inner join quejas_os WHERE idmos=id_orden and quejas_os.estatus=1
                and folio_pisa_os=folio_pisa and idmos=id_mos_os and asignado='$iduser'");
            $re = $con2->use_result();
            while ($row2 = $re->fetch_assoc()){
                $folio_pisa_os=$row2['folio_pisa_os'];
                $folio_pisaplex=$row2['folio_pisaplex'];
                $tipo=$row2['tipo_os'];
                $tarea=$row2['tipo_tarea'];
                $telefono=$row2['telefono'];
                $distrito=$row2['distrito'];
                $zona=$row2['zona'];
                $fecha=$row2['fecha'];
                $fecha_cierre=$row2['ddos']."/".$row2['mmos']."/".$row2['yearos'];
                $coment=$row2['coment_queja'];
                ?>
                <div align="center">
                <table border="2" class="table">
                    <tr>
                        <th>Folio Pisa</th>
                        <th>Folio Pisaplex</th>
                        <th>Tipo de Orden</th>
                        <th>Tipo de Tarea</th>
                        <th>Teléfono</th>
                        <th>Zona</th>
                        <th>Distrito</th>
                        <th>Fecha de Queja</th>
                        <th>Fecha de Liquidación</th>
                        <th>Comentario</th>
                    </tr>
                    <tr>
                        <td><?php echo $folio_pisa_os;?></td>
                        <td><?php echo $folio_pisaplex;?></td>
                        <td><?php echo $tipo;?></td>
                        <td><?php echo $tarea;?></td>
                        <td><?php echo $telefono;?></td>
                        <td><?php echo $zona;?></td>
                        <td><?php echo $distrito;?></td>
                        <td><?php echo $fecha;?></td>
                        <td><?php echo $fecha_cierre;?></td>
                        <td><?php echo $coment;?></td>
                    </tr>
                </table>
                </div>
                <?php
            }
            ?>   
     </div>
         <div class="modal-footer">
        <!--<a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>-->
     </div>
      </div>
   </div>
</div>
<?php
$con2->real_query("SELECT * FROM os inner join dataos inner join quejas_os WHERE idmos=id_orden and quejas_os.estatus=1
    and folio_pisa_os=folio_pisa and idmos=id_mos_os and asignado='$iduser'");
$re = $con2->use_result();
while ($row2 = $re->fetch_assoc()){
    $mos=$row2['idmos'];
}
if(isset($mos)){
    ?>
    <script>
       $(document).ready(function()
       {
          //$("#mostrarmodal").modal("show");
          $('#mostrarmodal').modal({backdrop: 'static', keyboard: false})
       });
    </script>
    <?php
}if(!isset($mos)){
     header('Location: indeInicio.php');
}
ob_end_flush();
?>