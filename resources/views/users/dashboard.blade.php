@extends('templates.t_users')



@section('title')
    @lang('user_site.dashboard.title')
@endsection
@section('css')
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
@endsection


@section('content')
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="animated fadeIn">Page principale</h4>
                    </div>
                    <div class="col-sm-6 hidden-xs text-right">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Utilisateur</a></li>
                            <li>Page principale</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!--breadcrumbs-->

        <div class="overflow-hidden">
             <div class="container">

            <div class="row">
                <div class="col-sm-3 margin40">
                    <div class="side-nav-wrapper">
                        @role('teacher')
                        <ul class="list-unstyled side-nav">
                            <h3 class="text-gray ">@lang('user_site.type.teacher')</h3>
                            <li><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>@lang('user_site.left_menu.sub_teacher.next_class')</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> @lang('user_site.dashboard.teacher.my_students')</a></li>
                        </ul>
                        @endrole
                        @role('student')
                        <ul class="list-unstyled side-nav">
                            <h3 class="text-gray ">@lang('user_site.type.student')</h3>
                            <li><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>@lang('user_site.left_menu.sub_teacher.next_class')</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> @lang('user_site.dashboard.teacher.my_students')</a></li>
                        </ul>
                        @endrole
                    </div>
                </div><!--sidebar col end-->
                <div class="col-sm-9">
                            <div class="divide80"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>This is example of Side navigation.</h4>
                            <p>
                                Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                    </div>
                    <div class="divide30"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>1/2 Col</h4>
                            <p>
                                Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <h4>1/2 Col</h4>
                            <p>
                                Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                    </div><!--1/2 row end-->
                    <div class="divide30"></div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>1/3 Col</h4>
                            <p>
                                Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                        <div class="col-sm-8">
                            <h4>2/3 Col</h4>
                            <p>
                                Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                                Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                    </div><!--1/3 row end-->
                    <div class="divide30"></div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>1/3 Col</h4>
                            <p>
                                Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <h4>1/3 Col</h4>
                            <p>
                                Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <h4>1/3 Col</h4>
                            <p>
                                Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                    </div><!--1/3 row end-->
                    <div class="divide30"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>
                                Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper.
                            </p>
                        </div>
                    </div>
                    <div class="divide60"></div>
                </div>
            </div>
        </div><!--side navigation container-->
        </div>
@endsection

                   
@push('scripts')
    <script src="{{ URL::asset('js/plugins/plugins.js') }}"></script> 
    <script src="{{ URL::asset('js/assan.custom.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
     <!--scripts and plugins -->
    
    <!--bootstrap js plugin-->
    <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>       
    <!--easing plugin for smooth scroll-->
    <script src="{{ URL::asset('js/jquery.easing.1.3.min.js') }}" type="text/javascript"></script>
    <!--sticky header-->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.sticky.js') }}"></script>
    <!--flex slider plugin-->
    <script src="{{ URL::asset('js/jquery.flexslider-min.js')}}" type="text/javascript"></script>
    <!--parallax background plugin-->
    <script src="{{ URL::asset('js/jquery.stellar.min.js')}}" type="text/javascript"></script>

 
    <!--on scroll animation-->
    <script src="{{ URL::asset('js/wow.min.js')}}" type="text/javascript"></script> 
    <!--owl carousel slider-->
    <script src="{{ URL::asset('js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <!--popup js-->
    <script src="{{ URL::asset('js/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>

     <script type="text/javascript">
        function promptLogout() {
            swal({
                title: "{{trans('alerts.modal.welcome.title')}}",
                text: "{{trans('alerts.modal.welcome.description')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: "{{trans('alerts.modal.welcome.option_yes')}}",
                cancelButtonText: "{{trans('alerts.modal.welcome.option_cancel')}}",
                closeOnConfirm: false,
                animation: "slide-from-top",
            },
            function () {
                window.location.replace("{{route('logout-get')}}");
            });            
        }
            
    </script>
@endpush