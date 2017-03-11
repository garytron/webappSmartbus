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

            var marker = null;
           
            navigator.geolocation.watchPosition(function success(position){
            
            var lat = position.coords.latitude;
            var long = position.coords.longitude;

            var pos = new google.maps.LatLng(lat, long);

            if(marker)
            {
                marker.setMap(null);
                marker=null;
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
        };
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWhKNVCUfiSZrkiCjISK5kFD4_WRsYgk&callback=initMap"
    async defer></script>

  </body>
</html>