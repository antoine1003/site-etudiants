<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Assan 3.0</title>    
        <!-- Plugins CSS -->
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    </head>

    <body>
         @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="fullscreen bg-parallax  accounts-page" data-jarallax='{"speed": 0.2}' style="background-image: background-image: url({{URL::asset(config('custom_settings.img.login_register'))}})">
            <div class="d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6  ml-auto mr-auto col-md-8 col-sm-10">
                            <div class="text-center mb30">
                                <a href="index.html">
                                <img src="images/logo.png" alt="">
                            </a>
                            </div>
                             <h3 class="text-center text-uppercase">Recover Account</h3>
                             <p class="lead text-center">Enter your email address to get restet link</p>
                             <form method="POST" action="{{ route('password.request') }}">
                             {{ csrf_field() }}
                                <div class="row mb30">
                                    <div class="col-sm-12 mb10">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary btn-rounded btn-block" type="submit">Send</button>
                                    </div>
                                </div>
                                <!--end of row-->
                            </form>
                             <div class="account-links">We'll sent you a password reset link to your email
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="js/plugins/plugins.js"></script> 
        <script src="js/assan.custom.js"></script> 
    </body>
</html>
