@extends('templates.t_welcome')



@section('title')
    @lang('user_site.welcome.title', ['number' => '1'])
@endsection
@section('css')
        <!-- Plugins CSS -->
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
@endsection


@section('content')           
        <div class="bg-parallax parallax-overlay"  data-jarallax='{"speed": 0.2}' style="background-image: url({{URL::asset(config('custom_settings.img.login_register'))}})">
            <div class="container mb40 mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div style="float:right;">
                              <label class="logout-float">
                                <button class="warning-alert btn btn-theme-dark btn-sm btn-sweet-alert">@lang('main_site.form.sign_out')</button>
                              </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12 mb10">
                    <h2 class="text-center uppercase text-white">@lang('user_site.welcome.one.message_h1', ['nom_site' => config('custom_settings.name_site')])</h2>
                    <p class="text-justify text-white">
                        @lang('user_site.welcome.one.message_body')
                    </p>
                </div>
                </div>
                <div class="row mb40 mt-3">
                    <div class="col-lg-4 mb30">
                        <div class="icon-box icon-box-center welcome-choice">
                            <a href="{{route('user.welcome', ['id' => 2, 'type' => 'student'])}}"><i class="icon-hover-1 bg-primary fa fa-graduation-cap icon-hover-default"></i></a>
                            <h4>@lang('user_site.welcome.type.student')</h4>
                            <p>
                                @lang('user_site.welcome.one.student_desc', ['nom_site' => config('custom_settings.name_site')])
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb30">
                        <div class="icon-box icon-box-center welcome-choice">                       
                            <a href="{{route('user.welcome', ['id' => 2, 'type' => 'teacher'])}}"><i class="icon-hover-1 bg-dark fa fa-book icon-hover-default">2</i></a>
                            <h4>@lang('user_site.welcome.type.teacher')</h4>
                            <p>
                                 @lang('user_site.welcome.one.teacher_desc')
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb30">
                        <div class="icon-box icon-box-center welcome-choice">
                            <a href="{{route('user.welcome', ['id' => 2, 'type' => 'parent'])}}"><i class="icon-hover-1 bg-success fa fa-user icon-hover-default">3</i></a>
                            <h4>@lang('user_site.welcome.type.parent')</h4>
                            <p>
                                 @lang('user_site.welcome.one.parent_desc', ['nom_site' => config('custom_settings.name_site')])
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

                   
@push('scripts')
    <script src="{{ URL::asset('js/plugins/plugins.js') }}"></script>
    <script src="{{ URL::asset('js/assan.custom.js') }}"></script>
                        <!--BOOTSTRAP ALERT-->
    <script src="{{ URL::asset('js/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        document.querySelector('.warning-alert').onclick = function () {
                swal({
                    title: "{{trans('alerts.modal.welcome.title')}}",
                    text: "{{trans('alerts.modal.welcome.description')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: "{{trans('alerts.modal.welcome.option_yes')}}",
                    cancelButtonText: "{{trans('alerts.modal.welcome.option_cancel')}}",
                    closeOnConfirm: false,
                    animation: "slide-from-top"
                },
                function () {
                    window.location.replace("{{route('logout-get')}}");
                });
            };
    </script>
@endpush