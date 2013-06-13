(function(){

    promoAnimation();

})();

function promoAnimation(){


        $(window).scroll(function () {
            if($(document).scrollTop() > '530'){
                $('#promo_man').addClass('man_loaded');
            }else{
                $('#promo_man').removeClass('man_loaded');
            }

            if($(document).scrollTop() > '600'){
                $('#promo_knife').addClass('knife_loaded');
            }else{
                $('#promo_knife').removeClass('knife_loaded');
            }

            if($(document).scrollTop() > '630'){
                $('#promo_leek').addClass('leek_loaded');
            }else{
                $('#promo_leek').removeClass('leek_loaded');
            }

            if($(document).scrollTop() > '660'){
                $('#promo_red').addClass('red_loaded');
            }else{
                $('#promo_red').removeClass('red_loaded');
            }

            if($(document).scrollTop() > '680'){
                $('#promo_yellow').addClass('yellow_loaded');
            }else{
                $('#promo_yellow').removeClass('yellow_loaded');
            }

        });
}