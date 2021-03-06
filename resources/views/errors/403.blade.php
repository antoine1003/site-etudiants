<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@lang('errors.403.title')</title>    
        <!-- Plugins CSS -->
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style-bs4.css') }}" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-darget=".navbar-seconday">       

        <div class="fullscreen bg-parallax parallax-overlay" style="background-image: url('{{ URL::asset('img/404.jpg') }}')">
            <div class="d-flex align-items-center text-center particle-content error-404-content">
                 <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h1 class="text-uppercase">403</h1>
                        <p class="lead">@lang('errors.403.description')</p>
                        <a href='{{ route("index") }}' class='btn btn-lg btn-white-outline'>@lang('errors.403.main_site')</a>
                    </div>
                </div>
            </div>
            </div>
        </div><!--page title end-->
       

        <!--back to top-->
        <a href="#" class="back-to-top hidden-xs-down" id="back-to-top"><i class="ti-angle-up"></i></a>
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="js/plugins/plugins.js"></script> 
        <script src="js/assan.custom.js"></script> 
    </body>
</html>
