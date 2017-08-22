@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')


  <div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
              <div class="panel-heading">
              <a href="/notification/index" class="btn btn-warning btn-block">Back</a>
               <button class="btn btn-primary btn-block">Notifications</button>
              </div>
               <div class="panel-body">
               
                <div class="col-sm-12 notification">
                   <h4><b>{{ $notification->title }}</b></h4>
                  <p class="pull-right">Posted at {{ $notification->created_at->format('d/m/Y h:i A') }}</p>
                  <p>{{ $notification->notifications_categories['name'] }}</p>
                  {!! $notification->notification_body !!}
                </div>
  			       
		           </div>
		    </div>
    </div>
     
   </div>

@stop  