/**
 * Created with JetBrains PhpStorm.
 * User: Warre
 * Date: 9/06/13
 * Time: 20:05
 * To change this template use File | Settings | File Templates.
 */


var api_url = "http://localhost/FOOD/api";

/*Store variabelen*/
var markers = new Array();
var stores;
var map;

(function(){

/*Store pagina*/
    loadStores();

})();


function loadStores(){

    console.log("hallo");
    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{
            var mapoptions = {
                center: new google.maps.LatLng(41.492537, -99.901813),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                zoomControl: true,
                streetViewControl: true
            };

            map = new google.maps.Map(document.getElementById("store_map"),
            mapoptions);

            addStores();
        }catch(e){
            console.log(e);
        }
    }
}

function addStores(){

    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{

            $.ajax({
                type:"GET",
                url: api_url + '/locations',
                success: function(data){
                    var stores = $.parseJSON(data);

                    for(var i=0; i<stores.length; i++){
                        var image = new google.maps.MarkerImage('images/store/pin_@2x.png', null, null, null, new google.maps.Size(16,25));
                        var myLatLng = new google.maps.LatLng(stores[i].longitude, stores[i].latitude);

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map:map,
                            icon: image,
                            address: stores[i].address,
                            location_id: stores[i].id,
                            rating: stores[i].address
                        });

                        markers.push(marker);
                    }
                    updateMapBoundsDependingOnVisibleLocations();

                },error:function(){
                    console.log(arguments);
                }
            });

        }catch(e){
            console.log(e);
        }
    }
}

function updateMapBoundsDependingOnVisibleLocations(){
    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{
            var limits = new google.maps.LatLngBounds();
            var visibleMarkers = array();

            $.each(markers, function(index, marker){
               if(marker.visible){
                   visibleMarkers.push(marker);
               }

                if(visibleMarkers.length>0)
                {
                    $.each(visibleMarkers, function (index, marker)
                    {
                        limits.extend(marker.position);
                    });
                    map.fitBounds(limits);
                }

            });
        }catch(e){
            console.log(e);
        }
    }
}