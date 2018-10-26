<?php
include("../Config/library.php");

$con = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserDigital.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
$con = Conectarse();
$correo = $_SESSION['mail'];
$user = $_SESSION['username'];
$idus=0;
$tos=0;
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($correo,$con);
$iduser=$Yo->regresaIdu();



?>

</head>
<body>
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">¿Que Es Esta Tabla?</h4>
			</div>
			<div class="modal-body">
            Brevemente se explicara las columnas:<br>
        <p style='color:#FF0000';>Folio Pisa:</p>Es un Campo que sirve como Bitacora de los Datos que contenia tu excel cargado previamente
        <br>
        <p style='color:#FF0000';>Tipo:</p>Es el tipo de Tecnologia que venia en el Excel que se Cargo
        <br>
        <p style='color:#FF0000';>Paqo:</p>De igual Manera Es el paco que venia en el Excel y se tomo Como Unico
        <br>
        <p style='color:#FF0000';>Nombre Del Archivo Con que se Cargo:</p>Este Campo Especifica El nombre y se le concatena el PACO,para que sea unico el excel y el registro

        <br>
            <p style='color:#FF0000';>Se Registro en bitacora:</p>Este Campo Quiere Decir Que en la bitacora si se guardo,aunque tenga estatus "Si","No"<br>
            no quiere decir que no esta guardado en bitacora,ese estatus significa que tu dato esta repetido en el excel, por lo cual no pasara a modificarse hasta que se resuelva el porque venia dos veces
        <br>
      <p style='color:#FF0000';>Se Modifico y Fue Encontrado:</p>Aqui Empieza lo bueno ya que se modifico el dato con la bitacora de excel con los datos reales y existentes por parte nuestra,es decir un MACH entre excel a nuestra informacion
        <br>
      <p style='color:#FF0000';>Fecha de Cargo de los Folios Pisa:</p>La Fecha en que se Cargaron los Folios con su Respectiva Hora
			</div>
		</div>
	</div>
</div>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal">
¿Que Es Esta Tabla?-Ayuda
</button>
<button type="button" class="btn btn-primary btn-lg">
<a  a href='javascript:window.history.go(-1);'>Regresar</a>
</button>


<script type='text/javascript'>
   document.getElementById('btn-cancelar').onclick = function () {
   location.href = 'paqocarga.php';
   };
</script>
<br><br><br>

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Supervisores</div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                        <td>Folio Pisa</td>
                        <td>Tipo</td>
                        <td>Paco</td>
                        <td>Nombre de Archivo Con el Que se Cargo</td>
                            <td>Se Registro en bitacora</td>
                                <td>Se Modifico y Fue Encontrado </td>
                                <td>Fecha de Cargo de los Folios Pisa </td>
                    </tr>
                    <?php
                    $zona=($_GET['zona']);
                    $paco=($_GET['paco']);
                    if($zona==1)
                    {
                      include("../sureste/Config/library.php");
                      $con = Conectarse();
                      $query = "SELECT * FROM excel_folios_bitacora  WHERE  paco='$paco' ";
                      $result = $con->query($query);
                      while($filas = $result->fetch_assoc()) {
                        $foliopisa=$filas['folio_pisa'];
                        $tipo=$filas['tipo'];
                        $paco=$filas['paco'];
                        $nombrearchivo=$filas['nombre_archivo'];
                        $guardar=$filas['guardar'];
                        $fechacargaDatos=$filas['fecha_carga_Datos'];
                        $encontrado=$filas['encontrado'];


  echo"
                      <tr>
  <td>$foliopisa</td>
  <td>$tipo</td>
  <td>$paco</td>
  <td>$nombrearchivo</td>";
  if($guardar=='SI'){
  echo "    <td>$guardar</td>";
  }
  elseif($guardar=='NO'){
  echo "    <td><p style='color:#FF0000';>Dato Repetido en Excel</p></td>";
  }
  if($encontrado=='SI'){
  echo "    <td>Se modifico este folio y se macheo correctamente </td>";
  }
  elseif($encontrado=='NO'){
  echo "    <td><p style='color:#FF0000';>No se pudo Modificar ya que no se encontro el<br> registro con la tabla donde se hace el mach</p></td>";
  }
  echo"

  <td>$fechacargaDatos</td>

  </tr>";
  }
                    }
                      elseif($zona==2){
                        include("../occidente/Config/library.php");
                        $con = Conectarse();
                        $query = "SELECT * FROM excel_folios_bitacora  WHERE  paco='$paco' ";
                        $result = $con->query($query);
                        while($filas = $result->fetch_assoc()) {
                          $foliopisa=$filas['folio_pisa'];
                          $tipo=$filas['tipo'];
                          $paco=$filas['paco'];
                          $nombrearchivo=$filas['nombre_archivo'];
                          $guardar=$filas['guardar'];
                          $fechacargaDatos=$filas['fecha_carga_Datos'];
                          $encontrado=$filas['encontrado'];


    echo"
                        <tr>
    <td>$foliopisa</td>
    <td>$tipo</td>
    <td>$paco</td>
    <td>$nombrearchivo</td>";
    if($guardar=='SI'){
    echo "    <td>$guardar</td>";
    }
    elseif($guardar=='NO'){
    echo "    <td><p style='color:#FF0000';>Dato Repetido en Excel</p></td>";
    }
    if($encontrado=='SI'){
    echo "    <td>Se modifico este folio y se macheo correctamente </td>";
    }
    elseif($encontrado=='NO'){
    echo "    <td><p style='color:#FF0000';>No se pudo Modificar ya que no se encontro el<br> registro con la tabla donde se hace el mach</p></td>";
    }
    echo"

    <td>$fechacargaDatos</td>

    </tr>";
    }
                      }
                       elseif($zona==3){
                         $q = "SELECT ruta,fecha_carga,zona,CONCAT(us.nombre,' ',us.apaterno,' ',us.amaterno) AS nombre ,de.paco FROM documento_excel AS de
INNER JOIN usuario AS us
ON de.usuario_cargo_excel=us.idu


WHERE  de.paco='$paco' ";
                         $result = $con->query($q);
                         while($filas = $result->fetch_assoc()) {
                           $nombre=$filas['nombre'];
                           $ruta=$filas['ruta'];
   $fechacarga=$filas['fecha_carga'];
 $paco=$filas['paco'];
                         }
echo "Nombre del Archivo:$ruta,fecha de Carga:$fechacarga,Nombre de Quien Cargo:$nombre,Paco:$paco y la Zona METRO";
                    $query = "SELECT * FROM excel_folios_bitacora  WHERE  paco='$paco' ";
                    $result = $con->query($query);
                    while($filas = $result->fetch_assoc()) {
                      $foliopisa=$filas['folio_pisa'];
                      $tipo=$filas['tipo'];
                      $paco=$filas['paco'];
                      $nombrearchivo=$filas['nombre_archivo'];
                      $guardar=$filas['guardar'];
                      $fechacargaDatos=$filas['fecha_carga_Datos'];
                      $encontrado=$filas['encontrado'];


echo"
                    <tr>
<td>$foliopisa</td>
<td>$tipo</td>
<td>$paco</td>
<td>$nombrearchivo</td>";
if($guardar=='SI'){
echo "    <td>$guardar</td>";
}
elseif($guardar=='NO'){
echo "    <td><p style='color:#FF0000';>Dato Repetido en Excel</p></td>";
}
if($encontrado=='SI'){
echo "    <td>Se modifico este folio y se macheo correctamente </td>";
}
elseif($encontrado=='NO'){
echo "    <td><p style='color:#FF0000';>No se pudo Modificar ya que no se encontro el<br> registro con la tabla donde se hace el mach</p></td>";
}
echo"

<td>$fechacargaDatos</td>

</tr>";
}
}
?>
                </table>
            </div>
        </div>
    </div>
</div>
<!--
<div class="col-md-6">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <div class="panel-heading">Busqueda</div>
        <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <form accept-charset="utf-8" method="POST">
                    <div class="form-group">
                        <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="FOLIO PISA" id="bus">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-12">
        <div id="resultadoBusqueda"></div>
    </div>
</div>-->
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
