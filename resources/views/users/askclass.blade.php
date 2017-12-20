@extends('templates.t_users')



@section('title')
    {{$breadcrumb_title}}
@endsection
@section('css')
    <link href="{{ URL::asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
                        @role('teacher')
                        <ul class="list-unstyled side-nav">
                            <h3 class="text-gray ">Professeur</h3>
                            <li><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>Mes prochains cours</a></li>
                            <li><a href="#"><i class="fa fa-users"></i> Mes élèves</a></li>
                        </ul>
                        @endrole
                        @role('student')
                        <ul class="list-unstyled side-nav">
                            <h3 class="text-gray ">@lang('user_site.type.student')</h3>
                            <li><a href="#"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>Mes prochains Cours</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i> Demander un cours</a></li>
                            <li><a href="#"><i class="fa fa-book"></i> Mes devoirs</a></li>
                        </ul>
                        @endrole
                    </div>
                </div><!--sidebar col end-->
                <div class="col-sm-9">
                    <div class="divide80"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('flash::message')

                {!! Form::open(['url' => 'user/askClass','method' => 'POST', 'class' => 'form-horizontal', 'style' => 'margin-bottom: 50px;']) !!}
                {{ csrf_field() }}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="title">Titre</label>
                      <div class="col-md-4">
                      <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required="">
                      <span class="help-block">Ex: Cours Antoine</span>
                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="professeur">Professeur</label>
                      <div class="col-md-4">
                        <select id="professeur" name="professeur" class="form-control">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="date">Début</label>
                      <div class="col-md-4">
                        <div class="input-group date form_datetime">
                          <input size="16" type="text" name="date" value="" class="form-control" required readonly>
                          <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                        </div>
                      </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="duration">Durée (min)</label>
                      <div class="col-md-2">
                            <input max="240" min="0" type="number" id="duration" name="duration" class="form-control" required="">
                      </div>
                      <div class="col-md-2">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            &nbsp;<label id="hours-min">0min</label>
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="submit"></label>
                      <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-success">Envoyer</button>
                      </div>
                    </div>
                </fieldset>
                 {!! Form::close() !!}

                </div>
            </div>
        </div><!--side navigation container-->
        </div>
@endsection


@push('scripts')
    <script src="{{ URL::asset('js/datetimepicker/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/datetimepicker/locales/bootstrap-datetimepicker.fr.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var dt = new Date();
        $(".form_datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            startDate: dt,
        });
        $( "#duration" ).change(function() {
            var hours = Math.floor( $('#duration').val() / 60);          
            var minutes = $('#duration').val() % 60;
            if (hours == '0') {
                $('#hours-min').html(minutes + 'min');
            }
            else
            {
                $('#hours-min').html(hours + 'h' + minutes + 'min');
            }
            
        });
        
    </script>
@endpush
