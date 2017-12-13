@extends('templates.t_users')



@section('title')
    @lang('user_site.dashboard.calendar')
@endsection
@section('css')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.print.css" media="print"/>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
@endsection


@section('content')
        <div class="overflow-hidden">
             <div class="container">

            <div class="row">
                 {!! $calendar->calendar() !!}
    
            </div>
        </div><!--side navigation container-->
        </div>
@endsection

                   
@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
{!! $calendar->script() !!}

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