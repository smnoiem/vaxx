//Mobile menu

(function($){
    'use strict';
    
    $(document).ready(function(){
        // DropDown menu on mobile devices
        $('#mobile-menu__opener').on('click touchstart', function(e){
            e.preventDefault();
            
            if (!$('#menu').hasClass('menu_slide_up')) {
                $('#menu').addClass('menu_slide_up');
            } 
            
            $('#menu').toggleClass('menu_slide_down');
            $(this).toggleClass('mobile-menu__opener_menu_open');
        });
        
        // For resize window on desktop devices
        $(window).resize(function() {
            if ($(window).width() > 768) {
                if ($('#menu').hasClass('menu_slide_up')) {
                    $('#menu').removeClass('menu_slide_up');
                } 
                
                if ($('#menu').hasClass('menu_slide_down')) {
                    $('#menu').removeClass('menu_slide_down');
                    $('#mobile-menu__opener').removeClass('mobile-menu__opener_menu_open');
                } 
            }
        });
    });
    
})(jQuery);

// single post page featured post slider 
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({

    loop:true,
    margin:30,
    responsiveClass:true,
    dots:false,
    responsive:{
        0:{
            items:2,
            nav:true,
            loop:true
        },
        600:{
            items:3,
            nav:true,
            loop:true
        },
        992:{
            items:4,
            nav:true,
            loop:true
        },
        1200:{
            items:6,
            nav:true,
            loop:true
        }
    }

  });
});


// real time & date count
// real time & date count

function liveClock() {
    var today = new Date();
    var day = today.getDay();
    var daylist = ["Sunday","Monday","Tuesday","Wednesday ","Thursday","Friday","Saturday"];

    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' | '+time;

    var now = moment().format('dddd') + ' ' + moment().format('LL') + " | " + moment().format('hh:mm:ss A') + ' IST';

    const collection = document.getElementsByClassName("displayDateTime");
    collection[0].innerHTML = now;

    const collection1 = document.getElementsByClassName("displayDateTime1");
    collection1[0].innerHTML = daylist[day] + ' , ' + dateTime;

    collection1[0].innerHTML = now;
}

$(document).ready(function () {
    setInterval('liveClock()', 1000);
});
