$(document).ready(init);

//var api_url = "http://localhost/FOOD/api";
//var api_url = "http://192.168.0.100/FOOD/api";
    var api_url = "http://172.30.26.141/FOOD/api";
//var url = "http://localhost/FOOD/src/";
//var url = "http://192.168.0.100/FOOD/src/";
var url = "http://172.30.26.141/FOOD/src/";
var foreigndata;
var filtered = false;
var videoactive = false;

$page = window.location.href;

function init(){

    //Pagina inladen
    loadPage($page);

    //Bij veranderen van protrait/landscape de columns opnieuw inladen
    $(window).resize(function(){

        console.log($(window).width());

        switch(window.orientation)
            {
              case -90:
              case 90:
                loadColumns();
                break;
            case 0:
                loadColumns();
                break;
            }
    });

    //timer laden
    timer('06/25/2013 00:00 AM');
    var cntnr = $('#container');

    //start
    cntnr.on('click', '#start_store_locator', scrollAndLoadPage);
    cntnr.on('click', '#start_burger_showoff', scrollAndLoadPage);
    cntnr.on('click', '#start_create_a_burger', scrollAndLoadPage);

    //header
    cntnr.on('click', '.header_link_start', scrollAndLoadPage);
    cntnr.on('click', '.header_link_list', scrollAndLoadPage);
    cntnr.on('click', '.header_link_store', scrollAndLoadPage);

    //promo
    cntnr.on('click', '#promo_iphone', showLeVideo);

    //list
    cntnr.on('click', '#list_submit', searchForBurger);
    cntnr.on('click', '#list_search', showCloseBtn);
    cntnr.on('click', '#list_clear', clearBurgerfield);
    cntnr.on('click', '#list_filter', filterBurgers);
    cntnr.on('click', '.list_burger_image_active', updateBurgerDetail);
    cntnr.on('click', '#list_vote_btn', addVoteToBurger);
    cntnr.on('keydown', '#list_search', enterSearchForBurger);

    //store
    cntnr.on('click', '#store_close_btn', closeStoreBox);
}

function loadPage($page){
    switch($page){
            case url +'#start':
                $.ajax({
                    type:"GET",
                    url: url + '?page=start&ajax=true',
                    success: function(data){
                           $('.wood_container').remove();
                           $('#content_bottom').hide().html(data).fadeIn();
                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
            break;

            case url +'#store':
                $.ajax({
                    type:"GET",
                    url: url + '?page=store&ajax=true',
                    success: function(data){
                           $('.wood_container').remove();
                           $('#content_bottom').hide().html(data).fadeIn();
                            loadStores();
                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
            break;

            case url +'#list':

                $.ajax({
                    type:"GET",
                    url: url + '?page=list&ajax=true',
                    success: function(data){
                           $('.wood_container').remove();
                           $('#content_bottom').html(data);
                            loadColumns(true);
                            foreigndata = $('#columns').html();
                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
                console.log("goToListPage");
            break;
        }
}

function loadColumns(load){


    if($(window).width() == '768' && $(window).height() == '928'){
        console.log("op de ipad mini portrait");
        deviceLoad();
    }else if($(window).height() == '672' && $(window).width() == '1024'){
        console.log("op de ipad mini landscape");
        deviceLoad();
    }else if(load){
        window.onload = function(){
            $('#columns').isotope({
              masonryHorizontal: {
                rowHeight: 360
              }
            });
            $('#columns').css('overflow','scroll');
            $('#columns').css('height','550px');
        }
    }else{
        console.log("op browser");
        browserLoad();
    }
}

function deviceLoad(){
    $(document).ready(function(){
        $('#columns').isotope({
          masonryHorizontal: {
            rowHeight: 360
          }
        });
        $('#columns').css('overflow','scroll');
        $('#columns').css('height','431px');
        $('#columns').css('-webkit-overflow-scrolling','touch');
    });
}

function browserLoad(){
        $('#columns').isotope({
          masonryHorizontal: {
            rowHeight: 360
          }
        });
        $('#columns').css('overflow','scroll');
        $('#columns').css('height','550px');
}

function scrollAndLoadPage(e){
    e.preventDefault();
    $clickedLink = url + $(this).attr('href');

    $('#responsive_nav').slideUp();
    $('#responsive_nav').removeClass('res_nav_active');

    switch($clickedLink){
            case url +'#start':
                $.ajax({
                    type:"GET",
                    url: url + '?page=start&ajax=true',
                    success: function(data){
                        console.log(data);
                           $('.wood_container').fadeOut(function(){
                               $('#content_bottom').hide().html(data).fadeIn();
                               $('html, body').animate({
                                    scrollTop: 761
                                }, 500);
                           });
                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
            break;

            case url +'#store':
                $.ajax({
                    type:"GET",
                    url: url + '?page=store&ajax=true',
                    success: function(data){
                        console.log(data);
                           $('.wood_container').fadeOut(function(){
                               $('#content_bottom').hide().html(data).fadeIn();
                               loadStores();
                               $('html, body').animate({
                                    scrollTop: 761
                                }, 500);
                           });

                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
            break;

            case url +'#list':

                $.ajax({
                    type:"GET",
                    url: url + '?page=list&ajax=true',
                    success: function(data){
                           $('.wood_container').fadeOut(function(){
                               $('#content_bottom').hide().html(data).fadeIn();
                               $('#columns').isotope({
                                 masonryHorizontal: {
                                   rowHeight: 360
                                 }
                               });
                               $('#columns').css('overflow','scroll');
                               $('#columns').css('height','550px');
                               $('#columns').css('-webkit-overflow-scrolling','touch');

                               foreigndata = $('#columns').html();
                               $('html, body').animate({
                                    scrollTop: 761
                                }, 500);
                           });
                    },
                    error: function(){
                        console.log(arguments);
                    }
                });
            break;
        }
}

function timer(date) {
        var end = new Date(date),
            timer,
            second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24,
            showRemaining;

        showRemaining = function () {
            var now = new Date(),
                distance = end - now,
                days,
                hours,
                minutes,
                seconds;

            if (distance < 0) {
                clearInterval(timer);
                $('#first_number, #second_number, #third_number').html("NOW");
                return;
            }

            days = Math.floor(distance / day);
            hours = Math.floor((distance % day) / hour);
            minutes = Math.floor((distance % hour) / minute);

            $('#days_number').html(days);

            if(days < 10){
                days = ('0' + days).slice(-2);
            }
            if(hours < 10){
                hours = ('0' + hours).slice(-2);
            }
            if(minutes < 10){
                minutes = ('0' + minutes).slice(-2);
            }

            $('#first_number').html(days);
            $('#second_number').html(hours);
            $('#third_number').html(minutes);
        };

        timer = setInterval(showRemaining, 1000);
};

function updateBurgerDetail(e){
    e.preventDefault();

    $.ajax({
        type:'GET',
        url: api_url + '/burgers/' + $(this).attr('href'),
        success: function(data){
            var arrData = $.parseJSON(data);
            $('#list_selected_burger header h1').html(arrData[0].name);
            $('#numb_active p').html(arrData[0].rating);
            var widthpercentage = (arrData[0].rating / 300) * 100;
            $('#numb_active').css('margin-left', widthpercentage + '%');
            $('#list_progress_bar_inner').css('width', widthpercentage + '%');
            $('#list_detail_image').attr('src', 'images/burgers/' + arrData[0].image_url);
            $('#list_vote_btn').attr('src', arrData[0].id);

            if(arrData[0].rating == 300){
                $('#list_votedreached_btn').css('display','block').show();
                $('#list_voted_btn').hide();
                $('#list_votedalready_btn').hide();
                $('#list_vote_btn').hide();
            }else{
                $('#list_voted_btn').hide();
                $('#list_votedalready_btn').hide();
                $('#list_vote_btn').show();
            }

            $('#list_names').html('');
            var names = '';
            $.each(arrData, function( key, val){
                console.log(val.user_name);

                var string = val.user_name + ', ';
                names += string;

            });
            names = names.substring(0, names.length -2);
            $('#list_names').html(names);
        }, error: function(){
            console.log(arguments);
        }
    });
}

function clearBurgerfield(e){
    e.preventDefault();
    $('#list_search').val('');
    $('#no_burgers').hide();

    $('#columns').remove();
    $('#list_all_burgers').append("<div id='columns'></div>");
    $('#columns').html(foreigndata);
    loadColumns();
    $('#list_burger_title').show();
}

function showCloseBtn(){
    $('#list_submit').css('margin-left','-85px');
    $('#list_clear').show();
}

function enterSearchForBurger(e){
    var code = e.which;
    if(code == 13){
        searchForBurger(e);
    }
}

function searchForBurger(e){
    e.preventDefault();

    $.ajax({
        type:"GET",
        url: url + '?page=list&ajax=search&str=' + $('#list_search').val(),
        success: function(data){

            if(data == 'no_records'){
                $('#columns').remove();
                $('#list_burger_title').hide();
                $('#no_burgers').fadeIn();
            }else if(data != 'leeg'){

                $('#columns').remove();
                $('#list_all_burgers').append("<div id='columns'></div>");
                $('#columns').html(data);
                loadColumns();

                $('#no_burgers').hide();
                $('#list_burger_title').show();

            }else{
                $('#columns').remove();
                $('#list_all_burgers').append("<div id='columns'></div>");
                $('#columns').html(foreigndata);
                loadColumns();
                $('#no_burgers').hide();
                $('#list_burger_title').show();
            }

        }, error: function(){
            console.log(arguments);
        }
    })
}

function addVoteToBurger(e){
    e.preventDefault();

    $.getJSON( "http://smart-ip.net/geoip-json?callback=?", function(userip){

        $.ajax({
            type:"GET",
            url: api_url + '/checkip?ip=' + userip.host + '&id=' + $('#list_vote_btn').attr('src'),
            success: function(data){
                    console.log(data);

                if(data == 'true'){
                    $('#list_vote_btn').hide();
                    $('#list_voted_btn').css('display','block');
                    var aantalVotes = parseInt($('#numb_active p').html());
                    aantalVotes ++;
                    var widthpercentage = (aantalVotes / 300) * 100;
                    $('#numb_active').css('margin-left', widthpercentage + '%');
                    $('#list_progress_bar_inner').css('width', widthpercentage + '%');
                    $('#numb_active p').html(aantalVotes);
                }else{
                    $('#list_votedalready_btn').css('display','block');
                    $('#list_vote_btn').hide();
                }



            }, error: function(){
                console.log(arguments);
            }
        })
    });
}

function filterBurgers(e){

    e.preventDefault();

    $.ajax({
        type:"GET",
        url: url + '?page=list&ajax=done',
        success: function(data){
            console.log(data);

            if(data != ''){

                if(filtered){
                    $('#columns').remove();
                    $('#list_all_burgers').append("<div id='columns'></div>");
                    $('#columns').html(foreigndata);
                    loadColumns();
                    $('#list_burger_title h1').html('All burgers in the box');
                    filtered = false;
                }else{
                    $('#columns').remove();
                    $('#list_all_burgers').append("<div id='columns'></div>");
                    $('#columns').html(data);
                    loadColumns();
                    $('#list_burger_title h1').html('All nominated burgers!');
                    filtered = true;
                }
            }

        }, error: function(){
            console.log(arguments);
        }
    });
}

function showLeVideo(e){

    var video = $('#video').get(0);

    $('#promo_left').addClass('video_playing_move_left');
    $('#promo_right').addClass('video_playing_move_right');

    setTimeout(function() {
        $('#videocontainer').addClass('video_start_playing');
        video.play();
        $('#promo_left').hide();
        $('#promo_right').hide();
    }, 1000);

    $('#video').bind('ended', function(){

        $('#videocontainer').fadeOut(function(){
            $('#videocontainer').removeClass('video_start_playing');
                $('#promo_left').show();
                $('#promo_right').show();
                $('#promo_left').removeClass('video_playing_move_left');
                $('#promo_right').removeClass('video_playing_move_right');
        });
    });


}