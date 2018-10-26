<?php
include("../Config/library.php"); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$userY=new Usuario();
$userY->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$userY->regresaIdu();
/*-------------------------*/
$tecnicoo=$_POST['tecnico'];
//$super=$_POST['supervisor'];
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
    $datosOS->obtenerDataosOsBD($idmos,$con);
    $tecnicoasig=$datosOS->regresaTecnicoAsignacionIdu();
    $IDDATA=$datosOS->regresaIddataos();
    $estatus=$datosOS->regresaEstatus();
    $observaciones=$datosOS->regresaObservaciones();
    $ddos=$datosOS->regresaDDOS();
    $mmos=$datosOS->regresaMMOS();
    $yearos=$datosOS->regresaYEAROS();
    $horaos=$datosOS->regresaHORAOS();
    $idorden=$datosOS->regresaIdOrden();
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
/*=====================================*/
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
        <script type="text/javascript">
            function limita(elEvento, maximoCaracteres) {
              var elemento = document.getElementById("texto");

              // Obtener la tecla pulsada 
              var evento = elEvento || window.event;
              var codigoCaracter = evento.charCode || evento.keyCode;
              // Permitir utilizar las teclas con flecha horizontal
              if(codigoCaracter == 37 || codigoCaracter == 39) {
                return true;
              }

              // Permitir borrar con la tecla Backspace y con la tecla Supr.
              if(codigoCaracter == 8 || codigoCaracter == 46) {
                return true;
              }
              else if(elemento.value.length >= maximoCaracteres ) {
                return false;
              }
              else {
                return true;
              }
            }

            function actualizaInfo(maximoCaracteres) {
              var elemento = document.getElementById("texto");
              var info = document.getElementById("info");

              if(elemento.value.length >= maximoCaracteres ) {
                info.innerHTML = "M�ximo "+maximoCaracteres+" caracteres";
              }
              else {
                info.innerHTML = "Puedes escribir hasta "+(maximoCaracteres-elemento.value.length)+" caracteres adicionales";
              }
            }
        </script>

<?php
    supBajantes($user);
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
    </div>
<!--************************************************-->
    <div class="table-responsive panel-body">
        <div class="col-md-4 panel panel-primary">
            <div class="panel-heading" align="center">
                <label>Datos de Orden</label>
            </div>
            <div  style="background-color:;" class="table-responsive">
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
        
        <div class="col-md-4 panel panel-primary">
            <div class="panel-heading" align="center">
                <label>Informacion</label>
            </div>
            <div  style="background-color:;" class="table-responsive">
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
                </tr>  
                </table>
            </div>
        </div>
        <div class="col-md-4 panel panel-primary">
            <div class="panel-heading" align="center">
                <label>IMAGENES DE ORDEN</label>
            </div>
            <div  style="background-color:;" class="table-responsive">
               <?php
                $adjunto=new Adjunto_os();
                $totalAd=$adjunto->TotalAdjuntosBD($con);
                for ($i=0; $i <= $totalAd; $i++) { 
                    $adjunto->obtenerAdjuntoOsBD($i,$con);
                    $idadjunto=$adjunto->regresaOsIdos();
                    $nombreimg=$adjunto->regresaNombreImg();
                    if($idadjunto==$idmos){
                        ?>
                        <a href="../os/<?php echo $nombreimg;?>" target="_blank"><img src="../os/<?php echo $nombreimg;?>" WIDTH="40" HEIGHT="40"></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 panel panel-primary">
                <div class="panel-heading" align="center">
                    <label>Informacion</label>
                </div>
                <div  style="background-color:;height:400px;overflow-y:scroll;" class="table-responsive">
                    <table class="table">
                    <form action="regComentarios.php" method="POST">
                        <input type="text" value="<?php echo $idorden;?>" name="idorden" style="display:none;" readonly>
                        <input type="text" value="<?php echo $idYo;?>" name="super" style="display:none;" readonly>
                        <label>Comentarios y observaciones de la queja: </label><br>
                        <div id="info">M�ximo 500 caracteres</div>
                        <textarea id="texto" onkeypress="return limita(event, 500);" onkeyup="actualizaInfo(500)" rows="15" cols="90" name="info" style="resize: none;"></textarea>
                        <input type="submit" class="btn btn-primary" value="REGISTRAR">
                    </form>
                    </table>
                </div>
            </div>
            <div class="col-md-6 panel panel-primary">
                <div class="panel-heading" align="center">
                    <label>DATOS REGISTRADOS</label>
                </div>
                <div  style="background-color:;height:400px;overflow-y:scroll;" class="table-responsive">
                <?php
                $info=new info_supbajantes();
                $total=$info->TotalInfoBD($con);
                //echo "Total de reportes:".$total;
                ?>
                    <table class="table">
                                <tr>
                                    <th>FECHA</th>
                                    <th>INFO</th>
                                    <th>SUPERVISOR DE CALIDAD</th>
                                </tr>
                        <?php
                            for ($i=0; $i <=$total ; $i++) { 
                                $info->obtenerInfoBD($i,$con);
                                $id_ordens=$info->regresaIdOrden();
                                if($id_ordens==$idmos){
                                    $datos=$info->regresaInfo();
                                    $dd=$info->regresaddqueja();
                                    $mm=$info->regresammqueja();
                                    $aaay=$info->regresayearqueja();
                                    $horaqueja=$info->regresahoraqueja();
                                    $superviInf=$info->regresaSupervisorCalidad();
                                    $super=new Usuario();
                                    $super->obtenerUsuarioBD($superviInf,$con);
                                    $nomSu=$super->regresaNombre();
                                    $apSu=$super->regresaApaterno();
                                    $amSu=$super->regresaAmaterno();
                                    ?>
                                    <tr>
                                        <th><?php echo $dd."/".$mm."/".$aaay." ".$horaqueja;?></th>
                                        <th><?php echo $datos;?></th>
                                        <th><?php echo $nomSu." ".$apSu." ".$amSu;?></th>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
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