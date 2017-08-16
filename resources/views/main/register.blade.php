@extends('templates.t_main')



@section('title')
    @lang('main_site.register.title')
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
                        <h3 class="text-white text-center mb30">@lang('main_site.register.login_title')</h3>
                        @include('flash::message')
                        {!! Form::open(['url' => 'register']) !!}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input name="nom" type="text" class="form-control" placeholder="@lang('validation.attributes.last_name')" value="{{old('nom')}}">
                                 {!! $errors->first('nom', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                <input name="prenom" type="text" class="form-control" placeholder="@lang('validation.attributes.first_name')" value="{{old('prenom')}}">
                                 {!! $errors->first('prenom', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control" placeholder="@lang('validation.attributes.email')" value="{{old('email')}}">
                                 {!! $errors->first('email', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                <input name="ville" type="test" class="form-control" placeholder="@lang('validation.attributes.city')" value="{{old('ville')}}">
                                {!! $errors->first('ville', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="@lang('validation.attributes.password')">
                                {!! $errors->first('password', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                <input name="password_confirmation" type="password" class="form-control" placeholder="@lang('validation.attributes.password_confirmation')" >
                                {!! $errors->first('password_confirmation', '<small class="help-block text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group">
                                  <button type="submit" class="btn btn-rounded btn-primary btn-block">@lang('main_site.form.sign_up')</button>
                            </div>
                            <div class="text-center"><a href="#" class="btn btn-link btn-block">@lang('main_site.register.account_already')</a></div>
                            <hr>
                            <div>
                                <a href="login" class="btn btn-white-outline btn-block">@lang('main_site.form.sign_in')</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection

                   
@push('scripts')
    <script src="js/plugins/plugins.js"></script> 
    <script src="js/assan.custom.js"></script> 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
@endpush