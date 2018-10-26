<?php
include("Config/library.php"); 
$con = Conectarse();  
/*
$Infuser  = new Infuser(); //class extends Usuario
$Infuser->obtenerIdu($con);
$Infuser->obtenerIdInfuser($con);
$idu = $Infuser->regresaIdu();
$idinfo = $Infuser->regresaIdinfo();
$Infuser->ingresarUsuario('yth@mosproyectos.com.mx','nombre','paterno','materno','123','748dsd84','7221458796','7225421658','1/2/3','4/5/6','direccion prueba','casado','1.68','NA','s54d78er345s5','7225487963','20','MOS INTERNO','2');
$Infuser->ingresarInfuser('0','9:00','12:00','PLANta','1993-03-27','MEXICANA','MasCulIno','67','b@mail.com','447d5f5g87r5d4','11111111','22222222','0','5000',$idu);
$Infuser->registrarUsuarioBD($con);
$Infuser->registrarInfouserBD($con);
*/
$correo = 'yth@mosproyectos.com.mx';

//$user = $_SESSION['username'];
$dfg=new Usuario();
$dfg->obtenerUsuarioBD('0',$con);
/*
$Tipo = new Tipo();
$Tipo->ingresarTipo('2','RH');
$Tipo->verTipo();
$Tipo->registrarTipoBD($con);
*/
?>