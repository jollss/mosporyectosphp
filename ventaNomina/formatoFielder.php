<?php
$con13 = Conectarse(); 
$sql13="SELECT * FROM areas_fielder where nom_area<>''";
$resultado13=$con->query($sql13);
?>
<form action="../contabilidad/pagoFielder.php" method="GET">
  <input type="hidden" name="option" value="3">
  <input type="hidden" name="main" value="<?php echo $main;?>">
  <div class="col-md-3">
    <select name="area" class="form-control">
    <?php
    while($row13 = $resultado13->fetch_assoc())
    {
      ?>
        <option value="<?php echo $row13['idarea'];?>"><?php echo $row13['nom_area'];?></option>
      <?php
    }
    ?>
    </select>
  </div>
  <div class="col-md-6">

    <table>
      <tr>
        <td>
          <input type="number" name="dia" min=1 max=31 placeholder="DIA" required>
        </td>
        <td>
          <input type="number" name="mes" min=1 max=12 placeholder="MES" required>
        </td>
        <td>
          <input type="number" name="year" min=2000 placeholder="AÑO" required>
        </td>
      </tr> 
    </table>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary">VER</button>
  </div>
  
</form>
<?php
if(isset($_GET['area'])){
  $area=$_GET['area'];
  $fecha=$_GET['dia']."/".$_GET['mes']."/".$_GET['year'];
  $sql2="SELECT equipos_fielder.id_area,idarea,idu,id_fielder,nom_area,idventa,validar_venta.fecha_pago,xsol,xpos,xflotante FROM usuario inner join equipos_fielder inner join areas_fielder inner join venta inner join validar_venta WHERE equipos_fielder.id_fielder=usuario.idu and equipos_fielder.id_area=idarea and activo=1 and idu=idvendedor and idventa=folio_solicitud and validar_venta.fecha_pago='".$fecha."'
    and equipos_fielder.id_area='".$area."'";
    //echo $sql2;
  $resultado2=$con->query($sql2);
  ?>
  <div class="panel-body col-md-12" style="height:500px;overflow-x:scroll;">
      <table class="table">
        <tr>
          <th></th>
          <th>Area</th>
          <th>Fecha de Pago</th>
          <th>xSolicitud</th>
          <th>xPosteo</th>
          <th>Flotantes</th>
        </tr>
          <input type="hidden" name="option" value="2">
          <input type="hidden" name="area" value="<?php echo $area;?>">
          <?php
          $index=0;
          while($row2 = $resultado2->fetch_assoc())
          {
            ?>
            <tr>
              <td><?php echo $index;?></td>
              <td><?php echo $row2['nom_area'];?></td>
              <td><?php echo $row2['fecha_pago'];?></td>
              <td><?php echo $row2['xsol'];?></td>
              <td><?php echo $row2['xpos'];?></td>
              <td><?php echo $row2['xflotante'];?></td>
            </tr>
            <?php
            $index=$index+1;
          }
          ?>
      </table>
    </div>
    <div class="col-md-12" align="center">
      <a href="">
        <button class="btn btn-primary">VER ARCHIVO</button>
      </a>
    </div>
  <?php
}
?>