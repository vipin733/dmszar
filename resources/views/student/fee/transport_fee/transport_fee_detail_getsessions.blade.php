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
		     @foreach($transports as $transport)
		      <li><a href="/student/transport/fee_detail/{{$transport->asessions['id']}}/{{strtotime($transport->asessions['created_at'])}}">{{ $transport->asessions['name'] }}</a></li>
		     @endforeach 
		    </ul>
		  </div>
	    </div>
	</div> 
  </div>   

@stop    

