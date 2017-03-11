<!-- Services Section -->
    <section id="rutas">
        <div class="container">
				<div class="row">
					<div class="col-md-12">
      <h1><center>Elija su ruta</center></h1>
      <center><strong>Rutas: </strong>
      <select id="ruta">
      <option value="Ruta Azteca">Ruta Azteca</option>
      <option value="Ruta 29">Ruta 29</option>
        </select> </center>
        <br/>
        <br/>
      <div id="ubicacion"></div>

    <div id="map" style="width:100%;height:400px;"></div>
    
    <script>
        var x = document.getElementById("ubicacion");

      function initMap() {
        var ubicacion = {lat: 19.020224, lng: -98.249825};
        var markers = [];

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: ubicacion,
          scrollwheel: true,
          zoom: 18
        });

        /*var pos2 = new google.maps.LatLng(19.024100, -98.239003);
        var marker2 = new google.maps.Marker({
                        position: pos2,
                        map: map
                        });*/
        
        if (navigator.geolocation) {

            var marker = null, circle = null, circle2 = null;

            navigator.geolocation.watchPosition(function success(position){
            
            var lat = position.coords.latitude;
            var long = position.coords.longitude;

            var pos = new google.maps.LatLng(lat, long);

                if(marker)
                {
                    marker.setMap(null);
                    marker=null;
                    circle.setMap(null);
                    circle2.setMap(null);
                    newMarker(pos);
                    //sendCoord(lat,long);
                }
                else
                {
                    newMarker(pos);
                    //alert(pos);
                    //sendCoord(lat,long);
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

            circle2 = new google.maps.Circle({
                //strokeColor: '#000000',
                strokeOpacity: 0.2,
                strokeWeight: 2,
                //fillColor: '#000000',
                fillOpacity: 0.05,
                map: map,
                radius: Math.sqrt(3857799) / 7,
            });
            circle2.bindTo('center',marker,'position');
        };

        function sendCoord(lat,long)
        {
             var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        //document.getElementById("txtHint").innerHTML = this.responseText;
                        //alert('Status: '+xmlhttp.status+' Response: '+xmlhttp.responseText);
                }
            };
            var data = "lat="+lat+"&long="+long;
            //alert(data);
            xmlhttp.open("POST", "/rutas/Inicio/coordenadas", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(data);
        };
        } else { 
            x.innerHTML = "La localizacion no está disponible para su navegador. Favor de probar en otro.";
        }

        /*************************************/
        //var ruta = document.getElementById("ruta");
        var ruta = document.getElementsByTagName('select')[0].onchange = function() {
            var index = this.selectedIndex;
            var ruta = this.children[index].innerHTML.trim();
            //console.log(ruta);

            getRutaCercana(ruta);
        };


        function getRutaCercana(ruta)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        //document.getElementById("txtHint").innerHTML = this.responseText;
                        //alert('Status: '+xmlhttp.status+' Response: '+xmlhttp.responseText);
                        
                        //Creamos nuestro parse JSON.
                        var objRuta = JSON.parse(xmlhttp.responseText);
                        //alert(objRuta.lat);
                        var lat2 = objRuta.lat;
                        var long2 = objRuta.long;

                        var ubicacion2 = new google.maps.LatLng(lat2, long2);
                        
                        var contentString = '<h5>Ruta: </h5>'+objRuta.nombre+'<br/><h5>Chofer: </h5>'+objRuta.chofer;

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        var marker2 = new google.maps.Marker({
                                    position: ubicacion2,
                                    map: map
                                });
                        marker2.addListener('click', function() {
                            infowindow.open(map, marker2);
                        });
                        map.setCenter(ubicacion2);
                        
                }
            };


            var data = "ruta="+ruta;
            //alert(data);
            xmlhttp.open("POST", "/rutas/Inicio/getRutas", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(data);
        };

    }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWhKNVCUfiSZrkiCjISK5kFD4_WRsYgk&callback=initMap"
    async defer></script>

</div>
</div>
</div>
</section>