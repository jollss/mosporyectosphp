<?php
include("../Config/library.php"); 
$idos=$_POST['ident'];
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Datauser=new Archivosuser();//hijo de infuser->hijo de usuario

$Datauser->obtenerUsuarioBD($idos,$con);
  $iduser=$Datauser->regresaIdu();
  $act=$Datauser->regresaActivo();
  $tipo=$Datauser->regresaTipoIdTipo();
  $correo=$Datauser->regresaCorreo();
  $name=$Datauser->regresaNombre();
  $ap=$Datauser->regresaApaterno();
  $am=$Datauser->regresaAmaterno();
  $ncuenta=$Datauser->regresaNocuenta();
  $pssw=$Datauser->regresaPssw();
  $cel=$Datauser->regresaCel();
  $tel=$Datauser->regresaTel();
  $dateingreso=$Datauser->regresaFechaIngreso();
  $dateseguro=$Datauser->regresaFechaSeguro();
  $dir=$Datauser->regresaDireccion();
  $estado_civil=$Datauser->regresaEstadoCivil();
  $estatura=$Datauser->regresaEstatura();
  $licencia=$Datauser->regresaLicencia();
  $curps=$Datauser->regresaCurp();
  $tel_emerg=$Datauser->regresaTelEmergencia();
  $status=$Datauser->regresaActivo();
  $tipo_personal=$Datauser->regresaTipoPersonal();
  $tipo_idtipo=$Datauser->regresaTipoIdTipo();

//$Datauser->obtenerInfuserBD($iduser,$con);
$Datauser->obtenerInfuserUBD($iduser,$con);
  $departamento=$Datauser->regresaDepartamento();
  $hora_entrada=$Datauser->regresaHoraEntrada();
  $hora_salida=$Datauser->regresaHoraSalida();
  $tipo_contrato=$Datauser->regresaTipoContrato();
  $fecha_nacimiento=$Datauser->regresaFechaNacimiento();
  $nacionalidad=$Datauser->regresaNacionalidad();
  $sexo=$Datauser->regresaSexo();
  $peso=$Datauser->regresaPeso();
  $nss=$Datauser->regresaNss();
  $ife=$Datauser->regresaIfe();
  $rfc=$Datauser->regresaRfc();
  $vig_licencia=$Datauser->regresaVigLicencia();
  $salario=$Datauser->regresaSalario();
  $con->real_query("SELECT * FROM usuario WHERE idu='$iduser'");
      $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
          $cubre=$row['cubre'];
          $vacacion_in=$row['vacaciones_in'];
          $vacacion_end=$row['vacaciones_end'];
          $tipo_pago=$row['tipo_pago'];
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
<?php
    nivel2($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<div class="col-md-12">
    <div class="col-md-3">
       <div class="panel panel-danger">
            <div class="panel-heading">NOTA</div>
            <?php
            if($status==1){
              ?>
              <div class="panel-body">
                    Si requieres eliminar este usuario del sistema solo da click en el boton siguiente.
                    <form action=" del.php" method="POST">
                        <div class="col-xs-offset-3 col-xs-9">
                                <input type="submit" class="btn btn-danger" name="del" value="<?php echo $iduser;?>">                            
                        </div>
                    </form>
                </div>
              <?php
            }
            if($status==0){
              ?>
              <div class="panel-body">
                    Si requieres activar este usuario del sistema solo da click en el boton siguiente.
                    <form action="up.php" method="POST">
                        <div class="col-xs-offset-3 col-xs-9">
                                <input type="submit" class="btn btn-success" name="del" value="<?php echo $iduser;?>">                            
                        </div>
                    </form>
                </div>
              <?php
            }
            ?>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">DATOS</div>
                <div class="panel-body">
                    El estado de este usuario es:
                    <form action=" del.php" method="POST">
                        <div class="col-xs-offset-3 col-xs-9">
                                <?php
                                if($act==0){
                                    ?>
                                        <b>USUARIO  NO  ACTIVO</b>
                                    <?php
                                }if($act==1){
                                    ?>
                                        <b>USUARIO ACTIVO</b>
                                    <?php
                                }
                                ?>
                        </div>
                    </form>
                </div>
        </div> 
    </div>
    <div class="col-md-5">
        <div class="panel panel-success">
            <div class="panel-heading">ARCHIVOS</div>
                <div class="panel-body" style="font-size:10px !important;">
                    <form action="modimg.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="idmod" value="<?php echo $iduser;?>" style="display: none" readonly>
                       <table border="0">
                           <tr>
                              <td>
                                <div class="input-group">
                                   <span><b>Acta de nacimiento</b></span>
                                    <input type="file" name="userfile[0]" id="archivo"></input>
                                </div>
                              </td>
                              <td>
                                <div class="input-group">
                                   <span><b>Comprobante de domicilio</b></span>
                                    <input type="file" name="userfile[1]" id="archivo"></input>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="input-group">
                                   <span><b>Comprobante de estudios</b></span>
                                    <input type="file" name="userfile[2]" id="archivo"></input>
                                </div>
                              </td>
                              <td>
                                <div class="input-group">
                                   <span><b>CURP</b></span>
                                    <input type="file" name="userfile[3]" id="archivo"></input>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="input-group">
                                   <span><b>LICENCIA</b></span>
                                    <input type="file" name="userfile[4]" id="archivo"></input>
                                </div>
                              </td>
                              <td>
                                <div class="input-group">
                                   <span><b>FOTOS</b></span>
                                    <input type="file" name="userfile[5]" id="archivo"></input>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="input-group">
                                   <span><b>ESTUDIO SOCIOECONOMICO</b></span>
                                    <input type="file" name="userfile[6]" id="archivo"></input>
                                </div>
                              </td>
                            </tr>
                            <tr>
                               <td></td>
                               <td>
                                  <div class="form-group">
                                      <div class="col-xs-offset-3 col-xs-9">
                                          <input type="submit" class="btn btn-primary" value="Enviar">
                                      </div>
                                  </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
        </div> 
    </div> 
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">Imagenes</div>
                <div class="panel-body">
                <?php
                $Datauser->obtenerasarchiUserBD($idos,$con);
                $acta=$Datauser->regresaActaNa();
                $domic=$Datauser->regresaCompDom();
                $cestud=$Datauser->regresaCompEstudios();
                $curp=$Datauser->regresaArchCurp();

                $alicencia=$Datauser->regresaArchLicencia();
                $afotos=$Datauser->regresaFotos();
                $asocio=$Datauser->regresaEstSocioeco();
                $url="../userData/".$iduser."/";
                 ?>  
                <div class="panel-body" style="font-size:10px !important;">
                      <table border="1">
                          <tr>
                            <td>
                              <?php
                              if($acta==''){
                                }
                              else{
                                  ?>
                                    <div class="input-group">
                                     <span><b>Acta de nacimiento</b></span><br>
                                      <a href="<?php echo $url.$acta;?>" target="_blank">
                                      <img src="../syspic/see.png" height="30px" width="30px" >
                                      </a>
                                    </div>
                                <?php
                                }?>
                            </td>
                            <td>
                              <?php
                              if($domic==''){
                                }
                              else{
                                  ?>
                                    <div class="input-group">
                                       <span><b>Comprobante de domicilio</b></span><br>
                                        <a href="<?php echo $url.$domic;?>" target="_blank">
                                        <img src="../syspic/see.png" height="30px" width="30px" >
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                              <?php
                              if($asocio==''){
                                }
                              else{
                                  ?>
                                    <div class="input-group">
                                       <span><b>ESTUDIO SOCIOECONOMICO</b></span><br>
                                        <a href="<?php echo $url.$asocio;?>" target="_blank">
                                        <img src="../syspic/see.png" height="30px" width="30px" >
                                        </a>
                                    </div>
                                <?php
                                }?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <?php
                              if($cestud==''){
                                }
                              else{
                                  ?>
                                    <div class="input-group">
                                       <span><b>Comprobante de estudios</b></span><br>
                                        <a href="<?php echo $url.$cestud;?>" target="_blank">
                                        <img src="../syspic/see.png" height="30px" width="30px" >
                                        </a>
                                    </div>
                                <?php 
                                }?>
                            </td>
                            <td>
                              <?php
                              if($curp==''){
                                }
                              else{
                              ?>
                                  <div class="input-group">
                                     <span><b>CURP</b></span><br>
                                      <a href="<?php echo $url.$curp;?>" target="_blank">
                                      <img src="../syspic/see.png" height="30px" width="30px" >
                                      </a>
                                  </div>
                                <?php
                                }?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                            <?php
                            if($alicencia==''){
                              }
                            else{
                                ?>
                              <div class="input-group">
                                 <span><b>LICENCIA</b></span><br>
                                  <a href="<?php echo $url.$alicencia;?>" target="_blank">
                                  <img src="../syspic/see.png" height="30px" width="30px" >
                                  </a>
                              </div>
                              <?php
                              }?>
                            </td>
                            <td>
                            <?php
                            if($afotos==''){
                              }
                            else{
                                ?>
                              <div class="input-group">
                                 <span><b>FOTOS</b></span><br>
                                  <a href="<?php echo $url.$afotos;?>" target="_blank">
                                  <img src="../syspic/see.png" height="30px" width="30px" >
                                  </a>
                              </div>
                              <?php
                              }?>
                            </td>
                          </tr>
                     
                      </table>
                </div>
                </div>
        </div> 
    </div>
</div>   
<div class="container col-md-12" name="toTop" id="topPos">
    <!--<div class="col-md-2"></div>-->
    <form class="form-horizontal" action="moduserlist.php" method="POST"> 
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">Modificar Usuario ID: <b><input type="number" value="<?php echo $iduser?>" name="iduser" style="background: transparent; border: none;" readonly></b></div>
            <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3">Tipo de usuario:</label>
                        <div class="col-xs-9">
                            <select class="form-control" name="tipo">
                            <?php
                            $cnx->real_query("SELECT * FROM tipo ORDER BY idtipo");
                            $result = $cnx->use_result();
                            while ($line = $result->fetch_assoc()){
                              if($line['idtipo']==$tipo){
                                ?>
                                <option value="<?php echo $line['idtipo'];?>" selected><?php echo $line['tipo'];?></option>
                                <?php
                              }else{
                            ?>
                                <option value="<?php echo $line['idtipo'];?>"><?php echo $line['tipo'];?></option>
                            <?php
                              }
                            }
                            ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Nombre(s):</span>
                      <input type="text" class="form-control" value="<?php echo $name?>"  name="name" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Apellido Paterno:</span>
                      <input type="text" class="form-control" value="<?php echo $ap?>"  name="ap" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Apellido Materno:</span>
                      <input type="text" class="form-control" value="<?php echo $am?>"  name="am" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Correo:</span>
                      <input type="email" class="form-control" value="<?php echo $correo?>"  name="correo" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Celular:</span>
                      <input type="number" class="form-control" value="<?php echo $cel?>"  min="0" name="celular" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono:</span>
                      <input type="number" class="form-control" value="<?php echo $tel?>"  min="0" name="tel" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Teléfono de Emergencia:</span>
                      <input type="number" class="form-control" value="<?php echo $tel_emerg?>"  min="0" name="tel_emerg" aria-describedby="sizing-addon2">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">Fecha de Nacimiento: </span>
                      <input type="date" class="form-control" value="<?php echo $fecha_nacimiento?>" name="fecha_nacimiento" aria-describedby="sizing-addon2" required>
                    </div>
                <div class="well well-sm"></div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2">NUMERO DE CUENTA: </span>
                      <input type="text" class="form-control" value="<?php echo $ncuenta?>" name="ncuenta" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2"> Fecha de Ingreso: </span>
                      <input type="date" class="form-control"  value="<?php echo $dateingreso?>" name="dateingreso" aria-describedby="sizing-addon2" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon2"> Fecha de alta a seguro:  </span>
                      <input type="date" class="form-control"  name="dateseguro" value="<?php echo $dateseguro?>" aria-describedby="sizing-addon2" required>
                    </div>
                <div class="well well-sm"></div>
                    <div class="form-group">
                        <span class="input-group-addon" id="sizing-addon2">Dirección: </span>
                        <textarea class="form-control" rows="3" name="dir" placeholder="Dirección"><?php echo $dir?></textarea>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="input-group">
                  <input value="<?php echo $pssw;?>" class="form-control" placeholder="Contraseña Temporal" name="pssw" aria-describedby="sizing-addon2" style="displaY:none;" readonly required>
                  <span class="input-group-addon" id="sizing-addon2">Fecha de INICIO de vacaciones</span>
                  <input type="date" class="form-control" name="vacacion_in" value="<?php echo $vacacion_in?>" placeholder="aaaa/mm/dd" aria-describedby="sizing-addon2">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Fecha de FIN de vacaciones</span>
                  <input type="date" class="form-control" name="vacacion_end" value="<?php echo $vacacion_end?>" placeholder="aaaa/mm/dd" aria-describedby="sizing-addon2">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Personal que cubre: </span>
                  <input type="text" class="form-control" value="<?php echo $cubre?>" placeholder="Personal que cubre" name="cubre" aria-describedby="sizing-addon2">
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Estado Civil: </span>
                  <input type="text" class="form-control" value="<?php echo $estado_civil?>" name="estado_civil" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Estatura: </span>
                  <input type="text" class="form-control" value="<?php echo $estatura?>" name="estatura" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Licencia: </span>
                  <input type="text" class="form-control" value="<?php echo $licencia?>" name="licencia" aria-describedby="sizing-addon2">
                </div>
                <?php
    //echo "<h4>".$curps."</h4>";
    ?>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Curp: </span>
                  <input type="text" class="form-control" value="<?php echo $curps?>" name="curp" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Nacionalidad: </span>
                  <input type="text" class="form-control" value="<?php echo $nacionalidad?>" name="nacionalidad" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Sexo: </span>
                  <input type="text" class="form-control" value="<?php echo $sexo?>" name="sexo" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Peso: </span>
                  <input type="float" class="form-control" value="<?php echo $peso?>" name="peso" aria-describedby="sizing-addon2" required>
                </div>
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Departamento: </span>
                  <input type="text" class="form-control" value="<?php echo $departamento?>" name="departamento" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Hora de Entrada: </span>
                  <input type="time" class="form-control" value="<?php echo $hora_entrada?>" name="hora_entrada" aria-describedby="sizing-addon2" required>
                  <span class="input-group-addon" id="sizing-addon2">Hora de Salida: </span>
                  <input type="time" class="form-control" value="<?php echo $hora_salida?>" name="hora_salida" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Tipo de Contrato: </span>
                  <input type="text" class="form-control" value="<?php echo $tipo_contrato?>" name="tipo_contrato" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">Vig. Licencia: </span>
                  <input type="text" class="form-control" value="<?php echo $vig_licencia?>" name="vig_licencia" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon">Salario  $</span>
                  <input type="number" class="form-control" name="salario" value="<?php echo $salario?>" aria-label="Amount (to the nearest dollar)">
                  <span class="input-group-addon">.00</span>
                  <span class="input-group-addon" id="sizing-addon2">Tipo de salario</span>
                  <!--<input type="text" class="form-control" value="<?php echo $vig_licencia?>" name="vig_licencia" aria-describedby="sizing-addon2" required>-->
                  <select name="tipo_pago" class="form-control">
                    <option value="<?php echo $tipo_pago;?>"><?php echo $tipo_pago;?></option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                    <option value="MENSUAL">MENSUAL</option>
                    <option value="POR DIA">POR DIA</option>
                  </select>
                </div>
                
            <div class="well well-sm"></div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">NSS: </span>
                  <input type="text" class="form-control" value="<?php echo $nss?>" name="nss" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">IFE: </span>
                  <input type="text" class="form-control" value="<?php echo $ife?>" name="ife" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">RFC: </span>
                  <input type="text" class="form-control" value="<?php echo $rfc?>" name="rfc" aria-describedby="sizing-addon2" required>
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="sizing-addon2">TIPO DE PERSONAL (MOS P-CONTRATISTA): </span>
                </div>
                <input type="text" class="form-control" name="tipo_personal" aria-describedby="sizing-addon2" value="<?php echo $tipo_personal;?>" required>
                <br>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <input type="submit" class="btn btn-primary" value="MODIFICAR">
                            <a href=" inde.php"><input type="button" class="btn btn-danger" value="Cancelar"></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>