@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
@stop
@section('nav')
@include('layouts.nav')
@stop
@section('content')

     <div class="row">
        <div class="panel panel-default">
		    <div class="panel-heading"><button class="btn btn-primary btn-block">Events</button></div>
	        <div class="panel-body">
                    {!! $calendar->calendar() !!}        
            </div>
        </div>    
     </div>

@endsection


@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@stop