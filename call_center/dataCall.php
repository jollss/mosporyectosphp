<?php
require_once '../Config/main.php';
require_once '../Config/foot.php';
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  

$tos=0;
$idus=$_POST['ident'];
$con->real_query("SELECT * FROM call_center WHERE id_callc='$idus'");
    $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $tos++;
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
        <link href="../css/slider.css" rel="stylesheet">
 <script>
        function actual() {
                 fecha=new Date(); 
                 hora=fecha.getHours(); 
                 minuto=fecha.getMinutes(); 
                 segundo=fecha.getSeconds();
                 if (hora<10) { 
                    hora="0"+hora;
                    }
                 if (minuto<10) { 
                    minuto="0"+minuto;
                    }
                 if (segundo<10) {
                    segundo="0"+segundo;
                    }
                 mireloj = hora+" : "+minuto+" : "+segundo; 
                         return mireloj; 
                 }
        function actualizar() { 
           mihora=actual(); 
           mireloj=document.getElementById("reloj"); 
           mireloj.innerHTML=mihora; 
             }
        setInterval(actualizar,1000);
</script>  
<script type="text/javascript">
    function show(bloq) {
     obj = document.getElementById(bloq);
     obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
}
</script>     
<script>
    if ($('#precio2').is(':show'))
    $('#precio1').show();
    else
    $('#precio1').hide();

</script>
<script type="text/javascript">
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("texto");
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
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
    call_center($user);
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hh=date('G');
    $min=date('i');
    $semana = date("W");
?>
</head>
<body>

<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
    <div align="center">
        <div id="reloj" style="width: 120px; height: 20px; padding: 2px 10px; border: 1px solid black; 
                     font: bold 1em dotum, 'lucida sans', arial; text-align: center;
                     float: right; margin: 1em 3em 1em 1em;">
               <?php echo $hh." : ".$min." : 00";?>
            </div>
    </div>
    <div class="panel panel-info">
             <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?>
             
             </div>
            <div class="panel-body">
                <div align="center">
                    <?php
                        $sql1="SELECT * FROM call_center INNER JOIN data_callcenter 
                              WHERE estado_call=1 AND call_center_id_calc=id_callc 
                              AND id_callc='$idus'";
                           $resultado=$con->query($sql1);
                           while($row = $resultado->fetch_assoc())
                           {
                                $id_callc=$row['id_callc'];
                                $consecutivo=$row['consecutivo'];
                                $cope=$row['cope'];
                                $expediente=$row['expediente'];
                                $telefono=$row['telefono'];
                                $nombre_cli=$row['nombre_cli'];
                                $distrito=$row['distrito'];
                                $calle=$row['calle'];
                                $numero=$row['numero'];
                                $num_interior=$row['num_interior'];
                                $sub_numero=$row['sub_numero'];
                                $colonia=$row['colonia'];
                                $supervisor=$row['supervisor'];
                                $estatus=$row['estatus'];
                                $observaciones=$row['observaciones'];
                                $tecnico=$row['tecnico'];
                                $estado_call=$row['estado_call'];
                                
                                $dd=$row['dd'];
                                $mm=$row['mm'];
                                $aaaa=$row['aaaa'];
                                $hora=$row['hora'];
                                $p_atendio=$row['p_atendio'];
                                $servicio=$row['servicio'];
                                $descr=$row['descri'];
                           }
                    ?>
                    <div class="col-md-12" style="background-color:white;">
                    <div class="show" id="precio1">
                        <div class="panel panel-success col-md-12">
                            <div class="panel-heading">ID: <b><?php echo $id_callc?></b></div>
                            CONSECUTIVO: <b><?php echo $consecutivo?></b>
                        </div>
                        <div class="col-md-4 panel panel-info">
                            <table border="0" class="table">
                                <tr><td>COPE: <b><?php echo $cope;?></b></td></tr>
                                <tr><td>EXPEDIENTE: <b><?php echo $expediente;?></b></td></tr> 
                                <tr><td>DISTRITO: <b><?php echo $distrito;?></b></td></tr>
                                <tr><td>ESTATUS: <b><?php echo $estatus;?></b></td></tr>                        
                            </table>    
                        </div>
                        <div class="col-md-8 panel panel-success">
                            <table border="0" class="table">
                                <tr><td>CLIENTE: <b><?php echo $nombre_cli;?></b></td></tr>
                                <tr><td>TELÉFONO: <b><?php echo $telefono;?></b></td></tr> 
                                <tr><td>SUPERVISOR: <b><?php echo $distrito;?></b></td></tr>
                            </table>
                            <table border="0" class="table">
                                <tr>
                                    <td>DIRECCIÓN:<td>
                                </tr>
                                <tr>
                                    <td>Calle: <b><?php echo $calle;?></b></td>
                                    <td>Colonia: <b><?php echo $colonia;?></b></td>
                                    <td>Núm. Interior: <b><?php echo $num_interior;?></b></td>
                                    <td>Sub. Número: <b><?php echo $sub_numero;?></b></td>
                                </tr>                       
                            </table>                 
                        </div>
                        <div class="col-md-6 panel panel-danger">
                            <table border="0">
                                <tr>
                                    <td>Tecnico:<b><?php echo $tecnico;?></b></td>
                                </tr> 
                                <tr>
                                    <td>Supervisor:<b><?php echo $supervisor;?></b></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 panel panel-danger">
                            <table border="0" class="table">
                            Observaciones:
                                    <td>Observaciones: <b><?php echo $observaciones;?></b></td>
                            </table>   
                        </div>
                    </div>
                    <div style="" id="precio2">
                            <div class="col-md-12" style="background-color:white;"><b>Fecha de finalización: <?php echo $dd."/".$mm."/".$aaaa." Hora:".$hora;?></b></div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="sizing-addon2">Persona que respondio: </span>
                                      <input type="text" class="form-control" value="<?php echo $p_atendio;?>" name="p_res" aria-describedby="sizing-addon2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">Desea el servicio?</span>
                                        <input type="text" class="form-control" value="<?php echo $servicio;?>" name="p_res" aria-describedby="sizing-addon2" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="background-color:orange; height:20% !important;">
                                    Mensaje:
                                </div>
                            </div>
                            <div class="col-md-3"></div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="comment">DESCRIPCION</label>
                                  <textarea class="form-control" rows="5" name="descripcion" id="texto" onkeypress="return limita(event, 500);" onkeyup="actualizaInfo(500)" readonly="readonly"><?php echo $descr;?></textarea>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="col-md-2"></div>
</div>
<div class="col-md-12">
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