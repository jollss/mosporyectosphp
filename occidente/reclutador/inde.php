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
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
if($ultimo =mysqli_query($con,"SELECT idU FROM usuario ORDER BY idu")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$id=$row_cnt+1;
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
    recluta($user);
?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script> 
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <!--<div class="col-md-2"></div>-->
    <form class="form-horizontal" action="ruserR.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Nuevo Prospecto</div>
            <div class="panel-body">
                    <div class="form-group">
                    <!--
                        <label class="control-label col-xs-3">Fase:</label>
                        <div class="col-xs-9">
                         <select class="form-control" name="tipo">
                          <option value="REGISTRO">REGISTRO</option>
                          <option value="ENTREVISTA">ENTREVISTA</option>
                          <option value="CAPACITACION">CAPACITACION</option>
                          </select>
                        </div>
                  -->
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Nombre(s):</span>
                      <input type="text" class="form-control" placeholder="Nombre (s)"  name="name" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Apellido Paterno:</span>
                      <input type="text" class="form-control" placeholder="Apellido Paterno"  name="ap" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Apellido Materno:</span>
                      <input type="text" class="form-control" placeholder="Apellido Materno"  name="am" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono:</span>
                      <input type="number" class="form-control" placeholder="Teléfono"  min="0" name="tel" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="well well-sm">
                        <div class="input-group">
                            <input type="radio" name="sexo" value="Masculino" checked>Masculino<br>
                            <input type="radio" name="sexo" value="Femenino">Femenino<br>
                        </div>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Se entero por que medio:</span>
                            <div class="" aria-describedby="">
                             <select class="" name="entero_vacante">
                              <option value="INTERNET">INTERNET</option>
                              <option value="REFERIDO">REFERIDO</option>
                              <option value="CAMPO">CAMPO</option>
                              <option value="FERIA DE EMPLEO">FERIA DE EMPLEO</option>
                              <option value="JORNADA DE EMPLEO">JORNADA DE EMPLEO</option>
                              <option value="STAND">STAND</option>
                              </select>
                            </div>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Fuente:</span>
                            <div class="" aria-describedby="">
                             <select class="" name="fuente">
                              <option value="FACEBOOK">FACEBOOK</option>
                              <option value="VOLANTE">VOLANTE</option>
                              <option value="HAWAIANA">HAWAIANA</option>
                              <option value="LONA">LONA</option>
                              <option value="TALENTECA">TALENTECA</option>
                              </select>
                            </div>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">REFERENCIADO:</span>
                            <div class="" aria-describedby="">
                             <select class="" name="referencia">
                              <option value="NA">NA</option>
                              <?php
                              $sql1="SELECT * FROM usuario WHERE activo=1 and tipo_idtipo=23 or tipo_idtipo=22 or tipo_idtipo=29 or tipo_idtipo=32 or tipo_idtipo=34 or tipo_idtipo=24 or tipo_idtipo=27 or tipo_idtipo=21 or tipo_idtipo=20";
                              $resultado=$con->query($sql1);
                              while($row = $resultado->fetch_assoc())
                              {
                                ?>
                                <option value="<?php echo $row['idu'];?>"><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></option>
                                <?php
                              }
                              ?>
                              </select>
                            </div>
                    </div>
                <div class="well well-sm">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-body">
            
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Correo:</span>
                    <input type="email" class="form-control" placeholder="Correo"  name="correo" aria-describedby="sizing-addon2">
                </div>
            
                <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Edad:</span>
                      <input type="number" class="form-control" placeholder="Edad"  min="18" name="edad" aria-describedby="sizing-addon2" required>
                </div>
                <div class="form-group">
                    <span class="input-group-addon" id="sizing-addon2">Dirección: </span>
                    <textarea class="form-control" rows="3" name="dir" placeholder="Dirección" required></textarea>
                </div>
            <div class="well well-sm"></div>
            <div class="">
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
    </div>
</form>
</div>
<div class="col-md-12"> <?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>