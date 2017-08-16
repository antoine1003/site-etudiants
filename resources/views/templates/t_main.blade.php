<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <title>@yield('title')</title>
        <link href="{{ URL::asset('css/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet">
        @section('css')
        @show
    </head>
    <body>
        <!-- Site Overlay -->
        <div class="site-overlay"></div>

        <nav class="navbar navbar-toggleable-md navbar-light navbar-transparent bg-faded">
            <div class="search-inline">
                <form>
                    <input type="text" class="form-control" placeholder="Type and hit enter...">
                    <button type="submit"><i class="ti-search"></i></button>
                    <a href="javascript:void(0)" class="search-close"><i class="ti-close"></i></a>
                </form>
            </div><!--/search form-->
            <div class="container">

                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img class='logo logo-light' src="{{config('custom_settings.logo_path')}}" alt="">
                </a>

                <div class="collapse navbar-collapse" id="navbarsspy">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a data-scroll class="nav-link active" href="home">@lang('main_site.menu.home')</a></li>
                    <li class="nav-item"><a data-scroll class="nav-link" href="about">@lang('main_site.menu.about')</a></li>
                    <li class="nav-item"><a data-scroll class="nav-link" href="pricing">@lang('main_site.menu.pricing')</a></li>
                    <li class="nav-item"><a data-scroll class="nav-link" href="contact">@lang('main_site.menu.contact')</a></li>
                </ul>
            </div>
                

            </div>
        </nav>


        @section('content')
        @show

        
        <footer class="footer footer-light pt50 pb30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <ul class="social-icons list-inline">
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>Facebook
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-twitter"></i>twitter
                                </a>
                            </li>
                        </ul>
                        <h4><i class="fa fa-phone"></i> 1800-355-4322</h4>
                        <h4><i class="fa fa-envelope"></i> {{config('custom_settings.mails.contact')}}</h4>
                        <p>© Copyright 2017. {{config('custom_settings.name_site')}}</p>
                        <div>
                            @if(LaravelLocalization::getCurrentLocale() === 'fr')
                                <a href="{{ LaravelLocalization::getLocalizedURL('en', Request::url()) }}"><span class="flag-icon flag-icon-us"></span> English</a>
                            @else
                                <a href="{{ LaravelLocalization::getLocalizedURL('fr', Request::url()) }}"><span class="flag-icon flag-icon-fr"></span> Français</a>
                            @endif
                        </div>                   
                </div>
            </div>
            </div>
        </footer>
        <!--/footer-->
        @stack('scripts')       
    </body>
</html>