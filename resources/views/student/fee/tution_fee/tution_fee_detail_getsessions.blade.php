@extends('layouts.app')
@section('nav')
@include('student.student_nav')
@stop
@section('content')

  <div class="row">
	<div class="col-md-12">
	    <div class="text-center">
			<div class="dropdown btn-group">
			  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">  --Select Session
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
			    @foreach($tutions as $tution)
			    <li> <a href="/student/tution/fee_detail/{{$tution->asessions['id']}}/{{strtotime($tution->asessions['created_at'])}}">{{ $tution->asessions['name'] }}</a></li>
		        @endforeach
			  </ul>
			</div>
	    </div>
	</div> 
  </div>  


@stop    

