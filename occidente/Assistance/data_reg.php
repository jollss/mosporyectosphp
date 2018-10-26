  <?php
require 'clase_conexion.php';
require 'check.php';
  date_default_timezone_set('America/Mexico_City');
  $dia=date('j');
  $mes=date('n');
  $aaaa=date('Y');

  $hoy=$aaaa."-".$mes."-".$dia;
  $registro = new Check();
  $cnt=$registro->obtenerTotaldeRegsitros($bd);
  $location=strtoupper($_GET['location']);
  ?>
  <table class="table">
      <tr>
        <th>Id Empelado</th>
        <th>Fecha</th>
        <th>Foto</th>
        <th></th>
      </tr>
  <?php
  for ($i=1; $i < $cnt; $i++) { 
    $dato=$registro->obtenerUnRegistro($bd,$i);
    //var_dump($dato);
    $compara=$dato[0]['fecha_reg']; 
    $loc=$dato[0]['location']; 
    if($hoy==$compara and $loc==$location)
    {
      ?>
        
          <tr>
              <td><?php echo $dato[0]['usuario'];?></td>
              <td><?php echo $dato[0]['fecha'];?></td>
              <td><!--<a href="fotos/<?php echo $dato[0]['imagen'];?>" target="_blank">--><img src="fotos/<?php echo $dato[0]['imagen'];?>" width=30 height=30><!--</a>--></td>
              <?php
              if($dato[0]['tipo']=='ENTRADA'){
              ?>
              <td style="color:green;"><?php echo $dato[0]['tipo'];?></td>
              <?php
              }if($dato[0]['tipo']=='SALIDA'){
              ?>
              <td style="color:RED;"><?php echo $dato[0]['tipo'];?></td>
              <?php
              }
              ?>
          </tr>
      <?php
    }
  }
  ?>
  </table>