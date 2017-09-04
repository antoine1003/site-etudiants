    @extends('templates.t_welcome')



    @section('title')
        @lang('user_site.welcome.title', ['number' => '2'])
    @endsection
    @section('css')
            <!-- Plugins CSS -->
            <link href="{{ URL::asset('css/plugins/plugins.css') }}" rel="stylesheet">
            <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
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
                        {!! Form::open(['url' => 'user/welcome/3/student','method' => 'GET','id' => 'mainform']) !!}
                        {{ csrf_field() }}                          
                                <fieldset id="fieldsetSelect">
                                <label for="exampleSelect1" class="text-white">@lang('user_site.welcome.two.student.class')</label>
                                <div class="form-group">                                    
                                        <div class="input-group">
                                            <select name="classe" class="form-control" id="classesSelect">
                                                @foreach ($categories as $categorie)
                                                    <optgroup label="{{$categorie->nom_categorie}}">
                                                        @foreach ($classes as $classe)
                                                            @if($classe->nom_categorie == $categorie->nom_categorie)
                                                                <option value="{{$categorie->nom_categorie.'$'.$classe->nom_classe}}">{{$classe->nom_classe}}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="hdn_classe" name="classe" disabled="disabled" />
                                            <div id="cancelClassDiv" class="input-group-addon" style="display: none;">
                                                <a id="cancelClassLink" href="" data-toggle="tooltip" data-animation="false" data-placement="top" title="@lang('user_site.welcome.two.student.cancel')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>                                        
                                        </div>
                                    <a id="linkAddClass" href="" class="text-white" data-toggle="modal" data-target="#gridSystemModal">@lang('user_site.welcome.two.student.dontfindclass')</a><br>
                                    <input type="submit" value="Suivant" class="btn btn-info mt-3">
                                </fieldset>
                                </div>
                            {!! Form::close() !!} 
                        </div>
                    </div>                    
                </div>
            </div>


                <!-- MODAL -->
                <div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="gridModalLabel">@lang('user_site.welcome.two.student.addclasstitle')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="container-fluid bd-example-row">
                                <div class="row">
                                    <div class="col-md-4">@lang('user_site.welcome.two.student.category')</div>
                                    <div class="col-md-6" id="divDefault">
                                        <div class="input-group">
                                             <select class="form-control form-control-sm" id="categorieSelect">
                                                @foreach ($categories as $categorie)  
                                                    <option>{{$categorie->nom_categorie}}</option>
                                                @endforeach
                                            </select>                                            
                                            <div class="input-group-addon form-control-sm">
                                                <a id="addCategorielink" data-toggle="tooltip" data-animation="false" data-placement="top" title="@lang('user_site.welcome.two.student.dontfindcategorie')" onclick="handleCategories()" href="javascript:void(0);" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="divAddCat" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="caterorieModal" id="addCatInput">
                                            <div class="input-group-addon form-control-sm">
                                                <a id="addCategorielink" data-toggle="tooltip" data-animation="false" data-placement="top" title="@lang('user_site.welcome.two.student.cancel')" onclick="handleCategories()" href="javascript:void(0);" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">@lang('user_site.welcome.two.student.classname')</div>
                                    <div class="col-md-6"><input type="text" name="classadd" id="classadd" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div id="errdiv" class="col-md-12" style="display: none;">
                                    <small class="help-block text-danger" id="errMessage"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('user_site.welcome.two.student.cancel')</button>
                        <button type="button" class="btn btn-primary" id="validateclass"  onclick="checkInput()">@lang('user_site.welcome.two.student.validate')</button>
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

        <script type="text/javascript">
        var newClassHasBeenAdd;
        var newCatHasBeenAdd = false;
        /**
         * Check and add the new
         * @return none
         */
        function checkInput() {
            var classeStr = document.getElementById('classadd').value;

            if (classeStr.trim() == '') {
                document.getElementById('errdiv').style.display = 'block';
                document.getElementById('errMessage').innerHTML = "@lang('user_site.welcome.two.student.classempty')";
            }
            else
            {
                document.getElementById('errdiv').style.display = 'none';
                if (!newCatHasBeenAdd) {                    
                    var categorie = document.getElementById("categorieSelect");
                    categorieStr = categorie.options[categorie.selectedIndex].value;
                }
                else
                {
                    categorieStr = document.getElementById("addCatInput").value;
                }
                if (categorieExist(categorieStr)) {
                    document.getElementById('cancelClassDiv').style.display = 'block';
                    document.getElementById('errMessage').innerHTML = "@lang('user_site.welcome.two.student.categoryalreadyexist')";

                }else {
                    var classesSelect = document.getElementById('classesSelect');
                    var optGroup = document.createElement('optgroup');
                    optGroup.label = categorieStr;
                    classesSelect.appendChild(optGroup);
                    var opt = document.createElement('option');
                    opt.setAttribute("value", categorieStr + '$' + classeStr);
                    opt.setAttribute("selected", "selected"); 
                    opt.innerHTML = classeStr;
                    optGroup.appendChild(opt);
                    classesSelect.setAttribute("disabled", "true");
                    var select_val = $('#classesSelect option:selected').val();
                    $('#hdn_classe').removeAttr("disabled");
                    $('#hdn_classe').val(select_val);
                    $('#fieldsetSelect option:last').prop('selected',true);
                    newClassHasBeenAdd = true;
                    document.getElementById('cancelClassDiv').style.display = 'block';
                    $('#gridSystemModal').modal('hide');
                }                
            }
        }

        $("#cancelClassLink").on('click', function(event) {
            if (newClassHasBeenAdd) {
                $('#fieldsetSelect option:last').remove();            
                document.getElementById('cancelClassDiv').style.display = 'none';
                fieldsetSelect.removeAttr("disabled");
            }
        });

        /**
         * Display the right div according the situation
         * @return {bool} true or false
         */
        function handleCategories() {
            if (newCatHasBeenAdd) {
                newCatHasBeenAdd = false;
                document.getElementById('divDefault').style.display = 'block';
                document.getElementById('divAddCat').style.display = 'none';
            }
            else{
                newCatHasBeenAdd = true;
                document.getElementById('divDefault').style.display = 'none';
                document.getElementById('divAddCat').style.display = 'block';
            }
        }

        /**
         * Check if a categorie already exists
         * @param  {string} value Category to check
         * @return {bool}
         */
        function categorieExist(value) {
            var allCat = [@foreach($categories as $categorie)
               '{{ htmlspecialchars_decode($categorie->nom_categorie)}}',
                @endforeach ];

            var exist = false;
            allCat.forEach(function(element) {
              if(element == value){
                exist = true;
              }
            });
        }
        </script>
        <script type="text/javascript">
            $('[data-toggle="tooltip"]').tooltip({
                trigger : 'hover'
            });
        </script>
    @endpush