@extends('templates.t_users')



@section('title')
    @lang('user_site.dashboard.title')
@endsection
@section('css')
        <!-- Plugins CSS -->
        <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
@endsection


@section('content')
 <div class="row">
                <div class="col-lg-3 mb40">
                    <div class="mb40 mt-4">
                        <h4 class="sidebar-title">@lang('user_site.left_menu.role')</h4>
                        <ul class="list-unstyled categories">
                            @role('student')
                                <li><a href="#">@lang('user_site.type.student')</a>
                                    <ul class="list-unstyled">
                                        <li><a href="#">@lang('user_site.left_menu.sub_student.ask_class')</a></li>
                                        <li><a href="#">@lang('user_site.left_menu.sub_student.ask_class')</a></li>
                                        <li><a href="#">@lang('user_site.left_menu.sub_student.ask_class')</a></li>
                                    </ul>
                                </li>
                            @endrole
                            @role('parent')
                                <li><a href="#">@lang('user_site.type.parent')</a></li>
                            @endrole
                            @role('teacher')
                                <li><a href="#">@lang('user_site.type.teacher')</a></li>
                            @endrole
                        </ul>
                    </div><!--/col-->
                    <div>
                        <h4 class="sidebar-title">@lang('user_site.left_menu.next_class')</h4> 
                        <ul class="list-unstyled">
                            <li class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">Beautiful Sofa lamp at low price</a></h5>
                                    April 05, 2017
                                </div>
                            </li>
                            <li class="media my-4">
                                <img class="d-flex mr-3 img-fluid" width="64" src="images/img2.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">We need to change our thinking about others</a></h5>
                                    Jan 05, 2017
                                </div>
                            </li>
                            <li class="media">
                                <img class="d-flex mr-3 img-fluid" width="64" src="images/img5.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">New awesome features of bootstrap 4</a></h5>
                                    March 15, 2017
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col">
                            <h2 class="mb30">Left <strong>Sidebar</strong> page</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.
                            </p>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.
                            </p>                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb20">
                            <img src="images/bg1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.
                        </div>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.
                    </p>
                </div>
            </div>
@endsection

                   
@push('scripts')
    <script src="{{ URL::asset('js/plugins/plugins.js') }}"></script> 
    <script src="{{ URL::asset('js/assan.custom.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>  
@endpush