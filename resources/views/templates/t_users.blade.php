
<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <title>@yield('title')</title>
        
        <link href="{{ URL::asset('css/custom.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="{{ URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- font awesome for icons -->
        <link href="{{ URL::asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">        
        <!--mega menu -->
        <link href="{{ URL::asset('css/yamm.css')}}" rel="stylesheet" type="text/css">
        <!--popups css-->
        <link href="{{ URL::asset('css/magnific-popup.css')}}" rel="stylesheet" type="text/css">
        <!-- custom css (blue color by default) -->
        <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" type="text/css" media="screen">
        @section('css')
        @show
    </head>
    <body>
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
                        <li><a href=""><i class="fa fa-calendar" aria-hidden="true"></i> @lang('user_site.menu.calendar')</a></li>
                        <li><a href=""><i class="fa fa-user-o" aria-hidden="true"></i>  @lang('user_site.menu.my_account')</a></li>
                        <li><a href=" <?php echo @route('user.inbox') ?>"><i class="fa fa-envelope" aria-hidden="true"></i>  @lang('user_site.menu.inbox') <span class="badge"><?php echo $nb_unread ?> </span></a></li>
                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a href="#" onclick="promptLogout()" class="warning-alert"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('main_site.form.sign_out')</a></li>
                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--container-->
        </div><!--navbar-default-->

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

       <script src="{{ URL::asset('js/sweetalert/sweetalert.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>
