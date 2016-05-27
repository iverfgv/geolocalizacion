<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
    <style>
      html, body {
        height: 90%;
        width: 80%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 80%;
        float:left;
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



    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
  <button onclick="javascript: trazarrutas();" type="button" name="agregar" value="Agregar" id="agregar" class="btn btn-primary waves-effect posi">Agregar</button>
  <button onclick="javascript: removeRoute();" type="button" name="remover" value="remover" id="remover" class="btn btn-primary waves-effect posi">remover</button>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map" name="map"></div>

     <div class="col-md-4 scrolltabla">
                                    <table id="grilla" class="lista" border="1">
                                        <thead>
                                            <tr>
                                                <th>ID |</th>
                                                <th>Latitud</th>
                                                <th>Longitud</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div> 

    {!!Form::open(['route'=>'ruta.store','method'=>'POST'])!!}

      <input type="hidden" name="ubicaciones" id="idubis"> 

      <input type="text" id="cLatitud" name="cLatitud">
      <input type="text" id="cLongitud" name="cLongitud">
    <div class="modal-footer">
      {!!Form::submit('Guardar',['class'=>'btn btn-default'])!!}
    </div>    

    
  </body>
</html>













<script>
  var markers = [];
  var markersEliminados=[];
  var map;
  
  /***************agregar marcado click en el boton agregar************/
  function fn_agregarmarcador()
  { 
    //console.log(markers);
      for (var i = 0; i < markers.length; i++) {
        //markers[i].setMap(map);
        fn_agregarmarcadores(i,markers[i].position.lat(),markers[i].position.lng());
        //console.log(markers[i].position.lat());
      }
  }
  /**********************************************************************/
  


 





function initAutocomplete() {
  var opciones = {  
          zoom: 15,
          center: {lat: 16.744486785935727, lng: -93.12396934757686},
          mapTypeId: google.maps.MapTypeId.ROADMAP
      };


    var div = document.getElementById('map');

    map = new google.maps.Map(div, opciones); // Creamos un marcador y lo posicionamos en el mapa  
    
    var marcador = new google.maps.Marker({  
      position: new google.maps.LatLng(16.744486785935727,-93.12396934757686),
      draggable:true,
      map: map
    });
    
  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

        /* Clear out the old markers.
        markers.forEach(function(marker) {
          marker.setMap(null);
        });
    markers = [];*/

    //Para cada lugar, obtener el icono, el nombre y la ubicación.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      //Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        draggable:true,
        title: place.name,
        position: place.geometry.location
      }));

      var maximo=0;
       for (var i = 0; i < markers.length; i++) {
        maximo=i;
      }

      fn_agregarmarcadores(maximo,place.geometry.location.lat(),place.geometry.location.lng());
      trazarruta();

      if (place.geometry.viewport) {
        //Sólo los códigos geográficos tienen ventana
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

















  /************* agregar marcador al hacer click ***********************/
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

      var maximo=0;
       for (var i = 0; i < markers.length; i++) {
        maximo=i;
      }

      fn_agregarmarcadores(maximo,lat,lng);


    }
  /********************************************************************/
 

   

}//se cierra initial
  
  function verificarMarker(valor){
  var b=0;
    for (var i = 0; i < markersEliminados.length; i++) {
      if(markersEliminados[i]==valor){
        b=1;
      }
    }

    return b;
}



function removeRoute() {
  /*map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: {lat: 16.744486785935727, lng: -93.12396934757686},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  */ 
  var DirectionsRenderer = new google.maps.DirectionsRenderer();
  DirectionsRenderer.setMap(map);
 
  alert("limpiado");
};

  function trazarrutas()
  {
     /********************************************************************************************/

        //trazado de rutas
          var b=0;
    var vlatitud=[];
    var vlongitud=[];
    var c=0;
    for (var i = 0; i < markers.length; i++){    
        b=verificarMarker(i);
        if(b==0)
        {
          vlatitud[c]=markers[i].position.lat();
          vlongitud[c]=markers[i].position.lng();
          c++;
        }
    }

   for (var i = 0; i < vlatitud.length; i++){    
      b=verificarMarker(i);
   
      var objConfigDR = {
                    map: map,
                    suppressMarkers: true
                } 
                 var gLatLong = new google.maps.LatLng(vlatitud[i],vlongitud[i]);
                if((i+1)<markers.length){
                var gLatLong2 = new google.maps.LatLng(vlatitud[i+1],vlongitud[i+1]);}
                else{gLatLong2 = new google.maps.LatLng(0,0);}
                //alert(markers[i].position.lat()+","+markers[i].position.lng());
                //alert(markers[i+1].position.lat()+","+markers[i+1].position.lng());
                var objConfigDS = {
                    origin:gLatLong,//new google.maps.LatLng(16.74438646155075,-93.12758445739746),
                    destination:gLatLong2,  //snew google.maps.LatLng(16.747119307064523,-93.1247091293335 ),
                    travelMode:google.maps.TravelMode.DRIVING //DRIVING, WALKING, TRANSIT, BICYCLING
                }

                var ds = new google.maps.DirectionsService(); //obtener coordenadas
                var dr = new google.maps.DirectionsRenderer(objConfigDR); //traduce coordenadas a la ruta visible
                ds.route(objConfigDS,fnRutear);

                function fnRutear(resultados, status){
                    if(status=='OK'){
                        dr.setDirections(resultados);
                    }
                    else{
                      //alert('Error: '+status);
                    }
                }
              }


        /********************************************************************************************/
  }







  /*
   google.maps.event.addListener(markers[0], 'dragend', function (event) {
        alert("llego");
    });
  */

   function fn_agregarmarcadores(index,latitud,longitud){ 

                cadena = "<tr id='quit2'>";
                cadena = cadena + "<td id='tdindex'>"+ index + "</td>";
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

                $('#cLatitud').val(arregloLatitud);
                $('#cLongitud').val(arregloLongitud);
                fn_eliminarmarcador();

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
                
                
            };
            
            function fn_eliminarmarcador(){
                $("a.elimina").click(function(){
                    index = $(this).parents("tr").find("td").eq(0).html();
                    latitud = $(this).parents("tr").find("td").eq(1).html();
                    longitud = $(this).parents("tr").find("td").eq(2).html();
                    
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
                });

                    })

                    eliminarMarcador(latitud,longitud); 

            };

            function eliminarMarcador(latitud,longitud){
              for (var i = 0; i < markers.length; i++) {
                if(markers[i].position.lat()==latitud&&markers[i].position.lng()==longitud)
                {
                  markers[i].setMap(null);       
                  markersEliminados.push(i);     
                }
                
              }
              removeRoute();
            }


            function actualizardatos(){
                $("a.elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                    /*******/
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
                  /**********/
                });
            };



























</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvaCqck3l_wuhNVoihmTvDxKYLWYBKpfQ&libraries=places&callback=initAutocomplete" async defer></script>