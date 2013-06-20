//var api_url = "http://172.30.26.141/FOOD/api";
var api_url = "http://192.168.0.100/FOOD/api";
//var api_url = "http://localhost/FOOD/api";

var map;
var first = true;

(function(){
    showNavigation();
})();

//Store pins laden
function loadStores(){

    google.maps.visualRefresh = true;
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

            map = new google.maps.Map(document.getElementById("store_map"),
            mapoptions);
            google.maps.event.trigger(map, 'resize');

            addStores();
        }catch(e){
            console.log(e);
        }
    }
}

//Store pins adden
function addStores(){

    if(typeof google === 'object' && typeof google.maps === 'object'){
        try{
            $.ajax({
                type:"GET",
                dataType:"json",
                url: api_url + '/locations',
                success: function(data){

                    var stores = data;
                    for(var i=0; i<stores.length; i++){
                        var ii = i;
                        var image = new google.maps.MarkerImage('images/store/pin_@2x.png', null, null, null, new google.maps.Size(32,50));
                        var myLatLng = new google.maps.LatLng(stores[ii].latitude, stores[ii].longitude);
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map:map,
                            icon: image,
                            tel: stores[ii].tel,
                            state: stores[ii].state,
                            street: stores[ii].street
                        });
                        google.maps.event.addListener(marker, 'click', function(){
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

//Store geklikt op een pin
function opPinGeklikt(event, pin){
    map.setCenter(new google.maps.LatLng(pin.position.jb, pin.position.kb));
    map.setZoom(15);

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

//Store pop up detail sluiten
function closeStoreBox(e){
    e.preventDefault();
    $('#store_pop-up-box').delay(0).animate({rotate: '-180deg'}, 300, function(){});
}

function showNavigation(){

    //Browser mode
    $(window).scroll(function () {
        if ($(this).scrollTop() > 670) {
            $('.header').addClass('show_header');
        } else {
            $('#responsive_nav').hide();
            $('.header').removeClass('show_header');
        }
    });

    //Responsive nav - browser
    $(window).resize(function(){
        if(window.innerWidth > 890){
            $('#responsive_nav').hide();
            $('#responsive_nav').removeClass('res_nav_active');
        }
    });

    //iPad portrait mode
    if($(window).width() == '768' && $(window).height() == '928'){
        showhidedevicenavigation(690);
    //iPad landscape mode
    }else if($(window).width() == '1024' && $(window).height() == '672'){
        showhidedevicenavigation(600);
    //iPhone mode
    }else if($(window).width() == '320'){
        showhidedevicenavigation(300);
    }


    //Sluiten van navigatie na klikken op el
    $('#header_navigation').on('click', function(e){
        e.preventDefault();

        $('#responsive_nav').slideToggle(function(){
            $('#responsive_nav').addClass('res_nav_active');
        });

    });

}

function showhidedevicenavigation(navnumber){
    $(document).on('scrollstop', function(){
        if ($(this).scrollTop() > navnumber) {
            console.log("binnen");
            $('.header').addClass('show_header');
        } else {
            $('#responsive_nav').hide();
            $('.header').removeClass('show_header');
        }
    });

}