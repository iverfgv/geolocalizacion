<!DOCTYPE html>
<html>
<head>
    <title></title>
     <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
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
                            <h1>***Mapa***</h1>
                            <button type="button" class="btn btn-primary" onclick="agregarMarker()">Agregar ruta</button>
                            <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on">
                            <input type="text" id="autocomplete" placeholder="Buscar direccion">
                            <div id="value">
                            <br>
                            <div id="mapa" style="width: 700px; height:500px;">
                               
                            </div>

                            <input type="text" id="coords" />

                           
                            <!-- ********************************************************************-->
                            </div>
                        </div>
                    </div>
</body>
</html>

<script type="text/javascript">
    var gMapa
    var geocoder;

    //NAMESPACE -->google.maps.x
    var divMapa = document.getElementById('mapa');
    navigator.geolocation.getCurrentPosition(fn_ok,fn_error)

    function agregarMarker(){
        
    }
   
   /***************************buscador en google maps*******************************************************/
        
    /*********************************************************************************************************/

   function fn_ok(respuesta){
         //mostrar(respuesta.coords);
         var lat=respuesta.coords.latitude;
         var lon=respuesta.coords.longitude;

         var gLatLong = new google.maps.LatLng(lat,lon);

         //configuracion de pantalla
         var objConfig={
            zoom:17,
            center: gLatLong //centra el mapa de acuerdo a la ubiacion actual
         }

         var gMapa=new google.maps.Map(divMapa,objConfig); //crea el mapa
             geocoder = new google.maps.Geocoder();   
         var objConfigMarker={
            position:gLatLong,
            animation: google.maps.Animation.DROP,
            draggable:true,
            map: gMapa,
            title:"esto aqui"
         }


         /***************************buscador en google maps*******************************************************/
        

       $(document).ready(function(){
              $("#autocomplete").autocomplete({
                  source:function(request,response){
                      geocoder.geocode({'address':request.term},function(results){
                          response($.map(results,function(item){
                              return {
                                 label:item.formatted_address,
                                 value:item.formatted_address,
                                 latitude:respuesta.coords.latitude,
                                 longitude:respuesta.coords.longitude
                              }
                              
                          }))
                      })
                 },
                  select:function(event,ui) {
                    var location    =   new google.maps.LatLng(ui.item.latitude,ui.item.longitude);
                    marker          =   new google.maps.Marker({
                        map:map,
                        draggable:true
                    })
                   var stringvalue     =   'latitude:<input type="text" value="'+ui.item.latitude+'" >Longitude:<input type="text" value="'+ui.item.longitude+'"><br/>';
                    $("#value").append(stringvalue);
                    marker.setPosition(location);
                    map.setCenter(location);
                    
                    
                }
                  
              })
          
            });
        /*********************************************************************************************************/
         /***************************************************/

         var gMarker = new google.maps.Marker(objConfigMarker);//efecto de salto a marcador
         

         gMarker.addListener('click',toggleBounce);

         function toggleBounce(){
            if(gMarker.getAnimation() !== null){
                gMarker.setAnimation(null);
            }
            else{
                gMarker.setAnimation(google.maps.Animation.BOUNCE);
            }
         }

        /***************************************************/

        /*************obtener posicion marcador depues de soltarlo**************************************/
        gMarker.addListener('dragend',function(event){
            document.getElementById("coords").value = this.getPosition().lat() + "," + this.getPosition().lng();
        });
        /***************************************************/

        



        //ubacion por nombre
         var gCoder = new google.maps.Geocoder();
         var objInformacion = {
            address: 'tuxtla gutierrez, conalep chiapa de corzo'
         }

        
         gCoder.geocode(objInformacion, fn_coder);

         function fn_coder(datos){
            var coordenadas = datos[0].geometry.location; //objLatlong

            var config = {
                map:gMapa,
                animation: google.maps.Animation.DROP,
                draggable:true,
                position:coordenadas,
                title: "conalep"
            }

            var gMarkerDV = new google.maps.Marker(config)
                gMarkerDV.setIcon('clientess.png')
         
         var objHtml = {
            content: '<div style="height: 150px; width: 300px"><h2>Conalep de chiapa de corzo</h2><h3>Escuela Tecnica</h3><p>Informacion aqui</p></div>'
         }

         var gIW = new google.maps.InfoWindow(objHtml);

         google.maps.event.addListener(gMarkerDV,'click',function(){
            gIW.open(gMapa,gMarkerDV);
         });

        }




        //trazado de rutas
        var objConfigDR = {
            map: gMapa,
            suppressMarkers: true
        }

        var objConfigDS = {
            origin:gLatLong,//LatLong string domicilio
            destination:objInformacion.address,
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
                alert('Error: '+status);
            }
        }







        //obtener coordenadas al arrastrar
        var marker; //varible del marcador
        var coords = {}; //coordenadas obtenidas con la geolocalizacion
        
    }

    function fn_error(){       
         divMapa.innerHTML = 'Hubo un problema solicitando los datos';
    }



    

</script>



