<!DOCTYPE html>
<html lang="es">
<head><meta charset="utf-8"><title>Ubicacion</title>
<script type="text/javascript">
function iniciar(){
var boton=document.getElementById('obtener');
boton.addEventListener('click', obtener, false);
}
 
function obtener(){navigator.geolocation.getCurrentPosition(mostrar, gestionarErrores);}
 
function mostrar(posicion){
var ubicacion=document.getElementById('localizacion');
var datos='';
datos+='Latitud: '+posicion.coords.latitude+'<br>';
datos+='Longitud: '+posicion.coords.longitude+'<br>';
datos+='Exactitud: '+posicion.coords.accuracy+' metros.<br>';
//ubicacion.innerHTML=datos;
ubicacion.innerHTML="<a href='http://maps.google.com/maps?q=loc: " + posicion.coords.latitude + "," + posicion.coords.longitude + "' target='_blank'>Aqui</a>";
}
 
function gestionarErrores(error){
alert('Error: '+error.code+' '+error.message+ '\n\nPor favor compruebe que está conectado '+
'a internet y habilite la opción permitir compartir ubicación física');
}
 
window.addEventListener('load', iniciar, false);
 
</script>
</head>
<body>
<div id="localizacion">
<button id="obtener" style="margin:30px;">Obtener mi localización</button>
</div>
</body>
</html>