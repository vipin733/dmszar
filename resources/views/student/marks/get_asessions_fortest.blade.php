@extends('layouts.app')
@section('nav')
@include('student.student_nav')
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
		     @foreach($asessions as $asession)
		      <li><a href="/student/test_marks/{{$asession->asessions['id']}}/{{strtotime($asession->asessions['created_at'])}}">{{ $asession->asessions['name'] }}</a></li>
		     @endforeach 
		    </ul>
		  </div>
	    </div>
	</div> 
  </div>   

@stop    

