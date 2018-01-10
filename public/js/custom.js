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
    $('#addLink').modal('show');
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
    $("#handle-friendship.accept, #handle-friendship.deny, #handle-friendship.block").click(function() {
        var id_senders = $(this).data('sender');
        var id_receiver = $(this).data('receiver');
        // 0 : demande refusée 
        // 1 : demande acceptée
        // 2 : bloqué
        var action = $(this).data('action');
        //var url_sub = route('user.handleFriends');
        
        //Parametres à envoyer dans la requête
        var dataString ='id_senders=' + id_senders + '&id_receiver=' + id_receiver + '&action=' + action ;
        // Style des messages à afficher
        $.notify.addStyle('notif-success', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-success">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-failed', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-error">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-warn', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-warn">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });

        $.ajax({
            // Paramètres de la requête
            type: "POST",
            url:  APP_URL + '/user/handleFriends', // URL à atteindre
            data: dataString,
            success: function(dara_response) {
                switch (dara_response) {
                    //Si la requêtes n'a pas eu de problèmes
                    case 'success':
                        if (action == 1) {                             
                            $.notify("Relation acceptée!",   { position:"right bottom",style: 'notif-success'});
                        }
                        else if (action == 2){
                            $.notify("Relation refusée!",   { position:"right bottom",style: 'notif-success'});
                        }
                        else
                        {
                            $.notify("Utilisateur bloqué!",   { position:"right bottom",style: 'notif-success'});
                        }
                        break;
                    case 'no_pending_request':
                         $.notify( "Aucune demande de connexion reçue de ce membre !",   { position:"right bottom",style: 'notif-warn'});
                        break;
                    default:
                         $.notify( "Une erreur c'est produite. <br>Merci de bien vouloir réessayer!",   { position:"right bottom",style: 'notif-failed'});
                        break;
                }
                
                // Si tout c'est bien passé une fois la requêtes terminée
                // On enlève la demande d'amis
                // et on enlève 1 dans le badge des notifications
                if (dara_response === 'success') {
                    $("#user_" + id_senders).slideUp(150, function() {
                        $(this).remove(); // Ici on retire la notification
                    });
                    
                    //Dans le suite on gère le badge des notifications
                    $('#badge-all-notification').html(function(i, val) { return val*1-1 }); 
                    var nb_all_not = $('#badge-all-notification').text();
                    if(nb_all_not == '0')
                    {
                        $('#badge-all-notification').addClass("hide");
                    }

                    $("#badge-friendship").text(function(i, val) { return val*1-1 });
                    var nb_not = $("#badge-friendship").text();
                    console.log(nb_not);
                    if (nb_not == '0') {
                        $("#no-friend-request").addClass('show').removeClass('hide');
                        $("#badge-friendship").hide();
                    }
                }

            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                },
            });
        });
    });
/*=====  End of FORM REQUEST FRIENDSHIP  ======*/

/*=========================================
=            NOTIFICATION READ            =
=========================================*/

$(function() {
    $("#notif-read.warn,#notif-read.succ").click(function() {
        var notifications_id = $(this).data('notification');
        
        var dataString ='notifications_id=' + notifications_id ;
        console.log(dataString);
        $.ajax({
            type: "POST",
            url:  APP_URL + '/user/readNotification',
            data: dataString,
            success: function(dara_response) {
                if (dara_response === 'success') {
                    $("#" + notifications_id).slideUp(150, function() {
                            $(this).remove(); 
                        });
                    $('#badge-all-notification').html(function(i, val) { return val*1-1 }); 
                    var nb_all_not = $('#badge-all-notification').text();
                    if(nb_all_not == '0')
                    {
                        $('#badge-all-notification').addClass("hide");
                    }

                    $("#badge-notification").text(function(i, val) { return val*1-1 });
                    var nb_not = $("#badge-notification").text();
                    console.log(nb_not);
                    if (nb_not == '0') {
                        $("#no-notification").addClass('show').removeClass('hide');
                        $("#badge-notification").hide();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                },
            });
        });
    });

/*=====  End of NOTIFICATION READ  ======*/

/*===========================================
=            NOTIFICATIONS COURS            =
===========================================*/


$(function() {
    $("#course-notif.accept-course, #course-notif.deny-course").click(function() {
        var id_notification = $(this).data('notification');
        var id_event = $(this).data('event-id');
        // 0 : demande refusée 
        // 1 : demande acceptée
        var action = $(this).data('action');
        //var url_sub = route('user.handleFriends');
        //
        var senders_id = $(this).data('sender');
        
        var dataString ='id_notification=' + id_notification + '&id_event=' + id_event + '&action=' + action  + "&senders_id=" + senders_id;
        $.notify.addStyle('notif-success', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-success">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-failed', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-error">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        $.notify.addStyle('notif-warn', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-warn">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
        console.log(dataString);        
        $.ajax({
            type: "POST",
            url:  APP_URL + '/user/handleClass',
            data: dataString,
            success: function(data_response) {

                    console.log(data_response);
                switch (data_response) {
                    case 'success':
                        if (action == 1) {                             
                            $.notify("Cours accepté. Visible maintenant dans votre calendrier!",   { position:"right bottom",style: 'notif-success'});
                        }
                        else if (action == 0){
                            $.notify("Cours refusé. L'emmeteur a été averti!",   { position:"right bottom",style: 'notif-success'});
                        } else {
                            $.notify("Une erreur c'est produite.<br>Merci de bien vouloir réessayer!",   { position:"right bottom",style: 'notif-warn'});
                        }
                        break;
                    default:
                         $.notify( "Une erreur c'est produite. <br>Merci de bien vouloir réessayer!",   { position:"right bottom",style: 'notif-failed'});
                        break;
                }

                if (data_response === 'success') {
                     $("#" + id_notification).slideUp(150, function() {
                        $(this).remove(); 
                    });
                    $('#badge-all-notification').html(function(i, val) { return val*1-1 }); 
                    var nb_all_not = $('#badge-all-notification').text();
                    if(nb_all_not == '0')
                    {
                        $('#badge-all-notification').addClass("hide");
                    }

                    $("#badge-notification").text(function(i, val) { return val*1-1 });
                    var nb_not = $("#badge-notification").text();
                    console.log(nb_not);
                    if (nb_not == '0') {
                        $("#no-notification").addClass('show').removeClass('hide');
                        $("#badge-notification").hide();
                    }
                }
                    
                },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                },
            });
        });
    });

/*=====  End of NOTIFICATIONS COURS  ======*/



