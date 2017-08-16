@extends('templates.t_main')



@section('title')
    @lang('main_site.login.title')
@endsection
@section('css')
        <!-- Plugins CSS -->
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="bg-parallax parallax-overlay accounts-page"  data-jarallax='{"speed": 0.2}' style='background-image: url("http://placehold.it/1920x1000")'>
            <div class="container">
                <div class="row pb30">
                    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                        @include('flash::message')
                        <h3 class="text-white text-center mb30">@lang('main_site.login.login_title')</h3>
                        <form method="POST" action="login">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="@lang('validation.attributes.email')" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="@lang('validation.attributes.password')">
                            </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-rounded btn-primary btn-block">@lang('main_site.form.sign_in')</button>
                            </div>
                            <div class="text-center"><a href="#" class="btn btn-link btn-block">@lang('main_site.login.login_trouble')</a></div>
                            <hr>
                            <div>
                                <a href="register" class="btn btn-white-outline btn-block">@lang('main_site.form.sign_up')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

                   
@push('scripts')
    <script src="js/plugins/plugins.js"></script> 
    <script src="js/assan.custom.js"></script> 
@endpush