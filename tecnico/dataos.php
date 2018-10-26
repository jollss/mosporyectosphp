<?php
include("../Config/library.php");
$idos=$_POST['ident'];
$cnx = Conectarse();
$con = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();

$dataos=new Dataos();
$dataos->obtenerOsBD($idos,$con);
$dataos->obtenerDataosOsBD($idos,$con);
$iidataos=$dataos->regresaIddataos();
$supervisor=$dataos->regresaSupervisorIdu();
$tecnicoasignado=$dataos->regresaTecnicoAsignacionIdu();
$estatus=$dataos->regresaEstatus();
$observaciones=$dataos->regresaObservaciones();
$ddos=$dataos->regresaDDOS();
$mmos=$dataos->regresaMMOS();
$yearos=$dataos->regresaYEAROS();
$horaos=$dataos->regresaHORAOS();
$idorden=$dataos->regresaIdOrden();
$fileos=$dataos->regresaFileOs();
$ddasig=$dataos->regresaDDASIG();
$mmasig=$dataos->regresaMMASIG();
$yearasig=$dataos->regresaYEARASIG();
$tipoOs=$dataos->regresaTipoOs();
$folio_pisa=$dataos->regresaFolioPisa();
$tareatipo=$dataos->regresaTipoTarea();
$compara='PQ2LPZOD';
$compara1='PQ1LPZOD';
$compara2='PQMLPZOD';
if($tareatipo==$compara or $tareatipo==$compara1 or $tareatipo==$compara2){
    $maxImagen=16;
}else{
    $maxImagen=7;
}
$minImagen=2;
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
    <script src="../js/jquery.min.js"></script>
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
    <!--Material-->
    <script type="text/javascript">
     function crearCampos(cantidad){
        var div = document.getElementById("campos_dinamicos");
        while(div.firstChild)div.removeChild(div.firstChild); // remover elementos;
            for(var i = 1, cantidad = Number(cantidad); i <= cantidad; i++){
            var salto = document.createElement("P");
            var input = document.createElement("input");
            var input2 = document.createElement("input");
            var text = document.createTextNode("Material " + i + ": ");
            input.setAttribute("name", "campo" + i);
            input.setAttribute("size", "12");
            input.className = "input";
            input2.setAttribute("name", "campo2" + i);
            input2.setAttribute("size", "12");
            input2.className = "input";
            salto.appendChild(text);
            salto.appendChild(input);
            salto.appendChild(input2);
            div.appendChild(salto);
            }
        }
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("mySelect").value;
            document.getElementById("demo").innerHTML = "You selected: " + x;
            if (x==2) {document.getElementById("demo").innerHTML = "<div style='background-color:green'></div> " + x;};
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
        $("input[type=radio]").click(function(event){
                var valor = $(event.target).val();
                if(valor =="2"){
                    $("#div1").show();
                    $("#div2").hide();
                } else if (valor == "1") {
                    $("#div1").hide();
                    $("#div2").show();
                } else {
                    // Otra cosa
                }
            });
        });
    </script>
<?php
    nivel1($user);
?>
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
        <div class="col-md-4">
            <div style="background-color:orange;">
                <?php
                if($fileos==''){
                    ?>
                    <label>No hay Archivo de OS</label>
                    <?php
                }else{
                    ?>
                    <a href="../os/<?php echo $fileos;?>" target="_blank">
                        <img src="../syspic/word.png" width="40" height="40">
                        <label>Archivo de OS</label>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php //echo $tipoOs."----".$compara;?>
            <div style="font-size:;">
                <div class="radio" style="color:white; font-size:30px;">
                  <label style="background-color:red;"><input type="radio" value="1" name="estado">Objetar</label>
                  <label style="background-color:green;"><input type="radio" value="2" checked="checked" name="estado">Liquidada</label>
                </div>
            </div>
            <!--
            <div style="background-color:orange;">
                    <?php
                    $foto=new Adjunto_os();
                    $totaladjuntos=$foto->TotalAdjuntosBD($con);
                    $auxI=0;
                    $imagenesNum=0;
                    $con->real_query("SELECT * FROM adjunto_os WHERE os_idos ='$idos'");
                    $r = $con->use_result();
                    while ($l = $r->fetch_assoc()){
                        $idadjunto=$l['os_idos'];
                        if($idadjunto==$idos){
                            $auxI=1;
                            $nombreimg=$l['nombreimg'];
                            $imagenesNum=$imagenesNum+1;
                            ?>
                            <a href="../os/<?php echo $nombreimg;?>" target="_blank">
                                <?php //echo $nombreimg; ?>
                                <label><?php echo $nombreimg; ?></label>
                                <img src="../syspic/see.png" width="20" height="20">
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>-->
        </div>
        <?php
            $Os=new Dataos();
            $Os->obtenerOsBD($idos,$con);
            $idmos=$Os-> regresaIdmos();
            $cope=$Os-> regresaCope();
            $expediente=$Os-> regresaExpediente();
            $folio_pisaplex=$Os-> regresaFolioPisaplex();
            $folio_pisa=$Os-> regresaFolioPisa();
            $telefono=$Os-> regresaTelefono();
            $cliente=$Os-> regresaCliente();
            $tipo_tarea=$Os-> regresaTipoTarea();
            $tecnologia=$Os-> regresaTecnologia();
            $distrito=$Os-> regresaDistrito();
            $zona=$Os-> regresaZona();
            $dilacion_etapa=$Os-> regresaDilacionEtapa();
            $dilacion=$Os-> regresaDilacion();
            $principal=$Os->regresaPrincipal();
            $secundario=$Os->regresaSecundario();
            $claro_video=$Os->regresaClaroVideo();
            $alfa=$Os->regresaAlfanumerico();
            $serie=$Os->regresaSerie();
        ?>
            <!--DATOS PARA LIQUIDAR-->
            <div id="div1" style="display:;">
                <?php
                $foto=new Adjunto_os();
                $totaladjuntos=$foto->TotalAdjuntosBD($con);
                $auxI=0;
                $imagenesNum=0;
                $con->real_query("SELECT * FROM adjunto_os WHERE os_idos ='$idos'");
	            $r = $con->use_result();
	            while ($l = $r->fetch_assoc()){
	            	$idadjunto=$l['os_idos'];
	            	if($idadjunto==$idos){
                        $auxI=1;
                        $nombreimg=$l['nombreimg'];
	                	$imagenesNum=$imagenesNum+1;
                    }
	            }
                echo "Imagen:".$imagenesNum." de ".$maxImagen;
                if($imagenesNum==0){
                    ?>
                    <br>
                    <label>Requieres imagenes</label>
                    <?php
                }
                if($imagenesNum>=$maxImagen){
                    ?>
                    <div style="background-color:orange;">
                    <?php
                    $foto=new Adjunto_os();
                    $totaladjuntos=$foto->TotalAdjuntosBD($con);
                    $auxI=0;
                    $imagenesNum=0;
                    $con->real_query("SELECT * FROM adjunto_os WHERE os_idos ='$idos'");
                    $r = $con->use_result();
                    while ($l = $r->fetch_assoc()){
                        $idadjunto=$l['os_idos'];
                        if($idadjunto==$idos){
                            $auxI=1;
                            $nombreimg=$l['nombreimg'];
                            $imagenesNum=$imagenesNum+1;
                            ?>
                            <a href="../os/<?php echo $nombreimg;?>" target="_blank" title="<?php echo $nombreimg;?>">
                                <?php //echo $nombreimg; ?>
                                <label><?php echo $nombreimg; ?></label>
                                <img src="../syspic/see.png" width="20" height="20">
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
                    <label>Por favor llena los datos de liquidacion que estan a continuacion</label>
                        <form action="regDetalles.php" method="POST">
                        <div class="radio" style="color:white; font-size:30px; display:none;">
                          <label style="background-color:;"><input type="radio" value="2" checked="checked" name="estado">Liquidada</label>
                        </div>

                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <?php
                                $dataos=new Dataos();
                                $dataos->obtenerDataosOsBD($idos,$con);
                                $aux=$dataos->regresaEstatus();
                                if($aux==0){
                                    ?>
                                    <div class="panel-heading">DATOS</div>
                                    <div class="panel-body">
                                    <table class="table table-bordered responsive">
                                        <tr>
                                            <th>PRINCIPAL</th>
                                                <td><input type="text" class="form-control" value="<?php echo $principal;?>" name="principal"></td>
                                        </tr>
                                        <tr>
                                            <th>SECUNDARIO</th>
                                            <td><input type="text" class="form-control" value="<?php echo $secundario;?>" name="secundario"></td>
                                        </tr>
                                        <tr>
                                            <th>Claro Video</th>
                                            <td>
                                                <select name="claro_video"  class="form-control" required>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Alfanumerico</th>
                                            <td><input type="text" class="form-control" value="" name="alfanumerico" maxlength='12' minlength='12' required></td>
                                        </tr>
                                        <tr>
                                            <th>Serie</th>
                                            <td><input type="text" class="form-control" value="" name="serie" required></td>
                                        </tr>
                                        <tr>
                                            <th>Coship</th>
                                            <td>
                                                <select name="coship"  class="form-control" required>
                                                    <option value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Numero de Serie</th>
                                            <td><input type="text" class="form-control" value="" name="numero_de_serie" maxlength='19' minlength='19' required></td>
                                        </tr>
                                    </table>
                                    </div>
                                    <?php
                                }if($aux==1){
                                    ?>
                                    <h2><span class="label label-success">Datos registrados</span></h2>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3" style="background-color:white;" align="center">
                            <?php
                                $dataos=new Dataos();
                                $dataos->obtenerDataosOsBD($idos,$con);
                                $aux=$dataos->regresaEstatus();
                                if($aux==0){
                                    ?>
                                    <input type="number" value="<?php echo $idos;?>" name="os_idorden" style="display:none;">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">¿Ya tiene cableado?</span>
                                        <select name="cableado" class="form-control" required>
                                            <option value="NO">NO</option>
                                            <option value="SI">SI</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <!--<span class="input-group-addon" id="sizing-addon2">Estatus de orden:</span>-->
                                    </div>
                                    <!--<textarea class="form-control" rows="3" name="detalles" placeholder="Detalles" style="resize:none;" required pattern="[A-Za-z0-9]+"></textarea>-->
                                    <input class="form-control" type="text" name="detalles" placeholder="Detalles">
                                    <?php
                                }if($aux==1){
                                    ?>
                                    <h2><span class="label label-success">Datos registrados</span></h2>
                                    <?php
                                }
                            ?>
                        </div>
                        <!--</div>-->
                        <div class="col-md-4" style="background-color:white;">
                            <div class="panel panel-info">
                                <div class="panel-heading">Material usado</div>
                                <div class="panel-body">
                                        <?php
                                            $dataos=new Dataos();
                                            $dataos->obtenerDataosOsBD($idos,$con);
                                            $aux=$dataos->regresaEstatus();
                                            if($aux==0){
                                                ?>
                                                <table border="0" class="table">
                                                    <tr>
                                                        <td><label>Modem</label>
                                                            <select name="modem"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                        </td>
                                                        <td><label>Rosetas</label>
                                                            <select name="rosetas"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tipo de Instalacion</td>
                                                        <td>
                                                            <input type="radio" name="tipo_instalacion" value="AEREA" required> Aerea<br>
                                                            <input type="radio" name="tipo_instalacion" value="SUBTERRANEA"> Subterranea<br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Metraje</label></td>
                                                        <td>
                                                            <select name="metraje"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="125">125</option>
                                                                <option value="150">150</option>
                                                                <option value="175">175</option>
                                                                <option value="200">200</option>
                                                                <option value="250">250</option>
                                                                <option value="300">300</option>
                                                                <option value="350">350</option>
                                                                <option value="400">400</option>
                                                                <option value="450">450</option>
                                                                <option value="500">500</option>
                                                                <option value="1125">1125</option>
                                                            </select>
                                                        </td>
                                                        <!--
                                                        <td>
                                                            <table class="table">
                                                                <tr><td>FIBRA</td></tr>
                                                                <tr>
                                                                    <td><input type="radio" name="f_25" class="form-control" value="25"> 25</td>
                                                                    <td><input type="radio" name="f_50" class="form-control" value="50"> 50</td>
                                                                    <td><input type="radio" name="f_75" class="form-control" value="75"> 75</td>
                                                                    <td><input type="radio" name="f_125" class="form-control" value="125"> 125</td>
                                                                </tr>
                                                            </table>
                                                            <td>COBRE</td>
                                                            <table class="table">
                                                                <tr>
                                                                    <td><input type="number" name="m_cobre" value="0" class="form-control" min=0 max=1000></td>
                                                                </tr>
                                                            </table>
                                                        </td>-->
                                                    </tr>
                                                </table>
                                                <?php
                                                    if($imagenesNum==0){
                                                    ?>
                                                        <label>Requieres imagenes</label>
                                                    <?php
                                                    }if($imagenesNum>=$maxImagen){
                                                ?>
                                                        <input type="submit" value="REPORTAR" class="btn btn-primary">
                                                 <?php
                                                    }if($aux==1){
                                                ?>
                                                        <h2><span class="label label-success">Datos registrados</span></h2>
                                                <?php
                                                    }
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>

                    </form>
                    <?php
                }else{
                    //if($tipoOs<>$compara or $tareatipo<>$compara){
                    if($tareatipo<>$compara and $tareatipo<>$compara1 and $tareatipo<>$compara2){
                    ?>
                        <form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">
                            <input value="<?php echo $idos;?>" style="display:none;" name="id">
                            <div class="" style="height:180px;overflow-y:scroll;">
                                <h4>Fotos de LIQUIDACION</h4>
                                <table>
                                    <tr>

                                        <td>1. Orden de servicio <input type="file" name="userfile[]" capture/></td>
                                        <td>2. Trayectoria <input type="file" name="userfile[]" /></td>
                                        <td>3. Roceta Abierta <input type="file" name="userfile[]" /></td>
                                    </tr>
                                    <tr>
                                        <td>4. Terminal Cerrada/Secundario <input type="file" name="userfile[]" /></td>
                                        <td>5. Modem <input type="file" name="userfile[]" /></td>
                                        <td>6. Prueba de medición <input type="file" name="userfile[]" /></td>
                                    </tr>
                                    <tr>
                                        <td>7. Gotero <input type="file" name="userfile[]" /></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            <dl>
                               <dd><input type="submit" value="SUBIR IMAGEN" id="envia" name="envia" class="btn btn-success"/></dd>
                            </dl>
                            </div>
                        </form>
                    <?php
                    }
                    //if($tipoOs==$compara or $tareatipo==$compara){
                    if($tareatipo==$compara or $tareatipo==$compara1 or $tareatipo==$compara2){
                        ?>
                        <form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">
                            <input value="<?php echo $idos;?>" style="display:none;" name="id">
                            <div class="" style="height:300px;overflow-y:scroll;background-color:white;font-size:1.2em;">
                                <h2>ANTES</h2>
                                <table>
                                    <tr>
                                        <tr>1)Instalación, remate y conexión en la terminal de red secundaria<input type="file" name="userfile[]" /></tr>
                                        <tr>2)Trayectoria y fijación del bajante o cordón de acomedida <input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>3)Remate de acometida, realización de gotero<input type="file" name="userfile[]" /></tr>
                                        <tr>4)Instalación y conexión del DIT (con tapa abierta)<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>5)Instalación y conexión de rosetas de módem y extensiones de voz <input type="file" name="userfile[]" /></tr>
                                        <tr>6)Ubicación correcta del módem xSDL (vista panorámica) <input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>7)Pantalla de lectura del Equipo de Medición de parámetros de transmisión xDSL (medir en roseta de módem) <input type="file" name="userfile[]" /></tr>
                                        <tr>8)Pantalla de lectura de parámetros eléctricos al par de cobre (indicando en el segmento donde se encontró la falla Terminal, CD o DG)<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                </table>
                                <h2>DESPUES</h2>
                                <table>
                                    <tr>
                                        <tr>1)Instalación, remate y conexión en la terminal de red secundaria<input type="file" name="userfile[]" /></tr>
                                        <tr>2)Trayectoria y fijación del bajante o cordón de acomedida(uso del tubo protector ranurado cuando aplique)<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>3)Remate de acometida, realización de gotero y usodel sello pasamuros<input type="file" name="userfile[]" /></tr>
                                        <tr>4)Instalación y conexión del DIT con microfiltro integrado y conexión de cordón marfil (Voz) y cordón gris (Datos), colocación de etiqueta naranja<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>5)Instalación y conexión de rosetas marfil para el servicio de VOZ y roseta gris para el servicio de DATOS <input type="file" name="userfile[]" /></tr>
                                        <tr>6)Ubicación correcta del módem xSDL donde se tenga la mejor cobertura de WIFI (vista panoramica)<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                    <tr>
                                        <tr>7)Pantalla de lectura del Equipo de Medición de parámetros de transmisión xDSL (medir en roseta gris de módem) <input type="file" name="userfile[]" /></tr>
                                        <tr>8)Pantalla de lectura de parámetros eléctricos al par de cobre donde se realizó el cambio<input type="file" name="userfile[]" /></tr>
                                    </tr>
                                </table>
                            <dl>
                               <dd><input type="submit" value="SUBIR IMAGEN" id="envia" name="envia" class="btn btn-success"/></dd>
                            </dl>
                            </div>
                        </form>
                        <?php
                    }
                }
                ?>
            </div>
            <!--DATOS PARA OBJECION-->
            <div id="div2" style="display:none;">
                <?php
                $foto=new Adjunto_os();
                $totaladjuntos=$foto->TotalAdjuntosBD($con);
                $auxI=0;
                $imagenesNum=0;
                $con->real_query("SELECT * FROM adjunto_os WHERE os_idos ='$idos'");
	            $r = $con->use_result();
	            while ($l = $r->fetch_assoc()){
	            	$idadjunto=$l['os_idos'];
	            	if($idadjunto==$idos){
                        $auxI=1;
                        $nombreimg=$l['nombreimg'];
	                	$imagenesNum=$imagenesNum+1;
                    }
	            }
                echo "Imagen:".$imagenesNum." de ".$minImagen;
                if($imagenesNum>=$minImagen){
                    ?>
                    <label>Por favor llena los datos de objecion que estan a continuacion</label>
                    <?php
                }else{

                    ?>
                    <form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">
                        <input value="<?php echo $idos;?>" style="display:none;" name="id">
                        <div class="" style="background-color:;">
                            <h4>Fotos de OBJECION</h4>
                            <table>
                                <tr>
                                    <td>1. Orden de servicio <input type="file" name="userfile[]" /></td>
                                    <td>2. Terminal <input type="file" name="userfile[]" /></td>
                                </tr>
                                <TR>
                                    <td>
                                        <input type="submit" value="SUBIR IMAGEN" id="envia" name="envia" class="btn btn-success"/>
                                    </td>
                                </TR>
                            </table>
                        </div>
                    </form>
                    <?php
                }
                ?>

                  <form action="regDetalles.php" method="POST">
                    <div class="radio" style="color:white; font-size:30px; display:none;">
                      <label style="background-color:red;"><input type="radio" value="1" checked="checked" name="estado">Objetar</label>
                    </div>
                    <div class="col-md-3"  style="display:none;">
                        <td><input type="text" value="0" name="principal"></td>
                        <td><input type="text" value="0" name="secundario"></td>
                        <td><input type="text" value="0" name="claro_video"></td>
                        <td><input type="text" value="0" name="alfanumerico"></td>
                        <td><input type="text" value="0" name="serie" required></td>
                        <td><input type="text" value="0" name="serie" required></td>
                        <input type="number" value="<?php echo $idos;?>" name="os_idorden" style="display:none;">
                        <td><input type="text" value="0" name="cableado" required></td>
                        <input type="radio" checked="checked" name="tipo_instalacion" value="NO APLICA" >
                    </div>
                    <div class="container col-md-4" name="toTop" id="topPos" style="background-color:;">

                        <div class="col-md-2" style="background-color:white; display:none;">

                            <div class="panel panel-info">
                                <div class="panel-heading">Material usado</div>
                                <div class="panel-body">
                                        <?php
                                            $dataos=new Dataos();
                                            $dataos->obtenerDataosOsBD($idos,$con);
                                            $aux=$dataos->regresaEstatus();
                                            if($aux==0){
                                                ?>
                                                <table border="0" class="table">
                                                    <tr>
                                                        <td><label>Modem</label>
                                                            <select name="modem"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                        </td>
                                                        <td><label>Rosetas</label>
                                                            <select name="rosetas"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Metraje</label></td>
                                                        <td>
                                                            <select name="metraje"  class="form-control" required>
                                                                <option value="0">0</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="200">200</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php
                                                    if($imagenesNum==0){
                                                    ?>
                                                        <label>Requieres imagenes</label>
                                                    <?php
                                                    }if($imagenesNum>=$minImagen){
                                                ?>
                                                        <input type="submit" value="REPORTAR" class="btn btn-primary">
                                                 <?php
                                                    }if($aux==1){
                                                ?>
                                                        <h2><span class="label label-success">Datos registrados</span></h2>
                                                <?php
                                                    }
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div>
                        <?php
                            if($imagenesNum==0){
                                ?>
                                <label>Requieres imagenes</label>
                                <?php
                            }if($imagenesNum>=$minImagen){
                                ?>
                                <label>SELECCIONA ALGUNA RAZON:</label>
                                    <select name="detalles"  class="form-control" required>
                                        <!--<option value="OTRA RAZON (VERIFICAR CON TECNICO)">OTRA</option>-->
                                        <option value="NO HAY RED DE FIBRA">NO HAY RED DE FIBRA</option>
                                        <option value="TERMINAL SATURADA">TERMINAL SATURADA</option>
                                        <option value="TERMINAL SIN POTENCIA">TERMINAL SIN POTENCIA</option>
                                        <option value="TERMINAL NO DADA DE ALTA">TERMINAL NO DADA DE ALTA</option>
                                        <option value="TERMINAL CON DAÑO FISICO">TERMINAL CON DAÑO FISICO</option>
                                        <option value="TERMINAL MAL ROTULADA">TERMINAL MAL ROTULADA</option>
                                        <option value="TERMINAL CRUZADA">TERMINAL CRUZADA</option>
                                        <option value="TUBERIA SATURADA INTERNA O INEXISTENTE (DENTRO DOMICILIO)">TUBERIA SATURADA INTERNA O INEXISTENTE (DENTRO DOMICILIO)</option>
                                        <option value="TUBERIA SATURADA INTERNA (VERTICALES)">TUBERIA SATURADA INTERNA (VERTICALES)</option>
                                        <option value="TUBERIA SATURADA EXTERNA (RADIAL)">TUBERIA SATURADA EXTERNA (RADIAL)</option>
                                        <option value="POZO INUNDADO">POZO INUNDADO</option>
                                        <option value="POZO SELLADO">POZO SELLADO</option>
                                        <option value="CLIENTE CON ADEUDO MAYOR A 3 MESES">CLIENTE CON ADEUDO MAYOR A 3 MESES</option>
                                        <option value="PERMISO PATRIMONIAL">PERMISO PATRIMONIAL</option>
                                        <option value="RE-AGENDA">RE-AGENDA</option>
                                        <option value="CAMBIO DE DOMICILIO">CAMBIO DE DOMICILIO</option>
                                        <option value="CLIENTE NO DIO ACCESO">CLIENTE NO DIO ACCESO</option>
                                        <option value="CLIENTE REQUIERE A SU PERSONAL DE SISTEMAS">CLIENTE REQUIERE A SU PERSONAL DE SISTEMAS</option>
                                        <option value="CLIENTE NO SE LOCALIZA">CLIENTE NO SE LOCALIZA</option>
                                        <option value="SOLO PERSONAL TELMEX">SOLO PERSONAL TELMEX</option>
                                        <option value="PERMISO REQUERDIO">PERMISO REQUERDIO</option>
                                        <option value="NO LE INTERESA">NO LE INTERESA</option>
                                        <option value="YA CUENTA CON EL SERVICIO">YA CUENTA CON EL SERVICIO</option>
                                        <option value="NO UTILIZA EL INTERNET/DESCONOCE SU CONTRATACION">NO UTILIZA EL INTERNET/DESCONOCE SU CONTRATACION</option>
                                        <option value="NO ACEPTA INSTALACION POR MALA EXPERIENCIA ANTERIOR/ DESCONFIANZA">NO ACEPTA INSTALACION POR MALA EXPERIENCIA ANTERIOR/ DESCONFIANZA</option>
                                        <option value="LINEA SIN INTERNET">LINEA SIN INTERNET</option>
                                        <option value="LINEA DADA DE BAJA">LINEA DADA DE BAJA</option>
                                    </select>
                                    <!--<textarea class="form-control" rows="8" name="detalles" placeholder="Detalles"  style="resize:none;" required pattern="[A-Za-z0-9]+"></textarea>-->

                                <input type="submit" value="REPORTAR" class="btn btn-primary">
                                <?php
                            }if($aux==1){
                                ?>
                                <h2><span class="label label-success">Datos registrados</span></h2>
                                <?php
                            }
                        ?>
                        </div>
                    </div>

                </form>
            </div>
            </div>
            <div class="col-md-12">
            <?php
                    $con1 = Conectarse();
                    $sql="SELECT * FROM objecion_os WHERE id_orden='$folio_pisa' ORDER BY fecha ASC";
                    $resultado=$con1->query($sql);
                    ?>
            <div style="background-color:;height:80px;overflow-y:scroll;">
                <?php //echo $folio_pisa;?>
                <table class="table">
                <?php
                    while($row = $resultado->fetch_assoc())
                    {
                        if($row['id_orden']<>0 or $row['id_orden']<>''){
                        ?>
                             <tr>
                                <td><?php echo $row['id_orden'];?></td>
                                <td><?php echo $row['fecha'];?></td>
                                <td><?php echo $row['observaciones'];?></td>
                                <td><?php echo $row['personal_telmex'];?></td>
                                <td><?php echo $row['distintivo'];?></td>
                              </tr>
                        <?php
                        }
                    }
                    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
                ?>
                </table>
            </div>
            <br><br>
            </div>
            <!--DATOS DE LA ORDEN-->
            <div class="container col-md-12" name="toTop" id="topPos" style="background-color blue;">
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Datos Cliente</div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <tr>
                                   <th>CLIENTE</th>
                                </tr>
                                <tr>
                                    <th>Folio Pisaplex</th>
                                    <td><?php echo $folio_pisaplex;?></td>
                                </tr>
                                <tr>
                                    <th>Folio Pisa</th>
                                    <td style="color:red;"><b><?php echo $folio_pisa;?></b></td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                        <td><?php echo $cliente;?></td>
                                </tr>
                                <tr>
                                    <th>Teléfono</th>
                                    <td><?php echo $telefono;?></td>
                                </tr>
                                <tr>
                                    <th>Distrito</th>
                                    <td><?php echo $distrito;?></td>
                                </tr>
                                <tr>
                                    <th>Zona</th>
                                    <td><?php echo $zona;?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-info">
                        <div class="panel-heading">Ordenes de Servicio</div>
                        <div class="panel-body">
                            <div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Folio MOS</th>
                                        <th><?php echo $idos;?></th>
                                    </tr>
                                    <tr>
                                        <th>Expediente</th>
                                        <td>
                                            <?php echo $expediente;?>
                                        </td>
                                        <th>Tipo de Tarea</th>
                                        <td>
                                            <?php echo $tipo_tarea;?>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th style="color:red;">Tipo de Orden: <?php echo $tipoOs;?></th>
                                        <th>DILACION ETAPA: <?php echo $dilacion_etapa;?></th>
                                    </tr>
                                    <tr>
                                        <th>Dilacion: <?php echo $dilacion;?></th>
                                        <th>Cope: <?php echo $cope;?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" >
    </div>
<?php
//}
?>
</div>
 <?php footer();?>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
