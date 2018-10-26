
<?php
include("../Config/library.php");
$cnx = Conectarse();
$con = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserG.js"></script>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserDigital.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
    cobranza($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

?>
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <label>Carga de Excel</label>
            </div>

            </div>
        </div>
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
                    Observa este Ejemplo o dale clic a la imagen para verla mejor jejeje:<br>
                    <a target='_blank' href='../imagenes/Captura de pantalla (2).png'>
              <img src="../imagenes/Captura de pantalla (2).png" style="max-width:100%;width:auto;height:auto;"></a></div>
        		</div>
        	</div>
        </div>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModal">
        ¿Como Cargarlo Ejemplo Da Clic Aqui?-Ayuda
        </button>
        <div class="col-md-12">
            <div ><font color="red"><h2>
 </h2></font>
<br>

            </div><br><br>
            <form action="importar.php" enctype="multipart/form-data" method="post">
               <input id="archivo" accept=".xlsx" name="archivo" type="file" />
               <input type="hidden" value="<?php echo "$idYo";?>" name="id"/>
               <br><br>
          Agrega el Paco del Excel:  <input type="text" name="paco" placeholder="Agrega el paqo" required>
               <input name="MAX_FILE_SIZE" type="hidden" value="20000" />
               <br><br>
               Selecciona el Tipo:
               <select name="tipo" required>
                 <option value="" >Sin Seleccion Alguna</option>
                 <option value="FIBRA" required >FIBRA</option>
                  <option value="COBRE">COBRE</option>
                   <option value="HIBRIDA">HIBRIDA</option>
                    <option value="TECNICA">TECNICA</option>
                     <option value="VOZ">VOZ</option>
                     <option value="PSR">PSR</option>
               </select>
               <br><br>
               Selecciona Zona:
               <select name="zona" required>
                 <option value="" >Sin Seleccion Alguna</option>
                 <option value="1" required >Sureste</option>
                  <option value="2">Occidente</option>
                   <option value="3">Metro</option>

               </select>
               <br><br>
               <input name="enviar" type="submit" value="enviar" />
            </form>
        </div>
    </div><br><br><br><br><br><br>
    <div class="col-md-1" ></div>
    <br><br>
    <br><br>
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
