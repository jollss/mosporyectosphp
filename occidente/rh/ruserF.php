<?php
include("../Config/library.php"); 
$con = Conectarse(); 
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
    nivel2($user);
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
    <form class="form-horizontal" action="ruser.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Nuevo Usuario</div>
            <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tipo de usuario:</label>
                        <div class="col-xs-9">
                        <select class="form-control" name="tipo">
                            <?php
                            $Tipos=new Tipo();
                            $tipos=$Tipos->totalTipo($con);
                            for ($i=0; $i <$tipos; $i++) { 
                              $Tipo=new Tipo();
                              $Tipo->obtenerTipoBD($i,$con);
                              $Tipo->verTipo();
                              $idtipo=$Tipo->regresaIdtipo();
                              $ntipo=$Tipo->regresaTipo();
                              ?>
                                <option value="<?php echo $idtipo;?>"><?php echo $ntipo;?></option>
                              <?php
                            }
                            ?>
                          </select>
                        </div>
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
                      <span class="input-group-addon" id="sizing-addon2">Correo:</span>
                      <input type="email" class="form-control" placeholder="Correo"  name="correo" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Celular:</span>
                      <input type="number" class="form-control" placeholder="Celular"  min="0" name="celular" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono:</span>
                      <input type="number" class="form-control" placeholder="Teléfono"  min="0" name="tel" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono de Emergencia:</span>
                      <input type="number" class="form-control" placeholder="Teléfono Emergencia"  min="0" name="tel_emerg" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Fecha de Nacimiento: </span>
                      <input type="date" class="form-control" placeholder="Tipo de Contrato" name="fecha_nacimiento" aria-describedby="sizing-addon2" required>
                    </div>
                <div class="well well-sm"></div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">NUMERO DE CUENTA: </span>
                      <input type="text" class="form-control" placeholder="NUMERO DE CUENTA" name="ncuenta" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2"> Fecha de Ingreso: </span>
                      <input type="date" class="form-control"  name="dateingreso" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2"> Fecha de alta a seguro:  </span>
                      <input type="date" class="form-control"  name="dateseguro" aria-describedby="sizing-addon2" required>
                    </div>
                <div class="well well-sm"></div>
                    <div class="form-group">
                        <span class="input-group-addon" id="sizing-addon2">Dirección: </span>
                        <textarea class="form-control" rows="3" name="dir" placeholder="Dirección"></textarea>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Contraseña Temporal: </span>
                  <input type="password" class="form-control" placeholder="Contraseña Temporal" name="pssw" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">ID Checador: </span>
                  <input type="text" class="form-control" placeholder="ID Checador" name="checador" aria-describedby="sizing-addon2" required>
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Estado Civil: </span>
                  <input type="text" class="form-control" placeholder="Estado Civil" name="estado_civil" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Estatura: </span>
                  <input type="text" class="form-control" placeholder="Estatura" name="estatura" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Licencia: </span>
                  <input type="text" class="form-control" placeholder="Licencia" name="licencia" aria-describedby="sizing-addon2">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Curp: </span>
                  <input type="text" class="form-control" placeholder="Curp" name="curp" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Nacionalidad: </span>
                  <input type="text" class="form-control" placeholder="Nacionalidad" name="nacionalidad" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Sexo: </span>
                  <input type="text" class="form-control" placeholder="Sexo" name="sexo" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Peso: </span>
                  <input type="float" class="form-control" placeholder="Peso" name="peso" aria-describedby="sizing-addon2" required>
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Departamento: </span>
                  <input type="text" class="form-control" placeholder="Departamento" name="departamento" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Hora de Entrada: </span>
                  <input type="time" class="form-control" name="hora_entrada" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Hora de Salida: </span>
                  <input type="time" class="form-control" name="hora_salida" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Tipo de Contrato: </span>
                  <input type="text" class="form-control" placeholder="Tipo de Contrato" name="tipo_contrato" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Vig. Licencia: </span>
                  <input type="text" class="form-control" placeholder="Vig. Licencia" name="vig_licencia" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon">Salario  $</span>
                  <input type="number" class="form-control" name="salario" min="0" aria-label="Amount (to the nearest dollar)">
                  <span class="input-group-addon">.00</span>
                </div>
                
            <div class="well well-sm"></div>
            <div class="">
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">NSS: </span>
                  <input type="text" class="form-control" placeholder="NSS" name="nss" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">IFE: </span>
                  <input type="text" class="form-control" placeholder="IFE" name="ife" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">RFC: </span>
                  <input type="text" class="form-control" placeholder="RFC" name="rfc" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">TIPO DE PERSONAL (MOS P-CONTRATISTA): </span>
                </div>
                <input type="text" class="form-control" placeholder="TIPO DE PERSONAL (MOS P-CONTRATISTA)" name="tipo_personal" aria-describedby="sizing-addon2" required>
                <br>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-info">
          <div class="panel-body">
                <div class="input-group">
                   <span><b>Acta de nacimiento</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>Comprobante de domicilio</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>Comprobante de estudios</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>CURP</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>LICENCIA</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>FOTOS</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                <div class="input-group">
                   <span><b>ESTUDIO SOCIOECONOMICO</b></span>
                    <input type="file" name="userfile[]" id="archivo"></input>
                </div>
                 <br><br>
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
</form>
</div>
<div class="col-md-12"> <?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>