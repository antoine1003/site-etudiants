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
                                <button id="load-more" onclick="loadMoreMessages()" data-conv_id="{{$conversations_id}}" data-nb_mess="{{$nb_messages}}" class="btn btn-default text-center mt-2" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i> Charger plus de messages</button>
                            </div>
                            <div class="divide10"></div>
                            @if(count($messages) > 0)
                                @foreach ($messages as $message)
                                <div class="panel panel-default">
                                    <div class="panel-body <?php if($conn_user->id != $message->emmeteurs_id){ echo "text-right";} ?> ">
                                     <strong><?php echo  $message->emmeteur;?> </strong><br>
                                       <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{Carbon\Carbon::parse($message->heure_envoi)->format('\\L\\e d/m/Y \\à  G\\hi\\ms\\s') }} <?php if($message->fichiers_id !=null){echo '<br><a href="'.asset('storage/'.$message->chemin) .'"><i class="fa fa-file" aria-hidden="true"></i> '. $message->nom_fichier .'</a>';} ?></span>
                                       <p><?php echo  $message->contenu;?> </p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="panel-body">
                                    <strong class="text-center">Vous n'avez pas encore échangé avec ce membre.</strong>
                                </div>
                            @endif
                            @include('flash::message')
                            <div class="panel panel-default">
                                <div class="panel-body">
                                {!! Form::open(['url' => 'user/inbox','method' => 'POST','files' => true]) !!}
                                {{ csrf_field() }}
                                    <input type="hidden" name="conversations_id" value="<?php echo $conversations_id ?>">

                                    <textarea class="form-control counted" name="contenu" data-emojiable="true" placeholder="Entrer votre message" rows="5" style="margin-bottom:10px;"></textarea>
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
     <script type="text/javascript">        
       document.getElementById('file-input').onchange = function () {
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
            var button = document.getElementById('load-more');
            var conv_id = button.dataset.conv_id;
            var nb_mess_update = parseInt(button.dataset.nb_mess)+5;
            window.location.replace(APP_URL + '/user/inbox/'+ conv_id + '/' + nb_mess_update);
        };            
    </script>
@endpush