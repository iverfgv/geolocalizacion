<!DOCTYPE html>
<html>
<head>
<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

    </style>
    <title></title>
     <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&callback=initAutocomplete"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
    <link rel="stylesheet" href="../js/jquery-ui-1.8.18.custom.css"/>
    <link rel="stylesheet" href="../js/bootstrap.min.js"/>
   
</head>
<body>
     <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">
                              
                            <!-- ************************* trazado de rutas*************************-->
                            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                            <h1>***Mapa***</h1>
                            <button type="button" class="btn btn-primary" onclick="fn_agregarmarcador()">Agregar ruta</button>

                            <input type="text" id="latitud" placeholder="latitud">

                            <input type="text" id="longitud" placeholder="longitud">

                            <div id="value">
                            <br>
                            
                               
                            </div>
                            <br>
                            <input type="text" id="cLatitud" name="cLatitud">
                            <input type="text" id="cLongitud" name="cLongitud">



                            <div class="col-md-3">
                             <label class="control-label"></label>
                                <button onclick="javascript: fn_agregarmarcador();" type="button" name="agregar" value="Agregar" id="agregar" class="btn btn-primary waves-effect posi">Agregar</button>
                            </div>

                        <div class="row">
                            <div id="mapa" class="col-md-8" style="width: 700px; height:500px; float:left;">
                        </div>

                        <div class="col-md-4 scrolltabla">
                                    <table id="grilla" class="lista" border="1">
                                        <thead>
                                            <tr>
                                                <th>ID |</th>
                                                <th>Ubicación</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>  

                                 <input onclick="deleteMarkers();" type=button value="Delete Markers">
                                

                         
                          <input type="hidden" name="ubicaciones" id="idubis">  

                           
                            <!-- ********************************************************************-->
                            </div>
                        </div>
                    </div>

</body>
</html>

<script type="text/javascript"> 
    var markers = [];  
    var itsolution = new google.maps.LatLng(16.74600732056105, -93.12956979999996);  

    var opciones = {  
        zoom: 15,
        center: itsolution,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };


    var div = document.getElementById('mapa');  

    var map = new google.maps.Map(div, opciones); // Creamos un marcador y lo posicionamos en el mapa  
    
    var marcador = new google.maps.Marker({  
      position: new google.maps.LatLng(16.744486785935727,-93.12396934757686),
      draggable:true,
      map: map
    });

    function nuevoMarker()
    {
      var marcador = new google.maps.Marker({  
          position: new google.maps.LatLng(16.744486785935727,-93.12396934757686),
          draggable:true,
          map: map
      });
    }

    


    /*****************************************************************************************/
    map.addListener('click', function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        addMarker(event.latLng,lat,lng);
    });   

     
    function addMarker(location,lat,lng) {
       
      var marker = new google.maps.Marker({
        position: location,
        draggable:true,
        map: map
      });
      markers.push(marker);
      fn_agregarmarcadorclick(lat,lng);
    }
    /*****************************************************************************************/

    function deleteMarkers() {
      clearMarkers();
      markers = [];
    }

    function clearMarkers() {
      setMapOnAll(null);
    }

    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }




    marcador.addListener('click',toggleBounce);

         function toggleBounce(){
            if(marcador.getAnimation() !== null){
                marcador.setAnimation(null);
            }
            else{
                marcador.setAnimation(google.maps.Animation.BOUNCE);
            }
         }


























        /*********************************************************************************************/
        function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]
}

        /*********************************************************************************************/



















     function fn_agregarmarcador(){

        /*var marcador = new google.maps.Marker({  
          position: new google.maps.LatLng(16.744486785935727,-93.12396934757686),
          draggable:true,
          map: map
      });*/
        /*
        document.getElementById("latitud").value = "16.744486785935727";
        document.getElementById("longitud").value = "-93.12396934757686";

        marcador.addListener('dragend',function(event){
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
        });*/

            
            var ltd = document.getElementById("latitud");
            var latitud = ltd.value;
            var lgd = document.getElementById("longitud");
            var longitud = lgd.value;

                cadena = "<tr id='quit2'>";
                cadena = cadena + "<td id='tdLatitud'>"+ latitud + "</td>";
                cadena = cadena + "<td  id='tdLongitud'>"+longitud + "</td>";
                cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
         
                $("#grilla tbody").append(cadena);
                arregloLatitud = [];
                arregloLongitud = [];
                $('#grilla tbody tr').each(function(){
                    variables =$(this).find("td[id='tdLatitud']").text()
                    arregloLatitud.push(variables);
                    variables =$(this).find("td[id='tdLongitud']").text()
                    arregloLongitud.push(variables);
                });

                console.log(arregloLatitud);
                $('#cLatitud').val(arregloLatitud);
                $('#cLongitud').val(arregloLongitud);
                fn_eliminarmarcador();
                
                
            };
            
            function fn_eliminarmarcador(){

                $("a.elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                   
                        $(this).parents("tr").fadeOut("normal", function(){
                            $(this).remove();
                                  arregloLatitud=[];
                                  arregloLongitud=[];
                $('#grilla tbody tr').each(function(){
                    variables =$(this).find("td[id='tdLatitud']").text()
                    arregloLatitud.push(variables);
                    variables =$(this).find("td[id='tdLongitud']").text()
                    arregloLongitud.push(variables);

                });
                
                $('#cLatitud').val(arregloLatitud);
                $('#cLongitud').val(arregloLongitud);
                           
                        })
                    
                });
            };



            function fn_agregarmarcadorclick(latitud,longitud){
                cadena = "<tr id='quit2'>";
                cadena = cadena + "<td id='tdLatitud'>"+ latitud + "</td>";
                cadena = cadena + "<td  id='tdLongitud'>"+longitud + "</td>";
                cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
         
                $("#grilla tbody").append(cadena);
                arregloLatitud = [];
                arregloLongitud = [];
                $('#grilla tbody tr').each(function(){
                    variables =$(this).find("td[id='tdLatitud']").text()
                    arregloLatitud.push(variables);
                    variables =$(this).find("td[id='tdLongitud']").text()
                    arregloLongitud.push(variables);
                });

                console.log(arregloLatitud);
                $('#cLatitud').val(arregloLatitud);
                $('#cLongitud').val(arregloLongitud);
                fn_eliminarmarcador();
                
                
            };

</script>


