@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

  <div class="row">
	<div class="col-md-12">
	    <div class="text-center">
	      <div class="dropdown btn-group">
		    <a class="btn dropdown-toggle btn-primary" data-toggle="dropdown" href="#">
		      --Select Session
		    </a>
		    <ul class="dropdown-menu">
		     @foreach($sessions as $session)
		      <li><a href="/st/student/{{$session->asessions['id']}}/{{strtotime($session->asessions['created_at'])}}/exam_marks/{{ $student['reg_no'] }}/get_exam_marks">{{ $session->asessions['name'] }}</a></li>
		     @endforeach 
		    </ul>
		  </div>
	    </div>
	</div> 
  </div>   

@stop 