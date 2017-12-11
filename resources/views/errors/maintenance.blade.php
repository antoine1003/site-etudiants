
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maintenance</title>
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body class="maintenance-page">
        <div class="container text-center">
            <div class="divide80"></div>
            <img src="{{ URL::asset('img/logo/logo_bgw_big.png') }}">
            <hr>
            <div class="divide40"></div>
            <div class="main-text">
                @lang('errors.maintenance.title')<br>
                <span>@lang('errors.maintenance.subtitle')</span>
            </div>
            <div class="divide80"></div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-6 margin40">
                            <div class="maintenance-box">
                                <i class="fa fa-warning"></i>
                                <h4>@lang('errors.maintenance.why_down.title')</h4>
                                <p>
                                    @lang('errors.maintenance.why_down.body')
                                </p>
                            </div><!--maintenance box-->
                        </div>
                        <div class="col-sm-6 margin40">
                            <div class="maintenance-box">
                                <i class="fa fa-clock-o"></i>
                                <h4>@lang('errors.maintenance.time_down.title')</h4>
                                <p>
                                    @lang('errors.maintenance.time_down.body',['time' => @config('custom_settings.estimated_maintenance_time_min')])
                                </p>
                            </div><!--maintenance box-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--scripts and plugins -->
        <!--must need plugin jquery-->
        <script src="js/jquery.min.js"></script>        
        <!--bootstrap js plugin-->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>       
        <!--easing plugin for smooth scroll-->
        <script src="js/jquery.easing.1.3.min.js" type="text/javascript"></script>
        <!--sticky header-->
        <script type="text/javascript" src="js/jquery.sticky.js"></script>
        <!--flex slider plugin-->
        <script src="js/jquery.flexslider-min.js" type="text/javascript"></script>
        <!--parallax background plugin-->
        <script src="js/jquery.stellar.min.js" type="text/javascript"></script>
    </body>
</html>