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
/*
$cnx->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnx->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}*/
$dataos=new Dataos();
$dataos->obtenerDataosBD($idos,$con);
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
/*
$con->real_query("SELECT * FROM dataos WHERE id_orden='$idos'");
$re = $con->use_result();
while ($r = $re->fetch_assoc()){
    $cope=$r['cope'];
    $terminal_optica=$r['terminal_optica'];
    $puerto=$r['puerto'];
    $claro_video=$r['claro_video'];
    $serie_ontalfanumerica=$r['serie_ontalfanumerica'];
    $principal=$r['principal'];
    $secundario=$r['secundario'];
    $tipo_os=$r['tipo_os'];
}*/
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
    
<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
        <div class="col-md-2" style="background-color:orange;">
            <?php
                if(!isset($fileos) || $fileos=='' || $fileos==0){
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
        <div class="col-md-2" style="background-color:white;">
            <form name="formu" id="formu" action="upload.php" method="post" enctype="multipart/form-data">
                <input value="<?php echo $idos;?>" style="display:none;" name="id">
                <dl>            
                   <dt><label>Imagenes a Subir:</label></dt>
                   <dd>
                   <div id="adjuntos">
                   <input type="file" name="userfile[]" /><br />
                   </div>
                   </dd>
                   <dt><a href="#" onClick="addCampo()">Subir otro archivo</a></dt>      
                   <dd><input type="submit" value="SUBIR" id="envia" name="envia" class="btn btn-success"/></dd>
                </dl>
            </form>
        </div>
        <!--
        <div class="panel panle-danger col-md-2">
            <div class="panel-heading">NOTA:</div>
            <div class="panel-body" >
            <div style="font-size:10px !important;">
            Recuerda que el orden para subir imagenes es:<br>
            1.- Foto de terminal<br>
            2.- Trayectoria<br>
            3.- Remate e Ingreso (roseta abierta)<br>
            4.- Remate e Ingreso (roseta cerrada)<br>
            5.- Modem con luces encendidas (Funcionando)<br>
            6.- Medidor de Potencia<br>
            </div>
            </div>
        </div>
        -->
        <div class="col-md-2" style="background-color:orange;">
            <?php
            //echo "Os:".$idos."<br>";
            $foto=new Adjunto_os();
            $totaladjuntos=$foto->TotalAdjuntosBD($con);
            //echo "Total de Fotos en sistema:".$totaladjuntos."<br>";
            for ($i=0; $i <=$totaladjuntos; $i++) { 
                $fotos=new Adjunto_os();
                $fotos->obtenerAdjuntoOsBD($i,$con);
                $idadjunto=$fotos->regresaOsIdos();
                if($idadjunto==$idos){
                $imagen=$fotos->regresaNombreImg();
                ?>
                    <a href="../os/<?php echo $imagen;?>" target="_blank">
                        <?php echo $imagen; ?>
                        <img src="../syspic/see.png" width="20" height="20">
                    </a>
                <?php
                
                }
            }
            ?>
        </div>
        <?php
            $Os=new Dataos();
            //$Dataos=new Dataos();
            $Os->obtenerOsBD($idos,$con);
            $idmos=$Os-> regresaIdmos();
                $cope=$Os-> regresaCope();
                $expediente=$Os-> regresaExpediente();
                /*$ddos=$Os-> regresaDDOS();
                $mmos=$Os-> regresaMMOS();
                $yearos=$Os-> regresaYEAROS();*/
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
                ?>
        <div class="col-md-3">
            <form action="regDetalles.php" method="POST">
            <div class="panel panel-info">
            <?php
                $dataos=new Dataos();
                $dataos->obtenerDataosOsBD($idos,$con);
                $aux=$dataos->regresaEstatus();
                if($aux==0){
            ?>
                <div class="panel-heading">DATOS</div>
                <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>PRINCIPAL</th>
                            <td><input type="text" value="<?php echo $principal;?>" name="principal"></td>
                    </tr>
                    <tr>
                        <th>SECUNDARIO</th>
                        <td><input type="text" value="<?php echo $secundario;?>" name="secundario"></td>
                    </tr>
                    <tr>
                        <th>Claro Video</th>
                        <td>
                            <select name="claro_video"  class="form-control" required>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                            <!--<input type="text" value="<?php echo $claro_video;?>" name="claro_video">-->
                        </td>
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
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">Estatus de orden:</span>
                            <select name="estado" class="form-control" required>
                                <option value="1">Objetar</option>
                                <option value="2">Liquidada</option>
                            </select>
                        </div>
                        <textarea class="form-control" rows="3" name="detalles" placeholder="Detalles" style="resize:none;" required></textarea>
            <?php
                }if($aux==1){
            ?>
                    <h2><span class="label label-success">Datos registrados</span></h2>
            <?php
                }
            ?>
        </div>
    </div> 
<div class="container col-md-12" name="toTop" id="topPos">
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
                    <td><?php echo $folio_pisa;?></td>
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
                            <th>Tecnologia: <?php echo $tecnologia;?></th>
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
                            <td><label>Modem</label><input type="number" min=0 max=1 name="modem" value=0 required></td>
                            <td><label>Rosetas</label><input type="number" min=0 max=4 name="rosetas" value=0 required></td>
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
                    
                    <input type="submit" value="REPORTAR" class="btn btn-primary">
                     <?php
                        }if($aux==1){
                    ?>
                            <h2><span class="label label-success">Datos registrados</span></h2>
                    <?php
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" >
    <!--
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Error</th>
                    <th><?php //echo $row['erroros'];?></th>
                    <th>Tipificación de error</th>
                    <th><?php //echo $row['dd'];?></th>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td><?php //if($row['status']==0){ echo "ABIERTO";}if($row['status']==1){ echo "FINALIZADO";}?></td>
                    <th>Semana</th>
                    <td><b><?php //echo $row['semana'];?></b></td>
                </tr>
            </table>
        </div>-->
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