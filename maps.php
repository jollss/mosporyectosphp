<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
    <script type="text/javascript" language="javascript">// <![CDATA[
      function get_loc() {
             if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(coordenadas);
             }else{
                alert('Este navegador es algo antiguo, actualiza para usar el API de localización');                  }
      }
      function coordenadas(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var map = document.getElementById("mapa");
            map.src = "http://maps.google.com/maps/api/staticmap?center=" + lat + "," + lon + "&amp;zoom=15&amp;size=600x480&amp;markers=color:red|label:A|" + lat + "," + lon + "&amp;sensor=false";
      }
    </script>
  </head>
  <body>
      <h3>My Google Maps Demo</h3>
      <div id="map"></div>
      <script>
        function initMap() {
          var uluru = {lat: -25.363, lng: 131.044};
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
          });
          var marker = new google.maps.Marker({
            position: uluru,
            map: map
          });
        }
      </script>
      <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArp8Di2dGPpFobvp958LwN7XQIsXZIeHU&callback=initMap">
      </script>
      <a href="javascript:get_loc();">Mostrar localización</a>
      <br />
  </body>
</html>