<?php
ob_start();
include("Config/conexionUser.php");
include("Config/conexionUser2.php");
$con = Conectarse();
/*============================================================*/
$mail=$_POST['mail'];
$pass=md5($_POST['password']);

$c=0;
    $us ="SELECT * FROM usuario WHERE correo = '$mail' AND pssw = '$pass' AND activo=1";
    if ($resultado = mysqli_query($con, $us))
    {
        while ($obj = mysqli_fetch_object($resultado)) {
            $name=$obj->nombre;
            $ap=$obj->apaterno;
            $am=$obj->amaterno;
            $zona=$obj->id_zona;
            $A=$name." ".$ap." ".$am;
    		$B=$obj->tipo_idtipo;
            $c++;
        }
        if ($c==1){
        	switch ($B) {

        		case $B==1:
        			session_start();
    				$_SESSION['mail']=$mail;
    				$_SESSION['username']=$A;
    				$_SESSION['password']=$pass;
                    ////logIn($nombre_archivo,$A,$mail);
    				header('Location: tecnico/inde.php');
        		break;
                case $B==2:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    $_SESSION['tiempo']=0;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: rh/inde.php');
                break;
                case $B==3:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    $_SESSION['tiempo']=0;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: supervisor/inde.php');
                break;
        		case $B==3:
        			session_start();
    				$_SESSION['mail']=$mail;
    				$_SESSION['username']=$A;
    				$_SESSION['password']=$pass;
                    $_SESSION['tiempo']=0;
                    //logIn($nombre_archivo,$A,$mail);
    				header('Location: supervisor/inde.php');
        		break;
        		case $B==4:
        			session_start();
    				$_SESSION['mail']=$mail;
    				$_SESSION['username']=$A;
    				$_SESSION['password']=$pass;
                    ////logIn($nombre_archivo,$A,$mail);
    				header('Location: validacion/inde.php');
        		break;
                case $B==5:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    $_SESSION['AltaGerencia']='MosProyectos';
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: AltaGerencia/inde.php');
                break;
                case $B==13:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: almacen/inde.php');
                break;
                case $B==15:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: level5adm/inde.php');
                break;
                case $B==16:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: digital/inde.php');
                break;
                case $B==17:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: call_center/inde.php');
                break;
                case $B==19:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: asignar/inde.php');
                break;
                case $B==20:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: reclutador/inde.php');
                break;

                case $B==21:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: ventas/inde.php');
                break;
                case $B==27:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: bp/inde.php');
                break;
                case $B==22:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: filderG/inde.php');
                break;
                case $B==23:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: filderG/inde.php');
                break;
                case $B==24:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: ventasS/inde.php');
                break;
                case $B==25:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: cbajantes/inde.php');
                break;
                case $B==26:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    //header('Location: bajantesG/inde.php');
                    header('Location: cbajantes/inde.php');
                break;
                case $B==28:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: supCalidadB/inde.php');
                break;
                case $B==34:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: ChOfficer/inde.php');
                break;
                case $B==32:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: Lider/inde.php');
                break;
                case $B==33:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: gerenteTF/inde.php');
                break;
                case $B==29:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: DirRh/inde.php');
                break;
                /*------------------------------------*/
                case $B==36:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: telmex/inde.php');
                break;
                /*------------------------------------*/
                case $B==37:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: cobranza/inde.php');
                break;
                /*INICIO ADMINISTRATIVOS*/
                case $B==39:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: administrativo/inde.php');
                break;
                case $B==40:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: administrativo/inde.php');
                break;
                case $B==41:
                    session_start();
                    $_SESSION['mail']=$mail;
                    $_SESSION['username']=$A;
                    $_SESSION['password']=$pass;
                    //logIn($nombre_archivo,$A,$mail);
                    header('Location: administrativo/inde.php');
                break;
                /*FIN ADMINISTRATIVOS*/
        		default:
                    //logError($logErrors,$mail);
        			echo "
    			    <script>
    			        alert('USUARIO NO EXISTE');
    			        document.location=('index.html');
    			    </script>";
        			break;
        	}
        }if($c<>1 and isset($_POST['tipo']) and $_POST['tipo']==5){
            session_start();
            $_SESSION['mail']=$mail;
            $_SESSION['username']=$A;
            $_SESSION['password']=$pass;
            $_SESSION['AltaGerencia']='MosProyectos';
            //logIn($nombre_archivo,$A,$mail);
            //header('Location: AltaGerencia/inde.php');
            var_dump($_SESSION);
        }
                    //logError($logErrors,$mail);
                    echo  "
    			    <script>
    			        alert('USUARIO O CONTRASEÑA INCORRECTOS');
    			        document.location=('index.html');
    			    </script>";
        mysqli_free_result($resultado);
    }
    /*else{
        echo  mysqli_error($con);
    }
    */

//}
$con -> close();
ob_end_flush();
?>
