<?php
  //error_reporting(0);
$idmos=($_POST['id']);
  include("../Config/library.php");
  $cnx = Conectarse();
  $con = Conectarse();
  $con2 = Conectarse();
  $mail = $_SESSION['mail'];
  $user = $_SESSION['username'];
  $Yo=new Usuario();
  $Yo->obtenerUsuarioCorreoBD($mail,$con);
  $idus=$Yo->regresaIdu();
  $name=$Yo->regresaNombre();
  $ap=$Yo->regresaApaterno();
  $am=$Yo->regresaAmaterno();
  $tos=0;
//  error_reporting(0);
$mes=date("m");
$año=date("y");
# definimos la carpeta destino
$carpetaDestino="../os/$idus$mes$año/";
# si hay algun archivo que subir
if($_FILES["archivo"]["name"][0])
{
    # recorremos todos los arhivos que se han subido
    for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)


    {

        # si es un formato de imagen
if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["name"][$i]=="image/jpg"|| $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")

        {
echo $idmos;
if($idmos==""){

  echo "  <script>alert('UPSS ALGO PASO INTENTALO NUEVAMENTE');
  document.location=('fotosos.php');
  </script>";
}
  else{
            # si exsite la carpeta o se ha creado
            if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
            {


                $origen=$_FILES["archivo"]["tmp_name"][$i];
                $destino=$carpetaDestino."".$idmos."".$idus.$_FILES["archivo"]["name"][$i];
$nombre=$idmos."".$idus."".$_FILES["archivo"]["name"][$i];
                # movemos el archivo
@move_uploaded_file($origen, $destino);
$sql11 = "INSERT INTO adjunto_os (nombreimg, os_idos)
VALUES ('$nombre','$idmos')";
$result2 = $con->query($sql11);
$result = mysqli_query($con, "SELECT COUNT(*) as total FROM adjunto_os WHERE os_idos='$idmos'");
$row = mysqli_fetch_array($result);
$count = $row['total'];
echo "<br>  $count";
}
}
}
}
}
/*

                if()
                {
                 $sql11 = "INSERT INTO adjunto_os (nombreimg, os_idos)
                VALUES ('$nombre','$idmos')";
                //  $result2 = $con->query($sql11);

                  $result = mysqli_query($con, "SELECT COUNT(*) as total FROM adjunto_os WHERE os_idos='$idmos'");
                  $row = mysqli_fetch_array($result);
                  $count = $row['total'];

if($count=='1'){

}
if($count=='7'){

$hora_actual=strftime("%H:%M:%S");
      $sql = "UPDATE dataos SET foto='SI' WHERE id_orden='$idmos'";
//$result = $con->query($sql);

               //echo "

                //<script>
              //  alert('Foto Agregadas Correctamente!');
              //  document.location=('fotosos.php');
              // </script>
            //  ";
            }
               }else{
            //  echo "
            //  alert('
            //<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];"');
            //document.location=('editarfotososliquidar.php?id=$idmos');
            //</script>";
              }
           }else{
    // echo "
  //  <script>
  //     alert('No se ha podido crear la carpeta: up/'.$user;');
  //       document.location=('editarfotososliquidar.php?id=$idmos');
  //      </script>";
           }
        }else{
//    echo "
//    <script>
//      alert('<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg,el nombre es muy largo o la calidad de la imagen supera lo permitido');
//      document.location=('editarfotososliquidar.php?id=$idmos');
//     </script>";

        }
    }
}
else{
//echo "
//<script>
//  alert('<br>No se ha subido ninguna imagen intenta nuevamente y baja la calidad de la imagen');
//  document.location=('editarfotososliquidar.php?id=$idmos');
//</script>
//";
}
*/
?>
