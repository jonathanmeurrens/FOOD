var api_url = "http://localhost/FOOD/api";

/*Store variabelen*/
var markers = new Array();
var stores;
var map;
var first = true;

(function(){

/*Store pagina*/
    console.log("hqdsmklfjqsdf");
    loadStores();
})();

function loadStores(){



    console.log("hallo")
    google.maps.visualRefresh = true;;
    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{
            var mapoptions = {
                center: new google.maps.LatLng(41.492537, -99.901813),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                zoomControl: false,
                streetViewControl: false,
                panControl: false
            };

            console.log("hallo");
            map = new google.maps.Map(document.getElementById("store_map"),
            mapoptions);

            addStores();
        }catch(e){
            console.log(e);
        }
    }
}

function addStores(){

    console.log("hallo");
    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{

            $.ajax({
                type:"GET",
                url: api_url + '/locations',
                success: function(data){
                    var stores = $.parseJSON(data);

                    console.log(data);

                    for(var i=0; i<stores.length; i++){
                        console.log("hallo");
                        var indi = i;
                        var image = new google.maps.MarkerImage('images/store/pin_@2x.png', null, null, null, new google.maps.Size(32,50));
                        var myLatLng = new google.maps.LatLng(stores[i].latitude, stores[i].longitude);

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map:map,
                            icon: image,
                            tel: stores[i].tel,
                            state: stores[i].state,
                            street: stores[i].street
                        });

                        google.maps.event.addListener(marker, 'click', function(){
                            console.log("hkom");
                            map.setCenter(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
                            map.setZoom(15);

                            console.log("hallo");
                            opPinGeklikt(event, this);
                        });
                    }

                },error:function(){
                    console.log(arguments);
                }
            });

        }catch(e){
            console.log(e);
        }
    }
}

function opPinGeklikt(event, pin){

    var splittedStreet = pin.street.split(' ').join('+');
    var splittedState = pin.state.split(' ').join('+');
    $('#store_directions').attr('href','https://maps.google.com/maps?q=' + splittedStreet + "+" + splittedState);

    if(first){
        $('#store_pop-up-box').hide();
        $('#store_pop-up-box').delay(0).animate({rotate: '-180deg'}, 0, function(){
            $('#store_pop-up-box').show();
            $('#store_tel').html(pin.tel);
            $('#store_street').html(pin.street);
            $('#store_state').html(pin.state);
            $('#store_pop-up-box').delay(0).animate({rotate: '0deg'}, 300);
            first = false;
        });
    }else{
        $('#store_pop-up-box').delay(0).animate({rotate: '-180deg'}, 300, function(){
            $('#store_tel').html(pin.tel);
            $('#store_street').html(pin.street);
            $('#store_state').html(pin.state);
            $('#store_pop-up-box').delay(0).animate({rotate: '0deg'}, 300);
        });
    }
}