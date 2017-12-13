
<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <title>@yield('title')</title>
        <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/layers.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/navigation.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/settings.css') }}" rel="stylesheet">
        <!-- font awesome for icons -->
        <link href="{{ URL::asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">        
        <!--mega menu -->
        <link href="{{ URL::asset('css/yamm.css')}}" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/jquery.mCustomScrollbar.css')}}" />
        <!-- custom css (blue color by default) -->
        <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{ URL::asset('css/less/navbar.less')}}" rel="stylesheet" type="text/css" media="screen">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @section('css')
        @show
    </head>
    <body>
        <div class="modal fade" tabindex="-1" role="dialog" id="addLink" style="margin-top: 100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter une connaissance</h4>
                    </div>                        
                    <div class="modal-body">
                        <div class="row">
                            {!! Form::open(['url' => 'user/addFriend','method' => 'POST',]) !!}
                            {{ csrf_field() }}
                            <!-- Text input-->
                                <div class="form-group">
                                  <label class="col-md-4 control-label" for="textinput">Email</label>  
                                  <div class="col-md-5">
                                  <input required="" name="email" type="email" placeholder="Entrez l'adresse mail" class="form-control input-md" style="margin-bottom: 10px;">
                              </div>
                            </div>
                            <!-- Button (Double) -->
                            <div class="form-group">  
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                <button name="submit" type="submit" class="btn btn-success">Ajouter</button>
                                <button class="btn btn-danger" data-dismiss="modal" >Fermer</button>
                              </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--navigation -->
        <div class="navbar navbar-default navbar-static-top yamm sticky" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="{{ URL::asset('img/logo/logo_bgw.png')}}" alt="ASSAN"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li> <a href="<?php echo @route('user.dashboard') ?>"><i class="fa fa-home" aria-hidden="true"></i> @lang('user_site.menu.home')</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-o" aria-hidden="true"></i>  @lang('user_site.menu.my_account') <i class="fa fa-angle-down"></i></a> 
                            <ul class="dropdown-menu">                            
                                <li><a href="{{@route('user.calendar')}}"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('user_site.menu.calendar')</a></li>
                                <li><a href=""><i class="fa fa-plus" aria-hidden="true"></i>  @lang('user_site.menu.add_friend')</a></li>
                            </ul>
                        </li>
                        <li><a href=" <?php echo @route('user.inbox') ?>"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('user_site.menu.inbox') <?php if($nb_unread > 0){echo '<span class="badge">'.$nb_unread . '</span>';} ?></a></li>    
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" id="dd_friendrequest">
                                <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> <?php if (count($pending_friendships) > 0) {
                                    echo '<span class="badge" id="badge-new-friendship">'. count($pending_friendships) .'</span>';
                                } ?></a>
                                <div class="dropdown-menu shopping-cart">

                                    <div class="cart-items content-scroll">
                                        <h5 class="text-center friendship"><i class="fa fa-bell" aria-hidden="true"></i> Demandes</h5>
                                        @if(count($pending_friendships) != 0)
                                            @foreach($pending_users as $pending_user)                                      
                                                <div id="user_{{$pending_user->id}}" class="cart-item clearfix">
                                                    <div class="description">
                                                        <a href="#">{{$pending_user->prenom.' ' .$pending_user->nom}} </a>
                                                        <strong class="price">{{$pending_user->email}}</strong>
                                                    </div><!--Description-->
                                                    <div class="buttons">
                                                        <a href="#" id="handle-friendship" class="fa fa-check accept" data-toggle="tooltip" title="Accepter" data-sender="{{$pending_user->id}}" data-receiver="{{Auth::user()->id}}" data-accepted="1"></a>
                                                        <a href="#" id="handle-friendship" class="fa fa-times deny" data-toggle="tooltip" title="Refuser" data-sender="{{$pending_user->id}}" data-receiver="{{Auth::user()->id}}" data-accepted="0"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h6 class="text-center">Vous n'avez pas de demande d'amis.</h6>
                                        @endif   
                                        
                                    </div><!--cart-items-->

                                    <div class="cart-footer">
                                        <a href="#" class="btn btn-success" id="openmodal"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter</a>
                                        <a href="{{@route('user.manageFriends')}}" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Gérer</a>
                                    </div><!--footer of cart-->


                                </div><!--cart dropdown end-->

                            </li>
                        <li> <a href="#" onclick="promptLogout()" class="warning-alert"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('main_site.form.sign_out')</a></li>
                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--container-->
            </div><!--navbar-default-->
            <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="animated fadeIn">{{ $breadcrumb_title }}</h4>
                    </div>
                    <div class="col-sm-6 hidden-xs text-right">
                        <ol class="breadcrumb animated fadeIn">
                            <li>{{ Auth::user()->prenom . ' ' . Auth::user()->nom }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!--breadcrumbs-->   
        @section('content')
        @show

        
        
         <!--footer light 1 begin-->
        <footer class="footer-light-1">
            <div class="footer-copyright text-center">
                 {{config('custom_settings.name_site')}} &copy; 2017. <br>
                All right reserved.
            </div>
        </footer>
        <!--footer end-->
        <!--js plugins-->
        @routes
        <script type="text/javascript">
            var APP_URL =" {!! url('/') !!}";
        </script>
        <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery-migrate.min.js') }}"></script>
        <!--easing plugin for smooth scroll-->
        <script src="{{ URL::asset('js/jquery.easing.1.3.min.js') }}" type="text/javascript"></script>
        <!--bootstrap js plugin-->
        <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>       
        <script  src="{{ URL::asset('js/jquery.sticky.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/jquery.mousewheel.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/jquery.mCustomScrollbar.concat.min.js')}}" type="text/javascript"></script>
        <!--flex slider plugin-->
        <script src="{{ URL::asset('js/jquery.flexslider-min.js')}}" type="text/javascript"></script>
        <!--owl carousel slider-->
        <script src="{{ URL::asset('js/owl.carousel.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/tweetie.min.js') }}" type="text/javascript"></script>
         <script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js" type="text/javascript"></script>
        <script src="{{ URL::asset('js/custom.js') }}"></script>

        <!--sticky header-->
        <script src="{{ URL::asset('js/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>  
        <script src="{{ URL::asset('js/jquery.stellar.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/jquery.counterup.min.js') }}" type="text/javascript"></script>
        <!--on scroll animation-->
        <script src="{{ URL::asset('js/wow.min.js')}}" type="text/javascript"></script> 
        
        <!--popup js-->
        <script src="{{ URL::asset('js/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
        function promptLogout() {
            swal({
                title: "{{trans('alerts.modal.welcome.title')}}",
                text: "{{trans('alerts.modal.welcome.description')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: "{{trans('alerts.modal.welcome.option_yes')}}",
                cancelButtonText: "{{trans('alerts.modal.welcome.option_cancel')}}",
                closeOnConfirm: false,
                animation: "slide-from-top",
            },
            function () {
                window.location.replace("{{route('logout-get')}}");
            });            
        }
        $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
        </script>

         @if (Session::has('bootstrap-alert'))
            <script type="text/javascript">
                  $.notify.addStyle('notif-html', {
                       html: '<div class="notifyjs-corner" style="right: 0px; bottom: 0px;">  <div class="notifyjs-wrapper notifyjs-hidable"><div class="notifyjs-arrow" style=""></div>        <div class="notifyjs-container" style="">            <div class="notifyjs-bootstrap-base notifyjs-bootstrap-{{Session::get("bootstrap-alert-type")}}">                <span data-notify-html/>            </div>        </div>    </div></div>',
                    });
                 $.notify( "{{Session::get('bootstrap-alert')}}",   { position:"right bottom", style: 'notif-html'});
            </script>
            <!-- <script type="text/javascript">
                 $.notify( "{{Session::get('bootstrap-alert')}}",   { position:"right bottom",className: "{{Session::get('bootstrap-alert-type')}}"});
            </script> -->
        @endif
        @stack('scripts')
    </body>
</html>
