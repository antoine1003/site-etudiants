@extends('templates.t_users')



@section('title')
    @lang('user_site.dashboard.inbox')
@endsection
@section('css')
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
@endsection


@section('content')       

        <div class="overflow-hidden">
             <div class="container">

            <div class="row">
                <div class="col-sm-3 margin40">
                    <div class="side-nav-wrapper">
                        <h3 class="animated fadeInRight">Conversations</h3>
                        <ul class="list-unstyled side-nav animated flipInX">
                            @foreach ($conversations as $conversation)
                                @if($conn_user->id == $conversation->u1_id)
                                    <li><a href="<?php echo  @route('user.inbox',['id' => $conversation->id]);?>">{{$conversation->u2_nom_complet}} <?php if ($conversation->nb_unread_conv != 0) { echo '<span class="badge">'.$conversation->nb_unread_conv.'</span>';} ?> </a></li>
                                @else
                                    <li><a href="<?php echo  @route('user.inbox',['id' => $conversation->id]);?>">{{$conversation->u1_nom_complet}} <?php if ($conversation->nb_unread_conv != 0) { echo '<span class="badge">'.$conversation->nb_unread_conv.'</span>';} ?>
                                    </a></li>
                                @endif

                            @endforeach
                        </ul>
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
@endpush