<?php
//var_dump($_POST);
$idus=$_POST['ident'];
//echo $main;
function optionSelect($dato,$name){
	if($dato==1){
		?>
		<select class="form-control" name="<?php echo $name;?>">
        	<option value="1" selected>SI</option>
        	<option value="0">NO</option>
        </select>
		<?php
	}if($dato==0){
		?>
		<select class="form-control" name="<?php echo $name;?>">
        	<option value="0" selected>NO</option>
        	<option value="1">SI</option>
        </select>
		<?php
	}if($dato<>0 and $dato<>1){
		?>
		<select class="form-control" name="<?php echo $name;?>">
			<option value="">-Selecciona-</option>
        	<option value="0">NO</option>
        	<option value="1">SI</option>
        </select>
		<?php
	}
}
?>
<div class="col-md-12">
        <div class="panel panel-info">
            <?php
            $sql2="SELECT * FROM venta WHERE idventa='$idus'";
            $resultado2=$con2->query($sql2);
            while($row2 = $resultado2->fetch_assoc())
            {
                $idventa=$row2['idventa'];
                $folio_ventas=$row2['folio_ventas'];
                $idvendedor=$row2['idvendedor'];
                $nombre=$row2['nombrev'];
                $ap=$row2['apaternov'];
                $am=$row2['amaternov'];
                $direccion=$row2['direccion'];
                $datos=$row2['datos'];
                $telefono_1=$row2['telefono_1'];
                $telefono_2=$row2['telefono_2'];
                $telefono_3=$row2['telefono_3'];
                $terminal=$row2['terminal'];
                $dia=$row2['dia'];
                $mes=$row2['mes'];
                $year=$row2['year'];
                $hora=$row2['hora'];
                $doc=$row2['documentacion'];
                $area=$row2['area'];
                $dist=$row2['distrito'];

                $fecha=$dia."/".$mes."/".$year." ".$hora;
                $estatus=$row2['estatus'];

                $idfilder=$row2['idvendedor'];
                $contesto=$row2['contesto'];

                $iduser=$row2['idvendedor'];
                $fechafilder=$row2['fecha_fielder'];
                $cliente=$row2['cliente'];
                $atiende=$row2['atiende'];
                $servicio=$row2['servicio'];
                $paquete=$row2['paquete'];
                $direccion=$row2['direccion_v'];
                $colonia=$row2['colonia'];
                $municipio=$row2['municipio'];
                $cp=$row2['cp'];
                $instalacion=$row2['gastos_instalacion'];
                $tiempo_i=$row2['tiempo_instalacion'];
                $obs=$row2['observaciones'];

                $siac=$row2['folio_siac'];//regresaFolioSiac();
                $comercial=$row2['tienda_comercial'];// regresaTiendaComercial();
                $telasig=$row2['tel_asignado'];// regresaTelAsignado();
                $folioOs=$row2['folio_os'];// regresaFolioOs();
                $etapa=$row2['etapa'];// regresaEtapa();
                $lps=$row2['listo_ps'];// regresaListoPs();
                $fechaC=$row2['fecha_comercial'];// regresaFechaComercial();
                $coments_1=$row2['coments_1'];
                $coments_2=$row2['coments_2'];
                /*
                if($contesto=='SI' or !isset($contesto)){
                    $iduser=$row2['idvendedor'];
                    $fechafilder=$row2['fecha_fielder'];
                    $cliente=$row2['cliente'];
                    $atiende=$row2['atiende'];
                    $servicio=$row2['servicio'];
                    $paquete=$row2['paquete'];
                    $direccion=$row2['direccion_v'];
                    $colonia=$row2['colonia'];
                    $municipio=$row2['municipio'];
                    $cp=$row2['cp'];
                    $instalacion=$row2['gastos_instalacion'];
                    $tiempo_i=$row2['tiempo_instalacion'];
                    $obs=$row2['observaciones'];
                    //$idventa=$row2[''];
                }
                */
                $dato=$row2['dato_completo'];
                $dato2=$row2['venta_area'];
                $dato3=$row2['venta_area'];
                $dato4=$row2['distrito_asignado'];
                $dato5=$row2['promotor_informo'];
                $dato6=$row2['valido_horas'];

                $fecha_mod=$row2['fecha_siac'];
            }
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $semana = date("W");
            ?>
            <div class="panel-heading">
                <?php 
                    echo $dia."/".$mes."/".$aaaa;
                ?>
            </div>
            <form action="../validarVenta/modVenta.php" method="POST">
            <input type="hidden" value="<?php echo $main;?>" name="main">
            <div class="panel-body">
            <div class="col-md-12">
                <!--<form action="modVenta.php" method="POST">-->
                <input type="" name="idventa" value="<?php echo $idventa;?>" style="display:none;">
                    <div class="well col-md-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">No. de Solicitud: <?php //echo $folio_ventas;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $folio_ventas;?>" name="folio_ventas"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Nombre: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $nombre;?>" name="nombre"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Apellido Paterno: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $ap;?>" name="apaterno"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Apellido Materno: <?php// echo $nombre;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $am;?>" name="amaterno"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Dirección: <?php //echo $direccion;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $direccion;?>" name="dir"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Detalles: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $datos;?>" name="datos"  required> 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Terminal: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $terminal;?>" name="terminal" > 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Area: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $area;?>" name="area" > 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Distrito: <?php //echo $datos;?></span>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $dist;?>" name="distrito" > 
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Documentacion</span>
                            <?php //echo $instalacion;?>
                            <select class="form-control" id="sel1" name="documentacion">
                            <?php 
                            if($doc=="NO" OR $doc==''){
                                ?>
                                <option value='NO' selected="selected">NO</option>
                                <option value='SI'>SI</option>
                            <?php
                            }if($doc=="SI"){
                                ?>
                                <option value='NO'>NO</option>
                                <option value='SI' selected="selected">SI</option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Fecha:<?php echo $fecha;?></span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">Telefonos</span>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon" id="sizing-addon3">
                            <?php //echo $telefono_1;?>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_1;?>" name="tel1"  required> 
                            </span>
                            <span class="input-group-addon" id="sizing-addon3">
                            <?php //echo $telefono_2;?>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_2;?>" name="tel2"  required> 
                            </span>
                            <span class="input-group-addon" id="sizing-addon3">
                            <?php //echo $telefono_3;?>
                            <input class="form-control" aria-describedby="sizing-addon4" value="<?php echo $telefono_3;?>" name="tel3"  required> 
                            </span>
                        </div>
                        <!--<div align="center"><input type="submit" value="MODIFICAR" id="envia" name="envia" class="btn btn-danger"/></div>-->
                    </div>
                <!--</form>-->
            </div>
            
	            <div class="col-md-12">
	            	<div class="col-md-6">
	            		<div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Datos Completos: </span>
	                        <?php  optionSelect($dato,'dato_completo'); ?>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Venta de Área: </span>
	                        <?php  optionSelect($dato2,'venta_area'); ?>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Venta DISTRITO Asignado: </span>
	                        <?php  optionSelect($dato3,'distrito_asignado'); ?>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <input class="form-control"  name="coments_1"  placeholder="COMENTARIOS" value="<?php echo $coments_1;?>"> 
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Cliente contesto: </span>
	                        <?php  optionSelect($dato4,'cliente_contesto'); ?>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Promotor informo detalles: </span>
	                        <?php  optionSelect($dato5,'promotor_informo'); ?>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <input class="form-control"  name="coments_2"  placeholder="COMENTARIOS" value="<?php echo $coments_2;?>"> 
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Valido -24hrs : </span>
	                        <?php  optionSelect($dato6,'valido_horas'); ?>
	                    </div>
	                    <div>
	                    	<textarea class="form-control" rows="3" name="detalles" placeholder="Observaciones"  style="resize:none;"  > <?php echo $obs;?> </textarea>
	                    </div>
	            	</div>

	            	<div class="col-md-6">
	            		<!--=========-->
						<input type="hidden" name="id" value="<?php echo $idventa;?>">
	                    
	                    <table>
	                    <?php
	                    if($siac<>0 or $siac<>''){
	                    ?>
	                        <tr>
	                            <td><span class="input-group-addon" id="sizing-addon3">Folio Siac: <?php echo $siac;?></span></td>
	                        </tr>
	                        <!--
	                        <tr>
	                            <td><span class="input-group-addon" id="sizing-addon3">Fecha de Registro: <?php echo $fechaR;?></span></td>
	                        </tr>
	                        -->
	                    <?php
	                    }if($siac==0 or $siac==''){
	                        ?>
	                        <div class="input-group input-group-sm">
	                            <span class="input-group-addon" id="sizing-addon3">Folio Siac:</span>
	                            <input class="form-control" aria-describedby="sizing-addon4"  name="siac"   > 
	                        </div>
	                        <?php
	                    }
	                    ?>
	                    </table>

	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Tienda Comercial: </span>
	                        <input class="form-control" aria-describedby="sizing-addon4"  name="tienda"  value=""  > 
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Teléfono: </span>
	                        <input class="form-control" aria-describedby="sizing-addon4" type="tel" value="" pattern=".{10}" name="tel"   > 
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Folio Orden de Servicio: </span>
	                        <input class="form-control" aria-describedby="sizing-addon4"  name="folio_o"  value=""  > 
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Etapa: </span>
	                        <!--
	                        <input class="form-control" aria-describedby="sizing-addon4"  name="estapa" value=""  > 
	                        -->
	                        <select name="estapa" class="form-control"  >
	                        	<option value="">-Seleccionar etapa-</option>
	                            <option value="ABIERTA">I ... ABIERTA</option>
	                            <option value="P">P ... POSTEADO</option>
	                            <option value="CANCELADA">X... CANCELADO</option>
	                            <option value="COMERCIAL">C... COMERCIAL </option>
	                            <option value="ADEUDO">CC... ADEUDO </option>
	                            <option value="DEMANDA/INFRAESTRUCTURA">ID... DEMANDA/INFRAESTRUCTURA</option>
	                            <option value="SOLICITUD DUPLICADA">SOLICITUD DUPLICADA </option>
	                            <option value="0">NINGUNO</option>
	                        </select>
	                    </div>
	                    <div class="input-group input-group-sm">
	                        <span class="input-group-addon" id="sizing-addon3">Listo para Instalar (PS): </span>
	                        <input class="form-control" aria-describedby="sizing-addon4"  name="ps"  value=""  > 
	                    </div>
	                     <div class="input-group input-group-sm">
	                     <button class="btn btn-primary">REGISTRAR</button>
	                     </div>
	                     <div>
	                     <label>
	                     Ultima modificación:
	                     	<?php echo $fecha_mod;?>
	                     </label>
	                     </div>
	                    <!--===========-->
	            	</div>
	            </div>
            
		    </div>  
		    </form>  
</div>