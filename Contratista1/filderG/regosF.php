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
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
//$idus=$_POST['addident'];
if($ultimo =mysqli_query($con,"SELECT idu FROM usuario ORDER BY idu")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$id=$row_cnt+1;
$cnx->real_query("SELECT * FROM usuario INNER JOIN tipo 
    WHERE usuario.tipo_idtipo=tipo.idtipo AND correo='$mail'");
$resultado = $cnx->use_result();
while ($list = $resultado->fetch_assoc()){
    $nsup=$list['nombre'];
    $apsu=$list['apaterno'];
    $amsu=$list['amaterno'];
}
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$nombre =strtoupper("");
$apc=strtoupper("");
$amc=strtoupper("");
$arcli=strtoupper("");
$discli=strtoupper("");
$telcli=strtoupper("");

$super=strtoupper("");
$tipo=strtoupper("");
$empresa=strtoupper("");
$pisaplex=strtoupper("");
$dilacion=strtoupper("");
$cope=strtoupper("");

$teroptica=strtoupper("");
$puerto=strtoupper("");
$serie=strtoupper("");
$ftek=strtoupper("");
$subterraneo=strtoupper("");
$principal=strtoupper("");

$secundario=strtoupper("");
$tipoins=strtoupper("");
$clarov=strtoupper("");
$zona=strtoupper("");
$error=strtoupper("");
$tiperror=strtoupper("");
$observ=strtoupper("");
$estpc=strtoupper("");
$estpfo=strtoupper("");
$cnx->real_query("SELECT * FROM usuario WHERE idu='$super'");
$resultado = $cnx->use_result();
while ($list = $resultado->fetch_assoc()){
    $nsup=$list['nombre'];
    $apsu=$list['apaterno'];
    $amsu=$list['amaterno'];
}
$idos=0;
if($ultimo =mysqli_query($con,"SELECT idmos FROM os ORDER BY idmos")){
  $row_cnt=mysqli_num_rows($ultimo);
  mysqli_free_result($ultimo);
}
$idos=$row_cnt+1;
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
    <!--IMAGENES-->
    <script type="text/javascript">
        var numero = 0;
        // Funciones comunes
        c= function (tag) { // Crea un elemento
           return document.createElement(tag);
        }
        d = function (id) { // Retorna un elemento en base al id
           return document.getElementById(id);
        }
        e = function (evt) { // Retorna el evento
           return (!evt) ? event : evt;
        }
        f = function (evt) { // Retorna el objeto que genera el evento
           return evt.srcElement ?  evt.srcElement : evt.target;
        }

        addField = function () {
           container = d('files');
           
           span = c('SPAN');
           span.className = 'file';
           span.id = 'file' + (++numero);

           field = c('INPUT');   
           field.name = 'userfile[]';
           field.type = 'file';
           
           a = c('A');
           a.name = span.id;
           a.href = '#';
           a.onclick = removeField;
           a.innerHTML = 'Quitar';

           span.appendChild(field);
           span.appendChild(a);
           container.appendChild(span);
        }
        removeField = function (evt) {
           lnk = f(e(evt));
           span = d(lnk.name);
           span.parentNode.removeChild(span);
        }
    </script>
    <script type="text/javascript">
        var numero = 0; //Esta es una variable de control para mantener nombres
                    //diferentes de cada campo creado dinamicamente.
        evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
           return (!evt) ? event : evt;
        }

        //Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
        addCampo = function () { 
        //Creamos un nuevo div para que contenga el nuevo campo
           nDiv = document.createElement('div');
        //con esto se establece la clase de la div
           nDiv.className = 'archivo';
        //este es el id de la div, aqui la utilidad de la variable numero
        //nos permite darle un id unico
           nDiv.id = 'file' + (++numero);
        //creamos el input para el formulario:
           nCampo = document.createElement('input');
        //le damos un nombre, es importante que lo nombren como vector, pues todos los campos
        //compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
           nCampo.name = 'userfile[]';
        //Establecemos el tipo de campo
           nCampo.type = 'file';
        //Ahora creamos un link para poder eliminar un campo que ya no deseemos
           a = document.createElement('a');
        //El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
           a.name = nDiv.id;
        //Este link no debe ir a ningun lado
           a.href = '#';
        //Establecemos que dispare esta funcion en click
           a.onclick = elimCamp;
        //Con esto ponemos el texto del link
           a.innerHTML = 'Eliminar';
        //Bien es el momento de integrar lo que hemos creado al documento,
        //primero usamos la función appendChild para adicionar el campo file nuevo
           nDiv.appendChild(nCampo);
        //Adicionamos el Link
           nDiv.appendChild(a);
        //Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
        //con esta función obtenemos una referencia a ella para usar de nuevo appendChild
        //y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
           container = document.getElementById('adjuntos');
           container.appendChild(nDiv);
        }
        //con esta función eliminamos el campo cuyo link de eliminación sea presionado
        elimCamp = function (evt){
           evt = evento(evt);
           nCampo = rObj(evt);
           div = document.getElementById(nCampo.name);
           div.parentNode.removeChild(div);
        }
        //con esta función recuperamos una instancia del objeto que disparo el evento
        rObj = function (evt) { 
           return evt.srcElement ?  evt.srcElement : evt.target;
        }
    </script>        
<?php
    nivel1($user);
?>  
</head>
<body>
<div class="col-md-12"><br><br><br><br></div>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<div class="panel panel-info">
<div class="panel-heading">Nueva Orden de Servicio</div>
<div class="panel-body">
<form class="form-horizontal" action="rlistosup.php" method="POST">
    <div class="col-md-6"> 
        <!--<form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">-->
            <input value="<?php echo $idos;?>" style="display:none;" name="id">
            <dl>            
               <dt><label>Imagenes a Subir:</label></dt>
               <dd>
               <div id="adjuntos">
               <input type="file" name="userfile[]" /><br />
               </div>
               </dd>
               <dt><a href="#" onClick="addCampo()">Subir otro archivo</a></dt>      
               <!--<dd><input type="submit" value="SUBIR" id="envia" name="envia" class="btn btn-success"/></dd>-->
            </dl>
            <!--</form>-->
            <div class="form-group">
            <select class="form-control" id="sel1" name="us">
                    <?php
                    $cnx->real_query("SELECT * FROM usuario WHERE correo='$mail' ORDER BY nombre");
                    $resultado = $cnx->use_result();
                    while ($list = $resultado->fetch_assoc()){
                        echo "<option value='".$list['idu']."'>".$list['nombre']." ".$list['apaterno']." ".$list['amaterno']."</option>";
                    }
                    ?>
            </select>
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id="sizing-addon3">Área:</span>
                <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
            </div>   
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id="sizing-addon3">Folio Pisaplex:</span>
                <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id="sizing-addon3">Télefono:</span>
                <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
            </div> 
            <div class="input-group input-group-sm">
                <span class="input-group-addon" id="sizing-addon3">Tipo:</span>
                <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
            </div>                 
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-addon" id="sizing-addon3">Tipo:</span>
            <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
        </div> 
        <div class="input-group input-group-sm">
            <span class="input-group-addon" id="sizing-addon3">Tipo:</span>
            <input class="form-control" aria-describedby="sizing-addon4" name="tipo" value="<?php echo $tipo;?>" required> 
        </div> 
    </div>
</form>
</div>
        <?php footer();?>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>