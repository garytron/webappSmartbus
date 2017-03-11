<!DOCTYPE html>
<html>
  <head>
    <!-- This stylesheet contains specific styles for displaying the map
         on this page. Replace it with your own styles as described in the
         documentation:
         https://developers.google.com/maps/documentation/javascript/tutorial -->
  </head>
  <body>
      Hola usuario, tu ubicacion es:
      <button onclick="getLocation()">Mostrar ubicacion</button>
      <div id="ubicacion"></div>
    <div id="map" style="width:100%;height:400px;"></div>
    
    <script>
        var x = document.getElementById("ubicacion");

      function initMap() {
        var ubicacion = {lat: 19.020224, lng: -98.249825};
        var markers = [];
        var idWatch;
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: ubicacion,
          scrollwheel: false,
          zoom: 20
        });

        if (navigator.geolocation) {

            var marker = null, circle = null;

            navigator.geolocation.watchPosition(function success(position){
            
            var lat = position.coords.latitude;
            var long = position.coords.longitude;

            var pos = new google.maps.LatLng(lat, long);

            if(marker)
            {
                marker.setMap(null);
                marker=null;
                circle.setMap(null);
                newMarker(pos);
            }
            else
            {
                newMarker(pos);
            }
        });

        function newMarker(pos)
        {
            marker = new google.maps.Marker({
                        position: pos,
                        map: map
                        });
            map.setCenter(pos);

                    /************************************/
            circle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.15,
                map: map,
                radius: Math.sqrt(3857799) / 100,
            });

            circle.bindTo('center',marker,'position');
        };
        } else { 
            x.innerHTML = "La localizacion no está disponible para su navegador. Favor de probar en otro.";
        }
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWhKNVCUfiSZrkiCjISK5kFD4_WRsYgk&callback=initMap"
    async defer></script>

  </body>
</html>