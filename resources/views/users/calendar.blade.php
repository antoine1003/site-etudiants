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
                <div class="panel panel-default mt-2">
                    <div class="panel-body" >
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div><!--side navigation container-->
        </div>
@endsection

                   
@push('scripts')
<script src="{{ URL::asset('js/jquery-dateFormat.min.js') }}"></script>
<script src="{{ URL::asset('js/fullcalendar/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('js/fullcalendar/fr.js') }}"></script>
{!! $calendar->script() !!}
@endpush