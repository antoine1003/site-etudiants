/*================================
=            SETTINGS            =
================================*/

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*=====  End of SETTINGS  ======*/


/*===========================*/
//sticky header

 jQuery( window ).resize(function() {
    jQuery(".navbar-collapse").css({ maxHeight: $(window).height() - $(".navbar-header").height() + "px" });
});
//sticky header on scroll
jQuery(document).ready(function () {
    $(window).load(function () {
        jQuery(".sticky").sticky({topSpacing: 0});
    });
});




jQuery(document).ready(function(){
    jQuery(".search-toggle").click(function(){
        jQuery(".search-bar").slideDown('fast');
    });
    jQuery('.search-close').click(function () {
            jQuery('.search-bar').slideUp();
        });
});

//owl carousel
jQuery(document).ready(function () {

    jQuery("#owl-slider").owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});

});

$('#openmodal').click(function(){
    $('.modal').modal('show');
    $('#dd_friendrequest').removeClass('open');
});

jQuery(window).load(function () {
    jQuery(".content-scroll").mCustomScrollbar({advanced: {
            updateOnContentResize: true
        },
        scrollButtons: {enable: false},
        mouseWheelPixels: "200",
        theme: "dark-2"
    });
});


//tooltips
jQuery(function () {
    jQuery('[data-toggle="tooltip"]').tooltip();
});

//partners slider
jQuery(document).ready(function () {

    jQuery("#owl-partners").owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:6
        }
    }
});

});

/** product single slider**/
$(document).ready(function() {
  $("#product-single").owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
});

$('.dropdown-menu').click(function(e) {
    e.stopPropagation();
});

/*===============================================
=            FORM REQUEST FRIENDSHIP            =
===============================================*/

/**

    TODO:
    - Change public !!!
    - Second todo item

 */


$(function() {
    $("#handle-friendship.accept, #handle-friendship.deny").click(function() {
        var id_senders = $(this).data('sender');
        var id_receiver = $(this).data('receiver');
        // 0 : demande refusée 
        // 1 : demande acceptée
        var is_accepted = $(this).data('accepted');
        //var url_sub = route('user.handleFriends');
        
        var dataString ='id_senders=' + id_senders + '&id_receiver=' + id_receiver + '&is_accepted=' + is_accepted ;
        $.notify.addStyle('notif-success', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-success">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-failed', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-error">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-warn', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-warn">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        //alert (dataString);return false;
        $.ajax({
            type: "POST",
            url:  APP_URL + '/user/handleFriends',
            data: dataString,
            success: function(dara_response) {
                switch (dara_response) {
                    case 'success':
                        if (is_accepted == 1) {
                             $('#badge-new-friendship').html(function(i, val) { return val*1-1 });
                            $.notify( "Relation acceptée!",   { position:"right bottom",style: 'notif-success'});
                        }
                        else {
                            $.notify( "Relation refusée!",   { position:"right bottom",style: 'notif-failed'});
                        }
                        break;
                    case 'no_pending_request':
                         $.notify( "Aucune demande de connexion reçue de ce membre !",   { position:"right bottom",style: 'notif-warn'});
                        break;
                    default:
                        
                        break;
                }
                    $("#user_" + id_senders).slideUp(150, function() {
                            $(this).remove(); 
                        }); 
                   
                   
                    
                },
            error: function(){
                console.log('x: number');
            },
            });
        });
    });
/*=====  End of FORM REQUEST FRIENDSHIP  ======*/

