@extends('templates.t_users')



@section('title')
    {{$breadcrumb_title}}
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
             <div class="col-md-5  col-md-offset-3 ">
                <p class=" text-info"><strong>Dernière modification</strong> {{Carbon\Carbon::parse(Auth::user()->updated_at)->format('\\l\\e d/m/Y \\à  G\\hi')}} </p>
             </div>
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
               @include('flash::message')
                <div class="panel panel-info">
                   <div class="panel-heading">
                      <h3 class="panel-title">{{Auth::user()->prenom. ' ' . Auth::user()->nom}}</h3>
                   </div>
                   <div class="panel-body">
                      <div class="row">                        
                         <div class=" col-md-12 col-lg-12 ">
                            <table class="table">
                               <tbody>
                                  <tr>
                                     <td>Adresse mail</td>
                                     <td>{{Auth::user()->email}}</td>
                                  </tr>
                                  <tr>
                                     <td>Ville:</td>
                                     <td>{{Auth::user()->ville}}</td>
                                  </tr>
                                  <tr>
                                     <td>Téléphone</td>
                                     <td><?php  if(Auth::user()->phone != null){ echo Auth::user()->phone;}else{echo "Téléphone non renseigné";} ?></td>
                                  </tr>
                                  <tr>
                                  <tr>
                                     <td>Mon rôle</td>
                                     <td>
                                        @role('teacher')
                                            <span class="label label-info">Professeur</span>
                                        @endrole
                                        @role('student')
                                            <span class="label label-warning">Elève</span>
                                        @endrole
                                        @role('parent')
                                            <span class="label label-warning">Parent</span>
                                        @endrole
                                     </td>
                                  </tr>
                                  <tr>
                                     <td>Date d'inscription</td>
                                     <td>{{Carbon\Carbon::parse(Auth::user()->created_at)->format('\\l\\e d/m/Y \\à  G\\hi')}}</td>
                                  </tr>
                                 
                               </tbody>
                            </table>
                         </div>
                      </div>
                   </div>
                   <div class="panel-footer text-center">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalMdp"><i class="fa fa-key" aria-hidden="true"></i> Changer mot de passe</a>
                    </div>
                </div>
             </div>
          </div>
       </div>
    </div>

    <div class="modal fade" id="myModalMdp" tabindex="-1" role="dialog" style="margin-top: 60px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Changer mon mot de passe</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            {!! Form::open(['url' => 'user/changePassword','id' => 'change-password','method' => 'POST', 'class' => 'form-horizontal']) !!}
            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="old_password">Ancien mot de passe</label>
              <div class="col-md-4">
                <input id="old_password" name="old_password" type="password" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="password">Nouveau mot de passe</label>
              <div class="col-md-4">
                <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="comfirmation_password">Confirmation</label>
              <div class="col-md-4">
                <input id="comfirmation_password" name="comfirmation_password" type="password" placeholder="" class="form-control input-md" required="">
                
              </div>
            </div>
            <div class="form-group">  
              <label class="col-md-4 control-label"></label>
              <div class="col-md-8">
                <button name="submit" type="submit" class="btn btn-success">Modifier</button>
              </div>
            </div>
            {!! Form::close() !!}
        </div>            
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@push('scripts')
 <script src="{{ URL::asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
 <script>
jQuery(document).ready(function() {
   jQuery("#change-password").validate({
      rules: {
        password : {
            minlength : 6
        },
        comfirmation_password : {
            minlength : 6,
            equalTo : "#password"
        },
        old_password: {
            minlength : 6,
        },
  },
});
   jQuery.extend(jQuery.validator.messages, {
    required: "Ce champs est obligatoire.",
    equalTo: "Les deux mots de passe ne sont pas identiques !",
    minlength: jQuery.validator.format("Le mot de passe doit faire plus de {0} caractères !"),
  });
});

</script>
@endpush
