@extends('templates.t_users')



@section('title')
    @lang('user_site.dashboard.conversation')
@endsection
@section('css')
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
                        <h4 class="animated fadeIn">Conversation</h4>
                    </div>
                    <div class="col-sm-6 hidden-xs text-right">
                        <ol class="breadcrumb animated fadeIn">
                            <li><a href="index.html">Utilisateur</a></li>
                            <li>Conversation</li>
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
                        <h3 class="animated fadeInRight">Conversations</h3>
                        <ul class="list-unstyled side-nav animated flipInX">
                            @foreach (array_reverse($conversations) as $conversation)
                                @if($conn_user->id == $conversation->u1_id)
                                    <li><a href="<?php echo  @route('user.inbox',['id' => $conversation->id]);?>"><?php echo  $conversation->u2_nom_complet?> <?php if ($conversation->nb_unread_conv != 0) { echo '<span class="badge">'.$conversation->nb_unread_conv.'</span>';} ?> </a></li>
                                @else
                                    <li><a href="<?php echo  @route('user.inbox',['id' => $conversation->id]);?>"><?php echo  $conversation->u1_nom_complet?><?php if ($conversation->nb_unread_conv != 0) { echo '<span class="badge">'.$conversation->nb_unread_conv.'</span>';} ?>
                                    </a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div><!--sidebar col end-->
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <button id="load-more" onclick="loadMoreMessages()" class="btn btn-default text-center load-messages" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i> Charger plus de messages</button>
                            </div>
                            <div class="divide10"></div>
                            @foreach ($messages as $message)
                            <div class="panel panel-default">
                                <div class="panel-body <?php if($conn_user->id != $message->emmeteurs_id){ echo "text-right";} ?> ">
                                 <strong><?php echo  $message->emmeteur;?> </strong><br>
                                   <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{Carbon\Carbon::parse($message->heure_envoi)->format('\\L\\e d/m/Y \\à  G\\hi\\ms\\s') }} <?php if($message->fichiers_id !=null){echo '<br><a href="'.asset('storage/'.$message->chemin) .'"><i class="fa fa-file" aria-hidden="true"></i> '. $message->nom_fichier .'</a>';} ?></span>
                                   <p><?php echo  $message->contenu;?> </p>
                                </div>
                            </div>
                            @endforeach
                            @include('flash::message')
                            <div class="panel panel-default">
                                <div class="panel-body">
                                {!! Form::open(['url' => 'user/inbox','method' => 'POST','files' => true]) !!}
                                {{ csrf_field() }}
                                    <input type="hidden" name="conversations_id" value="<?php echo $conversations_id ?>">
                                    <textarea class="form-control counted" name="contenu" placeholder="Entrer votre message" rows="5" style="margin-bottom:10px;"></textarea>
                                    {!! $errors->first('contenu', '<small class="text-danger help-block">:message</small>') !!}
                                    {!! $errors->first('document', '<small class="text-danger help-block">:message</small>') !!}
                                    <button class="btn btn-info" name="envoyer" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Envoyer</button>
                                    <label class="btn btn-default">
                                        <i class="fa fa-paperclip" style="margin: auto !important;" aria-hidden="true"></i> <input name="document" id="file-input" class="file-input"  accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" type="file" hidden>
                                    </label>
                                     <label id="file-name"></label> <a href="javascript:void" id="remove-file" style="visibility: hidden;"><i class="fa fa-times" aria-hidden="true" ></i></a> 
                                {!! Form::close() !!}
                                </div>
                            </div>
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
       document.getElementById('file-input').onchange = function () {
            alert('message?: DOMString');
            var fullPath = this.value;
            var filename = fullPath.replace(/^.*[\\\/]/, '');

            document.getElementById('file-name').innerHTML  = filename;

            document.getElementById('remove-file').style.visibility = 'visible';
        };

        document.getElementById('remove-file').onclick = function () {            
            document.getElementById('remove-file').style.visibility = 'hidden';
            document.getElementById("file-name").innerHTML = "";
            document.getElementById("file-input").value = "";
        };

    </script>
    <script type="text/javascript">        
        function loadMoreMessages() {  
            windows.location =  <?php echo @route('user.inbox',['id' => $conversations_id,'nb_message' => $nb_messages +5]); ?>;
        };            
    </script>
@endpush