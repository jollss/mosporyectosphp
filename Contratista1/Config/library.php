<?php
include("conexion2.php");  
require_once 'conexion.php';
include("log.php"); 
require_once 'main.php';
require_once 'foot.php';
require_once '../Models/usuario.php';
require_once '../Models/infuser.php';
require_once '../Models/tipo.php';
require_once '../Models/pendiente.php';
require_once '../Models/usuario_infuser.php';
require_once '../Models/cantidades.php';
require_once '../Models/os.php';
require_once '../Models/dataos.php';
require_once '../Models/archivosuser.php';
require_once '../Models/checklist.php';
require_once '../Models/adjunto_os.php';
require_once '../Models/material.php';
require_once '../Models/ventas.php';
require_once '../Models/filder.php';
require_once '../Models/folioSiac.php';
require_once '../Models/tienda_comercial.php';
require_once '../Models/asignacion_cobajante.php';
require_once '../Models/fase6.php';
require_once '../Models/fase7.php';
require_once '../Models/reclutamiento.php';
require_once '../Models/reclutadorCantidad.php';
require_once '../Models/fase8.php';
require_once '../Models/finVenta.php';
require_once '../Models/adjunto_venta.php';
require_once '../Models/info_supbajantes.php';
/****************************/

/****************************/
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}

?>