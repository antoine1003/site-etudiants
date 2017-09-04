<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <title>@yield('title')</title>
        <link href="{{ URL::asset('css/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet">
        @section('css')
        @show
    </head>
    <body>



        @section('content')
        @show

        
        <footer class="footer footer-light relative pt50 pb30">
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

        @if (Session::has('bootstrap-alert'))
            <script src="{{ URL::asset('js/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
            <script type="text/javascript">
                $.notify({
                    message: "{{Session::get('bootstrap-alert')}}",
                },{
                    // settings
                    placement: {
                        from: "top",
                        align: "center"
                    },
                    type: "{{Session::get('bootstrap-alert-type')}}",
                });
            </script>
        @endif
        @stack('scripts')       
    </body>
</html>