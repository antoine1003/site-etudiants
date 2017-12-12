    @extends('templates.t_welcome')



    @section('title')
        @lang('user_site.welcome.title', ['number' => '2'])
    @endsection
    @section('css')
            <!-- Plugins CSS -->
            <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
            <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
            <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet">
    @endsection


    @section('content')           
           <div class="bg-parallax parallax-overlay"  data-jarallax='{"speed": 0.2}' style=" background-position: 100% !important; background-image: url({{URL::asset(config('custom_settings.img.login_register'))}})">
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
                        <h2 class="text-center text-white">@lang('user_site.welcome.two.student.title')</h2>
                        <p class="text-justify text-white">
                            @lang('user_site.welcome.two.student.body')
                        </p>
                    </div>
                    </div>
                    <div class="row mb40 mt-3">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                        {!! Form::open(['url' => route("user.welcome-post",["type" => "student"]),'method' => 'POST','id' => 'mainform']) !!}
                        {{ csrf_field() }}                          
                                <fieldset id="fieldsetSelect">
                                <label for="exampleSelect1" class="text-white">@lang('user_site.welcome.two.student.class')</label>
                                <div class="form-group">                                    
                                        <div class="input-group">
                                            <select name="classe" class="form-control" id="classesSelect">
                                                @foreach ($categories as $categorie)
                                                    <optgroup label="{{ucfirst($categorie->nom_categorie)}}">
                                                        @foreach ($classes as $classe)
                                                            @if($classe->nom_categorie == $categorie->nom_categorie)
                                                                <option value="{{$categorie->nom_categorie.'$'.$classe->nom_classe}}">{{ucfirst($classe->nom_classe)}}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>                                       
                                        </div>

                                    <input type="submit" value="Suivant" class="btn btn-info mt-3">
                                </fieldset>
                                </div>
                            {!! Form::close() !!} 
                        </div>
                    </div>                    
                </div>
            </div>
               
    @endsection

                       
    @push('scripts')
        <script src="{{ URL::asset('js/plugins/plugins.js') }}"></script>
        <script src="{{ URL::asset('js/assan.custom.js') }}"></script>
                            <!--BOOTSTRAP ALERT-->
        <script src="{{ URL::asset('js/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
        @if (Session::has('bootstrap-alert'))
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