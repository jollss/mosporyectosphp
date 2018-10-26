<!--<script type="text/javascript" src="ajax.js"></script>-->
  <?php
  if(!isset($_GET['return'])){
    $longitud=$_GET['longitud'];
    $latitud=$_GET['latitud'];
  ?>
  <form action="../modVender/uploadFile.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" value="<?php echo $longitud;?>" name="longitud">
  <input type="hidden" value="<?php echo $latitud;?>" name="latitud">
  <input type="hidden" value="<?php echo $main;?>" name="main">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">*No. de Solicitud:</span>
      <input type="text" class="form-control" name="solicitud" id="solicitud" value="" aria-describedby="sizing-addon2"  onkeyup="loadXMLDoc()">
    </div>
    <span class="input-group-addon" id="sizing-addon2">
    <label>Archivo de solicitud</label>
    <input type="file" name="userfile[]" required>
    <label>Comprobante de domicilio</label>
    <input type="file" name="userfile[]" required>
    <label>Identificación Personal FRENTE</label>
    <input type="file" name="userfile[]" required>
    <label>Identificación Personal TRAS</label>
    <input type="file" name="userfile[]" required>
    <label>Aviso de Privacidad FRENTE</label>
    <input type="file" name="userfile[]">
    <label>Captura de MAPA</label>
    <input type="file" name="userfile[]">
    <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
    </span>
  </form>
  <div align="center">
<!--    Nota: Si aparece un mensaje a continuacion el número de solicitud ya existe.-->
  </div>
  <div id="myDiv" align="center"></div>
  <?php
  }if(isset($_GET['return'])){
    //var_dump($_GET);
    $folio=$_GET['return'];
    $latitud=$_GET['latitud'];
    $longitud=$_GET['longitud'];
    $con->real_query("SELECT * FROM adjunto_venta WHERE folio_venta='$folio'");
    $r = $con->use_result();
    ?>
    <div align="center">
    <table>
    <tr>
    <?php
    $count=0;
    while ($l = $r->fetch_assoc()){
        $count++;
        $totalAdjuntos=$l['idaventa'];
        $nameImg=$l['imagen_n'];
        ?>
          <td>
            <form method="POST" action="../modVender/delImage.php">
              <input type="hidden" name="main" value="<?php echo $main;?>">
              <input type="hidden" name="return" value="<?php echo $folio;?>">
              <input type="hidden" name="longitud" value="<?php echo $longitud;?>">
              <input type="hidden" name="latitud" value="<?php echo $latitud;?>">
              <input type="hidden" name="idImagen" value="<?php echo $totalAdjuntos;?>">
              <button type="submit">X</button>
            </form>
          </td>
          <td><img src="../adjVentas/<?php echo $nameImg;?>" width="100px" height="100px" title="<?php echo $totalAdjuntos;?>"></td>
        <?php
    }
    ?>
    </tr>
    </table>
    <table>
      <tr>
      <td>Imagenes minimas </td>
      <td><?php echo " <b>".$count.":".$minI."<b>";?></td>
    </tr>
    </table>
    <table border="1">
      <tr>
          <form action="../modVender/uploadFile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $longitud;?>" name="longitud">
            <input type="hidden" value="<?php echo $latitud;?>" name="latitud">
            <input type="hidden" value="<?php echo $folio;?>" name="solicitud">
            <input type="hidden" value="<?php echo $main;?>" name="main">
            <input type="hidden" value="1" name="reload">
            <td><label>Adjuntar más evidencia</label></td>
            <td><input type="file" name="userfile[]"></td>
            <td><input type="submit" value="CARGAR IMAGEN"></td>
            </span>
          </form>
        
      </tr>
    </table>
    </div>
     <script type="text/javascript" language="JavaScript">
      function checkTEL(theForm) {
        if(theForm.tel1.value != theForm.tel2.value && theForm.tel1.value != theForm.tel3.value){
          if(theForm.tel2.value != theForm.tel1.value && theForm.tel2.value != theForm.tel3.value ){
            if(theForm.tel3.value != theForm.tel1.value && theForm.tel3.value != theForm.tel2.value ){
              return true;
            }else{  
                  alert('El n\u00FAmero de tel\u00E9fono es igual');
                  return false;
              }
          }else{
                alert('El n\u00FAmero de tel\u00E9fono es igual');
                return false;
            }
        }else{       
              alert('El n\u00FAmero de tel\u00E9fono es igual');
              return false;
          }
      }
      </script> 
    <form action="../modVender/rventa.php" method="POST" onsubmit="return checkTEL(this);">
      <input type="hidden" name="folio" value="<?php echo $folio;?>">
      <input type="hidden" name="longitud" value="<?php echo $longitud;?>">
      <input type="hidden" name="latitud" value="<?php echo $latitud;?>">
      <input type="hidden" name="main" value="<?php echo $main;?>">
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Tipo de cliente:</span>
        <!--<input type="text" name="tipo_cliente" class="form-control" value="" aria-describedby="sizing-addon2" required>-->
        <select name="tipo_cliente" class="form-control" required>
          <option>--SELECCIONA UNA OPCION--</option>
          <option value="CLIENTE NUEVO">CLIENTE NUEVO</option>
          <option value="PORTABILIDAD">PORTABILIDAD</option>
          <option value="CLIENTE EXISTENTE">CLIENTE EXISTENTE</option>
        </select>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Nombre(s):</span>
        <input type="text" name="name" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Apellido Paterno:</span>
        <input type="text"name="ap"  class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Apellido Materno:</span>
        <input type="text" name="am" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">RFC:</span>
        <input type="text" name="rfc" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Teléfono 1:</span>
        <input type="tel" name="tel1" class="form-control" value="" name="tel1" id="tel1" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Teléfono 2:</span>
        <input type="tel" name="tel2" id="tel2" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Teléfono 3:</span>
        <input type="tel" name="tel3" id="tel3" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Correo:</span>
        <input type="mail" name="mail" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group" style="display:;">
          <span class="input-group-addon" id="sizing-addon2">Área:</span>
          <input type="text" name="area" class="form-control" value=""aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group" style="display:">
          <span class="input-group-addon" id="sizing-addon2">Distrito:</span>
          <input type="text" name="distrito" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Terminal:</span>
          <input type="text" name="terminal" minlength="9" maxlength="10"  class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Paquete:</span>
          <!--input type="text" name="terminal" minlength="9" maxlength="10" class="form-control" value="" aria-describedby="sizing-addon2" required>-->
          <select class="form-control" name="paquete_venta">
              <option value="RESIDENCIAL $333">RESIDENCIAL $333</option>
              <option value="RESIDENCIAL $389">RESIDENCIAL $389</option>
              <option value="RESIDENCIAL FRONTERA $389">RESIDENCIAL FRONTERA $389</option>
              <option value="RESIDENCIAL $599">RESIDENCIAL $599</option>
              <option value="RESIDENCIAL $999">RESIDENCIAL $999</option>
              <option value="RESIDENCIAL PURO 10MB $349">RESIDENCIAL PURO 10MB $349</option>
              <option value="RESIDENCIAL PURO 20MB $499">RESIDENCIAL PURO 20MB $499</option>
              <option value="RESIDENCIAL PURO 50MB $649">RESIDENCIAL PURO 50MB $649</option>
              <option value="RESIDENCIAL PURO 100MB $899">RESIDENCIAL PURO 100MB $899</option>
              <option value="COMERCIAL $399">COMERCIAL $399</option>
              <option value="COMERCIAL $549">COMERCIAL $549</option>
              <option value="COMERCIAL $799">COMERCIAL $799</option>
              <option value="COMERCIAL $1499">COMERCIAL $1499</option>
              <option value="COMERCIAL $1789">COMERCIAL $1789</option>
              <option value="COMERCIAL $2289">COMERCIAL $2289</option>
              <option value="COMERCIAL $404.84">COMERCIAL $404.84</option>
              <option value="COMERCIAL RED $706.08">COMERCIAL RED $706.08</option>
              <option value="COMERCIAL PREMIUM $1209.42">COMERCIAL PREMIUM $1209.42</option>
              <option value="COMERCIAL (Sin Internet) $899">COMERCIAL (Sin Internet) $899</option>
          </select>

      </div>
      <div class="form-group">
              <span class="input-group-addon" id="sizing-addon2">*Dirección: </span>
              <textarea class="form-control"name="dir"  minlength="15" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" required></textarea>
          </div>
      <div class="well well-sm"></div>
        <div class="form-group">
              <span class="input-group-addon" id="sizing-addon2">Detalles: </span>
              <textarea class="form-control" name="detalles" rows="3" name="detalles" maxlength="500" placeholder="Detalles" style="resize:none;" required></textarea>
          </div>
      <?php 
      if($count>=$minI){
      ?>
      <button type="submit" class="btn btn-primary"> REGISTRAR</button>
      <?php
        }else{
          echo "Verifica tu evidencia fotografica para registrar";
        }
        ?>
    </form>
    <?php
  }
  ?>
</div>
